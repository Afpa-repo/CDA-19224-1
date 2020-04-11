#!/usr/bin/env bash

# Loads the file with all the variables
source $(pwd)/scripts/variables.sh

# Load the file with all the utilities functions
source $(pwd)/scripts/functions.sh

# Load the file with all the needed verifications functions
source $(pwd)/scripts/verifications.sh

### Créer une fonction pour envoyer mail
### TODO

function run_command() {
    # If the 1st arg is equal to 2nd arg (redirects all inputs to /dev/null)
    if [ $1 = $2 ] &>/dev/null; then
        # Executes the first arg
        $1
        # Exits with code 0 (Nothing gone wrong)
        exit 0
    # Else if the user don't give a command
    elif [ $# -ne 2 ]; then
        # Prints an error message
        error_text "Vous devez donner une commande à executer."
        # Exits the script with code 2 (Bad Usage)
        exit 2
    fi
}

function help() {
    info_text "Chaudron - Version ${VERSION}"
    echo -e "Bienvenue ${UNDERLINE}${USER}${RMUNDERLINE}"

    sleep 0.5

    echo "Que puis-je faire pour vous ?"

    help_text "fix" "Permet de fix le PHP et le CSS."
    help_text "fixtures" "Permet de générer les fixtures."
    help_text "help" "Affiche la liste des commandes."
    help_text "reset" "Permet de remettre la base de données à zéro."
    help_text "upgrade" "Permet de mettre à jour toutes les dépendances."
    help_text "setup" "Permet de mettre en place le projet quand il vient d'être cloné."
    help_text "sql" "Permet de lancer des query SQL sur la base de données."
    help_text "start" "Lance le projet."
}

function fix() {
    verify_php
    verify_node

    $YARN php:lint
    $YARN php:fix
    $YARN css:fix
}

function fixtures() {
    verify_php

    $CONSOLE doctrine:fixtures:load -n
}

function reset() {
    $CONSOLE doctrine:database:drop --force
    $CONSOLE doctrine:database:create

    rm -rf ./src/Migrations/*.php

    if [ $? -eq 0 ]; then
        info_text "Les migrations on été supprimées avec succès."
    else
        error_text "MigrationError: Les migrations n'ont pas pu être supprimées."
        exit 1
    fi

    $CONSOLE make:migration
    $CONSOLE doctrine:migrations:migrate -n
}

function upgrade() {
    verify_composer
    verify_node

    info_text "Ctrl + C si vous ne voulez pas mettre à jour les dépendances avec Yarn."

    $YARN upgrade-interactive --latest
    composer upgrade
}

function setup() {
    verify_composer
    verify_php
    verify_node

    copy
    generate_secret

    question_text "Voulez vous installer les dépendances de Composer ?"
    read INS_COMPOSER

    if [[ $INS_COMPOSER =~ ^y ]]; then
        composer install
    fi

    question_text "Voulez vous installer les dépendences de Node.js ?"
    read INS_NODE

    if [[ $INS_NODE =~ ^y ]]; then
        $YARN install
    fi

    question_text "Voulez vous modifier DATABASE_URL dans le fichier .env ?"
    read INS_ENV

    if [[ $INS_NODE =~ ^y ]]; then
        info_text "Username de la BDD:"
        read DATABASE_USER

        info_text "Password de la BDD:"
        read DATABASE_PASSWORD

        info_text "Port de la BDD:"
        read DATABASE_PORT

        replace_in_file "s|^DATABASE_URL=.*|DATABASE_URL=mysql://${DATABASE_USER}:${DATABASE_PASSWORD}@127.0.0.1:${DATABASE_PORT}/ct404_diagonalley?serverVersion=5.7|" ".env"

        question_text "Voulez vous lancer les migrations ?"
        read MIGRATIONS

        if [[ $MIGRATIONS =~ ^y ]]; then
            reset
        fi
    fi
}

function sql() {
    verify_php

    info_text "Entrez la query SQL que vous voulez executer."
    read QUERY

    $CONSOLE doctrine:query:sql "$QUERY"
}

function start() {
    verify_all

    question_text "Voulez vous build les assets avec Webpack Encore ?"
    read BUILD

    if [[ $BUILD =~ ^y ]]; then
        question_text "Voulez vous lancer la version dev ?"
        read ENV

        if [[ $ENV =~ ^y ]]; then
            $YARN dev
        else
            $YARN build
        fi
    fi

    symfony server:start &
    $YARN maildev
}

# For each command in the commands array
for COMMAND in ${COMMANDS[@]}; do
    # Verify if it's an existing command in the COMMANDS array (variables.sh)
    if [[ ! " ${COMMANDS[@]} " =~ " $1 " ]]; then
        error_text "La commande ${1} n'existe pas."
        # Exits the script with code 127 (Command not found)
        exit 127
    else
        # Call the run_command with the user given command and the current command in the array
        run_command $1 $COMMAND
    fi
done

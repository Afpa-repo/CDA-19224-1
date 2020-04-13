#!/usr/bin/env bash

# ------------------- Text -------------------
function error_text() {
    # If the arguments count is not equal to 1
    if [ $# -ne 1 ]; then
        # Prints an error message
        call_stack
        echo -e "ArgumentError: 1 argument attendu ${#} arguments donnés.${RESET}"
        # Exits the script with code 2 (Bad Usage)
        exit 2
    else
        # Otherwise just print the message with the right formatting
        echo -e "${WHITE}${REDBG}${BOLD}${1}${RESET}"
    fi
}

function help_text() {
    # If the arguments count is not equal to 2
    if [ $# -ne 2 ]; then
        # Prints an error message
        call_stack
        echo -e "ArgumentError: 2 argument attendu ${#} arguments donnés.${RESET}"
        # Exits the script with code 2 (Bad Usage)
        exit 2
    else
        # Otherwise just print the message with the right formatting
        echo -e "${WHITE}$(tput setab $((RANDOM % 7)))${BOLD}${1}${RESET} - ${2}"
    fi
}

function info_text() {
    # If the arguments count is not equal to 1
    if [ $# -ne 1 ]; then
        # Prints an error message
        call_stack
        echo -e "ArgumentError: 1 argument attendu ${#} arguments donnés.${RESET}"
        # Exits the script with code 2 (Bad Usage)
        exit 2
    else
        # Otherwise just print the message with the right formatting
        echo -e "${WHITE}${BLUEBG}${BOLD}${1}${RESET}"
    fi
}

function question_text() {
    # If the arguments count is not equal to 1
    if [ $# -ne 1 ]; then
        # Prints an error message
        call_stack
        echo -e "ArgumentError: 1 argument attendu ${#} arguments donnés.${RESET}"
        # Exits the script with code 2 (Bad Usage)
        exit 2
    else
        # Otherwise just print the message with the right formatting
        echo -e "${WHITE}${YELLOWBG}${BOLD}${1} [y/n]${RESET}"
    fi
}

# ------------------- Utils -------------------
function call_stack() {
    echo -e | cat <<-END
${WHITE}${REDBG}${BOLD}
Fonction: ${FUNCNAME[1]}
Fichier: ${BASH_SOURCE}
Ligne: ${BASH_LINENO}
END
}

function copy() {
    # If the .env don't exists yet
    if [ ! -f .env ]; then
        # Copy .env.test into .env
        cp .env.test .env

        # If the exit code is 0
        if [ $? -eq 0 ]; then
            # Nothing went wrong and we tell the user
            info_text "Le fichier .env a été crée."
        # Otherwise
        else
            # Something went wrong and we tell the user
            error_text "CopyError: Le fichier .env n'a pas pu être créer."
            exit 1
        fi
    fi
}

function generate_secret() {
    replace_in_file "s|APP_SECRET=.*|APP_SECRET=${SECRET}|" ".env"
}

function replace_in_file() {
    if [ "$OS" = 'Darwin' ]; then
        sed -i '' -e "$1" "$2"
    else
        sed -i'' -e "$1" "$2"
    fi
}

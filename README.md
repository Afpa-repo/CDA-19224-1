# Chemin de Traverse

## Clone du projet

Pour clonez le projet executez la commande suivante

```shell script
git clone https://github.com/Afpa-repo/CDA-19224-1.git
```

Ou si vous voulez la version ssh

```shell script
git clone git@github.com:Afpa-repo/CDA-19224-1.git
```

## Mise en place du projet

Vous avez deux options.
Mettre le projet en place manuellement ou utiliser Chaudron l'outil spécialement crée pour ce projet !

### Mise en place avec Chaudron

Tout d'abord executons le script.

```shell script
chmod +x bin/chaudron # Rends le script executable
bin/chaudron help
```

La commande help va vous donner la liste des commandes disponibles.

Nous allons utiliser la commande setup pour mettre le projet en place

```shell script
bin/chaudron setup
```

Chaudron va vous guider pour vous permettre de mettre en place le projet !

### Mise en place manuelle

Tout d'abord veuillez créer un fichier .env (Copier le .env.test c'est plus rapide)
Puis remplissez les champs vides ! 

Maintenant vous devez installer les dépendances.
On va commencer avec composer

```shell script
composer install
```

Ensuite on va installer les dépendances de Yarn.
Pour cette étape vous allez avoir besoin de [Node.js](https://nodejs.org/en/)

```shell script
.yarn/releases/yarn-1.22.4.js install
```

Maintenant qu'on a toutes les dépendances il va falloir build les assets du projet avec Webpack Encore!

Si vous êtes en environnement de développement

```shell script
.yarn/releases/yarn-1.22.4.js dev
```

Si vous êtes en environnement de production

```shell script
.yarn/releases/yarn-1.22.4.js build
```

## Quelques commandes utiles

Pour pouvoir utiliser PHPCSFixer sur les fichiers du projet executez la commande suivante

```shell script
.yarn/releases/yarn-1.22.4.js php:fix
```

Pour pouvoir utiliser la fonction fix de [Stylelint](https://stylelint.io/) executez la commande suivante

```shell script
.yarn/releases/yarn-1.22.4.js css:fix
```

## TODO

-   Automatiser le php:fix et le css:fix avant de commit (Husky, pre-commit hooks, lint-staged)
-   Ajouter eslint pour linter le javascript

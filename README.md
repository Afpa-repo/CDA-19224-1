# Pour lancer le projet

## Pensez à installer les dépendances de composer

```shell script
composer install
```

## Renommez le fichier .env.test en .env

Renommez le fichier .env.test en .env et remplissez les valeurs vides

## Build les assets avec Webpack Encore

Vous devez installer [Node.js](https://nodejs.org/en/) pour cette étape

Pour build les assets lancez ces commandes

```shell script
.yarn/releases/yarn-1.22.4.js install
.yarn/releases/yarn-1.22.4.js build
```

## Utiliser PHPCSFixer

```shell script
.yarn/releases/yarn-1-22.4.js fix
```
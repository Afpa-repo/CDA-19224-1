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

## Chaudron - CLI
Pour pouvoir utiliser Chaudron il va falloir rendre le script executable

```shell script
# Une seule fois suffit 
# Pas besoin de le refaire à chaque fois !
chmod +x ./chaudron
```

Vous pouvez ensuite utiliser Chaudron !

```shell script
# Pour reset la BDD
# Utile quand on a des problèmes de migrations ou autres
./chaudron reset

# Pour avoir la liste des commandes
./chaudron list
```

## TODO
- Automatiser le php:fix et le css:fix avant de commit (Husky, pre-commit hooks, lint-staged)
- 
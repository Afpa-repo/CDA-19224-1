#!/usr/bin/env bash

# List variables (Array like)
COMMANDS=(fix fixtures reset upgrade start setup sql help)

# Colors variables
BOLD=$(tput bold)
BLUEBG=$(tput setab 4)
GREENBG=$(tput setab 2)
REDBG=$(tput setab 1)
YELLOWBG=$(tput setab 3)
RESET=$(tput sgr0)
UNDERLINE=$(tput smul)
RMUNDERLINE=$(tput rmul)
WHITE=$(tput setaf 7)

# Utils Variables
CONSOLE="php bin/console"
YARN=".yarn/releases/yarn-1.22.4.js"
OS="uname"
SECRET=$(date | md5sum | base64)

# Chaudron's Version
VERSION=2.0.0

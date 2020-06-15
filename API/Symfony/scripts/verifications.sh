#!/usr/bin/env bash

# Prints an error message if the user don't have Composer
function verify_composer() {
    if [ command -v composer ] >/dev/null 2>&1; then
        error_text "NotFoundError: Vous devez avoir Composer pour lancer cette commande."
        exit 1
    fi
}

# Prints an error message if the user don't have PHP
function verify_php() {
    if [ command -v php ] >/dev/null 2>&1; then
        error_text "NotFoundError: Vous devez avoir PHP pour lancer cette commande."
        exit 1
    fi
}

# Prints an error message if the user don't have Node.js
function verify_node() {
    if [ command -v node ] >/dev/null 2>&1; then
        error_text "NotFoundError: Vous devez avoir Node.js pour lancer cette commande."
        exit 1
    fi
}

# Prints an error message if the user don't have Symfony
function verify_symfony() {
    if [ command -v symfony ] >/dev/null 2>&1; then
        error_text "NotFoundError: Vous devez avoir Symfony pour lancer cette commande."
        exit 1
    fi
}

# Prints an error message if the user don't have all of the verify functions
function verify_all() {
    verify_composer
    verify_node
    verify_php
    verify_symfony
}
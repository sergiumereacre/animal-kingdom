#!/bin/bash

FLAG=$1
FLAG_HELP="help"
FLAG_INSTALL="install"
FLAG_KILL="kill"
FLAG_SEED="seed"
FLAG_START="start"
FLAG_REFRESH="refresh"
SAIL="./vendor/bin/sail"

if [[ "$FLAG" = "$FLAG_START" ]]; then
    echo "running npm dev"
    $SAIL npm run dev

elif [[ "$FLAG" = "$FLAG_KILL" ]]; then
    echo "setting sail down"
    $SAIL down

elif [[ "$FLAG" = "$FLAG_REFRESH" ]]; then
    echo "refreshing database"
    $SAIL artisan migrate:fresh

elif [[ "$FLAG" = "$FLAG_SEED" ]]; then
    echo "seeding database"
    $SAIL artisan db:seed

elif [[ "$FLAG" = "$FLAG_INSTALL" ]]; then
    echo "installing dependencies via docker"
    docker run --rm \
      -u "$(id -u):$(id -g)" \
      -v "$(pwd):/var/www/html" \
      -w /var/www/html \
      laravelsail/php82-composer:latest \
      composer install --ignore-platform-reqs

    echo "running sail up -d"
    $SAIL up -d

    echo "migrating tables"
    $SAIL artisan migrate:fresh --seed

    echo "installing npm"
    $SAIL npm install

else
    echo usage: prog command
    echo commands:
    echo $'\t'$FLAG_HELP$'\t'outputs list of commands
    echo $'\t'$FLAG_START$'\t'initialises sail process
    echo $'\t'$FLAG_SEED$'\t'seeds the database
    echo $'\t'$FLAG_KILL$'\t'kills sail process
    echo $'\t'$FLAG_REFRESH$'\t'wipes changes made to database
fi
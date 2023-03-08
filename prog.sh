#!/bin/bash

FLAG=$1
SAIL="./vendor/bin/sail"

if [[ -z "$FLAG" || "$FLAG" = "help" ]]; then
    echo "usage: prog command"
    echo "  commands:"
    echo "    help     outputs list of commands"
    echo "    start    initialises the application"
    echo "    kill     kills sail process"
    echo "    reset    wipes changes made to database"
fi

if [[ "$FLAG" = "start" ]]; then
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
    $SAIL artisan migrate

    echo "installing npm"
    $SAIL npm install

    echo "running npm dev"
    $SAIL npm run dev
fi

if [[ "$FLAG" = "kill" ]]; then
    echo "setting sail down"
    $SAIL down
fi

if [[ "$FLAG" = "reset" ]]; then
    echo "resetting database"
    $SAIL artisan migrate:reset
fi

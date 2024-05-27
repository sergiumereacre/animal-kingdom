<p align="center">
    <img src="https://i.ibb.co/kh1Mvgw/Logo.png" width="400" height="400"/>
</p>


# About Animal-Kingdom

Using docker to set up the project with containers that include laravel-sail, mysql and phpmyadmin to view mysql data tables and get a better GUI feel.

Pre-requisites:
- WSL 2
- Docker Desktop

Uses the following docker containers:
- sail/app
- phpmyadmin
- mysql

# Using prog.sh
prog.sh is a helper file included in this project. It gives succint aliases for some artisan commands.
To run the application.
```bash
./prog.sh start
```

To end the application.
```bash
./prog.sh kill
```

To clear the database.
```bash
./prog.sh refresh
```

To seed the database.
```bash
./prog.sh seed
```

To install the requirements (equivalent to steps 5-9 of the installation guide):
```bash
./prog.sh install
```

# Basic Sail Commands

Running laravel docker.
```bash
./vendor/bin/sail up
```

Killing laravel docker.
```bash
./vendor/bin/sail stop
```

You can set up an alias by running this command:
```
`alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'`
```

Now, you don't need to type any of the vendor/bin stuff. You can just type something like `sail up`

# Windows Project Setup

Use the following steps to set up the project repository. Run all of these commands inside the project folder in WSL. You can also set up an alias so that you don't need to do ```./vendor/bin/sail``` every time.

1. Make sure to install <a href="https://learn.microsoft.com/en-us/windows/wsl/install">**WSL**</a> and <a href="https://www.docker.com/">**Docker Desktop**</a>.
2. Clone the project repository into the **/etc/home/[username]** directory after you open up wsl.
3. To make it easier you can run vscode in that repository by opening WSL and running the command ```code .```
4. Open up docker desktop and make sure that these are enabled. <p><img src="https://i.ibb.co/ckJpCtf/Docker-Desktop-hi-Dg-Tax0-WD.png"/></p> <img src="https://i.ibb.co/9GmZT73/Docker-Desktop-k-BB1ud-Hh-W6.png"/>
5. Run the following command to install the composer dependencies. 
``` bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs 
```
6. Then try to run sail.
``` bash
./vendor/bin/sail up
```
7. Migrate the artisan database tables.
``` bash
./vendor/bin/sail artisan migrate
```

If you want to set up a clean database with some pre-made entries, run the following command:
``` bash
./vendor/bin/sail artisan migrate:fresh --seed
```
8. Run the npm modules initialisation by doing the following command.
``` bash
./vendor/bin/sail npm install
```
9. Run the npm nodes in another terminal.
``` bash
./vendor/bin/sail npm run dev
```

Congratulations, the application should now be running.

---

## Logging In

After running `sail migrate:fresh --seed`, a test user should be created for dev purposes. Just login with email - `test@test.com` and password `test`

---

## Working With The Database

To set up the database, run this:
```
./vendor/bin/sail artisan migrate
```

IF YOU ARE HAVING TROUBLE WITH THE MIGRATE COMMAND, 

Go to the self-hosted phpmyadmin page by going to [here](http://localhost:8080)

You can find the details in the .env file:
- Server: {DB_HOST}:{DB_PORT}
- Username: {DB_USERNAME}
- Password: {DB_PASSWORD}

Seeding after refreshing database: sail artisan migrate:fresh --seed

Just seeding: sail artisan db:seed

## WORKING ON THIS PROJECT

### AESTHETICS
- Visuals, views
    - All views can be found in the resources folder
    - Components are dynamic reusable elements, you can pass parameters to a template and it will render the same structure but with different data
    - Partials are static reusable elements. If you want, you can only focus on making components.
    - Layouts acts as a sort of HTML wrapper, a starting point where you can stick your components, partials, etc.

### ROUTING
- All routes can be found in routes/web.php
    - If you want to work on a certain page, check what sort of view is returned. Usually, these can be found in the Controller classes specified by the different routes such as VacancyController.
    - All controllers can be found in Http/Controllers/
    - For example, `return view('vacancies.manage')` will automagically return the view defined in resources/views/vacancies/manage.blade.php. Notice how the "vacancies" folder and "manage.blade.php" maps to "vacancies." and "manage" in the string.
    - Say you want to check your work on the vacancies.create view. This view is returned by the `vacancies/create` route in web.php You can navigate to `localhost/vacancies/create` to get the corresponding page.

## Making Images Publically Accessible, Misc
sail artisan storage:link

When in doubt, dump-autoload!!
sail composer dump-autoload

## Screenshots
![AK1](https://github.com/sergiumereacre/animal-kingdom/assets/48417081/e4d113ec-71d3-44c3-9ba1-169bf158c25e)
![AK2](https://github.com/sergiumereacre/animal-kingdom/assets/48417081/28203679-cb3e-451c-ad86-7090ecf1db79)
![AK3](https://github.com/sergiumereacre/animal-kingdom/assets/48417081/d7c49fb6-ba12-43dd-9e9a-831066d6ad36)
![AK4](https://github.com/sergiumereacre/animal-kingdom/assets/48417081/94dfc412-5787-492b-a3d0-94c2c8d5e476)
![AK5](https://github.com/sergiumereacre/animal-kingdom/assets/48417081/9f75b20e-5632-47e3-ad5a-419951e266ed)

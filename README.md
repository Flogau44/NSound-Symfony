# Festival Nation Sound

Welcome to the Festival Nation Sound website.

## Table of Contents

1. [Description](#description)
2. [Technical requirements](#Technical-requirements)
3. [Installation](#installation)
4. [DataBase Create](#dataBase-create)
5. [Create JWT for authentication](#create-JWT-for-authentication)
6. [Deployement](#deployement)
7. [Usage](#usage)
8. [Built With](#built-with)
9. [Contributing](#contributing)
10. [Authors](#authors)
11. [License](#license)

## Description

The festival's mobile app is designed as an informational platform for the target audience. Its purpose is to encourage users to explore all aspects of the event, including activities and entertainment beyond the concerts.

# Technical requirements

This project is a Symfony project with version 7.1 and PHP version 8.2 on Windows OS.

So you may need :

- install PHP 8.2 or higher (you can also use xampp)
- install composer (see the installation guide: [Composer Windows](hhttps://getcomposer.org/doc/00-intro.md#installation-windows))

Don't forget to update the environment variables for php and composer.

With PowerShell, check the version:

```bash
php -v
composer -v
```

If you want to check if your computer meets all requirements, open your console terminal and run this command :

```bash
symfony check:requirements
```

# Installation

To work on or read this project, you'll need to retrieve the code from Git and ask Composer to install the dependencies :

1. Clone the project to download its content

```bash
git clone ...
```

2. To install and run this project locally with Visual Studio Code, follow these steps (Prepare the Environment):

Install Scoop

```bash
Set-ExecutionPolicy RemoteSigned -scope CurrentUser
iwr -useb get.scoop.sh | iex
```

Install Symfony CLI

```bash
scoop install symfony-cli
```

Add Symfony CLI to PATH :

```bash
export PATH="$HOME/.symfony/bin:$PATH"
```

Download and install Node.js from nodejs.org. Then install Yarn :

```bash
cd beauty_salon/
npm install --global yarn
```

3. Make composer install dependencies

```bash
composer install
```

When working on a existing Symfony application for the first time, it may be useful to run this command which displays information about the project:

```bash
symfony console about
```

You'll probably also need to customize your ".env" or ".env.local" file and do a few other project-specific tasks :

## DataBase Create :

- add a ".env.local" file to the project
- copy/paste the .env file into the .env.local and configure :

```bash
DATABASE_URL="mysql://root:@127.0.0.1:3306/nation_sound_symfony"
```

(if in phpmyadmin your user is "root" and your password is "")

- create your database with Doctrine with this command :

```bash
php bin/console doctrine:database:create
```

and push it into phpmyadmin with the command :

```bash
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

- then to simulate data in your database, use the command

```bash
php bin/console doctrine:fixtures:load
```

Now you can check your phpmyadmin, you should have all the data in beauty_salon database.

## Create JWT for authentication:

- check in xampp/php/php.ini that your extension=sodium is uncomment,
- add a new folder named "jwt" in Beauty_salon/config,
- install JWT :

```bash
composer require lexik/jwt-authentication-bundle
```

- create a public and private key with command (before openssl must be install):

```bash
php bin/console lexik:jwt:generate-keypair
```

- confirm passphrase,
- copy/paste the new paragraph about JWT in .env to .env.local
- and in .env.local modify the value of JWT_PASSPHRASE with the real passphrase you choosed before

Now you should be able to request a token from api to authenticate.

## Usage

If you're using XAMPP, make sure to start Apache & MySQL, then run this command in your project:

```bash
symfony server:start
```

Access the application via http://localhost:8000/

## Deployement

1. Compile Vue.js files

```bash
yarn encore production
```

2. Clear Symfony cache

Clear syfony cache:

```bash
php bin/console cache:clear
```

Clear symfony cache production

```bash
php bin/console cache:clear --env=prod
```

3. Check dependency security

```bash
symfony check:security
```

4. Web Server Configuration

Ensure the web server points to public/

5. Deploying the Code- Transfer files via FileZilla

Copy your files to the designated directory on your server, excluding vendor/, .git/, or var/.

6. Installing Dependencies- Access the server using Putty

- Install Composer:

```bash
 php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
 php composer-setup.php
 php -r "unlink('composer-setup.php');"
```

- Install production dependencies:

```bash
  php composer.phar install
```

7. Migrate the data base

- Apply migrations:

```bash
  php bin/console doctrine:migrations:migrate
```

- Install .htaccess for Apache:

```bash
  php composer.phar require symfony/apache-pack
```

- Optimize Composer for production:

```bash
  php composer.phar install --no-dev --optimize-autoloader
```

8. Clearing the Cache- Clean and prepare the cache

```bash
php bin/console cache:clear --env=prod --no-debug
php bin/console cache:warmup
```

## Built With

- [Tailwind CSS](https://tailwindcss.com/) - Framework CSS (front-end)
- [Vue JS](https://vuejs.org/) - Framework front-end
- [API-Platform](https://api-platform.com/) - Framework Api
- [Symfony](https://symfony.com/) - Framework back-end
- [Visual Studio Code](https://code.visualstudio.com/) - IDE

## Contributing

Contributions make the open-source community an incredible place to learn, inspire, and create. Any contributions you make are greatly appreciated.

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## Authors

[@Flogau44](https://github.com/Flogau44)

## License

This project is licensed under the MIT License. See LICENSE for more details.

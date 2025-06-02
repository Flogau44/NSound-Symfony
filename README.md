# Festival Nation Sound

Bienvenue sur le site du Festival Nation Sound.

## Table des Matières

1. [Description](#description)
2. [Installation](#installation)
3. [Utilisation](#utilisation)
4. [Construit avec](#construit-avec)
5. [Contribuer](#contribuer)
6. [Auteurs](#auteurs)
7. [Licence](#licence)

## Description

L’application mobile du festival est de type informationnel pour les cibles identifiées. Pour inciter l’utilisateur à découvrir tous les aspects de l’événement (y compris les activités et animations hors des concerts.)

## Installation

Pour installer et exécuter ce projet localement avec Visual Studio Code, suivez ces étapes :

1. Préparer l’Environnement

Installer Scoop

```
Set-ExecutionPolicy RemoteSigned -scope CurrentUser
iwr -useb get.scoop.sh | iex
```

Installer Symfony CLI

```
scoop install symfony-cli
```

Ajoutez Symfony CLI au PATH :

```
bash
export PATH="$HOME/.symfony/bin:$PATH"
```

Télecharger et Installezr Node.js depuis nodejs.org. Ensuite, installez Yarn :

```
bash
npm install --global yarn
```

2. Créer un Projet Symfony

Créer un Nouveau Projet Symfony;

```
bash
symfony new --webapp my_project
```

OU

```
bash
composer create-project symfony/skeleton my_project
cd my_project
composer require webapp
```

Ouvrir le Projet dans VS Code;

```
bash
cd my_project
code .
```

3. Installer API-Platform

```
bash
symfony composer require api
```

4. Configurer Webpack Encore et Vue.js:

Installer Webpack Encore:

```
bash
composer require symfony/webpack-encore-bundle
yarn add @symfony/webpack-encore --dev
```

Installer Vue.js:

```
bash
yarn add vue@next vue-loader@next vue-template-compiler
```

Configurer Webpack Encore pour Vue.js

Ouvrez webpack.config.js et ajoutez :

```
javascript
// enable Vue JS
.enableVueLoader()
```

Créer le Fichier app.js:

Dans le répertoire assets, créez un fichier app.js :

```
javascript
import "./styles/app.css";
import { createApp } from "vue";
import App from "./App.vue";
createApp(App).mount("#app");
```

Créer un Composant Vue:

Dans le répertoire assets, créez un fichier App.vue :

```
vue
<template>

  <div id="app">
    <h1>Hello Vue</h1>
    <p>Test Test</p>
  </div>
</template>
<script>
export default {
  name: "App",
};
</script>
```

5. Installer Vue Router

```
bash
yarn add vue-router@next
```

6. Installer Tailwind CSS

Suivez le tutoriel d'installation de Tailwind CSS dans vos notes.

7. Créer un Contrôleur Symfony

Créer un Contrôleur:

```
bash
php bin/console make:controller AppController
```

Modifier le Contrôleur:

Ouvrez src/Controller/AppController.php et modifiez la méthode index :

```
php

<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_app')]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }
}
```

Créer le Template Twig:

Dans le répertoire templates/, créez un fichier index.html.twig :

```
html
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{% block title %}Welcome!{% endblock %}</title>
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 128 128%22><text y=%221.2em%22 font-size=%2296%22></text></svg>">
        {% block stylesheets %}
            {{ encore_entry_link_tags('app') }}
        {% endblock %}
        {% block javascripts %}
            {{ encore_entry_script_tags('app') }}
        {% endblock %}
    </head>
    <body>
        {% block body %}
        <div id="app"></div>
        {% endblock %}
    </body>
</html>
```

8. Composer de Test Unitaire

Symfony utilise PHPUnit pour les tests unitaires. Installez-le via Composer :

```
bash
composer require --dev symfony/phpunit-bridge
```

9. Installer les Fichiers de Traduction

```
bash
composer require symfony/translation
```

Configurer Symfony pour Utiliser le Français.

Dans config/packages/translation.yaml, définissez la langue par défaut en français :

```
yaml
framework:
    default_locale: fr
    translator:
        default_path: '%kernel.project_dir%/translations'
        fallbacks:
            - fr
```

10. Installer Tailwind CSS

```
bash
npm install tailwindcss @tailwindcss/postcss postcss postcss-loader
```

11. Configurer Webpack Encore pour Tailwind CSS

Dans webpack.config.js, ajoutez :

```
javascript
// enable Tailwind CSS
.enablePostCssLoader()
```

12. Configurer postcss.config.mjs

Créer le fichier postcss.config.mjs et ajouter :

```
javascript
export default {
  plugins: {
    "@tailwindcss/postcss": {},
  },
};
```

13. Ajouter les Directives Tailwind CSS à app.css

Dans assets/styles/, ajoutez les directives à app.css :

```
css
@import "tailwindcss";
```

14. Ajouter la Balise Viewport à index.html.twig

Dans templates/, ajoutez la balise viewport dans votre <head> à index.html.twig:

```
html
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  {% block stylesheets %}
    {{ encore_entry_link_tags('app') }}
  {% endblock %}
</head>
<body>
  <h1 class="text-3xl font-bold underline">
    Hello world!
  </h1>
</body>
</html>
```

15. Installer API Platform

bash

```
composer require api
```

16. Configurer API Platform

API Platform est maintenant installé et configuré automatiquement. Vous pouvez vérifier en lançant le serveur Symfony :

```
bash
symfony server:start
```

Accédez à http://localhost:8000/api pour voir l’interface de l’API.

17. Installer Axios

bash

```
npm install axios
```

Configurer Axios:

Créez un fichier de configuration pour Axios, par exemple src/axios.js :

```
javascript
import axios from 'axios';

const apiClient = axios.create({
  baseURL: 'http://localhost:8000/api',
  headers: {
    'Content-Type': 'application/json',
  },
});
export default apiClient;
```

18. Utiliser le serveur local :

Compiler les assets :

```
yarn encore dev --watch
```

Lancer le serveur Symfony :

```
symfony server:start
```

## Utilisation

Accédez à l’application via http://localhost:5500 (ou le port configuré par Live Server).

## Construit avec

- [Tailwind CSS](https://tailwindcss.com/) - Framework CSS (front-end)
- [Vue JS](https://vuejs.org/) - Framework front-end
- [API-Platform](https://api-platform.com/) - Framework Api
- [Symfony](https://symfony.com/) - Framework back-end
- [Visual Studio Code](https://code.visualstudio.com/) - IDE

## Contribuer

Les contributions sont ce qui fait de la communauté open source un endroit si incroyable pour apprendre, inspirer et créer. Toutes les contributions que vous faites sont grandement appréciées.

1. Forkez le projet
2. Créez votre branche Feature (`git checkout -b feature/AmazingFeature`)
3. Commitez vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Pusher vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrez une Pull Request

## Auteurs

[@Flogau44](https://github.com/Flogau44)

## Licence

Ce projet est sous licence MIT. Voir LICENSE pour plus d'informations.

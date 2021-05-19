## About Project

Le projet est une application basique de gestion des "To Do" se compose d'une partie backend développé en Laravel et une partie frontEnd développé en React JS

- Laravel:

    - Le projet Laravel peut être découpé en deux grandes parties une pour gérer l'authentifaction et un CRUD pour gérer les To Dos.

    - L'authentification est gérée par Laravel Sanctum qui fournit un système d'authentification ultra-léger pour les SPA et de générer 
      des jetons API (https://laravel.com/docs/8.x/sanctum).

    - La validation des requêtes est gérée par le validateur natif de Laravel.

    - La sérilialisation/deserialisation des données est gérée par une librairie tierce Fractal (https://fractal.thephpleague.com).

- React JS:

    - Le projet React JS une application frontend basique qui utilise la version 17 de React développé entièrement en javascript.

    - Une architecture qui se base sur le découplage des composants utilisé dans ce projet (parentComponent/childComponent ou containerComponent/childComponent):
       . Centraliser les traitements et la connexion au store et la gestion des stores dans les composants parents.
       . Les composants fils contiennent que du JSX au contraire des containers. 

    - L'application utilise pour la gestion du store Redux(Thunk) (http://redux.js.org/) qui est une bibliothèque JS permettant de gérer l’état d’une application de manière déterministe.

    - Les services sont utilisés pour la communication avec la partie back via la bibliothèque Axios (https://axios-http.com/docs/intro)
  

- Instalation:

    1- Crée un dossier dans lequel on va cloner les deux projets:
      # mkdir projects && cd projects

    2- Cloner le projet Laravel à partir du repository https://github.com/chedihayouni/laravel:
      
      # git clone https://github.com/chedihayouni/laravel

    3- Cloner le projet React JS à partir du repository https://github.com/chedihayouni/react:

      # git clone https://github.com/chedihayouni/react
    
    4- Copier le fichier docker.compose qui existe dans le projet Laravel et le coller au même niveau des deux projets dans le dossier créer dans la première étape.

    5- Lancer la commande pour créer les images:
    
      # docker-compose build

    6- Lancer la commande pour lancer le projet:
    
      # docker-compose up

    7- Se connecter sur phpMyAdmin et créer la BD avec le nom (laravel) http://localhost:8090:
    
       - Username: root
       
       - Password: root


    7- Se connecter sur le container Laravel pour créer la BD et lancer les migrations:
    
      # docker-compose exec laravel_app bash

      # php artisan migrate --force


    PS: Si vous rencontrez un problème il faut vérifier les droits sur les dossiers: logs, migrations ...

Liens:
 	- FrontEnd: http://localhost:3005
 	- BackEnd: http://localhost:8000
 	- phpmyadmin: http://localhost:8090

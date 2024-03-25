<img src="public/images/cook.png" width=100>


# CookAssistant

CookAssistant est une petite application faite en Symfony (PHP) permettant d'interagir avec une base (en CRUD). L'application possède également une intégration avec l'API de ChatGPT pour se générer des idées de plats.

## Démo
Voici une vidéo de démonstration montrant les principales fonctionnalités de l'application.

<video width="640" height="360" controls>
  <source src="https://yoshiip.xyz/projects/cookassistant/demo.mp4" type="video/mp4">
</video>

## Installation

1. Cloner le repo
2. Faites un fichier `.env.dev.local`, mettez dedans deux variables `DATABASE_URL` et `OPENAI_API_KEY` (avec leur valeurs respectives)
3. Lancez la fixtures pour ajouter des ingrédients avec `php bin/console doctrine:fixtures:load`
4. Lancez l'application avec `symfony server:start`

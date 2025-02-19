# Magisphere

Magisphere est un réseau social universitaire permettant aux étudiants et aux enseignants de partager des posts et des annonces au sein de l'université.

## 🚀 Fonctionnalités actuelles

-   📌 Publication de posts et annonces (CRUD complet)
-   🔎 Affichage du nombre de vues des posts
-   👤 Gestion des administrateurs et approbation des posts/annonces

## 🔮 Fonctionnalités à venir

-   💬 Commentaires et réactions (likes)
-   📢 Notifications en temps réel et Livewire
-   📨 Messagerie privée
-   🎨 Améliorations UI/UX
-   🗝️ Authentification : JWT / OAuth

## 🛠️ Technologies utilisées

-   **Framework :** Laravel
-   **Frontend :** Tailwind CSS, Alpine.js (sans Livewire pour l'instant, mais prévu plus tard)
-   **Base de données :** MySQL

## 📦 Installation

1. **Cloner le projet**

    ```sh
    git clone https://github.com/ton-pseudo/magisphere.git
    cd magisphere
    ```

2. **Backend**

    ```sh
    cd backend
    composer install
    cp .env.example .env
    php artisan serve
    ```

3. **Frontend**
    ```sh
    cd frontend
    npm install
    npm run dev
    ```

## 📜 Licence

Ce projet est sous licence MIT.

---

💡 _Magisphere, connectons notre université !_

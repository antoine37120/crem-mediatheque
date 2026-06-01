---
title: Premiers pas dans l'administration
type: tutorial
description: Découvrez le panneau d'administration de CREM, connectez-vous et naviguez dans les différentes sections.
---

# Premiers pas dans l'administration

Bienvenue dans l'interface d'administration de CREM. Ce tutoriel vous guide dans votre première connexion et la découverte de l'espace de gestion.

---

## Accéder au panneau d'administration

1. Ouvrez votre navigateur et rendez-vous à l'adresse suivante :
   - En environnement local : `http://votre-domaine/crem-admin`
   - En production : `https://votre-domaine/crem-admin`

   La page de connexion du panneau d'administration s'affiche.

2. Saisissez votre **adresse e-mail** et votre **mot de passe** dans les champs prévus à cet effet.

3. Cliquez sur le bouton **"Se connecter"**.

> **Note** : Il n'existe pas de système de rôles ou de permissions différenciés. Tout utilisateur authentifié accède à l'ensemble des fonctionnalités du panneau.

---

## Explorer la navigation latérale

Une fois connecté, vous découvrez le panneau organisé autour d'un **menu latéral gauche**. Chaque entrée correspond à une ressource ou une fonctionnalité de l'application.

Voici les sections principales, dans l'ordre d'affichage :

| Entrée | Icône | Description |
|---|---|---|
| **Items audio** | 🎵 (note de musique) | Gestion des enregistrements audio et de leurs métadonnées |
| **Playlists** | 📋 (liste) | Création et gestion de listes de lecture |
| **Aires géographiques** | 🌍 (globe) | Zones géographiques associées aux enregistrements |
| **Pages CMS** | 📊 (barres) | Gestion des pages statiques du site public |
| **Utilisateurs** | 👥 (utilisateurs) | Gestion des comptes utilisateurs |
| **Imports** | ⬇️ (téléchargement) | Import de données en masse |
| **Paramètres globaux** | ⚙️ (rouage) | Configuration générale de l'application |
| **Search Options** (groupe) | — | Contient **Options de durée** et **Options d'année** |

> **Astuce** : Cliquez sur une entrée du menu pour accéder à la liste des enregistrements ou au formulaire de création correspondant.

---

## Gérer votre profil

Votre profil utilisateur est accessible depuis l'angle supérieur droit du panneau.

1. Cliquez sur votre **nom** ou votre **avatar** dans le menu déroulant en haut à droite.

2. Sélectionnez **"Profil"** dans le menu qui s'affiche.

3. La page d'édition du profil s'ouvre. Vous pouvez y modifier :
   - Votre nom
   - Votre adresse e-mail
   - Votre mot de passe
   - Votre photo de profil

4. Après avoir effectué vos modifications, cliquez sur **"Enregistrer"** pour confirmer.

> **Note** : L'édition du profil est assurée par le plugin `filament-edit-profile`. Chaque utilisateur peut modifier ses propres informations.

---

## Utiliser la recherche globale

En haut du panneau, une **barre de recherche globale** vous permet de trouver rapidement un item audio.

1. Cliquez dans le champ de recherche situé en haut de l'écran.

2. Saisissez un terme de recherche (nom d'un enregistrement, traduction, etc.).

3. Les résultats s'affichent dynamiquement à mesure que vous tapez.

> **Note** : La recherche porte sur les noms et les traductions des items audio.

---

## Se déconnecter

Pour quitter le panneau d'administration :

1. Cliquez sur votre **nom** ou **avatar** en haut à droite.

2. Sélectionnez **"Déconnexion"** dans le menu déroulant.

3. Vous êtes redirigé vers la page de connexion.

---

## Pour aller plus loin

- [Ajouter un item audio](./ajouter-item-audio.md) — Créez votre premier enregistrement audio dans la médiathèque.
- [Guide des items audio](../guides/items-audio.md) — Comprendre la structure des données audio.
- [Explication des champs](../explications/champs-audio.md) — Détail complet des métadonnées d'un item audio.

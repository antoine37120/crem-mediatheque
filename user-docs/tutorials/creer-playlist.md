---
title: Créer une playlist ou un podcast
type: tutorial
description: Apprenez à créer une playlist ou un podcast dans la médiathèque CREM, à ajouter des items audio et à les organiser par glisser-déposer.
---

# Créer une playlist ou un podcast

Ce tutoriel vous explique comment créer une playlist ou un podcast, deux types de contenus partageant le même modèle mais distingués par leur type. Vous apprendrez également à y associer des items audio et à les ordonner.

> **Note** : Dans l'administration CREM, les playlists et les podcasts sont gérés via la même interface **"Playlists"**. La différence se fait par le champ **Type** : sélectionnez "Normal" pour une playlist ou "Podcast" pour un podcast. Sur le site public, ils apparaissent dans des sections séparées.

---

## Accéder au formulaire de création

1. Dans le menu latéral gauche, cliquez sur **"Playlists"**.

2. La liste des playlists et podcasts existants s'affiche. Cliquez sur le bouton **"Créer"** situé en haut à droite de l'écran.

   Le formulaire de création s'ouvre avec plusieurs sections.

---

## Remplir les informations en français

L'onglet **"fr"** est sélectionné par défaut. Il contient les champs pour la locale française.

1. **Nom** (requis) — Saisissez le titre de la playlist ou du podcast en français. Ce champ est obligatoire.

2. **Description** (optionnel) — Saisissez une description. Ce champ utilise un éditeur de texte riche vous permettant de mettre en forme le contenu (gras, listes, liens, etc.).

---

## Remplir la version anglaise

1. Cliquez sur l'onglet **"en"** pour passer à la locale anglaise.

2. **Nom** — Saisissez le titre en anglais.

3. **Description** — Saisissez la description en anglais (éditeur de texte riche).

> **Note** : Les onglets de traduction permettent de gérer le contenu multilingue. Seule la locale principale (français) exige un nom obligatoire.

---

## Configurer les champs généraux

Faites défiler le formulaire pour accéder aux champs suivants :

1. **Publié** — Activez ce toggle pour rendre la playlist ou le podcast visible sur le site public. Si désactivé, le contenu reste visible uniquement dans l'administration.

2. **Type** (requis) — Ouvrez la liste déroulante et sélectionnez :
   - **"Normal"** pour créer une **playlist** classique.
   - **"Podcast"** pour créer un **podcast**.

   > Ce choix détermine la section d'affichage sur le site public (rubriques `/playlists` ou `/podcasts`).

3. **Image** (requis) — Cliquez sur le champ de téléchargement pour sélectionner une image d'illustration sur votre ordinateur (format JPEG, PNG, etc.). Le fichier est stocké dans le dossier `storage/app/public/playlists-pictures/`. Ce champ est obligatoire.

---

## Enregistrer la playlist ou le podcast

1. Vérifiez l'ensemble des informations saisies.

2. Cliquez sur le bouton **"Enregistrer"** en bas du formulaire.

3. Le système valide les champs obligatoires, crée l'entrée et vous redirige vers la liste des playlists.

---

## Ajouter des items audio à une playlist

Une fois la playlist créée, vous pouvez lui associer des items audio.

1. Depuis la liste des playlists, cliquez sur l'icône **"Modifier"** (crayon) de la playlist concernée.

2. Dans la page d'édition, faites défiler jusqu'à la section **"Items audio dans cette playlist"** (Relation Manager). Cette section affiche la liste des items audio déjà associés.

3. Cliquez sur le bouton **"Ajouter un item audio"** situé en haut de cette section.

4. Une fenêtre de sélection s'ouvre. Choisissez un item audio dans la liste déroulante. Vous pouvez taper les premières lettres pour filtrer les résultats.

5. Cliquez sur **"Enregistrer"** dans la fenêtre pour valider l'ajout.

> **Astuce** : Vous pouvez également importer plusieurs items en masse via l'option **"Importer des items audio"** (icône cloud upload). L'import CSV permet d'associer des items audio à une playlist en une seule opération.

---

## Réordonner les items audio

Les items audio associés à une playlist sont ordonnés via le champ `sort`. Dans l'interface d'administration, le réordonnancement se fait par **glisser-déposer** :

1. Dans la section **"Items audio dans cette playlist"**, repérez l'icône de poignée (⣿) à gauche de chaque ligne du tableau.

2. Cliquez sur la poignée, maintenez enfoncé, puis glissez la ligne vers la position souhaitée.

3. Relâchez pour confirmer la nouvelle position. L'ordre est sauvegardé automatiquement.

> **Note** : Sur le site public, les items s'affichent dans l'ordre défini par le champ `sort`, en ne montrant que les items dont le statut de publication est actif.

---

## Résultat sur le site public

Une fois la playlist ou le podcast enregistré et publié, il est accessible sur le site public aux adresses suivantes :

| Type | Liste | Détail |
|------|-------|--------|
| Playlist | `/playlists` | `/playlists/{id}` |
| Podcast | `/podcasts` | `/podcasts/{id}` |

Les playlists et podcasts inédits (toggle "Publié" désactivé) ne sont pas visibles sur le site public.

---

## Pour aller plus loin

- [Ajouter un item audio](./ajouter-item-audio.md) — Créez un enregistrement audio dans la médiathèque.
- [Importer des items audio par CSV](./importer-csv.md) — Importez en masse des items audio avec association à une playlist.
- [Premiers pas dans l'administration](./premiers-pas-admin.md) — Familiarisez-vous avec l'interface d'administration.

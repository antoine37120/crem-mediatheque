---
title: Ajouter un item audio
type: tutorial
description: Apprenez à créer un nouvel enregistrement audio dans la médiathèque CREM, avec ses métadonnées et son fichier sonore.
---

# Ajouter un item audio

Ce tutoriel vous explique comment créer un nouvel enregistrement audio dans la médiathèque, étape par étape.

---

## Accéder au formulaire de création

1. Dans le menu latéral gauche, cliquez sur **"Items audio"**.

2. La liste des items audio existants s'affiche. Cliquez sur le bouton **"Créer"** situé en haut à droite de l'écran.

   Le formulaire de création s'ouvre avec plusieurs sections organisées en onglets.

---

## Remplir les informations en français

L'onglet **"fr"** est sélectionné par défaut. Il contient les champs pour la locale française.

1. **Nom** (requis) — Saisissez le titre de l'enregistrement en français. Ce champ est obligatoire.

2. **Description** (optionnel) — Saisissez une description de l'enregistrement. Ce champ utilise un éditeur de texte riche vous permettant de mettre en forme le contenu (gras, listes, liens, etc.).

---

## Remplir la version anglaise

1. Cliquez sur l'onglet **"en"** pour passer à la locale anglaise.

2. **Nom** — Saisissez le titre de l'enregistrement en anglais.

3. **Description** — Saisissez la description en anglais (éditeur de texte riche).

> **Note** : Les onglets de traduction permettent de gérer le contenu multilingue. Seule la locale principale (français) exige un nom obligatoire.

---

## Configurer les champs généraux

Faites défiler le formulaire pour accéder aux champs suivants :

1. **Publié** — Activez ce toggle pour rendre l'item visible sur le site public. Si désactivé, l'item reste visible uniquement dans l'administration.

2. **Cote** (requis) — Saisissez le code d'archive unique de l'enregistrement. Ce code identifie l'item dans le système d'archivage (exemple : `CNRSMH_I_2025_001`).

3. **Nom original** — Saisissez le nom de l'enregistrement dans sa langue d'origine. Ce champ est facultatif.

4. **Lien** — Saisissez l'URL vers l'archive externe, par exemple sur la plateforme `archives.crem-cnrs.fr`. Ce champ permet de référencer la source originale de l'enregistrement.

5. **Durée** — Saisissez la durée de l'enregistrement en secondes (nombre entier). Vous pouvez laisser ce champ vide si vous importez un fichier MP3 — la durée sera calculée automatiquement lors de l'import.

6. **Année** — Saisissez l'année d'enregistrement au format AAAA (exemple : `2025`). Ce champ est optionnel.

7. **Zone géographique** — Cliquez dans le champ de sélection pour ouvrir la liste déroulante. Commencez à taper le nom d'une zone pour filtrer les résultats, puis sélectionnez la zone correspondante. Ce champ est lié aux entrées de la section **"Aires géographiques"** accessible depuis le menu latéral.

8. **Fichier audio** — Cliquez sur le champ de téléchargement, sélectionnez un fichier MP3 sur votre ordinateur, puis confirmez. Le fichier est stocké dans le dossier `storage/app/public/audio-item-sound/`.

9. **Interprètes** — Saisissez le nom des interprètes de l'enregistrement. Vous pouvez en saisir plusieurs, séparés par des virgules ou des retours à la ligne.

10. **Collecteur** (requis) — Saisissez le nom de la personne ou de l'institution ayant réalisé l'enregistrement de collecte. Ce champ est obligatoire.

11. **Image** — Cliquez sur le champ de téléchargement pour sélectionner une image d'illustration sur votre ordinateur (format JPEG, PNG, etc.). Le fichier est stocké dans le dossier `storage/app/public/audio-item-image/`.

12. **Couleur** — Cliquez sur le champ de couleur pour ouvrir le sélecteur de palette. Vous pouvez choisir une couleur prédéfinie ou saisir un code hexadécimal (exemple : `#3B82F6`).

---

## Enregistrer l'item

1. Vérifiez l'ensemble des informations saisies.

2. Cliquez sur le bouton **"Enregistrer"** en bas du formulaire.

3. Le système valide les champs obligatoires, crée l'item audio et vous redirige vers la liste des items.

---

## Résultat : l'item dans la liste

Votre nouvel item apparaît dans le tableau de la liste **"Items audio"** avec les colonnes suivantes :

| Colonne | Description |
|---|---|
| Couleur | Pastille de couleur choisie |
| Waveform | Représentation graphique de la forme d'onde |
| Cote | Code d'archive unique |
| Nom | Titre de l'enregistrement |
| Nom original | Nom dans la langue d'origine |
| Durée | Durée en secondes |
| Année | Année d'enregistrement |
| Zone géo | Zone géographique associée |
| Fichier | Statut du fichier audio (présent / absent) |
| Collecteur | Nom du collecteur |
| Publié | Statut de publication (publié / non publié) |

---

## Filtrer et rechercher

### Filtres disponibles

Au-dessus du tableau, vous trouvez les filtres suivants :

- **Zone géographique** — Filtre la liste par zone géographique.
- **Statut publication** — Filtre par statut : publié ou non publié.

### Recherche globale

Vous pouvez également utiliser la barre de **recherche globale** située en haut du panneau pour trouver un item audio par son nom ou ses traductions.

### Actions groupées

Sélectionnez plusieurs items dans le tableau (cases à cocher) pour appliquer une action groupée :

- **Publier** — Publie tous les items sélectionnés.
- **Dépublier** — Dépublic tous les items sélectionnés.
- **Supprimer** — Supprime définitivement tous les items sélectionnés.

---

## Pour aller plus loin

- [Premiers pas dans l'administration](./premiers-pas-admin.md) — Familiarisez-vous avec l'interface d'administration.
- [Référence des champs AudioItem](../references/champs-audio-item.md) — Détail complet des métadonnées d'un item audio.
- [Workflow d'import](../explications/workflow-import.md) — Comprendre le pipeline complet d'import CSV.

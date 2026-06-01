---
title: Gérer les pages CMS
type: tutorial
description: Apprenez à créer, modifier et supprimer des pages statiques personnalisées pour le site public du CREM via l'interface d'administration.
---

# Gérer les pages CMS

Ce tutoriel vous explique comment créer et gérer des pages statiques (CMS) pour le site public du CREM. Ces pages vous permettent d'ajouter du contenu personnalisé — présentation, mentions légales, contact, etc. — accessible à une URL publique dédiée.

---

## Accéder au formulaire de création

1. Dans le menu latéral gauche, cliquez sur **"Pages CMS"**.

2. La liste des pages existantes s'affiche. Cliquez sur le bouton **"Créer"** situé en haut à droite de l'écran.

   Le formulaire de création s'ouvre avec les champs de la page.

---

## Configurer le slug de la page

Le premier champ du formulaire est le **slug** — l'identifiant unique de la page dans l'URL publique.

1. Saisissez un identifiant court et explicite en français, par exemple : `mentions-legales`, `contact` ou `presentation-du-laboratoire`.

2. Lorsque vous quittez le champ (clic ailleurs ou touche Tab), le slug est automatiquement mis en forme : les accents sont supprimés, les espaces remplacés par des tirets et la casse passée en minuscules.

   > Exemple : si vous saisissez `Mentions Légales`, le slug devient `mentions-legales`.

3. L'URL publique finale de la page sera : `/page/{slug}` — par exemple `/page/mentions-legales`.

> **Note** : Le slug est unique. Si vous tentez d'enregistrer un slug déjà existant, le système vous demandera d'en choisir un autre.

---

## Remplir les informations en français

L'onglet **"fr"** est sélectionné par défaut. Il contient les champs pour la locale française.

1. **Nom** (requis) — Saisissez le titre de la page tel qu'il s'affichera sur le site public. Ce champ est obligatoire.

2. **Contenu** (optionnel) — Saisissez le contenu de la page. Ce champ utilise un éditeur de texte riche (WYSIWYG) vous permettant de mettre en forme le texte : titres, gras, italique, listes, liens hypertextes, etc.

---

## Remplir la version anglaise

1. Cliquez sur l'onglet **"en"** pour passer à la locale anglaise.

2. **Nom** — Saisissez le titre de la page en anglais.

3. **Contenu** — Saisissez le contenu de la page en anglais (éditeur de texte riche).

> **Note** : Le changement de langue sur le site public se fait via le sélecteur de langue. Pour chaque langue, le contenu correspondant à la locale active est affiché.

---

## Enregistrer la page

1. Vérifiez l'ensemble des informations saisies.

2. Cliquez sur le bouton **"Enregistrer"** en bas du formulaire.

3. Le système valide les champs obligatoires, crée la page et vous redirige vers la liste des pages CMS.

---

## Résultat sur le site public

Dès l'enregistrement, la page est accessible publiquement sans délai supplémentaire. Les pages CMS n'ont pas de toggle de publication — une fois créée, la page est immédiatement visible.

- **URL :** `/page/{slug}`
- **Exemple :** Si le slug est `mentions-legales`, la page est accessible à l'adresse `/page/mentions-legales`

> **Attention** : Le contenu des pages CMS est stocké en HTML via l'éditeur riche. Il n'y a pas de validation ou de filtrage supplémentaire côté public. Veillez à ne pas insérer de code ou de contenu sensible.

---

## Modifier une page existante

1. Depuis la liste **"Pages CMS"**, cliquez sur l'icône **"Modifier"** (crayon) à droite de la ligne correspondante.

2. Le formulaire d'édition s'ouvre avec les valeurs actuelles. Vous pouvez modifier :
   - Le **slug** (attention : si vous changez le slug, l'URL publique change également).
   - Le **nom** (traductions française et anglaise).
   - Le **contenu** (traductions française et anglaise).

3. Cliquez sur **"Enregistrer"** pour appliquer les modifications.

> **Note** : Si vous conservez le même slug, l'URL publique reste inchangée. Les visiteurs continuent d'accéder à la page à la même adresse, avec le contenu mis à jour.

---

## Supprimer une page

1. Depuis la liste **"Pages CMS"**, cliquez sur l'icône **"Supprimer"** (corbeille) à droite de la ligne correspondante.

2. Une fenêtre de confirmation s'affiche. Cliquez sur **"Supprimer"** pour confirmer la suppression définitive.

3. La page est supprimée de la base de données. L'URL publique `/page/{slug}` n'est plus accessible et renvoie une erreur 404.

> **Attention** : La suppression est définitive et irréversible. Il n'existe pas de corbeille ou de versionnage pour les pages CMS. Si vous souhaitez désactiver temporairement une page, vous pouvez remplacer son contenu par un message informant de son indisponibilité.

---

## Bonnes pratiques

- **Choisissez des slugs explicites** et en minuscules, sans accents ni espaces (ex. `contact`, `mentions-legales`, `presentation`).
- **Évitez de modifier un slug** après avoir communiqué l'URL publique — les visiteurs ayant l'ancienne URL obtiendront une erreur 404.
- **Testez l'affichage** sur le site public après chaque création ou modification pour vérifier le rendu du contenu.
- **Structurez le contenu** avec les titres et sous-titres de l'éditeur riche pour une meilleure lisibilité.

---

## Pour aller plus loin

- [Premiers pas dans l'administration](./premiers-pas-admin.md) — Familiarisez-vous avec l'interface d'administration.
- [Créer une playlist ou un podcast](./creer-playlist.md) — Gérez les listes de lecture et podcasts.

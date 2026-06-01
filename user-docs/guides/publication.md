# Publications et visibilité

## Présentation

Chaque item audio et chaque playlist (podcast) possède un statut de
publication. Ce statut détermine si le contenu est visible sur le site public
ou uniquement accessible dans l'interface d'administration.

Deux états possibles :

- **Publié** (`published = true`) — visible sur le site public.
- **En révision** (`published = false`) — visible dans l'admin uniquement,
  permet de préparer les fiches avant de les rendre publiques.

---

## Publier un item audio

### Depuis la fiche de création ou d'édition

1.  Allez dans **« Items audio »** et cliquez sur **« Créer »** ou ouvrez un
    item existant.
2.  Dans le formulaire, repérez le bouton à bascule **« Publié »**.
    - Activez-le (position **Oui**) pour rendre l'item visible publiquement.
    - Laissez-le désactivé (position **Non**) pour le maintenir en révision.
3.  Remplissez les autres champs et validez avec **« Enregistrer »**.

### Directement depuis le tableau (sans ouvrir la fiche)

1.  Allez dans **« Items audio »**.
2.  Repérez la colonne **« Publié »** dans le tableau.
3.  Cliquez directement sur le toggle dans la cellule de l'item concerné.
    - Le changement est appliqué immédiatement, sans rechargement de page.

> Cette méthode est pratique pour basculer rapidement le statut de plusieurs
> items un par un.

### Actions groupées (plusieurs items à la fois)

1.  Depuis le tableau des items audio, cochez la case **en regard de chaque
    item** que vous souhaitez modifier.
2.  Dans la barre d'actions groupées qui apparaît, sélectionnez :
    - **« Publier »** pour publier tous les items sélectionnés.
    - **« Dépublier »** pour repasser les items sélectionnés en révision.
3.  Confirmez l'action dans la boîte de dialogue.

> Cette option est idéale pour des mises à jour massives (publier une série
> d'enregistrements d'une même mission, dépublier un lot obsolète, etc.).

### Filtrer par statut de publication

1.  Dans le tableau des items audio, utilisez le **filtre** dédié.
2.  Sélectionnez **« Publié »** pour n'afficher que les items visibles
    publiquement.
3.  Sélectionnez **« En révision »** pour n'afficher que les items en
    préparation.
4.  Vous pouvez combiner ce filtre avec les autres filtres de la colonne
    (projet, collection, zone géographique, etc.).

---

## Publier une playlist / un podcast

### Depuis la fiche de la playlist

1.  Allez dans **« Playlists »** (ou **« Podcasts »**) et ouvrez la playlist
    concernée.
2.  Dans le formulaire, activez ou désactivez le toggle **« Publié »**.
3.  Validez avec **« Enregistrer »**.

### Depuis le tableau

1.  Repérez la colonne **« Publié »** dans le tableau des playlists.
2.  Cliquez sur le toggle pour basculer le statut.
3.  Le changement est appliqué immédiatement.

> Note : les actions groupées (Publier / Dépublier) ne sont pas disponibles
> pour les playlists. Vous devez modifier chaque playlist individuellement.

---

## Comprendre l'état « En révision »

L'état **« En révision »** (toggle désactivé, `published = false`) correspond
à un item ou une playlist qui :

- ✅ **Existe** dans l'interface d'administration — vous pouvez le/la
  consulter, modifier les métadonnées, associer des fichiers audio.
- ❌ **N'est pas visible** sur le site public — il n'apparaît ni dans les
  listes, ni dans les résultats de recherche, ni via un lien direct.

### Quand utiliser l'état « En révision » ?

| Scénario                                                   | Statut recommandé |
|------------------------------------------------------------|-------------------|
| Saisie en cours d'une fiche (données incomplètes)          | En révision       |
| Item en attente de validation scientifique                 | En révision       |
| Fiche prête, aucun problème détecté                        | Publié            |
| Item temporairement retiré pour correction                 | En révision       |
| Archivage sans suppression (item conservé mais plus actif) | En révision       |

### Passage du statut

Rien ne bloque le passage de « En révision » à « Publié » et inversement.
Vous pouvez changer le statut à tout moment, autant de fois que nécessaire.

---

## Règles de visibilité sur le site public

- **Seuls les items audio publiés** apparaissent sur le site public.
- **Seules les playlists publiées** apparaissent sur le site public.
- Un item audio peut être publié même si sa playlist parente ne l'est pas
  (et vice-versa). Les deux statuts sont indépendants.
- Si un item publié est lié à une playlist non publiée, l'item reste visible
  individuellement — seule la playlist est masquée.

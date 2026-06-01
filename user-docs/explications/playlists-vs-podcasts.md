# Playlists vs Podcasts

> **Explication** — Pourquoi deux concepts pour un même modèle, et ce qui les distingue vraiment.

Si vous naviguez dans l'administration de CREM, vous verrez deux entrées distinctes dans le menu : **Playlists** et **Podcasts**. Pourtant, dans les coulisses du code, il s'agit du **même modèle**, de la **même table en base de données**, des **mêmes formulaires**. La seule différence est une valeur dans un champ `type_id`. Pourquoi ce choix ? Et qu'est-ce qui change concrètement pour vous ?

---

## Un même modèle, deux usages

Dans CREM, le modèle `Playlist` porte deux chapeaux :

| Type | `type_id` | Usage |
|---|---|---|
| **Playlist** | `1` | Regroupement thématique d'items audio (ex: « Enquêtes en Bretagne », « Chants de travail ») |
| **Podcast** | `2` | Série audio avec une identité éditoriale forte (ex: « Les voix de l'oralité », saison 2) |

Techniquement, les deux partagent exactement les mêmes attributs : nom, description, image de couverture, liste d'items audio ordonnés, statut de publication. C'est le même moule.

---

## Pourquoi ce choix technique ?

Vous pourriez légitimement vous demander : pourquoi ne pas avoir créé deux modèles distincts — `Playlist` et `Podcast` — si ce sont deux concepts différents ?

La réponse tient en trois points :

**1. Caractéristiques identiques.** Une playlist et un podcast ont les mêmes besoins : un titre, une description, une image, une liste ordonnée d'enregistrements audio. Ajouter un deuxième modèle aurait dupliqué inutilement le code (mêmes migrations, mêmes relations, mêmes contrôleurs, mêmes vues).

**2. Évolution facilitée.** Une modification apportée au modèle (ajout d'un champ, correction d'un comportement) s'applique automatiquement aux deux concepts. Pas de risque d'oublier de synchroniser deux modèles jumeaux.

**3. Flexibilité administrateur.** Un conservateur peut décider qu'une playlist mérite de devenir un podcast (ou l'inverse) en un clic, sans manipulation technique : il suffit de changer le `type_id` dans le formulaire d'édition.

> **Analogie** : c'est comme une valise. Que vous voyagiez pour le travail ou pour les loisirs, la valise reste la même — ce qui change, c'est l'étiquette que vous mettez dessus, ce que vous mettez dedans et comment vous la présentez à l'arrivée.

---

## Ce qui les différencie dans le frontend public

Si le modèle est unique, l'**interface publique**, elle, fait la différence. C'est là que le type joue vraiment :

| Aspect | Playlist (type_id=1) | Podcast (type_id=2) |
|---|---|---|
| **URL** | `/playlists/titre-de-la-playlist` | `/podcasts/titre-du-podcast` |
| **Page d'accueil** | Liste `/playlists` | Liste `/podcasts` |
| **Composant Livewire** | `teaser-playlist` | `teaser-podcast` |
| **Affichage des items** | Lecture séquentielle classique | Navigation épisodique |

Les gabarits de rendu sont différents : une playlist se présente comme une liste d'enregistrements que l'on peut écouter dans l'ordre, tandis qu'un podcast est présenté comme une série d'épisodes avec une logique de navigation par saison ou par numéro. Les **composants Livewire** qui pilotent ces affichages sont spécifiques à chaque type, ce qui permet de personnaliser l'expérience sans toucher au modèle de données.

---

## En pratique, dans l'administration

Concrètement, voici ce que vous devez retenir au quotidien :

- **Créer une playlist ou un podcast** se fait depuis le même formulaire. La liste déroulante « Type » en haut du formulaire détermine la nature de l'entité.
- **Transformer l'un en l'autre** est immédiat : éditez l'entité, changez le type, enregistrez. Les données (titre, description, items associés, image) sont conservées.
- **Les deux peuvent être publiés ou non**, indépendamment. Une playlist peut être en brouillon alors qu'un podcast est en ligne, et vice-versa.
- **L'ordre des items** se gère de la même façon : par glisser-déposer dans la liste des items associés.
- **Les playlists et podcasts sont indépendants** : un item audio peut appartenir à une playlist sans appartenir à un podcast, ou aux deux, ou à aucun. Il n'y a pas de hiérarchie ni de lien automatique entre les deux.

---

## Et la recherche ?

Dans le moteur de recherche du site public, playlists et podcasts sont indexés séparément. Une recherche peut filtrer par type, ou chercher dans les deux à la fois. Cela permet à l'utilisateur de tomber soit sur une playlist thématique, soit sur un épisode de podcast, selon ce qui correspond le mieux à sa requête.

---

## En résumé

Playlists et podcasts partagent la même infrastructure technique parce qu'ils ont structurellement les mêmes besoins. La différence est **éditoriale et présentielle** : elle affecte l'URL, le rendu visuel, le comportement de navigation, mais pas le modèle de données. Pour vous, administrateur, cela signifie moins de complexité à apprendre et plus de flexibilité pour organiser votre catalogue.

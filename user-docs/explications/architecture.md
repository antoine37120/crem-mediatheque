# Architecture de l'application

## Vue d'ensemble

CREM est une application web construite avec **Laravel 11** en backend, **Filament 3** pour le panneau d'administration, et **Livewire** couplé à **Alpine.js** pour l'interface publique. Cette stack permet de conjuguer la robustesse d'un framework MVC mature avec la souplesse d'un SPA là où c'est nécessaire, sans en subir la complexité.

Le cœur du projet est une médiathèque audio : un catalogue structuré d'enregistrements sonores, chacun associé à des métadonnées riches (nom, description, zone géographique, durée, année) et à un fichier MP3. Vous pouvez naviguer ces enregistrements, les regrouper en playlists ou podcasts, et consulter des pages éditoriales — le tout dans une interface bilingue français/anglais.

## Les modèles principaux

L'architecture métier s'articule autour de quelques entités clés, reliées entre elles par des relations Eloquent classiques.

### AudioItem — l'entité centrale

`AudioItem` est le modèle autour duquel tout s'organise. Chaque instance représente une fiche de catalogage complète : un titre, une description, un fichier audio (MP3), une image de couverture, des métadonnées (durée, année, cote), et une représentation visuelle de la forme d'onde (waveform). Ses champs textuels (nom, description, contenu associé) sont traduisibles en français et en anglais via le package `astrotomic/laravel-translatable` — deux tables distinctes en base, une par locale.

### Playlist et Podcast — deux facettes d'un même modèle

Le modèle `Playlist` sert à la fois pour les **playlists** (type_id=1) et les **podcasts** (type_id=2). La distinction est assurée par une clé étrangère vers `PlaylistType`. Cette unification évite la duplication de code et de schéma : ce qui différencie une playlist d'un podcast, c'est avant tout son affichage et son comportement dans l'interface publique, non sa structure de données.

Les `AudioItem` sont associés aux `Playlist` via une table pivot `AudioItemPlaylist` qui porte un champ `sort` — ce qui permet de définir un ordre personnalisé au sein de chaque playlist ou podcast.

### GeographicalArea — une hiérarchie à deux niveaux

Les `GeographicalArea` représentent les zones géographiques auxquelles les enregistrements sont rattachés. La table supporte une relation parent/enfant via `parent_id`, avec une contrainte métier : **deux niveaux maximum** (exemple : "Afrique" → "Afrique de l'Ouest"). Chaque zone peut avoir un code région optionnel. Les traductions sont gérées de la même manière que pour `AudioItem`.

### CmsPage et GlobalSetting — le contenu éditorial

`CmsPage` permet de créer des pages statiques publiques (À propos, Contact, etc.). Chaque page génère automatiquement un slug à partir de son titre, et son contenu est traduisible. Les `GlobalSetting` sont une paire clé/valeur pour le contenu éditorial multilingue plus atomique (accroches, textes d'interface, mentions légales) — une approche inspirée des systèmes de configuration de contenu.

### DurationOption et YearOption — des filtres configurables

Ces deux modèles sont des listes d'options utilisées pour les filtres de recherche dans l'interface publique. Les durées (par tranches) et les années sont paramétrables depuis l'administration, ce qui évite de les coder en dur et permet de les ajuster sans déploiement.

## Les relations entre modèles

Le schéma relationnel est délibérément simple, avec peu de degrés de séparation :

- Un **AudioItem** appartient à une **GeographicalArea** (`belongsTo`) — chaque enregistrement est rattaché à une zone unique.
- Un **AudioItem** peut appartenir à plusieurs **Playlist** (many-to-many via `AudioItemPlaylist`), avec un ordre explicite.
- Une **GeographicalArea** peut avoir une zone parente (self-referential `belongsTo`) — c'est ce qui construit l'arbre à deux niveaux.
- Une **Playlist** appartient à un **PlaylistType** (`belongsTo`) — c'est le commutateur playlist/podcast.

Cette simplicité n'est pas un hasard : elle reflète le fait que le catalogue est avant tout une base documentaire. Les relations complexes (polymorphisme, héritage, EAV) ont été évitées intentionnellement. Quand le besoin s'en fait sentir, c'est le code applicatif (Filament Resources, règles de validation, écoutes d'événements) qui prend le relais, pas le schéma.

## Les flux de données

Trois grandes voies permettent d'alimenter la médiathèque :

### Import par fichier CSV

C'est le flux principal pour les campagnes de catalogage. Un fichier CSV est déposé dans l'administration. Le moteur d'import lit chaque ligne, détecte le fichier MP3 correspondant via la **cote** (identifiant unique), copie le fichier audio dans le répertoire de stockage, génère la waveform (représentation visuelle du signal audio), puis associe l'item aux playlists indiquées dans le CSV. Ce flux est conçu pour traiter des lots — des centaines d'enregistrements en une seule opération.

### Création manuelle

Depuis l'interface Filament, vous pouvez créer un `AudioItem` individuellement : upload du fichier MP3, de l'image, sélection de la zone géographique, remplissage des champs traduits. Ce flux est celui des ajours ponctuels et des corrections.

### Publication

Qu'un item soit importé ou créé manuellement, il n'est pas immédiatement visible sur le site public. Un champ `published` (ou un statu équivalent) le rend accessible ou non. Une fois publié, il apparaît sur les routes publiques : `/tracks` pour la liste des enregistrements, `/playlists` et `/podcasts` pour les regroupements.

## Le rôle des événements et des jobs

Certaines opérations ne peuvent pas se faire de manière synchrone. La génération de la waveform, par exemple, est déléguée à un job Laravel (queue) — l'utilisateur n'attend pas que le traitement audio se termine pour continuer à travailler. De même, la copie des fichiers depuis un répertoire d'import est gérée par des listeners déclenchés après la création d'un `AudioItem`.

Cette séparation entre la création des données et les traitements lourds est un choix d'architecture qui rend l'interface réactive même quand le volume de médias est important.

## Administration Filament

Le panneau d'administration est organisé par **Resources Filament**, une par modèle principal. Chaque Resource expose :

- Un formulaire de création/édition avec des onglets de traduction (fr/en)
- Une table de listing avec recherche, filtres et actions en masse
- Des règles de validation propres au métier (unicité de la cote, hiérarchie géographique, taille des fichiers)

L'interface d'administration est entièrement en Filament, ce qui signifie qu'elle hérite de ses conventions : navigation latérale, actions par glisser-déposer pour l'ordre des playlists, et thème CSS personnalisable.

## Frontend public

La partie publique du site (visible par les visiteurs) est construite avec **Livewire** et **Alpine.js**. Elle consomme les mêmes modèles Eloquent mais dans un contexte en lecture seule : les routes sont localisées (`/en/tracks`, `/fr/tracks`), les contenus sont traduits automatiquement selon la locale de la requête, et la recherche exploite les index multilingues.

Ce découpage administration/frontend n'est pas une séparation physique (tout est dans le même codebase Laravel) mais une séparation logique : les contrôleurs Livewire du frontend ne modifient jamais les données, tandis que les Resources Filament gèrent l'intégralité des opérations d'écriture.

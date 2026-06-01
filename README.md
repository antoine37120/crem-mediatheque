# CREM — Médiathèque audio

Application de gestion et de diffusion du fonds d'archives sonores du [Centre de Recherche en Ethnomusicologie](https://crem-cnrs.fr/) (CNRS / Université Paris Nanterre).

**Stack :** Laravel 11 · Filament 3 · Livewire · Alpine.js · TailwindCSS · MySQL

## Fonctionnalités

- **Catalogage audio** — fiches multilingues (français/anglais) avec fichiers MP3, waveforms, métadonnées
- **Import CSV** — import en masse avec détection automatique des MP3, génération de waveforms, association aux playlists
- **Playlists et podcasts** — organisation thématique avec réordonnancement par glisser-déposer
- **Aires géographiques** — arbre hiérarchique à 2 niveaux
- **Site public** — lecteur audio (wavesurfer.js), recherche, pages CMS personnalisables
- **Administration** — panel Filament à `/crem-admin`

## Prérequis

- PHP ^8.2
- MySQL
- Composer
- Node.js + npm (pour les assets et la génération de waveforms)

## Installation

```bash
# 1. Cloner le dépôt
git clone https://github.com/antoine37120/crem-mediatheque.git
cd crem-mediatheque

# 2. Configurer l'environnement
cp .env.example .env
# Éditer .env avec vos paramètres de base de données

# 3. Installer les dépendances PHP
composer install

# 4. Générer la clé d'application
php artisan key:generate

# 5. Migrer la base de données
php artisan migrate --seed

# 6. Créer un utilisateur admin
php artisan make:filament-user
# Notez l'email et le mot de passe

# 7. Installer les dépendances frontend
npm install
npm run build

# 8. Lancer le worker de queue (nécessaire pour l'import CSV)
php artisan queue:work database
```

Accéder à `/crem-admin` dans votre navigateur.

## Import de données

1. Placer les fichiers MP3 dans `storage/app/public/import/`
2. Préparer un fichier CSV (voir [référence des colonnes](user-docs/references/colonnes-csv-import.md))
3. Depuis l'admin : Items audio → bouton d'import

## Documentation utilisateur

La documentation complète se trouve dans le dossier [`user-docs/`](user-docs/index.md) :

| Section | Contenu |
|---------|---------|
| [Tutoriels](user-docs/tutorials/premiers-pas-admin.md) | Premiers pas, ajout d'item, import CSV, playlists, pages CMS |
| [Guides](user-docs/guides/aires-geographiques.md) | Aires géographiques, publication, recherche, utilisateurs, waveforms |
| [Explications](user-docs/explications/architecture.md) | Architecture, multilingue, workflow d'import, playlists vs podcasts |
| [Références](user-docs/references/champs-audio-item.md) | Champs, format CSV, configuration, commandes artisan |

## Licence

Ce projet est distribué sous licence MIT. Voir le fichier [LICENSE](LICENSE).

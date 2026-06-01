# Référence des champs AudioItem

> **Référence** — Description exhaustive des attributs du modèle `AudioItem`.

Le modèle `AudioItem` (`app/Models/AudioItem.php`) est l'entité centrale de la médiathèque. Chaque instance représente un enregistrement audio unique — une fiche de catalogage avec ses métadonnées, son fichier sonore, sa représentation visuelle et ses traductions.

Les champs traduisibles (`name`, `description`) sont stockés dans la table `audio_item_translations` via le package `astrotomic/laravel-translatable`. Les autres champs sont stockés directement dans la table `audio_items`.

---

## Table des champs

| Champ | Type | Requis | Description |
|-------|------|--------|-------------|
| `id` | `id` (auto) | — | Identifiant numérique auto-incrémenté |
| `name (fr)` | `TextInput` | Oui | Titre de l'item en français. Stocké dans la table `audio_item_translations` avec `locale = 'fr'`. Limité à 255 caractères. |
| `name (en)` | `TextInput` | Non | Titre de l'item en anglais. Stocké dans la table `audio_item_translations` avec `locale = 'en'`. Limité à 255 caractères. |
| `description (fr)` | `RichEditor` | Non | Description longue en français. Éditeur WYSIWYG, stockée dans `audio_item_translations` avec `locale = 'fr'`. |
| `description (en)` | `RichEditor` | Non | Description longue en anglais. Éditeur WYSIWYG, stockée dans `audio_item_translations` avec `locale = 'en'`. |
| `published` | `Toggle` | Non | Visibilité publique de l'item. Par défaut `false` (brouillon). Type booléen, casté en `boolean` dans le modèle. |
| `cote` | `TextInput` | Oui | Code d'archive unique de l'enregistrement. Extraite automatiquement depuis l'URL du lien lors de l'import CSV. Limité à 255 caractères. |
| `original_name` | `TextInput` | Non | Nom de l'item dans la langue d'origine de l'enregistrement (ex. kirghize, persan). Limité à 255 caractères. |
| `link` | `TextInput` (URL) | Non | Lien vers l'archive externe (ex. https://archives.crem-cnrs.fr/...). Utilisé comme clé de déduplication lors de l'import CSV. Limité à 255 caractères. |
| `duration` | `TextInput` (numeric) | Non | Durée de l'enregistrement en secondes. Calculée automatiquement depuis le fichier MP3 via `wapmorgan/Mp3Info` lors de l'upload ou de l'import. Peut être `null` si aucun fichier n'est associé. |
| `year` | `TextInput` (numeric) | Non | Année de l'enregistrement (format YYYY). Champ nullable depuis la migration `2024_10_11_171441`. |
| `geographical_area_id` | `Select` | Oui | Identifiant de la zone géographique associée. Relation `BelongsTo` vers le modèle `GeographicalArea`. Liste déroulante avec recherche (noms traduits). |
| `file` | `FileUpload` | Non | Fichier audio MP3. Stocké dans le répertoire `audio-item-sound/` du disque public. Nom conservé via `preserveFilenames()`. |
| `interpreters` | `Textarea` | Non | Interprètes ou artistes de l'enregistrement. Champ texte multiligne (`TEXT` en base). Stocké tel quel, sans formatage. |
| `collector` | `TextInput` | Oui | Nom du collecteur ou enquêteur ayant réalisé l'enregistrement de terrain. Limité à 255 caractères. |
| `picture` | `FileUpload` | Non | Image de waveform (représentation visuelle du signal audio). Générée automatiquement via JustWave. Stockée dans `audio-item-image/`. Disque : `public`. |
| `color` | `ColorPicker` | Non | Index de couleur (entier) référençant la palette configurable dans `config/custom.php`. Utilisé pour la pastille colorée dans l'interface. Stocké comme `string(100)`. |

---

## Champs non exposés dans le formulaire

| Champ | Type | Description |
|-------|------|-------------|
| `created_at` | `timestamp` (auto) | Date de création de la fiche. |
| `updated_at` | `timestamp` (auto) | Date de dernière modification de la fiche. |

---

## Relations Eloquent

| Relation | Type | Modèle lié | Description |
|----------|------|------------|-------------|
| `geographicalArea()` | `BelongsTo` | `GeographicalArea` | Zone géographique de provenance. |
| `playlists()` | `HasMany` | `AudioItemPlaylist` | Associations aux playlists (table pivot avec ordre). |

---

## Traductions

Les champs `name` et `description` supportent le multilinguisme via le package `Astrotomic\Translatable`. Les traductions sont stockées dans la table `audio_item_translations` avec les colonnes :

| Colonne | Type | Description |
|---------|------|-------------|
| `audio_item_id` | `foreignId` | Identifiant de l'item parent. |
| `locale` | `string` | Code de langue (`fr` ou `en`). |
| `name` | `string(255)` | Titre traduit. |
| `description` | `longText` | Description traduite. |

Un index fulltext (`scout_search_index`) est défini sur `(name, description)` pour la recherche textuelle via Laravel Scout.

---

## Migrations clés

| Migration | Modifications |
|-----------|---------------|
| `2024_06_24_124024` | Création initiale des tables `audio_items` et `geographical_areas` |
| `2024_10_08_174116` | Ajout de la colonne `cote` (nullable, indexée) |
| `2024_10_09_114223` | Ajout des colonnes `link`, `original_name` et `region_code` |
| `2024_10_11_171441` | Passage de `year` en nullable |
| `2024_10_17_151452` | Passage de `duration`, `collector` et `file` en nullable |
| `2024_12_11_105139` | Ajout des colonnes `published` (boolean, defaut false) et `color` (string) |

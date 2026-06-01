# Référence des colonnes CSV d'import

> **Référence** — Mapping complet entre les colonnes du fichier CSV et les champs du modèle `AudioItem`.

L'import CSV est assuré par la classe `App\Filament\Imports\AudioItemImporter`. Chaque colonne du CSV peut être identifiée par plusieurs noms alternatifs (français, anglais, snake_case) grâce au système de `guess()` de Filament.

---

## Colonnes reconnues

| Colonne CSV | Noms alternatifs | Obligatoire | Exemple | Description |
|-------------|-----------------|-------------|---------|-------------|
| `original_name` | `TITRE ORIGINAL` | Non | `Nom d'archive 1953` | Nom de l'enregistrement dans sa langue d'origine. Limité à 255 caractères. |
| `name` | `TITRE ALTERNATIF` | Non | `Un titre en français` | Titre français de l'item. Stocké dans la traduction `fr`. Limité à 255 caractères. |
| `name_en` | `TITRE ANGLAIS` | Non | `A title in english` | Titre anglais de l'item. Stocké dans la traduction `en`. Limité à 255 caractères. |
| `description` | `DESCRIPTION` | Non | `Enregistrement réalisé lors...` | Description en français (texte long). Stockée dans la traduction `fr`. |
| `description_en` | `DESCRIPTION ANGLAIS` | Non | `Recording made during...` | Description en anglais (texte long). Stockée dans la traduction `en`. |
| `year` | `ANNÉE D'ENREGISTREMENT` | **Oui** | `1953` | Année de l'enregistrement (format YYYY, entier). |
| `geographicalArea` | `AIRE GEO`, `geographical_area` | Non | `af_occidentale` | Code région de l'aire géographique. Doit correspondre à la colonne `region_code` de la table `geographical_areas`. Si le code est inconnu, l'option « Créer les aires manquantes » permet la création automatique. |
| `interpreters` | `INTERPRETE` | Non | `Nurlanbek Nishanov` | Nom des interprètes ou artistes. Champ texte libre. |
| `collector` | `COLLECTEUR` | **Oui** | `During, Jean` | Nom du collecteur ou enquêteur. Limité à 255 caractères. Validation : requis. |
| `link` | `LIEN` | **Oui** | `https://archives.crem-cnrs.fr/archives/items/CNRSMH_I_2020_023_001_34/` | Lien vers l'archive externe. Utilisé comme clé de déduplication : si un item existe déjà avec le même `link`, il est mis à jour plutôt que créé. La **côte** (identifiant unique) est extraite du dernier segment de l'URL pour la recherche du fichier MP3. Limité à 255 caractères. |

---

## Colonnes ignorées

Les colonnes suivantes sont présentes dans certains fichiers CSV sources mais ne sont pas mappées à un champ du modèle. Elles sont ignorées silencieusement lors de l'import :

| Colonne ignorée | Raison |
|-----------------|--------|
| `pays` | Non utilisée ; la zone géographique est gérée via `region_code` et la table `geographical_areas`. |
| `remarque` | Champ libre non standardisé, sans équivalent dans le modèle. |
| `autorisation` | Réservée aux items en accès restreint — pas de champ correspondant dans le modèle actuel. |

> **Note** : Ces colonnes ne sont pas perdues dans le fichier source. Elles restent présentes dans le CSV original mais ne sont pas traitées. Si vous devez les conserver, envisagez de les ajouter comme métadonnées dans le champ `description`.

---

## Détail du mapping par colonne

### `original_name`
- **Stockage** : directement dans `$record->original_name`
- **Comportement** : non écrasé si non vide et que l'item existe déjà
- **Validation** : `max:255`

### `name` et `name_en`
- **Stockage** : dans `audio_item_translations` via `afterSave()`
- **Comportement** : si l'item existe déjà et que la valeur CSV est vide, la traduction existante est conservée
- **Validation** : `max:255`

### `description` et `description_en`
- **Stockage** : dans `audio_item_translations` via `afterSave()`
- **Comportement** : si l'item existe déjà et que la valeur CSV est vide, la traduction existante est conservée
- **Validation** : aucune limite de taille (type `longText`)

### `year`
- **Stockage** : directement dans `$record->year`
- **Validation** : obligatoire (`requiredMapping`)
- **Format** : entier (YYYY)

### `geographicalArea`
- **Stockage** : résolu en `geographical_area_id` (clé étrangère) dans `beforeSave()`
- **Résolution** : cherche `GeographicalArea::where('region_code', $value)` 
- **Cas spéciaux** :
  - Code trouvé → `geographical_area_id` positionné
  - Code inconnu + option `create_missing_areas` → création automatique d'une nouvelle zone
  - Code inconnu + option décochée → `RowImportFailedException` (ligne rejetée)

### `interpreters`
- **Stockage** : directement dans `$record->interpreters`
- **Comportement** : non écrasé si non vide et que l'item existe déjà

### `collector`
- **Stockage** : directement dans `$record->collector`
- **Validation** : obligatoire (`requiredMapping`) + `required|max:255`

### `link`
- **Stockage** : directement dans `$record->link`
- **Rôle clé** : utilisé comme identifiant unique dans `resolveRecord()` (clé de déduplication)
- **Extraction de la côte** : dernier segment de l'URL après découpage par `/`
- **Recherche MP3** : motif glob `*{cote}*.mp3` dans le dossier `storage/app/public/import/`

---

## Options du formulaire d'import

| Option | Type | Défaut | Description |
|--------|------|--------|-------------|
| `create_missing_areas` | `Toggle` | `false` | Créer automatiquement les aires géographiques manquantes dans le référentiel. Utile pour les imports exploratoires, mais peut générer des doublons si les codes région sont mal orthographiés. |

---

## Processus de déduplication

À l'import, le système utilise la colonne `link` comme clé de déduplication :

```php
AudioItem::firstOrNew(['link' => $this->data['link']]);
```

- Si un item existe déjà avec le même `link`, il est **mis à jour** (les champs non vides du CSV écrasent les valeurs existantes)
- Si aucun item n'existe avec ce `link`, un **nouvel item** est créé

Ce mécanisme permet de réimporter un fichier CSV corrigé sans créer de doublons.

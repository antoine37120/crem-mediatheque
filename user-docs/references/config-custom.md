# Référence du fichier `config/custom.php`

> **Référence** — Clés de configuration spécifiques à l'application CREM.

Le fichier `config/custom.php` contient les paramètres propres à CREM qui ne font pas partie de la configuration standard de Laravel. Ces valeurs sont accessibles dans toute l'application via la fonction `config('custom.<clé>')`.

---

## Tables des clés

| Clé | Type | Défaut | Description |
|-----|------|--------|-------------|
| `items_colors` | `array<string>` | Palette de 9 couleurs | Palette de couleurs utilisée pour les pastilles colorées des items audio dans l'interface. Chaque entrée est un code hexadécimal. L'index (0-8) est stocké dans le champ `color` du modèle `AudioItem`. |
| `NodeBinaryPath` | `string` | `false` (env) | Chemin absolu vers le binaire Node.js, utilisé pour la génération des waveforms via JustWave (qui orchestre Puppeteer/Chromium). Configurable via la variable d'environnement `CUSTOM_NodeBinaryPath`. |
| `NpmBinaryPath` | `string` | `false` (env) | Chemin absolu vers le binaire npm, utilisé pour la génération des waveforms. Configurable via la variable d'environnement `CUSTOM_NpmBinaryPath`. |

---

## Palette de couleurs (`items_colors`)

Les 9 couleurs par défaut sont définies dans le tableau `items_colors` :

| Index | Code hexa | Aperçu |
|-------|-----------|--------|
| 0 | `#eb5d0b` | Orange |
| 1 | `#f7df1a` | Jaune |
| 2 | `#96b522` | Vert clair |
| 3 | `#546d94` | Bleu-gris |
| 4 | `#681416` | Bordeaux |
| 5 | `#f9ad1a` | Jaune-orange |
| 6 | `#036a31` | Vert foncé |
| 7 | `#39287c` | Violet |
| 8 | `#cd1420` | Rouge |

L'index de couleur est stocké comme `string(100)` dans la colonne `color` de la table `audio_items`. La résolution en code hexadécimal se fait via la méthode `getHexaColor()` du modèle `AudioItem` :

```php
$colors = config('custom.items_colors');
return $colors[$this->color]; // ex : '#eb5d0b'
```

Si un item n'a pas encore de couleur (`color = null`), la méthode `setRandomColor()` en attribue une aléatoirement parmi la palette.

---

## Chemins des binaires (`NodeBinaryPath`, `NpmBinaryPath`)

Ces deux clés sont utilisées par la génération de waveform (via `spatie/browsershot` et `JustWave`). Elles sont initialisées à `false` par défaut et tirent leur valeur des variables d'environnement :

```php
'NodeBinaryPath' => env('CUSTOM_NodeBinaryPath', false),
'NpmBinaryPath' => env('CUSTOM_NpmBinaryPath', false),
```

### Utilisation dans l'environnement

Pour configurer ces chemins, définissez les variables d'environnement dans votre fichier `.env` :

```
CUSTOM_NodeBinaryPath=/usr/local/bin/node
CUSTOM_NpmBinaryPath=/usr/local/bin/npm
```

### Détection automatique

Si les variables d'environnement ne sont pas définies (valeur `false`), le système tente de détecter les binaires via les chemins système par défaut. En cas d'absence, la génération de waveform échoue silencieusement (étape non bloquante).

---

## Accès à la configuration

Tout composant de l'application peut accéder à ces valeurs :

```php
// Dans un modèle, contrôleur ou service
$colors = config('custom.items_colors');
$nodePath = config('custom.NodeBinaryPath');

// Dans une vue Blade
@php($color = config('custom.items_colors')[$item->color])
```

---

## Fichier complet

Le fichier `config/custom.php` dans sa version actuelle :

```php
<?php

return [
    'items_colors' => [
        '#eb5d0b',
        '#f7df1a',
        '#96b522',
        '#546d94',
        '#681416',
        '#f9ad1a',
        '#036a31',
        '#39287c',
        '#cd1420'
    ],

    'NodeBinaryPath' => env('CUSTOM_NodeBinaryPath', false),
    'NpmBinaryPath' => env('CUSTOM_NpmBinaryPath', false),
];
```

---

## File d'attente et jobs

Les imports CSV utilisent le système de files d'attente (queue) de Laravel. Assurez-vous que le worker de queue est actif pour que les imports s'exécutent :

```bash
php artisan queue:work
```

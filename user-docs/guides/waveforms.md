---
title: Génération des waveforms
type: guide
description: Comprendre le fonctionnement des waveforms et savoir les régénérer manuellement.
---

# Génération des waveforms

Chaque item audio de la médiathèque peut être accompagné d'une **waveform** — une représentation visuelle de l'intensité sonore du fichier MP3. Cette image facilite la navigation dans l'enregistrement sur le site public.

Ce guide vous explique comment les waveforms sont générées automatiquement et comment les régénérer si nécessaire.

---

## Fonctionnement général

La waveform est générée par le package **JustWave** (`antoine37120/justwave`) qui utilise **Puppeteer** (Node.js) pour dessiner l'image à partir du fichier audio. L'opération produit une image PNG transparente de 600×600 pixels, avec une forme d'onde blanche.

L'image est enregistrée dans le dossier `storage/app/public/audio-item-image/` sous le nom `{cote_de_l_item}.png`.

### Dépendances requises

Le processus nécessite que Node.js soit installé sur le serveur. Les chemins d'accès aux exécutables sont configurables dans le fichier `config/custom.php` via les variables d'environnement :

| Variable | Fichier de config | Description |
|---|---|---|
| `CUSTOM_NodeBinaryPath` | `config/custom.php` → `NodeBinaryPath` | Chemin vers l'exécutable Node.js |
| `CUSTOM_NpmBinaryPath` | `config/custom.php` → `NpmBinaryPath` | Chemin vers l'exécutable npm |

---

## Génération automatique à l'import CSV

Lorsque vous importez des items audio par fichier CSV, la waveform est générée automatiquement dans l'étape **6** du processus d'import :

1. Le fichier MP3 est copié dans `audio-item-sound/`.
2. La méthode `generatePicture()` est appelée sur l'item audio.
3. JustWave lance un rendu via Puppeteer pour produire l'image.
4. L'image est déplacée dans `audio-item-image/` et renommée avec la cote de l'item.
5. Une couleur aléatoire est attribuée à l'item.

> **⚠️ Important :** la génération de la waveform est une opération **non critique**. Si elle échoue (Node.js non installé, dépendances manquantes, fichier MP3 illisible), l'item est importé quand même. L'erreur est consignée dans les logs mais ne bloque pas l'import.

---

## Régénérer une waveform manuellement

Si la waveform n'a pas été générée automatiquement (import sans Node.js, ou tout autre échec), vous pouvez la régénérer à tout moment depuis l'interface d'administration :

1. Ouvrez l'item audio concerné dans le formulaire d'édition.
2. Dans la barre d'actions en haut de la page, cliquez sur le bouton **"Generate picture"**.
3. La waveform est recalculée et l'image mise à jour immédiatement.

Vous pouvez également cliquer sur ce bouton pour **remplacer** une waveform existante — par exemple si vous avez changé le fichier MP3 associé à l'item.

---

## Que faire en cas d'échec ?

Si le bouton "Generate picture" ne produit pas d'image, vérifiez les points suivants :

1. **Node.js est-il installé ?** — Vérifiez que l'exécutable Node.js est accessible sur le serveur. Les chemins sont configurés via les variables d'environnement `CUSTOM_NodeBinaryPath` et `CUSTOM_NpmBinaryPath` dans le fichier `.env`.

2. **Le fichier MP3 est-il présent ?** — L'item audio doit avoir un fichier MP3 associé (champ `Fichier audio` renseigné) et ce fichier doit être accessible dans `storage/app/public/audio-item-sound/`.

3. **Consultez les logs** — Les erreurs de génération sont enregistrées dans le fichier de log Laravel avec le message `"Erreur generation waveform pour item {id}"`.

Si le problème persiste, contactez l'équipe de développement en fournissant :
- L'ID ou la cote de l'item concerné.
- Le message d'erreur extrait des logs.
- La configuration Node.js du serveur.

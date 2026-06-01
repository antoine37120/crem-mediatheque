# Workflow d'import

> **Explication** — Comprendre comment les enregistrements audio arrivent dans la base CREM.

L'import est la porte d'entrée principale du catalogue. C'est par lui que des lots d'enregistrements — parfois plusieurs centaines à la fois — sont versés dans la médiathèque. Comprendre son fonctionnement vous évitera bien des écueils et vous permettra d'interpréter correctement les messages d'erreur ou d'avertissement.

---

## Vue d'ensemble

L'import se déclenche depuis l'interface d'administration, via un fichier CSV. Chaque ligne du CSV correspond à un futur **item audio** (un enregistrement unique). Le système exécute une série d'étapes dans un ordre précis : validation des données, résolution des zones géographiques, détection et copie des fichiers MP3, génération des waveforms, association aux playlists, et création des traductions.

Le schéma ci-dessous résume le pipeline complet :

```
CSV uploadé  →  Mapping colonnes  →  Résolution aires
                                          │
                                          ├─ Code trouvé en base → OK
                                          └─ Code inconnu → soit création, soit erreur
                                          │
                                          ▼
                                   Détection MP3 (par côte)
                                          │
                                          ├─ 1 fichier trouvé → copie + durée
                                          ├─ 0 fichier → warning (non bloquant)
                                          └─ Plusieurs → erreur (ambiguïté)
                                          │
                                          ▼
                                   Waveform (non bloquant)
                                          │
                                          ▼
                                   Association playlist + tri
                                          │
                                          ▼
                                   Traductions FR/EN
```

---

## 1. Upload du CSV

Tout commence par un fichier CSV, chargé depuis la page d'import de l'administration Filament. Le composant utilisé est celui de `eightynine/filament-excel-import`, qui prend en charge les formats `.csv`, `.xlsx` et `.ods`.

Le CSV doit contenir au minimum les colonnes correspondant aux champs obligatoires du modèle `AudioItem` : titre, côte, région, lien de fichier, etc. Les colonnes facultatives sont simplement ignorées si absentes.

---

## 2. Mapping des colonnes

Une fois le fichier chargé, le système tente de faire correspondre chaque colonne du CSV à un champ du modèle. Ce mapping est flexible : les noms français comme anglais sont acceptés.

Par exemple, les colonnes suivantes sont toutes reconnues pour le champ `original_name` :

| Valeur dans le CSV | Résultat |
|---|---|
| `TITRE ORIGINAL` | ✅ Mappé vers `original_name` |
| `original_name` | ✅ Mappé vers `original_name` |
| `Original name` | ✅ Mappé vers `original_name` |
| `titre_original` | ✅ Mappé vers `original_name` |

Cette souplesse évite les rejets intempestifs quand les fichiers proviennent de sources différentes (enquêteurs, partenaires, exports d'autres bases).

Si une colonne du CSV n'est reconnue par aucun champ, elle est ignorée silencieusement — les données non mappées ne sont pas perdues, mais elles ne sont pas importées non plus.

---

## 3. Résolution des aires géographiques

Chaque enregistrement est associé à une **aire géographique** (région, pays, zone dialectale). Le système utilise le code région présent dans le CSV pour retrouver l'aire correspondante en base.

Trois cas de figure :

- **Code trouvé** — l'aire existe en base, l'association se fait automatiquement.
- **Code inconnu + option « Créer les aires manquantes » cochée** — une nouvelle aire est créée avec le code comme nom. Utile quand vous importez des données d'une nouvelle région encore absente du référentiel.
- **Code inconnu + option décochée** — la ligne est marquée en échec. Vous devrez soit créer l'aire manuellement avant l'import, soit cocher l'option de création automatique.

> **Bon à savoir** : L'option de création automatique est pratique mais peut générer des doublons si le code est mal orthographié dans le CSV. Vérifiez toujours votre colonne région avant un import massif.

---

## 4. Détection des fichiers MP3

C'est l'étape la plus technique — et celle qui génère le plus de questions.

Le système **ne lit pas de lien HTTP direct** dans le CSV. Il procède ainsi :

1. La colonne « lien » ou « path » du CSV contient une référence vers le fichier audio.
2. Le système en extrait la **côte** (identifiant unique de l'enregistrement).
3. Il cherche ensuite un fichier `.mp3` dans le dossier `storage/app/public/import/` en utilisant un motif glob : `*{cote}*.mp3`.

### Résultats possibles

| Situation | Comportement |
|---|---|
| **Un seul fichier trouvé** | Copie vers le dossier de destination, calcul de la durée via `Mp3Info` |
| **Aucun fichier trouvé** | Warning (non bloquant) — l'item est créé mais sans fichier audio associé |
| **Plusieurs fichiers trouvés** | **Erreur bloquante** — le système ne peut pas choisir à votre place |

> **Pourquoi plusieurs fichiers ?** La recherche par motif glob peut remonter plusieurs résultats si plusieurs fichiers portent la même côte (par exemple `enquete123.mp3` et `enquete123_entretien.mp3`). Dans ce cas, renommez les fichiers pour les différencier avant l'import.

### Que faire si le MP3 n'est pas trouvé ?

Vérifiez successivement :

1. Le fichier est-il bien dans `storage/app/public/import/` ?
2. La côte dans le CSV correspond-elle à une partie du nom du fichier ?
3. Le fichier porte-t-il l'extension `.mp3` (et non `.wav`, `.m4a`, etc.) ?

---

## 5. Génération de la waveform

Une fois le MP3 copié, le système tente de générer une **waveform** (représentation visuelle du signal audio) via la bibliothèque JustWave, orchestrée par Puppeteer.

Cette étape est **non bloquante** : si la waveform échoue (par exemple parce que Puppeteer n'est pas disponible dans l'environnement), l'item est tout de même importé. Vous pourrez régénérer la waveform plus tard depuis l'interface d'édition de l'item.

---

## 6. Association à la playlist

Chaque item est automatiquement lié à la **playlist** que vous avez sélectionnée dans le formulaire d'import. L'ordre d'affichage (`sort`) est déterminé par la position de la ligne dans le CSV : le premier item reçoit l'ordre 1, le second l'ordre 2, et ainsi de suite.

Si vous importez plusieurs CSV vers la même playlist, les nouveaux items s'ajoutent à la suite des existants. Vous pouvez réordonner le tout depuis l'interface d'administration (glisser-déposer).

---

## 7. Traductions

Enfin, le système crée automatiquement les **traductions française et anglaise** de l'item. Les données traduisibles (titre, description, notes) proviennent des colonnes appropriées du CSV. Si une colonne de traduction est absente, le champ reste vide et pourra être complété ultérieurement.

---

## Gestion des erreurs et retours utilisateur

L'import n'est pas un processus « tout ou rien ». Une ligne en échec ne bloque pas les autres.

| Type | Conséquence | Où le voir ? |
|---|---|---|
| **Erreur** (région inconnue, MP3 ambigu) | La ligne n'est pas importée | Fichier CSV d'échec téléchargeable |
| **Warning** (MP3 manquant, waveform non générée) | L'item est importé, mais avec des données incomplètes | Historique de l'import, détail de l'item |
| **Notification** | Un message s'affiche dans l'interface | En haut de l'écran, après l'import |

À l'issue de l'import, un **CSV des lignes en échec** vous est proposé au téléchargement. Vous pouvez le corriger et le réimporter sans avoir à refaire l'intégralité du fichier initial.

---

## En résumé

L'import CREM est conçu pour être tolérant et informatif : tolérant parce qu'une ligne erronée ne fait pas échouer tout le lot, informatif parce que chaque problème est signalé avec suffisamment de détails pour être corrigé. Les deux points d'attention principaux sont la **cohérence des codes région** (vérifiez votre référentiel avant l'import) et la **présence des fichiers MP3 dans le bon dossier** avec la bonne côte dans leur nom.

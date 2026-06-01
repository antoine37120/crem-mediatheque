# Importer des items audio par CSV

Ce tutoriel vous guide pas à pas pour importer en masse des items audio dans la médiathèque du CREM à partir d'un fichier CSV. L'import asynchrone vous permet de traiter plusieurs centaines d'items en une seule opération, avec vérification et correction des erreurs.

---

## Prérequis

- Vous disposez d'un fichier CSV encodé en UTF-8, avec séparateur virgule (`,`) ou point-virgule (`;`).
- Vous avez placé les fichiers MP3 correspondants dans le dossier `storage/app/public/import/` **avant** de lancer l'import.
- Vous êtes connecté(e) à l'interface d'administration du CREM avec les droits suffisants pour importer des items.

---

## 1. Préparer le fichier CSV

Votre fichier CSV doit contenir les colonnes décrites ci-dessous. Les noms de colonnes sont acceptés en **français** ou en **anglais** (indifféremment). Les colonnes marquées **OBLIGATOIRE** sont requises ; les autres sont optionnelles.

| Colonne (français)       | Colonne (anglais)          | Description                                                | Obligatoire |
|--------------------------|----------------------------|------------------------------------------------------------|:-----------:|
| TITRE ORIGINAL           | `original_name`            | Nom d'archive original de l'item                          | Non         |
| TITRE ALTERNATIF         | `name`                     | Nom français de l'item                                    | Non         |
| TITRE ANGLAIS            | `name_en`                  | Nom anglais de l'item                                     | Non         |
| DESCRIPTION              | `description`              | Description en français                                    | Non         |
| DESCRIPTION ANGLAIS      | `description_en`           | Description en anglais                                     | Non         |
| ANNÉE D'ENREGISTREMENT   | `year`                     | Année d'enregistrement                                     | **Oui**     |
| AIRE GEO / `geographical_area` | `geographicalArea`   | Code de zone géographique (ex. `EUROPE`)                  | Non         |
| INTERPRETE               | `interpreters`             | Nom des interprètes                                        | Non         |
| COLLECTEUR               | `collector`                | Nom du collecteur                                          | **Oui**     |
| LIEN                     | `link`                     | URL de l'archive externe (ex. https://archives.crem-cnrs.fr/...) | **Oui** |

Autres colonnes possibles (ignorées par l'importateur) : `pays`, `remarque`, `autorisation`.

> **Exemple de ligne CSV (séparateur virgule) :**
> ```csv
> TITRE ORIGINAL,TITRE ALTERNATIF,TITRE ANGLAIS,DESCRIPTION,ANNÉE D'ENREGISTREMENT,AIRE GEO,INTERPRETE,COLLECTEUR,LIEN
> ARCH_001,Chant de moisson,Harvest song,Enregistré en Beauce,1990,EUROPE,Jean Dupont,Paul Martin,https://archives.crem-cnrs.fr/archives/items/CNRSMH_I_2020_023_001_34/
> ```

---

## 2. Placer les fichiers MP3 dans le dossier d'import

Les fichiers MP3 doivent se trouver dans `storage/app/public/import/` **avant** de lancer l'import. L'association entre un MP3 et un item se fait automatiquement via la **côte** extraite du lien.

**Comment la côte est extraite :**

Prenons le lien :
```
https://archives.crem-cnrs.fr/archives/items/CNRSMH_I_2020_023_001_34/
```

La côte extraite est :
```
CNRSMH_I_2020_023_001_34
```

Le système recherche alors un fichier dont le nom contient cette côte dans le dossier d'import. Par exemple :
```
CNRSMH_I_2020_023_001_34_faceA.mp3
```

> **Règle :** placez un seul fichier MP3 par côte dans le dossier. Si plusieurs MP3 correspondent à la même côte, l'import échouera pour cet item.

---

## 3. Accéder à la page d'import

1. Dans le menu de navigation de l'administration, cliquez sur **Items audio**.
2. Dans le haut de la liste des items, repérez l'icône d'import (un nuage avec une flèche vers le haut, _cloud upload_).
3. Cliquez sur cette icône pour ouvrir la fenêtre d'import.

---

## 4. Uploader le fichier CSV

1. Dans la fenêtre d'import, cliquez sur la zone de dépôt ou sur le bouton **Choisir un fichier**.
2. Sélectionnez votre fichier CSV sur votre ordinateur.
3. Une fois le fichier chargé, les options d'import apparaissent.

---

## 5. Configurer les options d'import

Avant de lancer l'import, deux options facultatives sont à votre disposition :

### Option A — Créer automatiquement les aires géographiques manquantes

Si votre CSV contient des codes de zones géographiques (colonne `AIRE GEO`) qui n'existent pas encore dans la base, cochez la case **"Créer automatiquement les aires géographiques manquantes"**. Le système créera alors ces zones automatiquement.

Décochez cette option si vous préférez que l'import échoue sur les zones inconnues, afin de les vérifier une par une.

### Option B — Associer à une playlist

Sélectionnez une **playlist existante** dans la liste déroulante pour que tous les items importés soient automatiquement rattachés à cette playlist.

Si vous ne souhaitez pas associer les items à une playlist, laissez le champ vide. Vous pourrez les associer manuellement plus tard.

---

## 6. Lancer l'import

1. Vérifiez que les options sont correctement configurées.
2. Cliquez sur le bouton **Lancer l'import** (ou **Importer**).
3. L'import est traité de manière **asynchrone** : vous pouvez fermer la fenêtre et continuer à naviguer. Un job en file d'attente s'occupe du traitement en arrière-plan.

---

## 7. Suivre le statut de l'import

1. Dans le menu de navigation, cliquez sur **Imports** (rubrique **Historique des imports**).
2. Vous voyez la liste de tous vos imports passés, avec leur **statut** :
   - **Succès** — tous les items ont été importés sans erreur.
   - **Partiel** — certains items ont été importés, d'autres ont échoué.
   - **Échec** — aucun item n'a pu être importé.
3. Cliquez sur l'icône **œil** (slideOver) d'un import pour voir les avertissements détaillés.
4. Pour télécharger le détail des lignes en erreur, cliquez sur le lien de téléchargement :
   ```
   /crem-admin/imports/{id}/failed-rows/download
   ```
   Ce fichier CSV contient chaque ligne en échec avec le message d'erreur associé.

---

## 8. Vérifier le résultat

Une fois l'import terminé avec succès, les traitements automatiques suivants sont appliqués à chaque item :

- **Détection et copie** du fichier MP3 : du dossier `import/` vers `audio-item-sound/`.
- **Calcul de la durée** audio via Mp3Info.
- **Génération de la waveform** (forme d'onde visuelle) via JustWave.
- **Création des traductions** française et anglaise à partir des colonnes `DESCRIPTION` et `DESCRIPTION ANGLAIS`.
- **Association à la playlist** choisie (avec un ordre basé sur le tri alphabétique ou l'ordre du fichier).

Vous pouvez dès maintenant consulter les items importés dans la liste **Items audio** et vérifier que toutes les informations sont correctes.

---

## Problèmes fréquents et solutions

### Aire géographique inconnue
**Cause :** le code de zone dans la colonne `AIRE GEO` n'existe pas dans la base.
**Solution :** activez l'option **"Créer automatiquement les aires géographiques manquantes"** avant l'import, ou vérifiez l'orthographe des codes dans votre CSV.

### Collecteur manquant
**Cause :** la colonne `COLLECTEUR` est vide pour une ligne.
**Solution :** renseignez un nom de collecteur valide dans votre CSV. Cette colonne est obligatoire.

### Aucun fichier MP3 trouvé
**Cause :** le fichier MP3 correspondant à la côte n'est pas présent dans `storage/app/public/import/`.
**Solution :** placez le fichier MP3 dans le dossier d'import et relancez l'import. Vérifiez le nom : il doit contenir la côte extraite du lien.

### Plusieurs fichiers MP3 trouvés pour la même côte
**Cause :** plusieurs fichiers dans le dossier d'import correspondent à la même côte.
**Solution :** ne conservez qu'un seul fichier MP3 par côte dans `storage/app/public/import/`.

### Lien manquant ou invalide
**Cause :** la colonne `LIEN` est vide ou ne contient pas une URL valide de la forme `https://archives.crem-cnrs.fr/archives/items/...`.
**Solution :** renseignez un lien complet pour chaque ligne. Sans lien, la côte ne peut pas être extraite et le MP3 ne peut pas être associé.

---

## Récapitulatif des étapes

1. ✅ Préparer le CSV avec les colonnes obligatoires (`COLLECTEUR`, `LIEN`, `ANNÉE D'ENREGISTREMENT`).
2. ✅ Déposer les fichiers MP3 dans `storage/app/public/import/`.
3. ✅ Aller dans **Items audio** → cliquer sur l'icône d'import.
4. ✅ Uploader le fichier CSV.
5. ✅ Configurer les options (zones géographiques, playlist).
6. ✅ Lancer l'import (asynchrone).
7. ✅ Consulter le statut dans **Imports**.
8. ✅ Vérifier les items importés et corriger les éventuelles erreurs.

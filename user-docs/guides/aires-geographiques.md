# Gestion des aires géographiques

## Présentation

Les aires géographiques permettent d'organiser les items audio par provenance
(géographique, culturelle, linguistique, etc.). Elles sont structurées sous forme
d'arbre hiérarchique, avec **deux niveaux maximum** :

- **Niveau 1 (zones racines)** : grandes régions, aires culturelles
  (ex. *Afrique occidentale*, *Asie du Sud-Est*, *Amérique latine*)
- **Niveau 2 (sous-zones)** : subdivisions des zones racines
  (ex. *Mali* sous *Afrique occidentale*)

---

## Accéder à la gestion des aires

1.  Connectez-vous à l'interface d'administration.
2.  Dans le menu latéral, cliquez sur **« Aires géographiques »**.
3.  L'interface affiche un arbre avec l'ensemble des zones existantes.

---

## Créer une zone racine (niveau 1)

1.  Depuis l'arbre des aires, cliquez sur le bouton **« Nouveau »**.
2.  Remplissez le formulaire :
    - **Code région** (`region_code`, requis) — saisissez un identifiant unique
      en minuscules, de préférence avec un préfixe géographique.
      Exemple : `af_occidentale`, `asie_sud_est`, `amazonie`.
    - **Onglet « fr »** — saisissez le nom de la zone en français.
    - **Onglet « en »** — saisissez le nom de la zone en anglais.
3.  Validez avec **« Enregistrer »**. La nouvelle zone apparaît dans l'arbre.

> **Conseil** : le code région est utilisé en interne et peut servir dans les
> imports CSV. Choisissez-le de façon cohérente (ex. `afrique_centrale`,
> `oceanie`).

---

## Créer une sous-zone (niveau 2)

1.  Dans l'arbre, **sélectionnez la zone parent** (zone racine) qui doit
    accueillir la sous-zone.
2.  Cliquez sur **« Ajouter enfant »**.
3.  Remplissez les mêmes champs que pour une zone racine :
    - Code région (unique au sein de l'arbre)
    - Nom français
    - Nom anglais
4.  Validez avec **« Enregistrer »**. La sous-zone apparaît sous la zone parent
    dans l'arbre.

> **Rappel** : une sous-zone ne peut pas elle-même avoir d'enfant. La
> hiérarchie est limitée à deux niveaux.

---

## Modifier une zone existante

1.  Dans l'arbre, **double-cliquez** sur la zone que vous souhaitez modifier.
2.  Le formulaire s'ouvre avec les données actuelles.
3.  Mettez à jour les champs nécessaires (code, nom français, nom anglais).
4.  Validez avec **« Enregistrer »**.

---

## Supprimer une zone

1.  Dans l'arbre, faites un **clic droit** sur la zone à supprimer.
2.  Dans le menu contextuel, sélectionnez **« Supprimer »**.
3.  Confirmez la suppression dans la boîte de dialogue.

> **Attention** : la suppression d'une zone est définitive. Les items audio
> qui lui étaient liés perdent leur rattachement géographique et ne
> seront plus filtrés par ce critère sur le site public. Vérifiez qu'aucun
> item important n'est associé avant de supprimer.

---

## Importer des aires géographiques depuis un fichier CSV

Vous pouvez créer ou mettre à jour plusieurs aires en une seule opération
via l'import CSV.

### Format attendu du fichier

Le fichier CSV doit contenir les colonnes suivantes (dans cet ordre) :

| Colonne         | Description                                      | Obligatoire |
|-----------------|--------------------------------------------------|-------------|
| `code région`   | Identifiant unique de la zone (ex. `af_centrale`)| Oui         |
| `nom français`  | Nom affiché en français                          | Oui         |
| `nom anglais`   | Nom affiché en anglais                           | Non         |

### Procédure d'import

1.  Allez dans **« Aires géographiques »**.
2.  Cliquez sur **« Importer »** (ou l'icône d'import CSV).
3.  Sélectionnez votre fichier CSV.
4.  Si vous importez également des items audio, l'option
    **« Créer les aires manquantes »** (dans l'import des items) permet de
    générer automatiquement les zones qui n'existent pas encore dans l'arbre.
5.  Lancez l'import et vérifiez le résultat dans l'arbre.

---

## Bonnes pratiques

- **Planifiez votre arbre** avant de créer les zones : définissez les grandes
  régions (niveau 1) puis les sous-ensembles (niveau 2).
- **Utilisez des codes cohérents** : préfixes géographiques en minuscules,
  séparés par des tirets bas (`af_`, `asie_`, `am_`, `oc_`).
- **Évitez la duplication** : avant de créer une zone, vérifiez qu'elle
  n'existe pas déjà dans l'arbre sous un autre nom.
- **Documentez vos codes** dans un fichier de référence partagé avec
  l'équipe, pour que tout le monde utilise les mêmes identifiants.

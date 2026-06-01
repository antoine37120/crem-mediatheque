# Recherche et filtres

Ce guide vous explique comment retrouver efficacement des items audio dans le panel d'administration CREM, grâce à la recherche globale et aux filtres disponibles.

---

## Recherche globale

En haut du panel d'administration, une barre de recherche globale vous permet de chercher dans l'ensemble du catalogue.

- **Ce qui est indexé :** le nom et la description des items audio, dans leurs deux versions linguistiques (français et anglais).
- **Comment l'utiliser :** saisissez un mot-clé (nom, terme dans la description) ; les résultats s'affichent au fur et à mesure de votre frappe.
- **Résultats :** chaque résultat affiche le nom de l'item audio correspondant. Un clic sur un résultat vous amène directement à la page d'édition de cet item.

> **Sous le capot :** la recherche globale utilise Laravel Scout. Les champs `name` et `description` (traductions françaises et anglaises) sont indexés automatiquement.

---

## Filtres dans le tableau des items audio

Depuis la page **Items audio**, deux filtres sont disponibles au-dessus du tableau pour affiner la liste affichée.

### Filtre par zone géographique

1. Cliquez sur l'icône **Filtre** (entonnoir) dans la barre d'outils du tableau.
2. Sélectionnez **Zone géographique** dans le menu déroulant.
3. Choisissez une zone dans la liste proposée — toutes les zones géographiques enregistrées apparaissent.
4. Le tableau se met à jour pour n'afficher que les items appartenant à cette zone.

Pour revenir à la vue complète, cliquez sur le bouton **Effacer** à côté du filtre actif.

### Filtre par statut de publication

1. Toujours depuis l'icône **Filtre**, sélectionnez **Statut** (ou l'étiquette équivalente dans l'interface).
2. Choisissez entre :

   - **En révision** — items non publiés (brouillons)
   - **Publié** — items visibles sur le site public

3. Le tableau se met à jour pour n'afficher que les items correspondant au statut choisi.

> **Astuce :** vous pouvez combiner les deux filtres (zone géographique + statut) pour une recherche plus précise.

---

## Options de recherche configurables (Search Options)

Le menu latéral du panel d'administration contient un groupe intitulé **Search Options**. Ce groupe regroupe deux ressources qui vous permettent de configurer des intervalles de recherche réutilisables.

### Options de durée

La ressource **Options de durée** vous permet de créer des intervalles de durée prédéfinis (par exemple : « 0-5 min », « 5-10 min », « 10-30 min »).

Pour ajouter une option de durée :

1. Dans le menu latéral, sous **Search Options**, cliquez sur **Options de durée**.
2. Cliquez sur **Nouvelle option de durée**.
3. Renseignez les champs suivants :

   - **Nom** (traduisible en français et en anglais) — par exemple « Court (0-5 min) »
   - **De** (`from`) — valeur de début de l'intervalle (nombre)
   - **À** (`to`) — valeur de fin de l'intervalle (nombre)

   > Au moins l'un des deux champs `from` ou `to` doit être renseigné.

4. Enregistrez. L'option apparaît alors dans la liste et peut être réutilisée.

### Options d'année

La ressource **Options d'année** fonctionne sur le même principe : elle vous permet de créer des intervalles d'années prédéfinis (par exemple : « Avant 1950 », « 1950-1970 », « 1970-1990 », « Après 2000 »).

Pour ajouter une option d'année :

1. Dans le menu latéral, sous **Search Options**, cliquez sur **Options d'année**.
2. Cliquez sur **Nouvelle option d'année**.
3. Renseignez les champs suivants :

   - **Nom** (traduisible en français et en anglais) — par exemple « 1950-1970 »
   - **De** (`from`) — année de début de l'intervalle
   - **À** (`to`) — année de fin de l'intervalle

4. Enregistrez.

### Modification et suppression

Pour chaque option (durée ou année), vous pouvez :

- **Modifier** ses valeurs en cliquant sur l'icône d'édition (crayon) dans la liste.
- **Supprimer** l'option via l'icône de suppression (corbeille).

> **Important :** les options de recherche sont multilingues. Lors de la création ou de la modification, pensez à remplir le nom dans les deux langues (français et anglais) via les onglets de traduction.

---

## Recherche dans le tableau

En complément des filtres, chaque colonne du tableau **Items audio** dispose d'un champ de recherche individuel (accessible via le menu des colonnes) pour les champs suivants :

- Cote
- Nom (traduction)
- Nom original
- Fichier
- Collecteur

Vous pouvez ainsi croiser plusieurs critères pour affiner votre recherche.

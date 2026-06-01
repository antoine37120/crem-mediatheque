# Gestion des utilisateurs

Ce guide vous explique comment créer, modifier et gérer les comptes utilisateurs du panel d'administration CREM.

---

## Accéder à la gestion des utilisateurs

Dans le menu latéral du panel d'administration, cliquez sur **Utilisateurs** (icône personnages, situé en ordre 6 dans la navigation).

La page affiche la liste de tous les utilisateurs enregistrés, avec les colonnes suivantes :

- **Nom** — nom complet de l'utilisateur
- **Email** — adresse email de connexion
- **Date de création** — date d'inscription (masquée par défaut, vous pouvez l'afficher via le menu des colonnes)
- **Date de modification** — dernière mise à jour du profil (masquée par défaut)

---

## Créer un utilisateur

1. Depuis la liste des utilisateurs, cliquez sur **Nouvel utilisateur** (bouton en haut à droite).
2. Remplissez les champs suivants :

   - **Nom** (obligatoire) — le nom affiché de l'utilisateur
   - **Email** (obligatoire) — l'adresse email qui servira d'identifiant de connexion
   - **Mot de passe** (optionnel à la création) — si laissé vide, l'utilisateur devra définir son mot de passe via la fonction "Mot de passe oublié" sur la page de connexion

3. Cliquez sur **Enregistrer**. Le nouvel utilisateur apparaît immédiatement dans la liste.

> **Important :** la création d'un utilisateur ne déclenche pas d'envoi d'email automatique. Vous devez communiquer les informations de connexion à l'utilisateur par un autre moyen.

---

## Modifier un utilisateur

1. Dans la liste des utilisateurs, cliquez sur l'icône d'édition (crayon) à droite de la ligne correspondante.
2. Vous pouvez modifier :

   - Le **nom**
   - L'**email**
   - Le **mot de passe** (laissez vide pour ne pas le changer)

3. Cliquez sur **Enregistrer** pour valider les modifications.

Pour **supprimer** un utilisateur, ouvrez sa fiche d'édition puis cliquez sur le bouton **Supprimer** en haut de la page. Confirmez la suppression dans la boîte de dialogue.

---

## Modifier son propre profil

Chaque utilisateur peut modifier ses informations personnelles depuis le menu déroulant en haut à droite de l'écran.

1. Cliquez sur votre nom dans le coin supérieur droit du panel.
2. Sélectionnez **Profil** dans le menu déroulant.
3. Sur la page de profil, vous pouvez modifier :

   - Votre **nom**
   - Votre **email**

4. Cliquez sur **Enregistrer** pour appliquer les changements.

> **Note :** cette page de profil est fournie par le plugin `filament-edit-profile`. Elle permet à chaque utilisateur de gérer ses propres informations sans passer par la section d'administration des utilisateurs.

---

## Accès et permissions

### Qui peut accéder au panel ?

Actuellement, **tout utilisateur disposant d'un compte avec une adresse email valide** peut se connecter au panel d'administration CREM (`/crem-admin`). La méthode d'accès (`canAccessPanel`) vérifie uniquement la présence d'un email — pas de rôle ou de permission spécifique.

### Y a-t-il des rôles ou des permissions ?

**Non.** L'application CREM ne possède pas de système de rôles (comme Spatie Permission) ni de politiques d'accès différenciées.

Cela signifie que tous les utilisateurs connectés ont accès à **l'ensemble des fonctionnalités** du panel :

- Gestion des items audio (création, modification, suppression, publication)
- Gestion des playlists et podcasts
- Import CSV
- Gestion des aires géographiques
- Gestion des pages CMS
- Configuration des options de recherche
- Paramètres globaux
- Gestion des utilisateurs (création, modification, suppression)

> **À retenir :** il n'existe pas de distinction entre un administrateur et un simple contributeur. Si vous devez restreindre l'accès à certaines fonctionnalités à l'avenir, l'ajout d'un système de rôles et permissions sera nécessaire.

---

## Connexion

La page de connexion est accessible à l'adresse `/crem-admin/login`. Les utilisateurs se connectent avec leur adresse email et leur mot de passe.

Si un utilisateur a oublié son mot de passe :

1. Sur la page de connexion, cliquez sur **Mot de passe oublié ?**
2. Saisissez son adresse email.
3. Un lien de réinitialisation lui sera envoyé (si la configuration mail du serveur est active).

---

## Bonnes pratiques

- **Choisissez des adresses email professionnelles** pour les comptes utilisateurs.
- **Communiquez les identifiants de manière sécurisée** — ne transmettez jamais les mots de passe en clair par email.
- **Supprimez les comptes inactifs** pour maintenir la sécurité de l'application.
- **Utilisez des noms explicites** pour identifier facilement chaque utilisateur dans la liste.

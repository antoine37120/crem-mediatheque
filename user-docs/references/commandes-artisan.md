# Commandes artisan disponibles

> **Référence** — Commandes `artisan` utiles pour l'administration et le développement de CREM.

L'application CREM est construite sur Laravel 11 et Filament 3. Les commandes ci-dessous sont celles couramment utilisées dans le cadre de ce projet. Aucune commande artisan personnalisée n'est définie dans le code de l'application ; toutes les commandes listées proviennent de Laravel, Filament ou de packages installés.

---

## Commandes générales Laravel

| Commande | Description |
|----------|-------------|
| `php artisan serve` | Lance le serveur de développement local (http://localhost:8000). |
| `php artisan down` | Met l'application en mode maintenance. |
| `php artisan up` | Sort du mode maintenance. |
| `php artisan about` | Affiche un résumé de la configuration de l'application. |

---

## Commandes de cache

| Commande | Description |
|----------|-------------|
| `php artisan cache:clear` | Vide le cache d'application. |
| `php artisan config:clear` | Supprime le cache de configuration. |
| `php artisan config:cache` | Crée le cache de configuration (recommandé en production). |
| `php artisan route:clear` | Supprime le cache des routes. |
| `php artisan route:list` | Liste toutes les routes enregistrées. |
| `php artisan view:clear` | Vide le cache des vues Blades. |
| `php artisan optimize:clear` | Vide tous les caches en une commande. |

---

## Commandes de base de données

| Commande | Description |
|----------|-------------|
| `php artisan migrate` | Exécute les migrations en attente. |
| `php artisan migrate:fresh` | Supprime toutes les tables et réexécute toutes les migrations. |
| `php artisan migrate:status` | Affiche l'état des migrations. |
| `php artisan db:seed` | Exécute les seeders de base de données. |
| `php artisan db:show` | Affiche les statistiques de la base de données. |
| `php artisan db:table` | Affiche les statistiques d'une table spécifique. |

---

## Commandes de stockage

| Commande | Description |
|----------|-------------|
| `php artisan storage:link` | Crée le lien symbolique `public/storage` → `storage/app/public`. **Nécessaire pour l'accès public aux fichiers audio et aux waveforms.** |

---

## Commandes de file d'attente (Queue)

L'import CSV s'exécute via le système de files d'attente. Le worker doit être actif pour traiter les imports.

| Commande | Description |
|----------|-------------|
| `php artisan queue:work` | Lance le worker de file d'attente en mode daemon. Reste actif et traite les jobs au fur et à mesure. |
| `php artisan queue:listen` | Lance le worker en mode écoute (redémarre à chaque job). Utile en développement. |
| `php artisan queue:table` | Crée la migration pour la table des jobs (si absente). |
| `php artisan queue:failed` | Liste les jobs échoués. |
| `php artisan queue:retry all` | Relance tous les jobs échoués. |
| `php artisan queue:flush` | Supprime tous les jobs échoués. |

---

## Commandes Filament

| Commande | Description |
|----------|-------------|
| `php artisan make:filament-user` | Crée un utilisateur Filament avec un formulaire interactif (nom, email, mot de passe). |
| `php artisan filament:optimize` | Optimise les composants Filament pour la production. |
| `php artisan filament:optimize:clear` | Supprime le cache d'optimisation Filament. |
| `php artisan livewire:configure` | Configure les paramètres Livewire (middleware, layout, etc.). |

---

## Commandes d'optimisation

| Commande | Description |
|----------|-------------|
| `php artisan optimize` | Optimise l'application pour la production (cache config, routes, events). |
| `php artisan optimize:clear` | Supprime tous les caches d'optimisation. |

---

## Commandes pratiques

| Commande | Description |
|----------|-------------|
| `php artisan make:model AudioItem` | Génère un nouveau modèle Eloquent (utilisé lors du développement de nouveaux modules). |
| `php artisan make:migration` | Génère une nouvelle migration. |
| `php artisan make:filament-resource` | Génère une ressource Filament (modèle, formulaire, table, pages). |
| `php artisan tinker` | Ouvre le REPL interactif PsySH pour exécuter du code PHP en direct. Utile pour tester des requêtes ou manipuler des données : `App\Models\AudioItem::count()`. |

---

## Commandes de maintenance

| Commande | Description |
|----------|-------------|
| `php artisan inspire` | Affiche une citation inspirante (défaut du fichier `routes/console.php`). |
| `php artisan schedule:list` | Liste les tâches planifiées. |
| `php artisan schedule:run` | Exécute les tâches planifiées immédiatement. |

---

## Commandes spécifiques au projet

Le projet CREM ne définit pas de commandes artisan personnalisées dans `routes/console.php` ou via `app/Console/Commands/`. Les seules commandes disponibles sont celles fournies par Laravel, Filament 3, Livewire et les packages installés dans `composer.json`.

Pour créer une nouvelle commande personnalisée :

```bash
php artisan make:command <NomCommande>
```

Cela génère un fichier dans `app/Console/Commands/` qui sera automatiquement enregistré par Laravel.

---

## Exemple d'utilisation typique

Dans le cadre d'un déploiement ou d'une mise à jour de CREM, la séquence suivante est recommandée :

```bash
# 1. Mode maintenance
php artisan down

# 2. Migrations
php artisan migrate

# 3. Optimisation
php artisan config:cache
php artisan route:cache
php artisan filament:optimize

# 4. Lien de stockage (si nécessaire)
php artisan storage:link

# 5. Sortie du mode maintenance
php artisan up
```

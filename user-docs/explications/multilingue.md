# Système multilingue

## Pourquoi un système multilingue dédié

Le site public de la médiathèque CREM s'adresse à un public francophone et anglophone. Les fiches de catalogage, les playlists, les zones géographiques, les pages statiques et les textes éditoriaux doivent tous exister dans les deux langues. Laravel ne propose pas de mécanisme de traduction de contenu en base de données — ses fichiers de traduction (`resources/lang/`) sont faits pour les chaînes statiques de l'interface, pas pour le contenu saisi par les utilisateurs.

C'est pourquoi le projet utilise **astrotomic/laravel-translatable**, un package qui ajoute la traduction multilingue au niveau des modèles Eloquent, sans duplication du schéma principal. Chaque modèle traduisible conserve ses propres colonnes (clés primaires, relations, timestamps) dans la table principale, tandis que les champs traduisibles vivent dans une table de traduction dédiée.

## Les deux locales et leur relation

Deux locales sont définies dans l'application :

- **`fr`** — locale principale, celle des données obligatoires
- **`en`** — locale secondaire, optionnelle mais recommandée

La locale française sert de **fallback** : si un champ n'a pas de traduction en anglais, c'est la valeur française qui est affichée au visiteur anglophone. Ce mécanisme évite les trous d'affichage tout en laissant le temps de compléter les traductions. Il est configurable : vous pourriez décider que l'absence de traduction anglaise doit déclencher une page 404 ou un avertissement, mais le comportement par défaut est de présenter la version française comme filet de sécurité.

Ce choix de la locale française comme locale principale n'est pas anodin. Il reflète la réalité du corpus : la majorité des enregistrements proviennent de fonds francophones, et le catalogage est d'abord fait en français. L'anglais vient en second, comme langue d'ouverture vers un public international.

## L'organisation des tables en base de données

Prenons l'exemple d'`AudioItem`. En base, vous trouverez :

- **`audio_items`** — la table principale, avec les colonnes non traduisibles : `id`, `cote`, `file_path`, `geographical_area_id`, `published`, `sort`, `created_at`, `updated_at`
- **`audio_item_translations`** — la table de traduction, avec : `id`, `audio_item_id` (clé étrangère), `locale` ('fr' ou 'en'), `name`, `description`, `content`

Chaque ligne de la table principale peut avoir zéro, une ou deux lignes dans la table de traduction — une par locale renseignée. La jointure est faite automatiquement par le package : quand vous accédez à `$audioItem->name`, Laravel Translatable interroge la table de traduction pour la locale courante et retourne la bonne valeur.

Le même motif se répète pour les autres modèles traduisibles :

| Table principale | Table de traduction |
|---|---|
| `playlists` | `playlist_translations` |
| `geographical_areas` | `geographical_area_translations` |
| `cms_pages` | `cms_page_translations` |
| `global_settings` | `global_setting_translations` |

Chaque table de traduction contient les colonnes spécifiques au modèle : `name`, `description`, `slug`, `content`, `short_description`, etc., selon les besoins de l'entité.

## Le fonctionnement dans Filament

L'interface d'administration Filament exploite deux traits pour gérer la traduction sans effort supplémentaire :

- **`ResourceTranslatable`** — activé au niveau de la Resource Filament, il indique que le modèle sous-jacent est traduisible
- **`TranslatableTabs`** — intégré au formulaire, il crée automatiquement un onglet par locale

Quand vous éditez un `AudioItem`, le formulaire affiche deux onglets : **Français** et **English**. Chaque onglet contient les mêmes champs (`name`, `description`, `content`), mais liés à la locale correspondante. Vous pouvez passer de l'un à l'autre sans perdre votre saisie.

Côté validation :

- Le champ `name` en français est **obligatoire** — c'est la locale principale
- Le champ `name` en anglais est **optionnel** — si vous ne le remplissez pas, le fallback fera son office
- Les autres champs (description, contenu) sont optionnels dans les deux langues

La recherche globale dans le panneau d'administration explore les deux locales simultanément. Si vous cherchez un mot-clé, il sera trouvé qu'il apparaisse dans la version française ou anglaise d'une fiche.

## Les routes localisées

Le site public utilise le package **`codezero/laravel-localized-routes`** pour préfixer les URL par locale :

- `/fr/tracks` → liste des enregistrements en français
- `/en/tracks` → liste des enregistrements en anglais
- `/fr/playlists/mon-titre` → détail d'une playlist en français
- `/en/playlists/my-title` → détail de la même playlist en anglais

Ce préfixe est détecté automatiquement par le middleware de Laravel, qui positionne la locale de l'application (`app()->setLocale()`) avant que les modèles ne soient chargés. Ainsi, quand une vue appelle `$audioItem->name`, elle obtient la bonne traduction sans code supplémentaire.

La locale par défaut (si le visiteur arrive sur `/tracks` sans préfixe) est le français. Un cookie ou la négociation de contenu HTTP peut être utilisé pour rediriger automatiquement vers la langue préférée du navigateur.

## Bonnes pratiques au quotidien

**Remplissez toujours la locale française.** C'est la locale obligatoire, celle du fallback, celle qui garantit que le site ne présente jamais de trou. Même si l'anglais vous semble prioritaire pour un contenu donné, commencez par le français.

**L'anglais est optionnel mais fortement recommandé.** Le site étant bilingue, un visiteur anglophone qui tombe sur du contenu français verra une expérience dégradée. Les traductions anglaises sont ce qui fait la différence entre un site « françai avec une option langue » et un site véritablement bilingue.

**Utilisez le même contenu rédactionnel dans les deux langues quand c'est pertinent.** Pour les noms propres, les termes techniques ou les cotes, il est parfois correct d'avoir la même valeur en français et en anglais. Les champs `name` peuvent être identiques si le terme ne se traduit pas.

**Les slugs sont automatiques.** Quand vous créez un `AudioItem` ou une `CmsPage`, le slug (utilisé dans l'URL) est généré à partir du `name` de la locale courante. Si vous remplissez le nom en français puis en anglais, chaque locale aura son propre slug — ce qui permet des URL comme `/fr/emissions/rituels-bretons` et `/en/emissions/breton-rituals`.

**N'oubliez pas les `GlobalSetting`.** Certains textes d'interface (mentions légales, accroche de la page d'accueil, texte du pied de page) sont stockés dans `GlobalSetting` et sont eux aussi traduisibles. Ils suivent exactement le même mécanisme que les autres modèles : pensez à les renseigner dans les deux langues quand vous modifiez un paramètre éditorial.

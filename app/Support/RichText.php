<?php

namespace App\Support;

use DOMDocument;

class RichText
{
    /**
     * Aperçu texte d'un contenu riche : les balises deviennent des espaces
     * (les sauts de ligne ne collent plus les mots) et les entités HTML
     * (&nbsp;, &amp;...) sont décodées.
     */
    public static function snippet(?string $html): string
    {
        if ($html === null || $html === '') {
            return '';
        }

        $text = html_entity_decode((string) preg_replace('/<[^>]*>/', ' ', $html), ENT_QUOTES, 'UTF-8');

        return trim((string) preg_replace('/[\s\x{00A0}]+/u', ' ', $text));
    }

    /**
     * Rendu frontend d'un contenu riche Trix : la légende imposée sous les
     * images (figcaption = nom du fichier par défaut) est supprimée et
     * recopiée dans l'attribut alt de l'image (accessibilité).
     */
    public static function render(?string $html): string
    {
        if ($html === null || $html === '' || ! str_contains($html, '<figure')) {
            return $html ?? '';
        }

        $document = new DOMDocument();
        libxml_use_internal_errors(true);
        $document->loadHTML('<?xml encoding="UTF-8">' . $html);
        libxml_clear_errors();

        $changed = false;
        foreach (iterator_to_array($document->getElementsByTagName('figure')) as $figure) {
            $captions = $figure->getElementsByTagName('figcaption');
            if ($captions->length === 0) {
                continue;
            }

            $caption = trim($captions->item(0)->textContent);
            $captions->item(0)->remove();
            $changed = true;

            if ($caption !== '') {
                foreach ($figure->getElementsByTagName('img') as $img) {
                    if (trim((string) $img->getAttribute('alt')) === '') {
                        $img->setAttribute('alt', $caption);
                    }
                }
            }
        }

        if (! $changed) {
            return $html;
        }

        $rendered = '';
        $body = $document->getElementsByTagName('body')->item(0);
        foreach ($body->childNodes ?: [] as $node) {
            $rendered .= $document->saveHTML($node);
        }

        return trim($rendered);
    }
}

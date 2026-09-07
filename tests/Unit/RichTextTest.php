<?php

namespace Tests\Unit;

use App\Support\RichText;
use PHPUnit\Framework\TestCase;

class RichTextTest extends TestCase
{
    public function test_snippet_replaces_tags_by_spaces(): void
    {
        $this->assertSame(
            'Sur la cloche du temple Endormi Un papillon Yosa Buson',
            RichText::snippet('Sur la cloche du temple<br>Endormi<br>Un papillon<br>Yosa Buson'),
        );
    }

    public function test_snippet_decodes_entities_and_collapses_whitespace(): void
    {
        $this->assertSame('Fin de ligne. Début', RichText::snippet('Fin de ligne. &nbsp;  Début'));
    }

    public function test_snippet_handles_null_and_empty(): void
    {
        $this->assertSame('', RichText::snippet(null));
        $this->assertSame('', RichText::snippet(''));
    }

    public function test_render_moves_figcaption_to_alt_and_removes_caption(): void
    {
        $html = '<p>Avant</p><figure data-trix-attachment="{}"><img src="a.png"><figcaption class="attachment__caption">photo.png</figcaption></figure><p>Après</p>';

        $out = RichText::render($html);

        $this->assertStringNotContainsString('figcaption', $out);
        $this->assertStringContainsString('alt="photo.png"', $out);
        $this->assertStringContainsString('Avant', $out);
        $this->assertStringContainsString('Après', $out);
    }

    public function test_render_keeps_html_without_figures_untouched(): void
    {
        $html = '<p>Texte <b>gras</b></p>';

        $this->assertSame($html, RichText::render($html));
    }

    public function test_render_preserves_existing_alt(): void
    {
        $html = '<figure><img src="a.png" alt="déjà là"><figcaption>nom.png</figcaption></figure>';

        $out = RichText::render($html);

        $this->assertStringContainsString('alt="déjà là"', $out);
        $this->assertStringNotContainsString('nom.png', $out);
    }
}

<div>
    @if ($track == 'none')

    @else
        <div class="track-title row py-2 align-items-center mh-100"
             x-data="textScrollChecker()"
             x-init="checkTextOverflow()"
             wire:key="track-title-{{ $track->id }}">
            <div class="col-3 me-auto img-track-player">
                <img src="{{ url('storage/'.$track->picture) }}"
                     class="card-img-top border rounded mw-100 mh-100"
                     alt="..."
                     style="background: {{ $track->getHexaColor() }};"/>
            </div>
            <div class="col-10 col-lg-6">
                <div class="scrolling-text-container" x-ref="container">
                    <h5 class="fw-bold fs-6 mb-0 scrolling-text"
                        x-ref="text"
                        :class="{ 'auto-scroll': needsScroll }"
                        title="{{ $track->translate(App::getLocale(), true)->name }}">
                        {{ $track->translate(App::getLocale(), true)->name }}
                    </h5>
                </div>
                <h5 class="fs-6 mb-0 text-wrap text-truncate">{{ $track->interpreters }}</h5>
            </div>
        </div>
    @endif
</div>

@script
<script>
    window.textScrollChecker = function () {
        return {
            needsScroll: false,

            checkTextOverflow() {
                // Attendre que le DOM soit prêt
                this.$nextTick(() => {
                    this.measureText();
                });

                // Re-vérifier lors du redimensionnement de la fenêtre
                window.addEventListener('resize', () => {
                    this.measureText();
                });

                // Re-vérifier quand Livewire met à jour le composant
                Livewire.on('play-track-to-playlist', () => {
                    setTimeout(() => {
                        this.measureText();
                    }, 100);
                });
            },

            measureText() {
                const container = this.$refs.container;
                const text = this.$refs.text;

                if (container && text) {
                    // Retirer temporairement l'animation pour mesurer correctement
                    text.classList.remove('auto-scroll');

                    // Forcer le recalcul des dimensions
                    const containerWidth = container.clientWidth;
                    const textWidth = text.scrollWidth;

                    // Activer le défilement si le texte dépasse + marge de sécurité
                    this.needsScroll = textWidth > (containerWidth + 10);
                }
            }
        }
    }
</script>
@endscript

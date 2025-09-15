<div>
    @if ($track == 'none')

    @else
        <div class="track-title row py-2 align-items-center mh-100 ms-0"
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
                        <div data-text="{{ $track->translate(App::getLocale(), true)->name }}"><span x-ref="textBlock" >{{ $track->translate(App::getLocale(), true)->name }}</span></div>
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
                    console.log('resize') ;
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
                const textBlock = this.$refs.textBlock;
                console.log(container) ;
                if (container && text) {
                    // Retirer temporairement l'animation pour mesurer correctement
                    //text.classList.remove('auto-scroll');

                    // Forcer le recalcul des dimensions
                    const containerWidth = container.clientWidth;
                    const textWidth = textBlock.offsetWidth ;
                    console.log(containerWidth);
                    console.log(textWidth);

                    // Activer le défilement si le texte dépasse + marge de sécurité
                    const newNeedsScroll = textWidth > (containerWidth + 10);


                    console.log(this.needsScroll);
                    console.log(newNeedsScroll);

                    if (this.needsScroll !== newNeedsScroll) {
                        this.needsScroll = newNeedsScroll;
                        console.log('needsScroll updated to:', this.needsScroll);

                        // Forcer Alpine à détecter le changement
                        this.$nextTick(() => {
                            // Re-appliquer la classe si nécessaire
                            console.log('hohohoh');
                            if (this.needsScroll) {
                                text.classList.add('auto-scroll');
                            } else {
                                text.classList.remove('auto-scroll');
                            }
                        });
                    }

                }
            }
        }
    }
</script>
@endscript

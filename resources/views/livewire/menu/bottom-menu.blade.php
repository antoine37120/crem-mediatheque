{{-- mobile --}}
<div>
    <div class="rp-2 bg-white">
        {{-- <div class="col-4">"{{ $menuItem }}" </div> --}}
        <div class="row">
            <div class="col text-center">
                <a href="{{route('home')}}" class="text-black text-decoration-none" wire:navigate>
                    <div>{{ __('menu.home') }}</div>
                    <img src="/storage/icons/Home.png" alt="" class="" style="width: 28px; height: 28px" />
                </a>
            </div>
            <div class="col text-center">
                <a href="{{route('tracks')}}" class="text-black text-decoration-none" wire:navigate>
                    <div>{{ __('menu.tracks') }}</div>
                    <img src="/storage/icons/Tracks.png" alt="" class="" style="width: 28px; height: 28px" />
                </a>
            </div>
            <div class="col text-center">
                <a href="{{route('playlists')}}" class="text-black text-decoration-none" wire:navigate>
                    <div>{{ __('menu.playlists') }}</div>
                    <img src="/storage/icons/Playlist.png" alt="" style="width: 28px; height: 28px" />
                </a>
            </div>
            <div class="col text-center">
                <a href="{{route('podcasts')}}" class="text-black text-decoration-none" wire:navigate>
                    <div>{{ __('menu.podcasts') }}</div>
                    <img src="/storage/icons/podcast.png" alt="" class="" style="width: 28px; height: 28px" />
                </a>
            </div>

            <div class="col text-center pt-2">
                        <div
                            x-data="{
                                open: false,
                                toggle() {
                                    if (this.open) {
                                        return this.close()
                                    }

                                    this.$refs.button.focus()
                                    {{-- remplacer button par menu ? --}}

                                    this.open = true
                                },
                                close(focusAfter) {
                                    if (! this.open) return

                                    this.open = false

                                    focusAfter && focusAfter.focus()
                                }
                            }"
                            x-on:keydown.escape.prevent.stop="close($refs.button)"
                                {{-- remplacer keydown par touch ? et button par menu ? --}}
                            x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                            x-id="['dropdown-button']"
                                {{-- remplacer par dropdown-menu ? --}}
                            class="relative"
                        >
                            <!-- Button -->
                            <button
                                x-ref="button"
                                x-on:click="toggle()"
                                :aria-expanded="open"
                                :aria-controls="$id('dropdown-button')"
                                type="button"
                                class="dropup dropleft relative flex items-center whitespace-nowrap justify-center gap-2 pb-2 rounded-lg bg-white hover:bg-gray-50 text-gray-800 border-0 hover:border-gray-200"
                            >
                            {{-- shadow-sm border-gray-200 --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                </svg>
                            </button>

                            <!-- Panel -->
                            <div
                                x-ref="panel"
                                x-show="open"
                                x-transition.origin.bottom.right
                                x-on:click.outside="close($refs.button)"
                                {{-- remplacer click par touch pour mobile ? button par menu ? --}}
                                :id="$id('dropdown-button')"
                                x-cloak
                                class="position-absolute bottom-0 end-0 vw-100 py-2 rounded-lg shadow-sm z-10 origin-bottom-right bg-white p-1.5 outline-none border border-gray-200"
                             >
                             {{-- bottom-100  --}}
                                <div class="m-auto">
                                    <ul class="list-unstyled text-nowrap fs-5 d-grid gap-0 my-4 ms-3 text-center">
                                        <li>
                                            <a href="{{route('home')}}" class="text-black text-decoration-none d-block pb-1 border-bottom border-black-40" wire:navigate>
                                                <img src="/storage/icons/Home.png" alt="" class="" style="width: 28px; height: 28px"></img>
                                                <span>{{ __('menu.home') }}</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('tracks')}}" class="text-black text-decoration-none d-block pb-1 border-bottom border-black-40" wire:navigate>
                                                <img src="/storage/icons/Tracks.png" alt="" class="" style="width: 28px; height: 28px"></img>
                                                <span>{{ __('menu.tracks') }}</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('playlists')}}" class="text-black text-decoration-none d-block pb-1 border-bottom border-black-40" wire:navigate>
                                                <img src="/storage/icons/Playlist.png" alt="" class="" style="width: 28px; height: 28px"></img>
                                                <span>{{ __('menu.playlists') }}</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('podcasts')}}" class="text-black text-decoration-none d-block pb-1 border-bottom border-black-40" wire:navigate>
                                                <img src="/storage/icons/podcast.png" alt="" class="" style="width: 28px; height: 28px"></img>
                                                <span>{{ __('menu.podcasts') }}</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('cmsPage', ['cmsPage' => 'about']) }}" class="text-black text-decoration-none d-block pb-1 border-bottom border-black-40" wire:navigate>
                                                <img src="/storage/icons/About.png" alt="" class="" style="width: 28px; height: 28px"></img>
                                                <span>{{ __('menu.about') }}</span>
                                            </a>
                                        </li>
                                        <li>
                                        <span class=" w-full d-block pb-1 border-bottom border-black-40 items-center rounded-md text-black-50">{{ __('menu.localization.title') }}</span>
                                        </li>
                                        <li>
                                            <a href="#new" class="text-black text-decoration-none lg:py-1.5 w-full d-block pb-1 border-bottom border-black-40 items-center rounded-md transition-colors text-left text-gray-800 hover:bg-gray-50 focus-visible:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed" wire:navigate>
                                                <span>{{ __('menu.localization.fr') }}</span>
                                            </a>
                                        </li>
                                        <li><a href="#edit" class="text-black text-decoration-none lg:py-1.5 w-full d-block pb-1 border-bottom border-black-40 items-center rounded-md transition-colors text-left text-gray-800 hover:bg-gray-50 focus-visible:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed" wire:navigate>
                                                <span>{{ __('menu.localization.en') }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

            </div>

        </div>


        <div class="d-none">
            <div class="col-4 text-center d-flex flex-column">
                <a href="{{route('tracks')}}" class="text-black text-decoration-none" wire:navigate>
                    <div>Search</div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-search d-inline" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </a>
            </div>
            <div class="col-4 text-center d-flex flex-column">
                <a href="{{route('cmsPage', ['cmsPage' => 'abaout']) }}" class="text-black text-decoration-none" wire:navigate>
                    <div>About</div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-question d-inline" viewBox="0 0 16 16">
                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                    </svg>
                </a>
            </div>
        </div>

    </div>
</div>

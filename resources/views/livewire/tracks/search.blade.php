<div>
    <form wire:submit="playSearch" class="mt-0">
        <div class="row g-5 mx-0 mt-1 mb-4">
            <input type="hidden" name="q" value="{{ $search }}">
            <div class="col-10 offset-1 d-flex flex-column d-lg-none mt-2 mt-md-auto g-5">
                <div class="col-10 col-sm-8 col-md-12 m-auto py-2">
                    <div class="input-group form-text-group">
                        <input type="text" class="form-control form-text-input" name="q" wire:model.live="search" placeholder="Rechercher...">
                        <span class="input-group-text" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg></span>
                    </div>
                </div>
            </div>
            <div class="col-10 offset-1 d-flex flex-column flex-md-row mt-0 mt-md-2mt-lg-auto g-5">
                <div class="col-10 col-sm-8 col-md-3 m-auto pe-md-1 pe-lg-5 py-2 py-md-0">
                    <select class="form-select" name="year" wire:model.live="query_year">
                                <option value="">Année</option>
                        @foreach($years as $year)
                            <option value="{{ $year->id }}" {{ old('year') == $year->id ? 'selected' : '' }}>{{ $year->translate(App::getLocale(), true)->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-10 col-sm-8 col-md-6 m-auto px-md-4 py-2 py-md-0">
                    <select class="form-select" name="geoArea" wire:model.live="query_geoArea">
                                <option value="">Zone</option>
                        @foreach($geoAreas as $geoArea)
                            <option value="{{ $geoArea->id }}" {{ old('geoArea') == $geoArea->id ? 'selected' : '' }}>{{ $geoArea->translate(App::getLocale(), true)->name }}</option>

                            @foreach($geoArea->childs as $geoAreaChild)
                                <option value="{{ $geoAreaChild->id }}" {{ old('geoArea') == $geoAreaChild->id ? 'selected' : '' }}>&nbsp;&nbsp;{{ $geoAreaChild->translate(App::getLocale(), true)->name }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="col-10 col-sm-8 col-md-3 m-auto ps-md-1 ps-lg-5 py-2 py-md-0">
                    <select class="form-select" name="duration" wire:model.live="query_duration">
                                <option value="">Durée</option>
                        @foreach($durations as $duration)
                            <option value="{{ $duration->id }}" {{ old('duration') == $duration->id ? 'selected' : '' }}>{{ $duration->translate(App::getLocale(), true)->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </form>
    <div>
        <div class="row align-items-start m-0">
            <div class="col-10 offset-1">
                <div wire:loading>
                    <div class="">Searching</div>
                </div>
                <div wire:loading.remove>

                @if(sizeof($tracks) == 0)
                    <div class="px-1">
                        <div class="alert alert-light border-0" role="alert">
                            <h4 class="alert-heading">Aucun resultat</h4>
                            <p>{{ $search }}</p>
                        </div>
                    </div>
                    @else
                    <div class="px-1 pe-4 mb-4 text-center">
                        <livewire:tracks.search-actions wire:key="audio-search-actions" />
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row align-items-start g-2 g-md-5 mt-auto mx-0 tracks-list-self">
        @foreach ($tracks as $track)
            {{-- <div class="col-12 col-lg-4 col-xxl-3 px-2 px-lg-5" id="audio-{{ $track->id }}-searchrch-wrap"> --}}
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 ps-2 pe-2 mt-2 mt-md-4" id="audio-{{ $track->id }}-searchrch-wrap">
                <livewire:tracks.teaser :track="$track" wire:key="audio-search-{{ $track->id }}" />
            </div>
        @endforeach
    </div>
</div>

<div>
    <form wire:submit="playSearch" class="mt-0">
        <div class="row g-5 mx-0 mt-1 mb-4">
            <input type="hidden" name="q" value="{{ $search }}">
            <div class="col-10 offset-1 d-flex flex-column flex-md-row g-5">
                <div class="col-10 col-sm-8 col-md-3 m-auto pe-md-5 py-2 py-md-0">
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
                <div class="col-10 col-sm-8 col-md-3 m-auto ps-md-5 py-2 py-md-0">
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
    <div class="row align-items-start">
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

    <div class="row align-items-start g-5 mx-0">
        @foreach ($tracks as $track)
            <div class="col-sm-6 col-lg-4 col-xxl-3 px-5" id="audio-{{ $track->id }}-searchrch-wrap">
                <livewire:tracks.teaser :track="$track" wire:key="audio-search-{{ $track->id }}" />
            </div>
        @endforeach
    </div>
</div>

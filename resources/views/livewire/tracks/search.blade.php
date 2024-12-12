<div>
    {{-- In work, do what you enjoy. --}}
    <div class="row g-5 mx-0 mt-1 mb-5">
        {{-- my-3 --}}
        <form wire:submit="playSearch">
            <input type="hidden" name="q" value="{{ $search }}">
        <div class="row g-5">
            <div class="col-sm-4 px-5">
                <select class="form-select" name="year" wire:model.live="query_year">
                            <option value="">Année</option>
                    @foreach($years as $year)
                        <option value="{{ $year->id }}" {{ old('year') == $year->id ? 'selected' : '' }}>{{ $year->translate(App::getLocale(), true)->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 px-5">
                <select class="form-select" name="geoArea" wire:model.live="query_geoArea">
                            <option value="">Zone géographique</option>
                    @foreach($geoAreas as $geoArea)
                        <option value="{{ $geoArea->id }}" {{ old('geoArea') == $geoArea->id ? 'selected' : '' }}>{{ $geoArea->translate(App::getLocale(), true)->name }}</option>
                        
                        @foreach($geoArea->childs as $geoAreaChild)
                            <option value="{{ $geoAreaChild->id }}" {{ old('geoArea') == $geoAreaChild->id ? 'selected' : '' }}>&nbsp;&nbsp;{{ $geoAreaChild->translate(App::getLocale(), true)->name }}</option>
                        @endforeach
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 px-5">
                <select class="form-select" name="duration" wire:model.live="query_duration">
                            <option value="">Durée</option>
                    @foreach($durations as $duration)
                        <option value="{{ $duration->id }}" {{ old('duration') == $duration->id ? 'selected' : '' }}>{{ $duration->translate(App::getLocale(), true)->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        </form>
    </div>
    <div class="row align-items-start g-5">
        <div wire:loading>
            <div class="">Searching</div>
        </div>
        <div wire:loading.remove>

        @if(sizeof($tracks) == 0)
            <div class="col px-1">
                <div class="alert alert-light border-0" role="alert">
                    <h4 class="alert-heading">Aucun resultat</h4>
                    <p>{{ $search }}</p>
                </div>
            </div>
        @endif

        </div>
    </div>

    <div class="row align-items-start g-5">

    @foreach ($tracks as $track)
        <div class="col-sm-3 px-5" id="audio-{{ $track->id }}-searchrch-wrap">
           <livewire:tracks.teaser :track="$track" wire:key="audio-search-{{ $track->id }}" />
        </div>
    @endforeach
    </div>
</div>

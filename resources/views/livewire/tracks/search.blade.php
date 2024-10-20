<div>
    {{-- In work, do what you enjoy. --}}
    <div class="row g-5">
        <form wire:submit.prevent="search">
        <div class="row g-5">
            <div class="col-sm-4 px-5">
                <select class="form-select" id="category" name="category">
                            <option value="">Select year</option>
                    @foreach($years as $year)
                        <option value="{{ $yer }}" {{ old('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 px-5">
                <select class="form-select" id="category" name="category">
                            <option value="">Select year</option>
                    @foreach($years as $year)
                        <option value="{{ $yer }}" {{ old('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 px-5">
                <select class="form-select" id="category" name="category">
                            <option value="">Select year</option>
                    @foreach($years as $year)
                        <option value="{{ $yer }}" {{ old('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        </form>

    
    <div class="row align-items-start g-5">
    @foreach ($tracks as $track)
        <div class="col-sm-3 px-5">
            <livewire:tracks.teaser :track="$track" wire:key="audio-{{ $track->id }}" />
        </div>
    @endforeach
    </div>
</div>

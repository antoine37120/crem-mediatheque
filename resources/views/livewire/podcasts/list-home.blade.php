<div>
    {{-- In work, do what you enjoy. --}}
    <div class="row align-items-start g-5 pb-5">
    @foreach ($podcasts as $podcast)
        <div class="col-sm-3 px-5">
            <livewire:podcasts.teaser :podcast="$podcast" />
        </div>
    @endforeach
    </div>
</div>

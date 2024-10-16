<div>
    {{-- In work, do what you enjoy. --}}
    <div class="row align-items-start">
    @foreach ($podcasts as $podcast)
    {{-- where playlist has type_id=2 --}}

        <div class="col-3">
            <livewire:podcasts.teaser :podcast="$podcast" />
        </div>
    @endforeach
    </div>
</div>

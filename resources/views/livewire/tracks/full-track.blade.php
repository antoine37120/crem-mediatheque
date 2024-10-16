<div>
    <div class="container mt-5">
        <div class="row w-100" style="width: 18rem;">
            <div class="col-2">
                <img src="{{ url('storage/'.$track->picture) }}" class="card-img-top border rounded" alt="..." style="background: {{ $track->randomColor() }};"/>
            </div>
            <div class="col-10">
                <h5 class="fw-bold">{{ $track->geographicalArea->translate(App::getLocale())->name }}</h5>
                <h5 class="fw-bold">{{ $track->interpreters }}</h5>
                <h5 class="fw-bold">{{ $track->collector }}</h5>
                <div class="">{!! $track->translate(App::getLocale())->description !!}</div>
                <p><a href="{{ $track->link }}" target="_blank"class="btn btn-primary">See on archive</a></p>
            </div>
            <livewire:tracks.actions :track="$track"  wire:key="actions-{{ $track->id }}"/>
        </div>
    </div>
</div>

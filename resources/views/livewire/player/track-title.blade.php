<div>
    @if ($track == 'none')

    @else
    <div class="track-title row py-2 align-items-center mh-100">
        {{-- style="width: 18rem;" --}}
        {{-- w-100 --}}
            <div class="col-3 me-auto img-track-player">
                <img src="{{ url('storage/'.$track->picture) }}" class="card-img-top border rounded mw-100 mh-100" alt="..." style="background: {{ $track->getHexaColor() }};"/>
            </div>
            {{-- <div class="col-3"></div> --}}
            <div class="col-10 col-lg-6">
                <h5 class="fw-bold fs-6 mb-0 text-wrap text-truncate">{{ $track->translate(App::getLocale(), true)->name }}</h5>
                <h5 class="fs-6 mb-0 text-wrap text-truncate">{{ $track->interpreters }}</h5>
            </div>
    </div>
    @endif
</div>

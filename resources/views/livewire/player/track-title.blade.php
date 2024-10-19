<div>
    @if ($track == 'none')  

    @else
    <div class="row w-100 py-2 align-items-center" style="width: 18rem;">
            <div class="col-3">
                <img src="{{ url('storage/'.$track->picture) }}" class="card-img-top border rounded w-100" alt="..." style="background: {{ $track->randomColor() }};"/>
            </div>
            <div class="col-8">
                <h5 class="fw-bold fs-6 mb-0">{{ $track->translate(App::getLocale())->name }}</h5>
                <h5 class="fs-6 mb-0">{{ $track->interpreters }}</h5>
            </div>
    </div>
    @endif
</div>

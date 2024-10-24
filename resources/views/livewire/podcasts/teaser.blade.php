<div>
    <div class="card-track bg-transparent position-relative" >
        <div class="position-relative w-75">
            <img src="{{ url('storage/'.$podcast->picture) }}" class="card-img-top rounded border border-dark" alt="..." style="background: {{ $podcast->randomColor() }};"/>
        </div>
        <div class="py-2">
            <h5 class="podcast-title"><a  href="{{route('podcast', ['podcast' => $podcast->id])}}" class="text-black text-decoration-none fw-bold" wire:navigate>{{ Illuminate\Support\Str::limit($podcast->translate(App::getLocale(), true)->name, 45, '...') }}</a></h5>
            <p class="fs-5">
                {{ $podcast->description }}
            </p>
        </div>
    </div>

</div>

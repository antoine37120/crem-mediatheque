<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    <div class="card" style="width: 18rem;">
        <img src="{{ url('storage/'.$track->picture) }}" class="card-img-top" alt="..." style="background: #000;"/>
        <div class="card-body">
            <h5 class="card-title">{{ $track->name }}</h5>
            <p class="card-text">{{ $track->description }}</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>

</div>

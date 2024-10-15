<div>
    <div class="card" style="width: 18rem;">
        <img src="{{ url('storage/'.$playlist->picture) }}" class="card-img-top" alt="..." style="background: #000;"/>
        <div class="card-body">
            <h5 class="card-title">{{ $playlist->translate(App::getLocale())->name }}</h5>
            <p class="card-text">{{ $playlist->translate(App::getLocale())->description }}</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>

</div>

<div>
    <div class="card" style="width: 18rem;">
        <img src="{{ url('storage/'.$podcast->picture) }}" class="card-img-top" alt="..." style="background: #000;"/>
        <div class="card-body">
            <h5 class="card-title">{{ $podcast->translate(App::getLocale())->name }}</h5>
            <p class="card-text">{{ $podcast->translate(App::getLocale())->description }}</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>

</div>

<div>
    {{-- page d'un podcast avec ses morceaux --}}
    <div class="col-1">
        <div>
            "< / >"
        </div>
    </div>
    <div class="col-10">
        <div class="row align-items-start g-5">
            {{-- teaser modifié de la playlist : img (réduite) + nom + description --}}
            <div class="row">
                <div class="col-sm-2 px-5">
                    {{-- <livewire:podcasts.teaser :podcast="$podcast" /> --}}
                    <img src="{{ url('storage/'.$podcast->picture) }}" class="card-img-top rounded border border-dark" alt="..."/>
                </div>
                <div class="col-sm-10">
                    <h5>nom du podcast</h5>
                    <p>Description podcast: Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cumque quidem corporis repudiandae nostrum maiores repellat, sapiente dolor atque maxime excepturi iure ratione perspiciatis deleniti pariatur mollitia tenetur illo laboriosam voluptate!</p>
                </div>
            </div>
        </div>
    </div>

    {{-- teaser de chaque morceau de la playlist, avec description complète --}}
    <div class="container my-4">
        <div class="row align-items-start my-2 g-5">
            <div class="col-2 px-5">
                {{-- à remplacer par img de track --}}
                <img src="{{ url('storage/'.$podcast->picture) }}" class="card-img-top rounded border border-dark" alt="..."/>
            </div>
            <div class="col-10">
                <h5>Titre du morceau</h5>
                <h5>Aire géographique</h5>
                <h5>Interprête</h5>
                <h5>Collecteur</h5>
                <p>Descriptif moreceau: Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam quae cum inventore praesentium minus dignissimos eum impedit ducimus iste illum dolor, mollitia reprehenderit quod enim nam optio amet provident iure.</p>
            </div>
        </div>
        <div class="row align-items-start my-2 g-5">
            <div class="col-2 px-5">
                {{-- à remplacer par img de track --}}
                <img src="{{ url('storage/'.$podcast->picture) }}" class="card-img-top rounded border border-dark" alt="..."/>
            </div>
            <div class="col-10">
                <h5>Titre du morceau</h5>
                <h5>Aire géographique</h5>
                <h5>Interprête</h5>
                <h5>Collecteur</h5>
                <p>Descriptif moreceau: Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam quae cum inventore praesentium minus dignissimos eum impedit ducimus iste illum dolor, mollitia reprehenderit quod enim nam optio amet provident iure.</p>
            </div>
        </div>
    </div>
</div>

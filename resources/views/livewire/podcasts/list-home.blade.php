<div>
    <h2 class="px-4 pb-4 fw-bold"><a href="{{route('podcasts')}}" class="text-black text-decoration-none" wire:navigate>Podcasts</a></h2>
    <div class="row align-items-start g-5 pb-5">
    @foreach ($podcasts as $podcast)
        <div class="col-sm-6 col-lg-4 col-xxl-3  ps-5">
        <livewire:podcasts.teaser :podcast="$podcast" />
        </div>
    @endforeach
    </div>
</div>

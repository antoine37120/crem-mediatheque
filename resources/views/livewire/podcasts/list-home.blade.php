<div>
    <h2 class="px-4 pb-4 fw-bold"><a href="{{route('podcasts')}}" class="text-black text-decoration-none" wire:navigate>Podcasts</a></h2>
    <div class="row flex-nowrap align-items-start g-5 pb-5 home-podcasts">
    @foreach ($podcasts as $podcast)
        <div class="col-3 ps-5 me-5 me-sm-3 me-lg-0">
            {{-- col-sm-6 col-lg-4 col-xxl-3 --}}
        <livewire:podcasts.teaser :podcast="$podcast" />
        </div>
    @endforeach
    </div>
</div>

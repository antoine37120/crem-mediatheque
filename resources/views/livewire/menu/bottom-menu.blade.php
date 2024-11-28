{{-- mobile --}}
<div>
    <div class="row fixed-bottom p-2">
        {{-- <div class="col-4">"{{ $menuItem }}" </div> --}}
        <div class="col-4">Home
            <a href="{{route('home')}}" class="text-black text-decoration-none" wire:navigate>
                <img src="/storage/app/public/icons/home_24dp_E8EAED.png" alt="img-home">
            </a>
        </div>
        <div class="col-4">Search
                <img src="/storage/app/public/icons/search_24dp_E8EAED.png" alt="img-search">
        </div>
        <div class="col-4">About
            <a href="{{route('cmsPage', ['cmsPage' => 'abaout']) }}" class="text-black text-decoration-none" wire:navigate>
                <img src="/storage/app/public/icons/question_mark_24dp_E8EAED.png" alt="img-about">
            </a>
        </div>
    </div>
</div>

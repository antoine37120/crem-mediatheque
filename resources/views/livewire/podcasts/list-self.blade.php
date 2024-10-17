<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="row align-items-start g-5">
    @foreach ($podcasts as $podcast)
        <div class="col-sm-3 px-5">
            <livewire:podcasts.teaser :podcast="$podcast" />
        </div>
    @endforeach
    </div>
</div>

<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="row align-items-start">
    @foreach ($podcasts as $podcast)
        <div class="col-3">
            <livewire:podcasts.teaser :podcast="$podcast" />
        </div>
    @endforeach
    </div>
</div>

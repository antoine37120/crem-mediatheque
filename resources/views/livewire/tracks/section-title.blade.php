<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="">
    @if ($track->itemBefore() != null)
    <a href="{{route('track', ['audioItem' => $track->itemBefore()?->audio_item_id])}}" wire:navigate class="d-inline-block text-white align-top p-1"> < prev</a>
    @endif
    @if ($track->itemAfter() != null)
    <a href="{{route('track', ['audioItem' => $track->itemAfter()?->audio_item_id])}}" wire:navigate class="d-inline-block text-white align-top p-1"> next ></a>
    @endif
    <h2 class="d-inline-block w-75 align-top pt-1">{{ $track->translate(App::getLocale())->name }}</h2>
    </div>

</div>

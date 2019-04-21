<div class="modal-realisation">
    <div title="Fermer la fenêtre" class="close-realisation">X</div>
    <div class="slideshowContainer">
        @foreach($images as $k => $image)
        <figure class="slides" data-idex="{{$k}}">
            <div class="slideNumber">
                {{$k + 1 .'/'. count($images)}}
            </div>
            <img src="{{asset('storage/uploads/' . $image->name)}}" alt"">
            @if($image->description != null || $image->description != '')
            <div class="legend">{{$image->description}}</div>
            @endif
        </figure>
        @endforeach
    </div>
</div>
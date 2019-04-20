<div class="modal-realisation">
    <div title="Fermer la fenêtre" class="close-realisation">X</div>
    <div class="slideshowContainer">
        @foreach($images as $k => $image)
        <figure class="slides" data-idex="{{$k}}">
            <div class="slideNumber">
                {{$k + 1 .'/'. count($images)}}
            </div>
            <img src="{{asset('storage/uploads/' . $image->name)}}" alt"">
            <div class="legend">Lorem ipsum, dolor sit amet
                consectetur adipisicing elit. Natus, eos, iusto unde
                quos enim, magni corporis ducimus commodi repudiandae
                aperiam saepe! Impedit perferendis expedita esse placeat earum,
                quibusdam numquam optio!</div>
        </figure>
        @endforeach
    </div>
</div>
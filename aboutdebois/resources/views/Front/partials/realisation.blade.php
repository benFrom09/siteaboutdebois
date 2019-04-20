<section id="realisations">
    <div class="section-title">
        <h2 class="title-center">Réalisations</h2>
    </div>
    <hr>
    <div class="slider-container">

        <div class="slider" id="slider">
            @foreach($images as $image)
            @if($image->published == 1)
            <div class="slider-item" data-id="{{$image->id}}">
                <div class="slider-image">
                    <img class="s-img" src="{{asset('storage/uploads/'. $image->name)}}" alt="$image->description">
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>
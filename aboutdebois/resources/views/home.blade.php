@extends('layouts.back')
@section('content')
<div class="site-wrapper">
    <div class="site-wrapper-inner text-white text-center">
        <i class="fas fa-spinner fa-pulse fa-4x"></i>
    </div>
</div>
<div class="container-fluid" id="gallery">
    @isset($category)
    <h2 class="text-title mb-3">{{ $category->name }}</h2>
    @endif
</div>
<div class="d-flex justify-content-center">
    {{ $images->links() }}
</div>
<div class="galery-container">
    @foreach($images->items() as $image)
    <div class="card" id="image{{ $image->id }}">
        <a href="{{ url('storage/uploads/' . $image->name) }}" class="image-link">
            <img class="card-img-top" src="{{ asset('storage/thumbs/' . $image->name) }}" alt="image">
        </a>
        @isset($image->description)
        <div class="card-body">
            <p class="card-text">{{ $image->description }}</p>
        </div>
        @endisset
        <div class="card-footer text-muted">
            <em>
                <a href="#" data-toggle="tooltip"
                    title="{{ __('Voir les photos de ') . $image->name }}">{{ $image->name }}</a>
            </em>
            <div class="pull-right">
                <em>
                    {{ $image->created_at->formatLocalized('%x') }}
                </em>
            </div>
        </div>
        @include('Admin.page.partials.gestionphotos')
    </div>

    @endforeach
</div>
<div class="d-flex justify-content-center">
    {{ $images->links() }}
</div>
</main>
@endsection
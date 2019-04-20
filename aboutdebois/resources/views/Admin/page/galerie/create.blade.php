@extends('layouts.back')
@section('content')
@component('partials.components.card')
@slot('title')
@lang('Ajouter une image')
@endslot
<form method="POST" action="{{ route('galery.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group{{ $errors->has('image') ? ' is-invalid' : '' }}">
        <div class="custom-file">
            <input type="file" id="image" name="image"
                class="{{ $errors->has('image') ? ' is-invalid ' : '' }}custom-file-input" required>
            <label class="custom-file-label" for="image"></label>
            @if ($errors->has('image'))
            <div class="invalid-feedback">
                {{ $errors->first('image') }}
            </div>
            @endif
        </div>
        <br>
    </div>
    <div class="form-group preview-container">
        <img id="preview" class="img-fluid" src="#" alt="">
    </div>
    <div class="form-group">
        <label for="category_id">@lang('Catégorie')</label>
        <select id="category_id" name="category_id" class="form-control">
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    @include('partials.form-group', [
    'title' => __('Description (optionnelle)'),
    'type' => 'text',
    'name' => 'description',
    'required' => false,
    ])
    @component('partials.components.button')
    @lang('Envoyer')
    @endcomponent
</form>
@endcomponent

@endsection
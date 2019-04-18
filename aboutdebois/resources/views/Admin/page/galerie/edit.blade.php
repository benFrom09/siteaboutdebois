@extends('layouts.back')
@section('content')
@component('partials.components.card')
@slot('title')
@lang('Editer une image')
@endslot
<form method="POST" action="{{ route('galery.update',$image->id) }}">
    @csrf
    <div class="card preview">
        <img src="{{asset('storage/thumbs/' . $image->name)}}" alt="" class="img-thumbnail">
    </div>
    <div class="form-group">
        <label for="name">@lang('Nom de l\'image')</label>
        <input class="form-control" type="text" name="name" id="name" value="{{$image->name}}">
    </div>
    <div class="form-group">
        <label for="category_id">@lang('Catégorie')</label>
        <select id="category_id" name="category_id" class="form-control">
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="description">@lang('Description (optionnelle) ')</label>
        <input class="form-control" type="text" name="description" id="description" value="{{$image->description}}">
    </div>

    @component('partials.components.button')
    @lang('Editer')
    @endcomponent

</form>
@endcomponent

@endsection
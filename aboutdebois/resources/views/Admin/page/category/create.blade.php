@extends('layouts.back')
@section('content')
@component('partials.components.card')
@slot('title')
@lang('Ajouter une catégorie')
@endslot
<form method="POST" action="{{ route('category.store') }}">
    {{ csrf_field() }}
    @include('partials.form-group', [
    'title' => __('Nom'),
    'type' => 'text',
    'name' => 'name',
    'required' => true,
    ])
    @component('partials.components.button')
    @lang('Envoyer')
    @endcomponent
</form>
@endcomponent
@endsection
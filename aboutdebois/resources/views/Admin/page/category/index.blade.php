@extends('layouts.back')
@section('content')
@component('partials.components.card')
@slot('title')
@lang('Gestion des catégories')
@endslot
<table class="table text-white">
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td>
                <a type="button" href="{{ route('category.destroy', $category->id) }}"
                    class="btn btn-danger btn-sm pull-right" data-toggle="tooltip" data-name="delete-category"
                    title="@lang('Supprimer la catégorie') {{ $category->name }}"><i class="fas fa-trash"></i></a>
                <a type="button" href="{{ route('category.edit', $category->id) }}"
                    class="btn btn-warning btn-sm pull-right mr-2" data-toggle="tooltip"
                    title="@lang('Modifier la catégorie') {{ $category->name }}"><i class="fas fa-edit"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endcomponent
@endsection
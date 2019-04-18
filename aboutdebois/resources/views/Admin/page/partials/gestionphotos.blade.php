<div class="galery-menu" id="{{ $image->id }}">
    <span class="pull-right">
        <span class="menu-icons">
            <a class="image-delete text-danger" href="{{ route('galery.destroy', $image->id) }}" data-toggle="tooltip">
                <i class="fa fa-trash"></i>
                <span class="abdb-info">@lang('Supprimer cette photo')</span>
            </a>
            <a class="description-edit" data-id="{{ $image->id }}" href="{{ route('galery.edit', $image->id) }}"
                data-toggle="tooltip">
                <i class="fa fa-pencil-alt"></i>
                <span class="abdb-info">@lang('Editer/Ajouter une description')</span>
            </a>
            <a class="category-edit" data-id="{{ $image->category_id }}"
                href="{{ route('category.edit', $image->category_id) }}" data-toggle="tooltip">
                <i class="fa fa-edit"></i>
                <span class="abdb-info">@lang('Modifier la catégorie')</span>
            </a>
            <a class="img-publish" data-publish="{{$image->published}}" data-id="{{$image->id}}" href="#"
                data-toggle="tooltip">
                <i class="fa @if($image->published) fa-check @else fa-upload @endif"></i>
                <span class="abdb-info">@if($image->published) @lang('Changer de statut : retirer du
                    slider') @else @lang('Changer de statut : publier')@endif</span>
            </a>
        </span>
        <form action="{{ route('galery.destroy', $image->id) }}" method="POST" class="hide">
            @csrf
            @method('DELETE')
        </form>
    </span>
</div>
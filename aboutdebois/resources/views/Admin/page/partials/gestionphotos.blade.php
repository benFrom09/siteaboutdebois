<div class="galery-menu" id="{{ $image->id }}">
    <span class="pull-right">
        <span class="menu-icons">
            <a class="image-delete text-danger" href="{{ route('galery.destroy', $image->id) }}" data-toggle="tooltip">
                <i class="fa fa-trash"></i>
                <span class="info">@lang('Supprimer cette photo')</span>
            </a>
            <a class="description-manage" href="#" data-toggle="tooltip"
                title="@lang('Editer/Ajouter une description')">
                <i class="fa fa-comment"></i>
            </a>
            <a class="category-edit" data-id="{{ $image->category_id }}" href="{{ route('galery.update', $image->id) }}"
                data-toggle="tooltip" title="@lang('Changer de catégorie')">
                <i class="fa fa-edit"></i>
            </a>
            <a class="published-edit" href="#" data-toggle="tooltip"
                title="@lang('Changer de statut publier/retirer du slider')">
                <i class="fa @if($image->published) fa-graduation-cap @else fa-child @endif"></i>
            </a>
        </span>
        <form action="{{ route('galery.destroy', $image->id) }}" method="POST" class="hide">
            @csrf
            @method('DELETE')
        </form>
    </span>
</div>
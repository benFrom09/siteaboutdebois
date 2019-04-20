<nav role="navigation" class="navbar navbar-expand-md fixed-top ">
    <div id="logo">
        <a class="navbar-brand"><span>a</span> bout de bois</a>
        <span id="menuiserie">menuiserie</span>
    </div>
    <!-- button responsive -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!---->
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav nav-item-container mr-auto">
            <li class="nav-item">
                <a class="abdb-link" href="{{route('static')}}">voir le site<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="abdb-link {{ currentRoute(route('home')) }}" href="{{route('home')}}">Galerie<span
                        class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle
                    @isset($category)
                    {{ currentRoute(route('galery.category', $category->slug)) }}
                    @endisset
            " href="#" id="navbarDropdownCat" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    @lang('Catégories')
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownCat">
                    @foreach($categories as $category)
                    <a class="dropdown-item" data-id="{{$category->id}}"
                        href="{{ route('galery.category', $category->slug) }}">{{ $category->name }}</a>
                    @endforeach
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="btn btn-default dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="true">
                    Menu
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li>
                        <a class="dropdown-item" href="{{ route('category.create') }}">
                            <i class="fas fa-plus"></i> @lang('Ajouter une catégorie')
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('category.index')}}">
                            <i class="fas fa-wrench"></i> @lang('modifier une catégorie')
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('galery.create') }}">
                            <i class="fas fa-plus"></i> @lang('Ajouter une image')
                        </a>
                    </li>
                    <li role="separator" class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<div id="pageHeader">
    <header>
        <div id="logo">
            <div>
                <a href="https://www.pagesjaunes.fr/pros/57407323" target="_blank"><span>a</span> bout de bois</a>
                <span id="menuiserie">menuiserie</span>
            </div>
            <span id="hamburgerBtn">☰</span>
        </div>

        <nav role="navigation">
            <ul id="header-menu">
                <li><a href="{{url('/') . '#'}}">Accueil</a></li>
                <li><a href="{{url('/') . '#presentation'}}">Présentation</a></li>
                <li><a href="{{url('/') . '#realisations'}}">Réalisations</a></li>
                <li><a href="{{url('/') . '#s-about'}}">A propos</a></li>
                <li><a href="{{url('/') . '#s-contact'}}">Contact</a></li>
                @auth
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Déconnection') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <li><a href="{{route('home')}}">Mon Espace</a></li>
                @endauth
            </ul>
        </nav>
    </header>
    <div class="scroll-indic-container">
        <div class="scroll-indic" id="bar"></div>
    </div>
</div>
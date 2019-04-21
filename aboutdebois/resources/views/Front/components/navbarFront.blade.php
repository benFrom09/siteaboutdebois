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
            <li class="nav-item active">
                <a href="#">Acceuil<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a href="{{route('/') . #presentation}}">Présentation</a>
            </li>
            <li class="nav-item">
                <a href="#">Réalisation</a>
            </li>
            <li class="nav-item">
                <a href="#">A propos</a>
            </li>
            <li class="nav-item">
                <a href="#">Contact</a>
            </li>
            @auth
            <li class="nav-item">
                <a href="#">Mon espace</a>
            </li>

            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endauth
        </ul>
    </div>
</nav>
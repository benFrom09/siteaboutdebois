<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        @include('partials.head')
    </head>

    <body>
        <div id="pageHeader">
            <header>
                @include('Admin.components.navbar')
            </header>
        </div>
        <main class="admin">
            @if (session('ok'))
            <div class="container">
                <div class="alert alert-dismissible alert-success fade show" role="alert">
                    {{ session('ok') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif
            @yield('content')
        </main>
    </body>

</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        @include('partials.head')
    </head>

    <body>
        <div id="pageHeader">
            <header>
                @include('Front.components.navbarFront')
                @include('Front.components.scrollindicator')
            </header>
        </div>
        <main class="py-4">
            @yield('content')
        </main>
    </body>

</html>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">

 <!-- CSRF Token -->
 <meta name="csrf-token" content="{{ csrf_token() }}">

 <title>{{ config('app.name', 'A-bout-de-bois') }}</title>

 <!-- Scripts -->
 <script src="{{ asset('js/app.js') }}" defer></script>

 <!-- Favicon -->

 <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon">

 <!-- Fonts -->
 <link rel="dns-prefetch" href="//fonts.gstatic.com">
 <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

 <!-- Styles -->
 <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@component('mail::message')
# {{$validate['object']}}

###Envoyé par {{$validate['email']}}, le {{$date}}<br>

<p>{{$validate['message']}}</p>

###Envoyé depuis {{ config('app.name') . '.com' }}
@endcomponent
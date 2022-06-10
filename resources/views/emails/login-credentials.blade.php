@component('mail::message')
# Tus Credenciales para acceder a {{ config('app.name') }}

Utiliza estas credenciales para acceder al sistema.

@component('mail::button', ['url' => url('login')])
Login
@endcomponent

@component('mail::table')
    | UserName | Contraseña |
    |:---------|:-----------|
    |{{ $user->email }} | {{ $password }}
    
@endcomponent

Gracias por elegirnos,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')

A new user registered.

@component('mail::table')
|               |                     |
|:-------------:|:-------------------:|
| Name          | {{$user->fullname}} |
| Email         | {{$user->email}}    |
@endcomponent

@component('mail::button', ['url' => $url])
View User
@endcomponent


@endcomponent

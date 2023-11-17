@component('mail::message')
# One Time Password

Dear {{ $firstname }},

This is your one time password {{$token}}
DO NOT share it with a third party.


Thanks,<br>
{{ config('app.name') }}
@endcomponent

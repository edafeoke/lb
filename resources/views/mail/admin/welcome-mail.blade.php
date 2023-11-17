@component('mail::message')
# Welcome

Hi {{($user->firstname)}}!

Your account application was submitted successfully.

Awaiting approval.


Thanks,<br>
{{ config('app.name') }}
@endcomponent

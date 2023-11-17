@component('mail::message')
# Account Created

Welcome {{$user->firstname}}, your account has been created successfully

Account Details
@component('mail::table')
|                           |                                                     |
| --------------------------|:---------------------------------------------------:|
| Account Name              | {{$user->fullnames}}                                |
| Account Type              | {{Str::ucfirst($account->account_type)}} Account    |
| Account Number            | {{$account->account_number}}                        |
| Account Balance           | {{money($account->total_balance,$user->currency)}}  |
| Account Currency          | {{$user->currency}}                                 |
@endcomponent

@component('mail::button', ['url' => $url ])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

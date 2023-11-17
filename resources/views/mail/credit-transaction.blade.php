@component('mail::message')
# Credit Transaction

Dear {{$user->firstname}}, you have been credited with the sum of {{money($transaction->amount,$user->currency)}} to your account number {{Str::limit($transaction->account_number,'3','*******')}} on {{$transaction->created_at->format('d/m/Y h:i:s')}} @if($transaction->from_bank) from {{$transaction->from_bank}} @endif.
<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent

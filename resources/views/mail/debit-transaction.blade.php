@component('mail::message')
# Debit Transaction

Dear {{$user->firstname}}, you transferred the sum of {{money($transaction->amount,$user->currency)}} to account number {{Str::limit($transaction->account_number,'3','*******')}} on {{$transaction->created_at->format('d/m/Y h:i:s')}}.
<br>
It may take 3 to 7 working days for this transaction to be successful.
<br>
<br>
If you did not carry out this activity please reply to this email.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

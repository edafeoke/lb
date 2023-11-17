@component('mail::message')
# Transfer Initiated

A new transfer action was initiated.

Transfer Information
@component('mail::table')
|                                |                                |
| -------------------------------|:------------------------------:|
| Sender                         | {{$transfer->user->fullnames}} |
| Bank Name                      | {{$transfer->bank_name}}       |
| Account Name                   | {{$transfer->account_name}}    |
| Account Number                 | {{$transfer->account_number}}  |
| Account type                   | {{$transfer->account_type}}    |
| Transfer Type                  | {{$transfer->type}}            |
| Amount                         | {{money($transfer->amount)}}   |
| Swift                          | {{$transfer->swift}}           |
| Routing                        | {{$transfer->routing}}         |
| Remarks                        | {{$transfer->remarks}}         |

@endcomponent


@component('mail::button', ['url' => $url])
View Transfer
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')
# New Order Notification

Hi {{$user->firstname}},

A new order was carried out in your account.

Order Information
@component('mail::table')
|         Order Id          |      Action            |       Amount           |       Description      |
| --------------------------|:----------------------:|:----------------------:|:----------------------:|
| {{$order->order_id}}      | {{$order->type}}       | {{money($order->amount)}}     | {{$order->description}}|
@endcomponent
@component('mail::button', ['url' => $url])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

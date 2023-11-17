@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
    @if(setting('app_dark_logo')||setting('app_light_logo'))
      <img src="{{(setting('app_sidebar')=='light')? asset('uploads/appLogo/app-logo-dark.png'):asset('uploads/appLogo/app-logo-light.png')}}" alt="App Logo" class=" img brand-image img-responsive" style="opacity: .8; margin:50% display: block; margin-left: auto; margin-right: auto; width: 50%;">
    @else
      {{ config('app.name') }}
    @endif
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent

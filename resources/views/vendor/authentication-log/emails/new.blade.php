@component('mail::message')
# @lang('Hola!')

@lang('Su cuenta de :app inició sesión desde un nuevo dispositivo.', ['app' => $settingGeneral->site_title])

> **@lang('Account:')** {{ $account->email }}<br/>
> **@lang('Time:')** {{ $time->toCookieString() }}<br/>
> **@lang('IP Address:')** {{ $ipAddress }}<br/>
> **@lang('Browser:')** {{ $browser }}<br/>
@if ($location && $location['default'] === false)
> **@lang('Location:')** {{ $location['city'] ?? __('Unknown City') }}, {{ $location['state'], __('Unknown State') }}
@endif

@lang('Si fuera usted, puede ignorar esta alerta. Si sospecha alguna actividad sospechosa en su cuenta, cambie su contraseña.')

@lang('Saludos,')<br/>
{{ $settingGeneral->site_title }}
@endcomponent

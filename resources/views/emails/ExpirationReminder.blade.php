@component('mail::message')
 {{$details['title']}}

<b>Hello!</b> <br >
This is to remind you that your Package will expire on {{$details['date']}}.<br >
In order not to lose any data, kindly click the button below to go to your dashboard and renew this package 

@component('mail::button', ['url' => $details['url']])
Go to dashboard
@endcomponent

Thank you,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')
{{$details['title']}}

{{$details['stat']}}
<br >
{{$details['text']}}

@component('mail::button', ['url' => $details['url']])
Go to dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
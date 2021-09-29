@component('mail::message')
{{$details['title']}} <br>

Sorry, your request to publish an item with product number <b>{{$details['product_id']}}</b> has just been denied <br>
Due to infringement of one or more rules guiding the Bazzar Plus platform 

Click the link below to read the guidelines for publishing products on our platform

@component('mail::button', ['url' => $details['url']])
BazaarPlus Guidelines
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent


@component('mail::message')
{{$details['title']}} <br>

Congratulations, your item with product number <b>{{$details['product_id']}}</b> has just been approved. <br>

You can click on the button below to preview the item

@component('mail::button', ['url' => $details['url']])
Preview Product
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
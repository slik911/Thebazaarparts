@component('mail::message')
Hello,<br>

A potential buyer is interested in one of your products. Please kindly provide them with the quotation as regards to the item below; <br>
Product Name :{{$details['product_name']}}<br>
Product ID :{{$details['product_id']}}<br>

<br>
Customer Details <br>
Name :<span style="text-transform: capitalize">{{$details['fullname']}}</span> <br>
Email :<a href="mailto:{{$details['email']}}">{{$details['email']}}</a> <br>
Phone Number :{{$details['phone']}} <br>
Company Name :<span style="text-transform: capitalize">{{$details['company_name']}}</span> <br>
Address :{{$details['address']}} <br>

@component('mail::button', ['url' => $details['url']])
Click Here to see item
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')
Message<br>
<span style="text-align:justify"> {{$details['message']}}</span><br> <br>
Best Regards, <br>
<span style="text-transform: capitalize">{{$details['fullname']}}</span> <br>
<a href="mailto:{{$details['email']}}">{{$details['email']}}</a> <br>
{{$details['phone']}} <br>
Company: <span style="text-transform: capitalize">{{$details['company_name']}}</span> <br>
Address : {{$details['address']}} <br>
Message Type : <span style="text-transform: capitalize">{{$details['message_type']}}</span> <br>


Sent From,<br>
{{ config('app.name') }}
@endcomponent

@extends('layouts.master')
@section('title')
    About Us
@endsection
@section('content')
    @include('includes.header')
   <div class="container">
       <div class="row mt-5 bg-white p-4">
           <div class="col-md-7 ">
            <h5 style="font-size:20px; font-weight:600" class=" mb-3">SAFETY TIPS</h5>
           <h6 style="font-weight:600"> Stay safe & happy with The Bazaar Plus!</h6>  
            <p style="font-size:14px;">
                Don’t be a victim, watch out for potential scammers. Check out these important tips to avoid being scammed:
            Are you selling an Item on The Bazaar Plus?
            </p>
            <ul style="font-size:14px">
                <li>Do not share your personal information with anyone - even if they claim they are from The Bazaar Plus </li>
                <li>The only email account The Bazaar Plus uses for customer support is support@thebazaarplus.com</li>
            </ul>
 	
            <h6 style="font-weight:600">Are you looking for a job on The Bazaar Plus?</h6>  
            <ul style="font-size:14px">
                <li>Never wire money in or outside the country to process the visa and other documents for the promised job. </li>
                <li>Never pay for an application fee. It is illegal for recruiters to request a fee from job applicants.</li>
                <li>Always verify the authenticity of the company you are dealing with before taking a decision to accept job offers. Do some research on the company, read reviews, check if they have a website and compare the information that has been sent to you from them.</li>
                <li>
                    Verify the company and visit their office if possible.
                </li>
                <li>Stay alert for suspicious signs such as companies using free email domains, errors in grammar and spelling and ads offering attractive salaries without requiring any experience or skills.</li>
            </ul>
            	
            <h6 style="font-weight:600">Are you selling your personal items on The Bazaar Plus ?</h6>
            <ul style="font-size:14px">
                <li>Never reply to an SMS with your credit card information. The Bazaar Plus will never send an SMS asking for your personal information. </li>
                <li>Never respond to any email claiming to represent The Bazaar Plus concerning your ads except for support@thebazaarplus.com.</li>
                <li>The only email account The Bazaar Plus uses for customer support is support@thebazaarplus.com 
                    Are you buying a personal Item on The Bazaar Plus?</li>
                <li>
                    Never send money to anyone in or outside the country unless you see the actual product and meet the owner face to face.
                </li>
                <li>Always be sure that the seller is verified, if you are buying from Bazaar Parts, be sure the seller has our official verification badge on their profile.</li>
            </ul>

            <h6 style="font-weight:600">What should you do if you suspect a scam?</h6>
           <p style="font-size:14px">
            If you suspect you've been scammed don't hesitate to contact our support team immediately through the contact us form.
            Our support team will then delete the scam ad and block the user’s account.
           </p>
            <h6 style="font-weight:600">Stay safe & happy with The Bazaar Plus! </h6>
             <span style="color:red; font-style:italic; font-size:14px;">
                Disclaimer: The Bazaar Plus is a platform to facilitate exchanges, any interactions that happen off the platform are the sole responsibility of the buyer and the seller.
             </span>
            
           </div>

              <div class="col-md-5 d-none py-5 pt-5 d-sm-block">
                <center><img src="{{asset('images/Safety.jpg')}}" alt=""</center>
              </div>

       </div>
   </div>
@endsection
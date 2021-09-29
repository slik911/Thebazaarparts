@extends('layouts.master')
@section('title')
    About Us
@endsection
@section('content')
    @include('includes.header')
   <div class="container">
       <div class="row mt-5 bg-white p-4">
           <div class="col-md-7 ">
            <h5 style="font-size:20px; font-weight:600" class=" mb-3">FAQ</h5>
           <h6 style="font-weight:600"> How can I register as a user?</h6>  
            <p style="font-size:14px;">
                From the login, click on register and follow instruction (Your can either register automatically with your Gmail or Facebook account).  Note: active whatsapp number is recommended during registration. 
            </p>
         
 	
            <h6 style="font-weight:600">How can I register as a company?</h6> 
            <p  style="font-size:14px;">After registering as a normal user under Bazaar Parts, you can apply to become a seller by registering your company details. </p> 
            <ul style="font-size:14px">
                <li>Tips: Click on “Become seller” at the top right side at the Bazaar parts home page.</li>
            </ul>
            	
            <h6 style="font-weight:600">What are the documents required to become a verified member?</h6>
            <p  style="font-size:14px;">For Bazaar Parts; Company trade license and manager / owner identity card like International passport or National ID Card.
                For Bazaar community: User identity card like International passport or National ID Card.
                 </p> 
                <ul style="font-size:14px">
                <li>Tips: In the dashboard, click on <b>“Verify”</b> and follow instruction. </li>
                
            </ul>

            <h6 style="font-weight:600">How can I buy a package in Bazaar Parts?</h6>
            <p  style="font-size:14px;">There are two membership option; Economic package and membership package.
                 </p> 
                <ul style="font-size:14px">
                <li>	Tips: In the dashboard of Bazaar Parts, click Package Manager . </li>
                
            </ul>

            <h6 style="font-weight:600">How can I buy packages in Bazaar Community?</h6>
           <p style="font-size:14px">
            There are several options; You can become a premium member which gives you more access in the platform or you can buy promotional ad packages.  
           </p>
           <ul style="font-size:14px">
            <li>Tips: In the dashboard of Bazaar community, click premium membership to subscribe or click on community ads to purchase individual ad packages. </li>

        </ul>

        <h6 style="font-weight:600">How can I post on Bazaar community request?</h6>
           <ul style="font-size:14px">
            <li>Tips: In the dashboard of Bazaar community, click on request manager and follow instructions.</li>
                
        </ul>
            
           </div>

              <div class="col-md-5 py-5 pt-5 d-none d-sm-block">
                <center>
                    <img src="{{asset('images/FAQ.jpg')}}" alt="">
                </center>
              </div>

       </div>
   </div>
@endsection
@extends('layouts.master')
@section('title')
    Contact Us
@endsection
@section('cssfiles')
    <link rel="stylesheet" href="{{asset('css/contact.css')}}">
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
@endsection
@section('jsfiles')
<script src="{{asset('js/toastr.min.js')}}"></script>
@endsection
@section('content')
@include('includes.header')

<section class="contact-area  py-5">
    {{-- <div id="map"></div> --}}
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="contact-box-tp">
                    <h4>Contact Info</h4>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="contact-box d-flex">
                            <div class="contact-icon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="contact-content">
                                <h6>Our Location</h6>
                                <p>Plot 16 House 1 Oduguwa Ogunsanya Green Estate Amuwo Odofin Lagos.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="contact-box d-flex">
                            <div class="contact-icon">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div class="contact-content">
                                <h6>Email Address</h6>
                                <p>enquiry@thebazaarparts.com <br>support@thebazaarparts.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="contact-box d-flex">
                            <div class="contact-icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="contact-content">
                                <h6>Phone Number</h6>
                                <p>+234 806 3815290<br></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="social-link">
                    <ul class="list-unstyled list-inline">
                        <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-youtube"></i></a></li>
                        <li class="list-inline-item"><a href="https://www.instagram.com/thebazaarplus_official/" target="blank"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="contact-form">
                    <h4>Get In Touch</h4>
                    <form action="{{route('contact.send')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <p><input type="text" id="name" name="name" placeholder="Full Name" required=""></p>
                             </div>
                            <div class="col-md-6">
                                <p><input type="text" id="email" name="email" placeholder="Email" required=""></p>
                            </div>
                            <div class="col-md-6">
                                <p><input type="text" id="phone" name="phone" placeholder="Phone Number"></p>
                            </div>
                            <div class="col-md-6">
                                <p><input type="text" id="company_name" name="company_name" placeholder="Company Name"></p>
                            </div>
                            <div class="col-md-12">
                                <p><input type="text" id="address" name="address" placeholder="Address" required></p>
                            </div>

                            <div class="col-md-12">
                                <p>

                                      <select class="form-control form-control-md" name="type" id="type" >
                                        <option><span id="select_placeholder">Select message type</span></option>
                                        <option value="request for quote">Request for Quote</option>
                                        <option value="enquired">Enquiries</option>
                                        <option value="others">Others</option>
                                      </select>

                                </p>
                            </div>
                            <div class="col-md-12">
                                <p><textarea name="message" id="message" placeholder="Message" required=""></textarea></p>
                            </div>
                            <div class="col-md-12">
                                <button type="submit">Send Message</button>
                            </div>
                        </div>
                        <div id="form-messages"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')

    <script>
        $(document).ready(function() {
            @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
            @endif
        });

    </script>
@endsection

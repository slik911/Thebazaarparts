@extends('layouts.master')
@section('title')
    Register
@endsection
@section('csslinks')
<link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
@endsection
@section('jsfiles')
<script src="{{asset('js/toastr.min.js')}}"></script>
<script src="{{asset('js/jquery.steps.min.js')}}"></script>
@endsection
@section('content')
@include('includes.header')
<nav class="breadcrumb bg-light justify-content-center" style="font-size:13px;">
    <a class="breadcrumb-item" href="{{route('parts')}}" style="color:#54268c; text-decoration:none">Home</a>
        <span class="breadcrumb-item active">Login</span>
    </nav>
<div id="registerUser">
    <div class="container">
        <div class="row" style="margin-top:30px; ">
            <div class="col-md-7 mx-auto">
                <div class="row d-block d-sm-none">
                    <div class="col-md-5 mx-auto">
                    <div class="row">
                        <div class="col-12">
                            <h3 style="font-weight:501; font-size:15px;" class="text-center mb-3">SIGN UP </h3>
                        </div>
                        <div class="col-6">

                            <a href="{{ url('auth/google') }}" class="btn btn-outline btn-block pt-2 pb-2 shadow-sm" style="border:1px solid #ccc;">
                                <img src="{{asset('images/google.svg')}}" alt="" width="20px" height="20px" style="margin-left:-20px; margin-top:-5px;"> <span style="font-family: sans-serif; font-weight:500; margin-left:5px;">  Google</span>
                                </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ url('auth/facebook') }}" class="btn btn-outline btn-block p-2" style="border:1px solid #ccc; background:#3b5999">
                                <img src="{{asset('images/facebook.svg')}}" alt="" width="20px" height="20px" style="margin-top:-8px;"> <span style="font-family: sans-serif; font-weight:500; margin-left:5px;">  <b class="text-white" style="margin-top:20px;" >Facebook</b></span>
                            </a>
                        </div>
                        <div class="col-12">
                            <p class="text-center" style="margin-bottom:10px; margin-top:5px"><em>Or</em></p>
                        </div>
                    </div>

                    </div>
                </div>

                <h5 class="mb-3  d-none d-sm-block">Register  BazaarPlus</h5>


                    <ul class="nav nav-pills mb-3 nav-justified" style=" text-center" id="pills-tab" role="tablist">
                        <li class="nav-item link1" role="presentation">
                          <a class="nav-link active"  style="color:#919191" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa fa-user-circle" aria-hidden="true" onclick=""></i> Personal Information</a>
                        </li>
                        <li class="nav-item link2" role="presentation">
                          <a class="nav-link"  style="color:#919191" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fa fa-key    "></i> Login Information</a>
                        </li>
                        <li class="nav-item link3" role="presentation">
                          <a class="nav-link"  style="color:#919191" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fa fa-check-circle" aria-hidden="true"></i> Finish Registration</a>
                        </li>

                      </ul>

                  <form action="{{ route('register') }}" id="form" method="POST">
                      @csrf

                      <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Full Name :</label>
                                        <input id="name" type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address :</label>
                                        <input id="address" type="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}"  autocomplete="address">

                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Phone :</label>
                                        <input id="phone" type="phone" class="form-control  @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  autocomplete="phone" placeholder="+2348030000000">

                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Country :</label>
                                        <select  class="form-control @error('country') is-invalid @enderror"   autocomplete="country" name="country" id="country">
                                            <option value="" >Select Country...</option>
                                            @foreach ($countries as $country)
                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach
                                          </select>

                                        @error('country')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>State :</label>
                                        <select  name="state" id="state"  class="form-control @error('state') is-invalid @enderror" name="state"  autocomplete="state">
                                            <option value="">Choose State</option>
                                          </select>

                                        @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <a class="btn  btn-warning btnNext text-white">Next</a>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Email Address :</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Password :</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Confirm Password :</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <a class="btn  btn-secondary btnPrevious text-white">Previous</a>
                                        <a class="btn  btn-warning btnNext2  text-white">Next</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="row">
                                <div class="col-12 pl-4">
                                    <p> I am a ?</p>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input checkInput" id="buyer" name="role" value="buyer">
                                        <label class="custom-control-label m-0" for="buyer">Buyer</label>
                                    </div>

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input checkInput" id="seller" name="role" value="seller">
                                        <label class="custom-control-label m-0" for="seller">Seller</label>
                                    </div>
                                </div>
                                <div class="col-md-12" id="comp1">
                                    <div class="form-group">
                                        <label>Company Name : <small><em>(For Sellers Only)</em></small></label>
                                        <input name="company_name" type="text" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-12" id="comp2">
                                    <div class="form-group">
                                        <label>Company Address :</label>
                                        <input name="company_address" type="text" class="form-control" >
                                    </div>

                                </div>
                                <div class="col-12 pl-4 mt-3 mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="terms" name="terms" value="true" >
                                        <label class="custom-control-label m-0" for="terms">I agree to <a href="{{route('terms')}}">Terms and Conditions</a></label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <a class="btn btn-warning btnPrevious text-white">Previous</a>
                                        <input type="submit" value="Finish" class="btn btn-secondary  text-white" id="finish">
                                    </div>
                                </div>
                            </div>
                      </div>
                      </div>
                  </form>

            </div>
            <div class="col-md-4 d-none d-sm-block" style="order:0">
                <div class="row py-5">

                    <div class="col-12">
                        <h3 style="font-weight:501; font-size:15px;" class="text-center mb-3">SIGN UP </h3>
                        <a href="{{ url('auth/google') }}" class="btn btn-outline btn-block pt-2 pb-2" style="border:1px solid #ccc;">
                            <img src="{{asset('images/google.svg')}}" alt="" width="20px" height="20px" style="margin-left:-20px; margin-top:-5px;"> <span style="font-family: sans-serif; font-weight:500; margin-left:5px;">  Google</span>
                            </a>
                    </div>
                    <div class="col-12">
                        <p class="text-center" style="margin-bottom:10px; margin-top:10px"><em>Or</em></p>
                    </div>
                    <div class="col-12">
                        <a href="" class="btn btn-outline btn-block p-2" style="border:1px solid #ccc; background:#3b5999">
                            <img src="{{asset('images/facebook.svg')}}" alt="" width="20px" height="20px" style="margin-top:-8px;"> <span style="font-family: sans-serif; font-weight:500; margin-left:5px;">  <b class="text-white" style="margin-top:20px;" >Facebook</b></span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
    <script>
        $(document).ready(function(){

            @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
            @endif

            $('#comp1').hide();
            $('#comp2').hide();
            $('.link1 a').addClass('disabled, text-white');
            $('.link2 a').addClass('disabled');
            $('.link3 a').addClass('disabled');


          $('#country').val(160);


            var country = 160;

            $.ajax({
                    method: 'get',
                    url:"{{route('getstate')}}",
                    data:{id:country},
                    success: function(data){
                        $('#state').html('<option value="">Select State</option>');
                            $.each(data, function(key, value){
                            $('#state').append('<option value = '+value.id+ '>'+value.name+'</option>');
                        });
                    }
                });

                $('#country').on('change', function(){
                var id = $(this).val();
                $.ajax({
                    method: 'get',
                    url:"{{route('getstate')}}",
                    data:{id:id},
                    success: function(data){
                        $('#state').html('<option value="">Select State</option>');
                            $.each(data, function(key, value){
                            $('#state').append('<option value = '+value.id+ '>'+value.name+'</option>');
                        });
                    }
                });
            });


            $('.btnNext').click(function(){
                var name = $('#name').val();
                var add = $('#address').val();
                var phone = $('#phone').val();
                var pattern = /^(\+234)\d{10}$/;
                var country = $('#country').val();
                var state = $('#state').val();

                if(name==""){
                toastr.error('First name is required')
                    $('.link2 a').addClass('disabled');
                }
                else if(add==""){
                    toastr.error('Address is required')
                    $('.link2 a').addClass('disabled');
                }
                else if(phone==""){
                    toastr.error('Phone is required')
                    $('.link2 a').addClass('disabled');
                }
                else if(!phone.match(pattern)){
                    toastr.error("Phone number format does not match");
                    $('.link2 a').addClass('disabled');
                }
                else if(country==""){
                    toastr.error('Country is required')
                    $('.link2 a').addClass('disabled');
                }
                else if(state==""){
                    toastr.error('State is required')
                    $('.link2 a').addClass('disabled');
                }
                else{
                    $('.link2 a').removeClass('disabled');
                    $('.link1 a').removeClass('disabled, text-white');

                    $('.nav-pills  .active').parent().next('li').find('a').trigger('click');
                }

            });


            $('.btnNext2').click(function(){
                var pwd = $('#password').val();
                var email = $('#email').val();
                var cpwd = $('#password-confirm').val();

                if(email == ""){
                    toastr.error('Email is required')
                    $('.link3 a').addClass('disabled');
                }
                else if(pwd == ""){
                    toastr.error('Password is required')
                    $('.link3 a').addClass('disabled');
                }
                else if(cpwd == ""){
                    toastr.error('Confirm Password is required')
                    $('.link3 a').addClass('disabled');
                }
                else if(pwd != cpwd){
                    toastr.error('Passwords does not match')
                    $('.link3 a').addClass('disabled');
                }
                else{
                    $('.link3 a').removeClass('disabled');
                    $('.link2 a').removeClass('disabled, text-white');
                    $('.nav-pills  .active').parent().next('li').find('a').trigger('click');
                }
            });

            $('.checkInput').on('change', function() {
                $('.checkInput').not(this).prop('checked', false);
                if($('.checkInput:checked').val() == 'seller'){
                    $('#comp1').slideDown("slow");
                    $('#comp2').slideDown("slow");
                }
                else{
                    $('#comp1').slideUp("slow");
                    $('#comp2').slideUp("slow");
                }
            });


            $('#finish').click(function(){
            event.preventDefault();
            // alert('ok')

            var val = $('.checkInput:checked').val();
            var terms = $('#terms:checked').val();

            if(!val){
                toastr.error('Are you a Buyer or a Seller?, Please Select one.')
            }
            else if(!terms)
            {
                toastr.error('Please read the terms and conditions and agree before you register');
            }
            else{

                $('#form').submit();
            }
           });


            $('.btnPrevious').click(function(){
            $('.nav-pills  .active').parent().prev('li').find('a').trigger('click');
            });



        });
    </script>
@endsection

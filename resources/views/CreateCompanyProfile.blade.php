@extends('layouts.master')
@section('title')
    Company Profile
@endsection
@section('csslinks')
<link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
@endsection
@section('jsfiles')
<script src="{{asset('js/toastr.min.js')}}"></script>
@endsection
@section('content')
@include('includes.header')
    <div id="content-profile" class=" p-2">
        <div class="container">

                <form action="{{route('buyer.profileUpdate')}}" id="form_details" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-5 pl-3 pr-3 pb-5">
                            <div class="col-12">
                                <h5 style="font-weight:501">Register Company Information</h5>
                                <p style="font-size:13px">Fill all fields to be able to sell on this platform</p>
                            </div>
                            <div class="col-md-8 order-lg-0 order-1">

                                <div class="form-group mt-md-0 mt-3">
                                  <label for="">Company Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="" placeholder="" aria-describedby="helpId" required>
                                </div>
                                <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" name="address" id="address" class="form-control"  value=""  placeholder="" aria-describedby="helpId" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                                    </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="">Phone Number</label>
                                        <input type="text" name="phone" id="phone" class="form-control"  value=""  placeholder="+2348030000000" aria-describedby="helpId" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" id="email" class="form-control"  value=""  placeholder="" aria-describedby="helpId"  required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="">Business Type</label>
                                        <input type="text" name="business_type" id="business_type" class="form-control"  value=""  placeholder="" aria-describedby="helpId" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="">Website</label>
                                        <input type="text" name="website" id="website" class="form-control" value=""   placeholder="" aria-describedby="helpId">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-warning text-white" id="save">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mx-auto order-0">
                                <center><div id="profile-pic" style="border:1px solid #ccc; width:200px; height:200px;">

                                <img id="blah"  src="http://placehold.it/400" alt="your image" style="width:200px; height:200px; object-fit:cover; object-position:center;"/>

                                </div>
                                <input type='file' name= "image" id="image" required onchange="readURL(this);" class="pl-4 mt-4" style="background:#" />

                                {{-- @if ($profile->slug)
                                <a href="{{route('parts.company_profile', ['slug' => $profile->slug])}}" target="blank" class="btn btn-block btn-warning mt-3">Preview Profile</a>
                                @else
                                <a href="#" class="btn btn-block btn-warning mt-3 disabled">Preview Profile</a>
                                @endif --}}

                            </center>


                            </div>



                        </div>
                    </form>

        </div>
    </div>
@endsection

@section('js')
    <script>
$(document).ready(function() {
		@if(Session::has('success'))
		toastr.success("{{ Session::get('success') }}");
		@endif

		@if(Session::has('info'))
		toastr.info("{{ Session::get('info') }}");
		@endif

		@if(Session::has('warning'))
		toastr.warning("{{ Session::get('warning') }}");
		@endif


		@if(Session::has('error'))
		toastr.error("{{ Session::get('error') }}");
        @endif


        $('#save').click(function(){
                event.preventDefault();
                var ext = $('#image').val().split('.').pop().toLowerCase();
                var name = $('#name').val();
                var address = $('#address').val();
                var desc = $('#description').val();
                var phone = $('#phone').val();
                var pattern = /^(\+234)\d{10}$/;
                var email = $('#email').val();
                var type = $('#business_type').val();
                var image = $('#image').val();
                var website = $('#website').val();

                var pattern2 = /^(http|https)?:\/\/(www\.)?[a-zA-Z0-9-\.]+\.[a-z]{2,4}/;
                var pattern3 = /https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)/;

                if(name == ''){
                    toastr.error("Company name is required");
                }
                else if(address == ''){
                    toastr.error("Address is required");
                }
                else if(desc == ''){
                    toastr.error("description is required");
                }
                else if(phone == ''){
                    toastr.error("phone is required");
                }
                else if(!phone.match(pattern)){
                    toastr.error("Phone number format does not match");
                }

                else if(email == ''){
                    toastr.error("email is required");
                }


                else if(type == ''){
                    toastr.error("Business type  is required");
                }

                else{

                    if(image != ''){

                        var file = $('#image')[0].files[0];
                        if(file.size > 2000000){
                             toastr.error("Maximum file size is 2mb");
                        }
                        else{
                            if ($.inArray(ext, ['gif','png','jpg','jpeg']) == -1){
                                toastr.error("file must be an image");
                            }
                            else{
                                if(website != ''){
                                if(!website.match(pattern3)){
                                    toastr.error("Url doesnt match the format");
                                }
                                else{
                                    // alert('submit');
                                    $('#form_details').submit();
                                }

                                }
                                else{
                                    $('#form_details').submit();
                                    // alert('submit');
                                }
                            }

                        }


                    }
                    else{
                            if(website != ''){
                                    if(!website.match(pattern3)){
                                        toastr.error("Url doesnt match the format");
                                    }
                                    else{
                                        // alert('submit');
                                        $('#form_details').submit();
                                    }

                            }
                            else{
                                $('#form_details').submit();
                                // alert('submit');
                            }
                        }

                }

            });

	});

             function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }



    </script>
@endsection

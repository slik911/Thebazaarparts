@extends('layouts.app')
@section('title')
    Profile
@endsection
@section('cssfile')
<link rel="stylesheet" href="{{asset('css/panel.css')}}">
@endsection
@section('header')
    Seller - Profile
@endsection
@section('content')
    <div id="content-profile" class="bg-white p-3">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="true" style="color:#111">Personal Information</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#company" role="tab" aria-controls="company" aria-selected="false" style="color:#111">Company Profile</a>
                </li>

              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="Personal Information">
                    <div class="row">
                        <div class="col-md-8 mt-5">
                            <h4>Personal Informations</h4>
                        <form action="{{route('profile.update')}}" method="post" >
                                @csrf
                                @method("PUT")
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" id="id" value="{{Auth::user()->id}}" name="id">
                                        <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="name" id="pname" style="text-transform: capitalize" value="{{Auth::user()->name}}" class="form-control" placeholder="" aria-describedby="helpId" required>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="">Phone Number</label>
                                        <input type="text" name="phone" id="phone" value="{{Auth::user()->phone}}" class="form-control" placeholder="" aria-describedby="helpId" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{Auth::user()->email}}" placeholder="" aria-describedby="helpId" required readonly>
                                        </div> 
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <input type="text" name="address" id="address" value="{{Auth::user()->address}}" class="form-control" placeholder="" aria-describedby="helpId" required>
                                            </div> 
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Country</label>
                                            <select class="form-control pb-1" name="country" id="country" required>
                                                @foreach ($country as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>    
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">State</label>
                                            <select class="form-control pb-1" name="state" id="state" required>
                                                @foreach ($state as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-secondary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="company" role="tabpanel" aria-labelledby="Company Profile">
                <form action="{{route('seller.profileUpdate')}}" id="form2" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-5 pl-3 pr-3 pb-5">
                            <div class="col-md-8 order-lg-0 order-1 ">
                                <h4>Company Details</h4>
                                <p><b><span class="text-danger">Notice!</span></b> &nbsp; Profiles will be verified again after each changes made.</p>
                                <div class="form-group">
                                  <label for="">Company Name</label>
                                <input type="text" name="name" id="company_name" class="form-control" value="{{$profile->name}}" placeholder="" aria-describedby="helpId" required>
                                </div>
                                <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" name="address" id="company_address" class="form-control"  value="{{$profile->address}}"  placeholder="" aria-describedby="helpId" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                <textarea class="form-control" name="description" id="company_description" rows="5" required>{{$profile->description}}</textarea>
                                    </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="">Phone Number</label>
                                        <input type="text" name="phone" id="company_phone" class="form-control"  value="{{$profile->phone}}"  placeholder="+2348000000000   " aria-describedby="helpId" required>
                                        <small class="text-muted text-danger">Whatsapp enabled number</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" id="company_email" class="form-control"  value="{{$profile->email}}"  placeholder="" aria-describedby="helpId" >
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="">Business Type</label>
                                        <input type="text" name="business_type" id="business_type" class="form-control"  value="{{$profile->business_type}}"  placeholder="" aria-describedby="helpId" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="">Website</label>
                                        <input type="text" name="website" id="website" class="form-control" value="{{$profile->website}}"   placeholder="http://www.example.com" aria-describedby="helpId">
                                        </div> 
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-3 mx-auto  order-0">
                                <center><div id="profile-pic" style="border:1px solid #ccc; width:200px; height:200px;">
                                    @if ($profile->logo == null)
                                    <img id="blah" src="http://placehold.it/400" alt="your image" style="width:200px; height:200px; object-fit:cover; object-position:center;"/>
                                    @else
                                <img id="blah"  src="{{asset('images/company_logo/'.$profile->logo)}}" alt="your image" style="width:200px; height:200px; object-fit:contain; object-position:center;"/>
                                    @endif
                                </div>
                                <input type='file' name= "image" id="image" onchange="readURL(this);" class="pl-4 mt-4" style="background:#" />

                                {{-- @if ($profile->slug)
                                <a href="{{route('parts.company_profile', ['slug' => $profile->slug])}}" target="blank" class="btn btn-block btn-warning mt-3">Preview Profile</a>
                                @else
                                <a href="#" class="btn btn-block btn-warning mt-3 disabled">Preview Profile</a>
                                @endif --}}
        
                            </center>
        
            
                            </div>


                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-secondary" id="send">Save</button>
                                </div>
                            </div>
        
                           
                        </div>
                    </form>
                </div>

              </div>

        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
                var id = $('#id').val();
          
                $.ajax({
                    method: 'get',
                    url:"{{route('get.region')}}",
                    data:{id:id},
                    success: function(data){   
             
                    $('#state').val(data.state_id);
                    $('#country').val(data.country_id);
                    }
                });

                $('#country').on('change', function(){
                var id = $(this).val();
                $.ajax({
                    method: 'get',
                    url:"{{route('getstate')}}",
                    data:{id:id},
                    success: function(data){
                        console.log(data);
                        $('#state').html('<option value="">Select State</option>');
                            $.each(data, function(key, value){
                            $('#state').append('<option value = '+value.id+ '>'+value.name+'</option>');
                        });
                    }
                });
            });

            $('#send').click(function(){
                event.preventDefault();

                
                


                var ext = $('#image').val().split('.').pop().toLowerCase();
                var name = $('#company_name').val();
                var address = $('#company_address').val();
                var desc = $('#company_description').val();
                var phone = $('#company_phone').val();
                var email = $('#company_email').val();
                var type = $('#business_type').val();
                var image = $('#image').val();
                var website = $('#website').val();

                var pattern = /^(\+234)\d{10}$/;
                var pattern2 = /^(http|https)?:\/\/(www\.)?[a-zA-Z0-9-\.]+\.[a-z]{2,4}/;

                var pattern3 = /https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)/;

                // if(website.match(pattern3)){
                //     alert('ok');
                // }
                // else{
                //     alert('noo match');
                // }

                
                

                // alert(ext+''+name+''+address+''+desc+''+email+''+phone+''+type+''+image)


                if(name == ''){
                    toastr.error("Company name is required"); 
                }
                else if(address == ''){
                    toastr.error("Address is required");
                }
               
                else if(email == ''){
                    toastr.error("email is required");
                }
                else if(desc == ''){
                    toastr.error("description is required");
                }
                else if(phone == ''){
                    toastr.error("phone is required");
                }
                else if(type == ''){
                    toastr.error("Business_type  is required");
                }
                else if(!phone.match(pattern)){
                    toastr.error("Phone number format does not match");
                }
                            
                else{

                    if(image != ''){
                        var file = $('#image')[0].files[0];
                        if ($.inArray(ext, ['gif','png','jpg','jpeg']) == -1){
                            toastr.error("file must be an image");
                        }
                        else if(file.size > 2000000){
                            toastr.error("Maximum file size is 2mb");
                        }
                        else{
                            if(website != ''){
                                if(!website.match(pattern3)){
                                    toastr.error("Url doesnt match the format");
                                }
                                else{
                                    // alert('submit');
                                    $('#form2').submit();
                                }
                               
                            }
                            else{
                                $('#form2').submit();
                                // alert('submit');
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
                            $('#form2').submit();
                        }
                    }
                    else{
                        $('#form2').submit();
                        // alert('submit');
                    }
                   }
                  
                    
                }
                    
            });
        })
       
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
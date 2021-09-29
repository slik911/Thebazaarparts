@extends('layouts.app')
@section('title')
    Profile
@endsection
@section('cssfile')
<link rel="stylesheet" href="{{asset('css/panel.css')}}">
@endsection
@section('header')
    User's - Profile
@endsection
@section('content')
    <div id="content-profile" class="bg-white p-3 pb-3 mb-4">
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
                        <form action="" method="post" >
                                <div class="row">
                                    <div class="col-md-12">
                          
                                        <div class="form-group">
                                        <label for="name">Full Name</label>
                                        <input type="text" name="name" id="name" class="form-control" readonly style="color: black" placeholder="" aria-describedby="helpId" value="{{$user->name}}" required>
                                        </div>
                                    </div>
        
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="">Phone Number</label>
                                        <input type="text" name="phone" id="phone" readonly style="color: black" value="{{$user->phone}}" class="form-control" placeholder="" aria-describedby="helpId" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" id="email" readonly style="color: black" class="form-control" value="{{$user->email}}" placeholder="" aria-describedby="helpId" >
                                        </div> 
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <input type="text" name="address" id="address" readonly style="color: black" value="{{$user->address}}" class="form-control" placeholder="" aria-describedby="helpId" >
                                            </div> 
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Country</label>
                                            <select class="form-control pb-1" name="country" readonly style="color: black" id="country" required>
                   
                                            <option value="{{$user->country_id}}">{{$user->country_name}}</option>
                                
                                            </select>
                                        </div>    
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">State</label>
                                            <select class="form-control pb-1" name="state" readonly style="color: black" id="state" required>
                                                <option value="{{$user->state_id}}">{{$user->state_name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="company" role="tabpanel" aria-labelledby="Company Profile">
                <form action="{{route('seller.profileUpdate')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-5 pl-3 pr-3 pb-5">
                            <div class="col-md-8 ">
                                <h4>Company Details</h4>
                                <div class="form-group">
                                  <label for="">Company Name</label>
                                <input type="text" name="name" id="company_name" readonly style="color: black" class="form-control" value="{{$user->company_name}}" placeholder="" aria-describedby="helpId" required>
                                </div>
                                <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" name="address" id="address" readonly style="color: black" class="form-control"  value="{{$user->company_address}}"  placeholder="" aria-describedby="helpId" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                <textarea class="form-control" name="description" readonly style="color: black" id="description" rows="10" required>{{$user->company_description}}</textarea>
                                    </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="">Phone Number</label>
                                        <input type="text" name="phone" id="phone" readonly style="color: black" class="form-control"  value="{{$user->company_phone}}"  placeholder="" aria-describedby="helpId" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" id="email" readonly style="color: black" class="form-control"  value="{{$user->company_email}}"  placeholder="" aria-describedby="helpId" >
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="">Business Type</label>
                                        <input type="text" name="business_type" readonly style="color: black" id="business_type" class="form-control"  value="{{$user->company_business_type}}"  placeholder="" aria-describedby="helpId" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="">Website</label>
                                        <input type="text" name="website" id="website" readonly style="color: black" class="form-control" value="{{$user->company_website}}"   placeholder="" aria-describedby="helpId">
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mx-auto">
                                <center><div id="profile-pic" style="border:1px solid #ccc; width:200px; height:200px;">
                                
                                <img id="blah"  src="{{asset('images/company_logo/'.$user->company_logo)}}" alt="your image" style="width:200px; height:200px; object-fit:cover; object-position:center;"/>
                           
                                </div>


        
                            </center>
        
            
                            </div>
                           
                        </div>
                    </form>
                </div>

              </div>

        </div>
    </div>
@endsection


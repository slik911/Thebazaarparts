@extends('layouts.master')
@section('csslinks')
<link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('css/single_product.css')}}">
@endsection
@section('title')
{{$profile->name}}
@endsection
@section('content')

@include('includes.header')

    <div id="profile-content"  style="margin-bottom:-45px;">
        <div class="container">
         <div class="row">
             <div class="col-12">
                <div class="card" style=" border:none; box-shadow:none; border-radius:0">
                    <div class="card-body">
                       <div class="row">
                        <div class="col-md-11">
                            <div class="row">
                                <div class="col-md-3">
                                    <center>
                                        <img src="{{asset('images/company_logo/'.$profile->logo)}}" class="img-fluid" alt="" style="width: 120px; height:120px; object-fit:contain;">
                                    </center>
                                </div>
                                <div class="col-md-9">
                                <h2 style="font-weight:500; text-transform:uppercase; " id="profile_name" class="text-secondary text-md-left text-center">{{$profile->name}}</h2>

                                <div class="social-link text-md-left text-center">
                                    <ul class="list-unstyled list-inline">
                                    
                                        <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="Send us a message"><a href="mailto:{{$profile->email}}" ><i class="fa fa-envelope" style="background-color:#3d1c65"></i></a></li>
                                        <li class="list-inline-item"><a href="https://api.whatsapp.com/send?phone={{ltrim($profile->phone, '+')}}" data-toggle="tooltip" data-placement="top" title="Chat with us" target="blank"><i class="fa fa-whatsapp text-white bg-success"></i></a></li>
                                        @if ($profile->website)
                                    <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="Visit our website"><a href="{{$profile->website}}" ><i class="fa fa-globe bg-info " style="background-color:#3d1c65"></i></a></li> 
                                        @endif
                                    </ul>
                                </div>
                                
                    
                                </div>
                            </div>
                        </div>
                        
                       </div>
                    </div>
       
            </div>
             </div>
         </div>
        </div>

        <div class="container-fluid ">
            
            <div class="row p-md-5 p-3" style="background-color:#54268c">
                <div class="col-md-12">

                            <h5 class="text-white" style="font-weight: 500"><b>Description</b></h5>
                            <p style="text-align: left; font-size:14px;" class="text-white">{{$profile->description}}</p>
                </div>
                </div>
            </div>


        <div class="container bg-white">
            <div class="card "  style="box-shadow: none; border:none;">
                <div class="card-body"  style=" border-radius:0px;">
                    <div class="row ">
                        <div class="col-md-6">
                            <table class="table table-striped nowrap table-bordered table-responsive-sm" width="100%" style="font-size:13px;">
                                
                                    <thead>
                                        <th><b style="color: #3d1c65; font-weight:601;;">Profile Information</b></th>
                                    <th></th>
                                    </thead>
            
                                    <tbody>
                                       
                                        <tr>
                                            <th scope="row">Member Since</th>
                                            <td>{{Carbon\carbon::parse($profile->created_at)->format('d, M Y')}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Business Type</th>
                                            <td style="text-transform: capitalize">{{$profile->business_type}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Address</th>
                                            <td>{{$profile->address}}</td>
                                        </tr>
                                    </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-striped table-inverse table-bordered " width="100%" style="font-size:13px;">
                                
                                    <thead>
                                        <th><b style="color: #3d1c65; font-weight:601;">Contact Details</b></th>
                                    <th></th>
                                    </thead>
            
                                    <tbody>
                                       
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td><a href="mailto:{{$profile->email}}"  style="color:#333">{{$profile->email}}</a></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">phone</th>
                                            <td>{{$profile->phone}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Website</th>
                                            <td><a href="{{$profile->website}}" style="color:#333">{{$profile->website}}</a></td>
                                        </tr>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>




   <div id="company_products"  style="background-color: #54268c">
       <div class="container pt-3 pb-3">

            <div class="row">
                <div class="col-12">
                    <h6 style="font-weight:501" class="mb-4 mt-4 text-white">COMPANY PRODUCTS</h6>
                </div>
               
                @if ($products->isEmpty())
                <div class="col-12">
                 <h2 class="text-center mt-5">No Item(s) Available!</h2>
                </div>
             @else
             @foreach ($products as $product)
             <div class="col-md-2 col-6 mb-4">
                <div class="card shadow-sm" style="border:none">
                        <a href="{{route('parts.single-product', ['slug'=>$product->slug])}}">
                            <img class="card-img-top img-fluid pt-2" src="{{asset('images/products/'.$product->image)}}" style="width:100%; height:100px; object-fit:contain; border-radius:0px"  alt="">
                        </a>
                    <div class="card-body">
                        <h6 class="card-title" style="font-size:14px; line-height:3px;"><a href="{{route('parts.single-product', ['slug'=>$product->slug])}}" style="text-decoration:none; color:#54268c">
                            @if (strlen($product->name)>15)
                            {{substr($product->name, 0, 15)}}...
                            @else
                                {{$product->name}}
                            @endif</a></h6>
                            <p  style="color:#716aca; font-size:12px; text-transform:capitalize;">{{$product->category_name}}, {{$product->subcategory_name}}</p>
                        <p class="card-text" style="font-size:12px; line-height:2px;">&#8358; <b>{{number_format($product->price)}}</b> </p>
                    </div>
                </div>
            </div>
             @endforeach
             <div class="col-12">
                <a href="{{route('company.products', ['company_slug'=> $profile->slug])}}" class="float-right text-white" style="font-size:15px; color:#3d1c65">View All Company products >></a>
               </div>
       
             @endif

             
            
            </div>
            
       </div>
       </div>


       <div class="container-fluid " >
        <div class="row">
            <div class="col-md-8 mx-auto" style="background-color: #fff">
                <div class="card pt-5 pb-5" style="border:none; box-shadow:none">
                    <div class="card-body   justify-content-center">
                       <center>
                            <div class="row  ">
                            @if ($membership)
                            @if ($membership->verified == true)
                            <div class="col-md-3 col-6 mx-auto  ">
                            <center>
                                <img src="{{asset('images/verification/verified.png')}}" class="img-fluid" style="width:70px; height:70px" alt="">
                                <p class="mt-3"  style="color: #54268c; font-size:11px; font-weight:600; text-transform:uppercase" >Verified Member</p>
                            </center>
                            </div>
                            @else
                            <div class="col-md-3 col-6 mx-auto">
                            <center>
                                <img src="{{asset('images/verification/no_verified.png')}}" class="img-fluid" style="width:70px; height:70px" alt="">
                                <p class="mt-3"  style="color: #54268c; font-size:11px; font-weight:600; text-transform:uppercase" >Not Verified</p>
                            </center>
                            </div>
                            @endif
                       
                   
                            @if ($membership->silver == true)
                            <div class="col-md-3 col-6 mx-auto ">
                            <center>
                                <img src="{{asset('images/verification/silver.png')}}" class="img-fluid" style="width:70px; height:70px" alt="">
                                <p  class="mt-3"  style="color: #54268c; font-size:11px; font-weight:600; text-transform:uppercase" ">Silver Membership</p>
                            </center>
                            </div>
                            @else
                            <div class="col-md-3 col-6 mx-auto">
                                <center>
                                    <img src="{{asset('images/verification/no_silver.png')}}" class="img-fluid" style="width:70px; height:70px" alt="">
                                    <p  class="mt-3"  style="color: #54268c; font-size:11px; font-weight:600; text-transform:uppercase" >Silver Membership</p>
                                </center>
                                </div>
                            @endif
                       
                       
                            @if ($membership->gold == true)
                            <div class="col-md-3 col-6 mx-auto">
                            <center>
                                <img src="{{asset('images/verification/gold.png')}}" class="img-fluid" style="width:70px; height:70px" alt="">
                            <p  class="mt-3"  style="color: #54268c; font-size:11px; font-weight:600; text-transform:uppercase" >Gold Membership</p>
                            </center>
                            </div>
                            @else
                            <div class="col-md-3 col-6 mx-auto">
                                <center>
                                    <img src="{{asset('images/verification/no_gold.png')}}" class="img-fluid" style="width:70px; height:70px" alt="">
                                    <p  class="mt-3"  style="color: #54268c; font-size:11px; font-weight:600; text-transform:uppercase" >Gold Membership</p>
                                </center>
                                </div>
                            @endif
                        
                        
                            @if ($membership->platinum == true)
                            <div class="col-md-3 col-6 mx-auto ">
                            <center>
                                <img src="{{asset('images/verification/platinum.png')}}" class="img-fluid" style="width:70px; height:70px" alt="">
                                <p  class="mt-3"  style="color: #54268c; font-size:11px; font-weight:600; text-transform:uppercase" >Platinum Membership</p>
                            </center>
                            </div>
                            @else
                            <div class="col-md-3 col-6 mx-auto">
                                <center>
                                    <img src="{{asset('images/verification/no_platinum.png')}}" class="img-fluid" style="width:70px; height:70px" alt="">
                                    <p  class="mt-3"  style="color: #54268c; font-size:11px; font-weight:600; text-transform:uppercase" >Platinum Membership</p>
                                </center>
                                </div>
                            @endif
                            @else


                                <div class="col-md-3 col-6 mx-auto">
                                <center>
                                    <img src="{{asset('images/verification/no_verified.png')}}" class="img-fluid" style="width:70px; height:70px" alt="">
                                    <p  class="mt-3"  style="color: #54268c; font-size:11px; font-weight:600; text-transform:uppercase" >Not Verified</p>
                                </center>
                                </div>
                                <div class="col-md-3 col-6 mx-auto">
                                <center>
                                    <img src="{{asset('images/verification/no_silver.png')}}" class="img-fluid" style="width:70px; height:70px" alt="">
                                    <p  class="mt-3"  style="color: #54268c; font-size:11px; font-weight:600; text-transform:uppercase" >Silver Membership</p>
                                </center>
                                </div>
                                <div class="col-md-3 col-6 mx-auto">
                                <center>
                                    <img src="{{asset('images/verification/no_gold.png')}}" class="img-fluid" style="width:70px; height:70px" alt="">
                                    <p  class="mt-3"  style="color: #54268c; font-size:11px; font-weight:600; text-transform:uppercase" >Gold Membership</p>
                                </center>
                                </div>
                                <div class="col-md-3 col-6 mx-auto">
                                <center>
                                    <img src="{{asset('images/verification/no_platinum.png')}}" class="img-fluid" style="width:70px; height:70px" alt="">
                                    <p  class="mt-3"  style="color: #54268c; font-size:11px; font-weight:600; text-transform:uppercase" >Platinum Membership</p>
                                </center>
                                </div>


                            @endif
                            </div>
                       </center>
                    </div>
                </div>
            </div>
        </div>
       </div>

   </div>
@endsection
@section('js')
    <script>
        $(".new-slider").owlCarousel({
		autoplay:false,
    	autoplayTimeout:7000,
    	autoplayHoverPause:true,
    	smartSpeed:500,
		loop: true,
		responsiveClass: true,
		items : 3,
		nav : true,
		navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
		margin: 20,
		dots: true,
		responsive: {
			0: {
				items: 2
			},
			576: {
				items: 2
			},
			768: {
				items: 2
			},
			992: {
				items: 6
			}
		}
    });
    </script>
@endsection
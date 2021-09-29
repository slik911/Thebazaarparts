@extends('layouts.master')
@section('title')
{{$product->name}}
@endsection
@section('cssfiles')
<link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
@endsection
@section('jsfiles')
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5fc836206323f454"></script>
@endsection


@section('content')
@include('includes.header')
<nav class="breadcrumb bg-light justify-content-center" style="font-size:13px;">
    <a class="breadcrumb-item" href="{{route('parts')}}" style="color:#3d1c65; text-decoration:none">Home</a>
    <a href="{{route('products', ["category"=>$product->category_name, "subcategory_slug"=>null])}}" class=" breadcrumb-item text-secondary">{{$product->category_name}}</a>
    <a class="breadcrumb-item text-secondary" href="{{route('products', ["category"=>$product->category_name, "subcategory_slug"=>$product->subcategory_slug])}}">{{$product->subcategory_name}}</a>
    <span class="breadcrumb-item active"  style="color:#3d1c65; text-decoration:none">{{$product->name}}</span>
</nav>
    <div id="product_content">
        <div class="container">
            <div class="row  mt-3">

                <div class="col-md-8 p-5 bg-white">
                    <div class="row">
                        <div class="col-md-8" >
                            <div class="card p-3" style="border:1px solid #dddbdb; border-radius:0; box-shadow:none">
                                <img src="{{asset('images/products/'.$product->image)}}" class="img-fluid " style="width: 100%; height:300px; object-fit:contain; object-position:center" alt="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="sg-content mt-3">
                                <small style="font-size: 12px;"><a href="{{route('products', ["category"=>$product->category_name, "subcategory_slug"=>null])}}" style="text-decoration:none; color:#3d1c65">{{$product->category_name}}</a> &nbsp;, &nbsp; <a href="{{route('products', ["category"=>$product->category_name, "subcategory_slug"=>$product->subcategory_slug])}}" style="text-decoration:none; color:#3d1c65">{{$product->subcategory_name}}</a></small>

                                 <div class="pro-name">
                                 <h2 class="display-4 mt-2" style="text-transform:capitalize; font-size:30px; font-weight:400">{{$product->name}}</h2>
                                 </div>

                                 <h3 class="display-4  mt-md-4 mt-2" style="text-transform:capitalize; font-size:20px; font-weight:400">&#8358; {{number_format($product->price)}}</h3>
                                 <p>Availability : @if ($product->availability == true)
                                    <span class="text-success">In Stock</span>
                                    @php
                                        $l = "Hi, i'm interested in the item you posted on Bazaar Parts ";

                                        $txt = urlencode($l.Request::fullUrl())
                                    @endphp
                                 @else
                                 <span class="text-danger">Out ofStock</span>
                                 @endif</p>
                                 <div class="social-link">
                                    <ul class="list-unstyled list-inline">

                                        @guest
                                        <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="Send us a message"><a href="{{route('single.auth', ['package'=>$product->section, 'slug'=>$product->slug])}}" ><i class="fa fa-envelope" style="background-color:#3d1c65"></i></a></li>
                                        @else
                                        <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="Send us a message"><a href="#"  data-toggle="modal" data-target="#modelId" ><i class="fa fa-envelope" style="background-color:#3d1c65"></i></a></li>
                                        @endguest


                                        @guest
                                            <li class="list-inline-item"><a href="{{route('single.auth', ['package'=>$product->section, 'slug'=>$product->slug])}}" data-toggle="tooltip" data-placement="top" title="Login to chat with seller" ><i class="fa fa-whatsapp text-white bg-success"></i></a></li>
                                            @else
                                            <li class="list-inline-item"><a href="https://api.whatsapp.com/send?phone={{ltrim($product->company_phone, '+')}}&text={{$txt}}" data-toggle="tooltip" data-placement="top" title="Chat with seller" target="blank"><i class="fa fa-whatsapp text-white bg-success"></i></a></li>
                                        @endguest
                                    </ul>
                                </div>

                                <h6>Share Using</h6>
                                 @php
                    $txt = urlencode(Request::fullUrl())
                    @endphp
                    <a href="https://api.whatsapp.com/send?text={{$txt}}" target="blank"><i class="fa fa-whatsapp" aria-hidden="true" style="color:white; background-color:rgb(0, 87, 0); padding:10px 11px; border-radius:50%;"></i></a>
                                <a href="https://twitter.com/intent/tweet?text={{$txt}}" target="blank"><i class="fa fa-twitter" aria-hidden="true" style="color:white; background-color:rgb(6, 119, 150); padding:10px 11px; border-radius:50%;"></i></a>

                                <a href="https://www.facebook.com/sharer/sharer.php?u={{$txt}}&display=popup" target="blank"><i class="fa fa-facebook" aria-hidden="true" style="color:white; background-color:rgb(7, 78, 116); padding:10px 14px; border-radius:50%;"></i></a>

                            </div>
                        </div>
                        <div class="col-md-12 mt-5" id="reviews">
                            <div class="sg-tab">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#pro-det"  style="color:#333">Product Details</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#rev" style="color:#333">Reviews ({{$review_count}})</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="pro-det" role="tabpanel">
                                       <table class="table table-striped " style="font-size:13px;">
                                        <tr>
                                            <th>
                                                Model
                                            </th>
                                            <td>
                                                <span style="text-transform: capitalize">{{$product->brand_name}}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Product Type
                                            </th>
                                            <td>
                                               <span style="text-transform: capitalize">{{$product->type}}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                               Part No
                                            </th>
                                            <td>
                                                <span>{{$product->part_no}}</span>
                                            </td>
                                        </tr>
                                       </table>

                                       <h5 class="mt-5" style="font-size:16px; font-weight:600">Description</h5>
                                       <p style="font-size:13px;">{{$product->description}}</p>
                                    </div>
                                    <div class="tab-pane fade" id="rev" role="tabpanel">
                                        @foreach ($review_data as $review)
                                        <div class="review-box d-flex">
                                            <div class="rv-img">

                                            </div>
                                            <div class="rv-content" style="width:100%">
                                                <h6 style="text-transform: capitalize">{{$review->full_name}} <span>({{Carbon\carbon::parse($review->created_at)->format('M d, Y')}})</span></h6>

                                                <p>{{$review->review}}</p>
                                            </div>
                                        </div>
                                        @endforeach

                                        <div class="review-form">
                                            <h6>Add Your Review</h6>
                                        <form action="{{route('review.post')}}" method="POST">
                                                @csrf
                                                <div class="row">
                                                <input type="hidden" name="id" value="{{$product->product_id}}" required>
                                                <input type="hidden" name="user_id" value="{{$product->user_id}}" required>

                                                    @if (!Auth::check())
                                                    <div class="col-md-6">
                                                        <label>Your Name*</label>
                                                        <input type="text" name="name" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Your Email*</label>
                                                        <input type="text" name="email" required>
                                                    </div>
                                                    @endif
                                                    <div class="col-md-12">
                                                        <label>Your Review*</label>
                                                        <textarea required name="review"></textarea>
                                                        <button type="submit">Add Review</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-5 mt-5">
                            <h5 class="mt-5" style="font-size:16px; font-weight:600">ABOUT SELLER</h5>
                            <hr  class="mb-md-0 mb-5">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-3 col-11 mx-auto mt-md-5 ml-3" style="">
                                    <center><img src="{{asset('images/company_logo/'.$product->company_logo)}}" class="img-fluid " style="width:150px; height:150px; object-fit:contain;  margin-top:-30px;" alt=""></center>
                                    </div>
                                    <div class="col-md-8 col-12 mt-md-4">
                                    <a href="{{route('parts.company_profile', ['slug'=>$product->company_slug])}}" style="color:#575962; text-decoration:none"><h5 style="font-weight: 600; text-transform:uppercase" class="mb-3 mt-md-0 mt-4 text-md-left text-center ">{{$product->company_name}} </h5></a>
                                    <div class="row">

                                            @if ($membership)
                                            @if ($membership->verified == true)
                                            <div class="col-3  ">
                                            <center>
                                                <img src="{{asset('images/verification/verified.png')}}" class="img-fluid" style="width:30px; height:30px" alt="">
                                                <p style="font-size:10px">Verified <br> Member</p>
                                            </center>
                                            </div>
                                            @else
                                            <div class="col-3">
                                            <center>

                                                <img src="{{asset('images/verification/no_verified.png')}}" class="img-fluid" style="width:30px; height:30px" alt="">
                                                <p style="font-size:10px">Not Verified</p>
                                            </center>
                                            </div>
                                            @endif


                                            @if ($membership->silver == true)
                                            <div class="col-3 ">
                                            <center>
                                                <img src="{{asset('images/verification/silver.png')}}" class="img-fluid" style="width:30px; height:30px" alt="">
                                                <p style="font-size:10px">Silver <br> Membership</p>
                                            </center>
                                            </div>
                                            @endif


                                            @if ($membership->gold == true)
                                            <div class="col-3">
                                            <center>
                                                <img src="{{asset('images/verification/gold.png')}}" class="img-fluid" style="width:30px; height:30px" alt="">
                                            <p style="font-size:10px;">Gold <br> Membership</p>
                                            </center>
                                            </div>
                                            @endif


                                            @if ($membership->platinum == true)
                                            <div class="col-3">
                                            <center>
                                                <img src="{{asset('images/verification/platinum.png')}}" class="img-fluid" style="width:30px; height:30px" alt="">
                                            <p style="font-size:10px;">Platinum <br>Membership</p>
                                            </center>
                                            </div>
                                            @endif
                                            @else
                                            <div class="col-3">
                                                <center>

                                                    <img src="{{asset('images/verification/no_verified.png')}}" class="img-fluid" style="width:30px; height:30px" alt="">
                                                    <p style="font-size:10px">Not Verified</p>
                                                </center>
                                                </div>

                                            @endif

                                    </div>





                                    <p class="text-left" style="font-size: 14px;">{{substr($product->company_desc, 0, 250)}}...</p>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-12">
                                        <h5 class="mt-5" style="font-size:16px; font-weight:600">CONTACT DETAILS</h5>

                                        @if (Auth::check())
                                        <table class="table table-striped" style="font-size:13px;">

                                            <tbody>
                                                <tr>
                                                    <th>Email</th>
                                                    <td><a href="mailto:{{$product->company_email}}" style="color:#3d1c65">{{$product->company_email}}</a></td>
                                                </tr>
                                                <tr>
                                                    <th>Phone Number</th>
                                                    <td>{{$product->company_phone}}</td>
                                                </tr>
                                                <tr>
                                                 <th>Website</th>
                                                 <td>{{$product->company_website}}</td>
                                             </tr>
                                            </tbody>
                                    </table>
                                     <hr>
                                        @else
                                    <p>Kindly click <a href="{{route('login')}}" style="color:#3d1c65">Here</a> to view contact details</p>
                                        @endif
                                        <p  style="font-size:13px;">Please click <a href="{{route('parts.company_profile', ['slug'=>$product->company_slug])}}" style="color:red" target="blank">Here</a> to view complete Company Profile</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            @include('includes.featured')
                        </div>
                    </div>

                </div>
                <div class="col-md-3 offset-md-1  d-none d-sm-block">
                  <div  id="side_sticky_nav" class="bg-white pt-5 pl-3 pr-3">
                    <h6 style="color:#fff; font-size:13px; font-weight:600; background:#3d1c65;" class="pt-3 pb-4 pl-3" ><i class="
                        fas fa-layer-group"></i> CATEGORIES</h6>
                        <div style=" padding:0px; margin-top:-20px;">

                            @foreach ($categories as $category)
                            <a href="{{route('products', ["category"=>$category->name, "subcategory_slug"=>null])}}" style="text-transform:capitalize">
                                    {{$category->name}}
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-right float-right pt-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                      </svg>
                                </a>
                            @endforeach
                        </div>
                        <section id="advert">
                            <div class="row">
                                <div class="col-12 mt-4">
                                    <img src="{{asset('images/side1.jpg')}}" class="img-fluid" alt="">
                                </div>
                                <div class="col-12 mt-4 pb-5">
                                    <img src="{{asset('images/side2.jpg')}}" class="img-fluid" alt="">
                                </div>
                            </div>
                        </section>
                </div>

              </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="border-radius: 0px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Request For Quotation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            <form action="{{route('quote.send')}}" method="post">
                    @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                        <input type="hidden" name="slug" id="slug" value="{{$product->slug}}">
                        <input type="hidden" name="package" id="package" value="{{$product->section}}">
                        <input type="hidden" name="product_id" id="product_id" value="{{$product->product_id}}">
                        <input type="hidden" name="company_email" value="{{$product->company_email}}">
                            <p><input type="text" id="name" name="name" class="form-control" placeholder="Full Name" required></p>
                         </div>
                        <div class="col-md-6">
                            <p><input type="text" id="email" name="email" class="form-control" placeholder="Email" required></p>
                        </div>
                        <div class="col-md-6">
                            <p><input type="text" id="phone" name="phone" class="form-control" placeholder="Phone Number" required></p>
                        </div>
                        <div class="col-md-6">
                            <p><input type="text" id="company_name" name="company_name" class="form-control" placeholder="Company Name" required></p>
                        </div>
                        <div class="col-md-12">
                            <p><input type="text" id="address" name="address" class="form-control" placeholder="Address" required></p>
                        </div>
                        <div class="col-md-12">
                            <label for="">Product</label>
                        <p><input type="text" id="product_name" name="product_name" class="form-control" value="{{$product->name}}" readonly required></p>
                        </div>



                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning btn-sm text-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary btn-sm">Send Request</button>
                </div>
            </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
     var carousel = function() {
		$('.carousel-testimony').owlCarousel({
			center: true,
			loop: true,
			items:1,
			margin: 30,
            stagePadding: 0,
            autoplay:true,
            autoplayTimeout:1000,
            autoplayHoverPause:true,
            rtl:true,
			nav: false,
			navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
			responsive:{
				0:{
					items: 2
				},
				600:{
					items: 2
				},
				1000:{
					items: 4
				}
			}
		});

	};
    carousel();


    </script>
@endsection

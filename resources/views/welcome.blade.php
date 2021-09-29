@extends('layouts.master')
@section('cssfiles')
<link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
@endsection
@section('jsfiles')
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
@endsection
@section('title')
    The Bazaaar Parts - Buy and Sell Spare Parts all across the country
@endsection
@section('content')
@include('includes.header')


<div id="categories" style="" class="d-block d-sm-none">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-4 mt-4">
                <h6 style="font-weight:600; color:#333">
                    TOP CATEGORIES
                </h6>
            </div>

            @foreach ($categories as $category)
            <div class="col-6" >
                <div class="card bg-white p-3 d-flex justify-content-center mb-4 shadow-sm" style="border:none" >
                    <a href="{{route('categories', ['category'=>$category->name])}}">
                        <center><img src="{{asset('images/category/'.$category->image)}}" style="width:60px; height:60px; object-fit:contain" alt=""></center>
                        <h6 class="text-center mt-3"  style="font-size:13px; color:#575962; text-transform:capitalize"><b>{{$category->name}}</b></h6>
                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>

<div class="container">

    <div class="row mt-4">
        <div class="col-md-3  d-none d-sm-block">
            <div  id="side_sticky_nav">
                <h6 style="color:#fff; font-size:13px; font-weight:600; background:#3d1c65;" class="pt-3 pb-4 pl-3" ><i class="
                    fas fa-layer-group"></i> CATEGORIES</h6>
                    <div style=" padding:0px; margin-top:-20px;" >

                        @foreach ($categories as $category)
                        <a href="{{route('products', ["category"=>$category->name, "subcategory_slug"=>null])}}" style="text-transform:capitalize;" >
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
        <div class="col-md-8 mx-auto">
            <div id="carouselExampleControls" class="carousel slide d-none d-sm-block mb-4" data-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                  <img src="{{asset('images/Dec1.jpg')}}" class="d-block w-100" alt="..."  style="width:100%; height:200px; object-fit:cover">
                  </div>
                  <div class="carousel-item">
                    <img src="{{asset('images/Dec2.jpg')}}" class="d-block w-100" alt="..." style="width:100%; height:200px; object-fit:cover">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            <div class="row p-2 bg-white pb-4 shadow-sm" style="border: none; margin:1px ">
                <div class="col-12 mt-2">
                    <h6 style="font-weight:501">TOP FEATURED PRODUCTS</h6>
                    <hr>
                </div>
                @foreach ($featured_products as $product)
                    <div class="col-md-4 col-6 mt-4">
                        <div class="row">
                            <div class="col-md-5 col-6">
                                <img class="card-img-top" src="{{asset('images/products/'.$product->image)}}" class="img-fluid" style=" border-radius:0px;" alt="">
                            </div>
                            <div class="col-md-7 col-6" style="padding-left: 2px;">
                                <p><a href="{{route('parts.single-featured-product', ['slug'=>$product->slug])}}" style="color:#575962; text-decoration:none; font-size:14px; line-height:20px; text-transform:captalize">
                                    @if (strlen($product->name)>15)
                                    {{substr($product->name, 0, 10)}}...
                                    @else
                                        {{$product->name}}
                                    @endif
                                    </a>
                                </p>
                                <p style="font-size:15px; font-weight:bold; margin-top:-18px;">&#8358; {{number_format($product->price)}}</p>
                                <a href="{{route('parts.single-featured-product', ['slug'=>$product->slug])}}" class="btn btn-sm " style="color:white; background:#3d1c65; font-size:11px;">See Details</a>
                            </div>
                        </div>
                    </div>
            @endforeach
            </div>

            <div class="row">
                <div class="col-12 ml-auto">
                   <div class="float-right"> {{ $featured_products->links()}}</div>
                </div>
            </div>

            <section id="hotlist" class="mt-4 bg-white">
                <div class="row">
                 <div class="col-md-12 ">
                     <div class="top-slr"  style="border:none">
                         <div class="sec-title">
                             <h5 class="mt-1 mb-3">HOT LISTS</h5>
                         </div>
                         <div class="slr-slider owl-carousel mt-3" style="z-index: 0">
                             <div class="slr-items pb-3">
                                @foreach ($hotlist_products as $product)
                                <div class="row mb-3">
                                    <div class="col-md-5 col-6 bg-white">
                                        <img class="card-img-top" src="{{asset('images/products/'.$product->image)}}" class="img-fluid" style=" border-radius:0px;" alt="">
                                    </div>
                                    <div class="col-md-7 col-6" style="padding-left: px;">
                                        <p><a href="{{route('parts.single-featured-product', ['slug'=>$product->slug])}}" style="color:#575962; text-decoration:none; font-size:14px; line-height:20px; text-transform:captalize">
                                            @if (strlen($product->name)>15)
                                            {{substr($product->name, 0, 10)}}...
                                            @else
                                                {{$product->name}}
                                            @endif
                                            </a>
                                        </p>
                                        <p style="font-size:15px; font-weight:bold; margin-top:-20px;">&#8358; {{number_format($product->price)}}</p>
                                        <a href="{{route('parts.single-hotlist-product', ['slug'=>$product->slug])}}" class="btn btn-sm" style="color:white; background:#54268c; font-size:11px">See Details</a>
                                    </div>
                                </div>

                                @endforeach

                             </div>
                         </div>
                     </div>
                 </div>
                </div>
            </section>

            @if (!$platinum->isEmpty())
            <div class="col-md-12  mt-5 img-slider order-0">
                <div class="sec-title">
                    <h6 class="mt-1 mb-3" style="font-weight:600">PLATINUM MEMBERS</h6>
                </div>
                <div class="carousel-testimony owl-carousel ftco-owl">

                    @foreach ($platinum as $member)
                    <div class="item ">
                        <div class="testimony-wrap py-md-4 py-2 bg-white shadow-sm">
                        <a href="{{route('parts.company_profile', ['slug'=>$member->slug])}}">
                            <img class="img-fluid mg pt-2" src="images/company_logo/{{$member->logo}}" style="width:100%; height:80px; object-fit:contain; border-radius:0px"  alt="">
                        </a>
                        </div>
                      </div>
                    @endforeach
                  </div>
               </div>
            @endif
        </div>

    </div>
</div>
@endsection
@section('js')
    <script>
    $(document).ready(function(){
        $(".slr-slider").owlCarousel({
		autoplay:false,
    	autoplayHoverPause:true,
    	smartSpeed:500,
		loop: true,
		responsiveClass: true,
		items : 3,
		nav : true,
		navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
		margin: 20,
		dots: false,
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 2
			},
			768: {
				items: 2
			},
			992: {
				items: 3
			}
		}
    });
    });
    var carousel = function() {
         $('.carousel-testimony').owlCarousel({
             center: true,
             loop: true,
             items:1,
             margin: 30,
             stagePadding: 0,
             autoplay:true,
             autoplayTimeout:2000,
             autoplayHoverPause:true,
             rtl:true,
             nav: false,
             navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
             responsive:{
                 0:{
                     items: 3
                 },
                 600:{
                     items: 4
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

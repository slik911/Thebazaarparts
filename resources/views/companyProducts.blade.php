@extends('layouts.master')
@section('title')
    Products
@endsection

@section('cssfiles')
<link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
{{-- <link rel="stylesheet" href="{{asset('css/single_product.css')}}">fe --}}
@endsection
@section('jsfiles')
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
@endsection
@section('content')
    @include('includes.header')
    <div class="" id="products">
        <div class="container">
            <div class="row mt-4">
                <div class="col-12 mb-4">
                    <h6 class="mt-md-0 mt-3" style="text-transform: capitalize"><b class="text-secondary" style="font-weight:601">{{$title}}</b> <small>({{$product_count}} Product Results)</small></h6>
                </div>
            
                <div class="col-md-9">
                    <div class="row">
                   
                        

                        @if ($products->isEmpty())
                           <div class="col-12">
                            <h5 class="text-center mt-5">No Item(s) Available!</h5>
                           </div>
                        @else
                        @foreach ($products as $product)
                        <div class="col-md-3 col-6 mb-4">
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
                        
                        @endif
                        <div class="col-12 ml-auto">
                            <div class="float-right"> {{ $products->links()}}</div>
                         </div>
                 
                     
                         <div class="col-md-12 mt-4">
                             @include('includes.featured')
                         </div>
                    </div>
                   
                       
                    

                </div>

                @include('includes.sidebar')
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        jQuery(document).ready(function(){
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

            var $this = $('.items');
            if ($this.find('div').length > 0) {
                $('.items').append('<div><a href="javascript:;" class="showMore arrow"></a></div>');
            }
            // If more than 2 Education items, hide the remaining
            $('.items .item').slice(0,3).addClass('shown');
            $('.items .item').not('.shown').hide();
            $('.items .showMore').on('click',function(){
                $('.items .item').not('.shown').toggle(300);
                $(this).toggleClass('showLess');
            });

            });
    </script>
@endsection

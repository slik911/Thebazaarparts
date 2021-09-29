{{-- <div class="col-md-12 padding-fix-l20">
    <div class="new-product">
        <div class="sec-title">
            <h4 class="mb-4" style="font-weight: 600">FEATURED PRODUCTS</h4>
        </div>
        <div class="new-slider owl-carousel" style="z-index: 0">
            @foreach ($featured as $item)
    
                    <div class="new-item">
                        <div class="new-img">
                        <img class="main-img img-fluid" src="{{asset('img/products/'.$item->image)}}" style="width:100%; height:100px; object-fit:cover" alt="">    
                        </div>
                        <div class="tab-heading">
                            <ul class="list-unstyled list-inline">
                                <li class="list-inline-item"><a href="{{route('parts.products', ["category"=>$item->category_name, "subcategory_slug"=>null])}}" style="text-transform: capitalize">{{$item->category_name}},</a></li>
                            <li class="list-inline-item"><a href="{{route('parts.products', ["category"=>$item->category_name, "subcategory_slug"=>$item->subcategory_slug])}}" style="text-transform: capitalize">{{$item->subcategory_name}}</a></li>
                            </ul>
                            <p><a href="{{route('parts.single-featured-product', ['slug'=>$item->slug])}}" style="text-transform: capitalize; ; font-size:14px; ">@if (strlen($item->name)>20)
                                {{substr($item->name, 0, 20)}}...
                                @else
                                    {{$item->name}}
                                @endif</b></a><br></a></p>
                        </div>
                        <div class="img-content d-flex justify-content-between">
                            <div>
                                <ul class="list-unstyled list-inline price"  style="margin-top: -15px;">
                                    <li class="list-inline-item">&#8358; {{number_format($item->price)}}</li>
                                    <li class="list-inline-item"></li>
             
                                </ul>
                            </div>
                   
                        </div>
                    </div>

            @endforeach
        </div>
    </div>
</div>
 --}}


 {{-- 
    <div class="ads">
        <div class="sec-title">
            <h6 style="font-weight:400; color:#919191" class="mt-2 mb-3">
                Trending Ads
             </h6>
        </div>
        @foreach ($trending as $ad)
        <div class="new-slider owl-carousel mt-3" style="z-index: 0">
            <div class="slr-items pb-3">
                <div class="card shadow-sm" style="border:none">
                    <a href="{{route('single.product', ['slug'=>$ad->slug])}}">
                        <img class="card-img-top" src="{{asset('images/products/'.$ad->image)}}" style="width:100%; height:100px; object-fit:contain; border-radius:0px" class="img-fluid" alt="">
                    </a>
                    <div class="top-left">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star" style="margin-top:-3px;" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                          </svg>
                       Ads
                
                </div>
                <div class="card-body">
                    <h6 class="card-title" style="font-size:14px;"><a href="{{route('single.product', ['slug'=>$ad->slug])}}" style="text-decoration:none; color:#54268c">{{$ad->product_name}}</a></h6>
                    <p class="card-text" style="font-size:12px;">&#8358; {{number_format($ad->price)}} </p>

                </div>
            </div>
            </div>
        </div>
        @endforeach
    </div>
 --}}

 <div class="ads mt-4 bg-white p-4">

    <h6 style="font-weight:400; color:#333" class="mt-2 mb-3">
        FEATURED PRODUCTS
     </h6>
    <div class="carousel-testimony owl-carousel ftco-owl">

        @foreach ($featured as $ad)
        <div class="item bg-white" style="border:1px solid ghostwhite">
          <div class="testimony-wrap py-4">
            <a href="{{route('parts.single-featured-product', ['slug'=>$ad->slug])}}">
                <img class="img-fluid pt-2" src="{{asset('images/products/'.$ad->image)}}" style="width:100%; height:100px; object-fit:contain; border-radius:0px"  alt="">
            </a>

         
            <div class="text pl-3 pt-3 mt-3" style="border-top:1px solid ghostwhite">
                <h6 class="card-title" style="font-size:14px;"><a href="{{route('parts.single-featured-product', ['slug'=>$ad->slug])}}" style="text-decoration:none; color:#54268c">
                    @if (strlen($ad->name)>15)
                               ... {{substr($ad->name, 0, 15)}}
                    @else
                        {{$ad->name}}
                    @endif
                </a></h6>
                <p class="card-text" style="font-size:12px;">&#8358; {{number_format($ad->price)}} </p>
            </div>
          </div>
        </div>   
        @endforeach

      </div>
 </div>

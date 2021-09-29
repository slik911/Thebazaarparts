@extends('layouts.master')
@section('title')
    Products
@endsection
@section('content')
    @include('includes.header')
    <div class="" id="products">
        <div class="container">

          <nav class="breadcrumb bg-light justify-content-center" style="font-size:13px;">
            <a class="breadcrumb-item" href="{{route('parts')}}" style="color:#54268c; text-decoration:none">Home</a>
            <span class="breadcrumb-item active">{{$category->name}}</span>
        </nav>
                <div class="row">
                  <div class="col-md-3 order-md-0 order-lg-0 order-2 ">

                    <div  id="side_sticky_nav">
                      <h6 style="color:#fff; font-size:13px; font-weight:600; background:#3d1c65;" class="pt-3 pb-4 pl-3" ><i class="
                          fas fa-layer-group"></i> {{$category->name}}</h6>
                               <div style=" padding:0px; margin-top:-20px;" class="items">

                                  @foreach ($subcategories as $sub)
                                  <a href="{{route('products', ["category"=>$category->name, "subcategory_slug"=>$sub->slug])}}" style="text-transform:capitalize" class="item">
                                      {{$sub->name}}
                                      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-right float-right pt-1" fill="currentColor" style="margin-top:7px;" xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                        </svg> <br>
                                        <small>{{number_format($sub->count)}} ads</small>
                                  </a>
                                  @endforeach

                          </div>

                          <div  id="side_sticky_nav2" class="mt-3">
                            <h6 style="color:#fff; font-size:13px; font-weight:600; background:#3d1c65;" class="pt-3 pb-4 pl-3" ><i class="
                                fas fa-layer-group"></i> BRANDS</h6>
                                     <div style=" padding:0px; margin-top:-20px;" class="items_2">
                                        @foreach ($brands as $brand)
                                        <a href="{{route('products.brand', ["category"=>$category->name, "brand_slug"=>$brand->slug])}}" style="text-transform:capitalize" class="item">
                                            {{$brand->name}}
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-right float-right pt-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                              </svg>
                                        </a>
                                        @endforeach
                                </div>

                        </div>

                          <h6 style="color:#fff; font-size:13px; font-weight:600; background:#3d1c65;" class="pt-3 pb-3 pl-3 mt-3 d-none d-sm-block" ><i class="
                            fas fa-layer-group"></i> Filter</h6>
                          <form action="{{route('product.filter')}}" method="post" style="border: 1px solid #dddbdb; margin-top:-8px; padding:10px;" class="d-none d-sm-block bg-white">
                            @csrf
                              <div class="row">
                                <input type="hidden" name="category" value="{{$category->name}}">
                                <div class="col-6">
                                  <div class="form-group">

                                    <select class="form-control  form-control-sm" name="country" id="country" >
                                      <option value="">Country</option>
                                      @foreach ($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group">

                                    <select class="form-control form-control-sm" name="state" id="state" >
                                      <option value="">State</option>
                                    </select>
                                  </div>
                                </div>
                              </div>

                              <div class="form-group">

                                <select class="form-control  form-control-sm" name="type" id="type">
                                  <option value="">Type</option>
                                  <option value="Nigeria Used">Nigeria Used</option>
                                  <option value="Belgium Tokunbo">Belgium Tokunbo</option>
                                  <option value="Brand New">Brand New</option>
                                </select>
                                </div>

                                <div class="row">
                                  <div class="col-12">
                                    <label for="" style="font-size:12px;">Price Filter</label>
                                  </div>
                                  <div class="form-group col-md-6">
                                    <input type="number" class="form-control  form-control-sm" style="font-size:12px;" name="min_price" id="min_price" aria-describedby="helpId" placeholder="Min">
                                  </div>
                                  <div class="form-group col-md-6">
                                      <input type="number" class="form-control  form-control-sm" style="font-size:12px;" name="max_price" id="max_price" aria-describedby="helpId" placeholder="Max">

                                    </div>
                                </div>

                                <div class="form-group">
                                  <button type="submit" class="btn btn-sm btn-block btn-warning text-white">Filter</button>
                                </div>
                          </form>

                    </div>

                  </div>
                  <div class="col-md-9">
                      <div class="row">
                          <div class="col-12 d-block d-sm-none">

                          <form action="{{route('product.filter')}}" method="post">
                                    @csrf
                                      <div class="row">
                                        <input type="hidden" name="category" value="{{$category->name}}">
                                        <div class="col-6">
                                          <div class="form-group">
                                            <label for="">Country</label>
                                            <select class="form-control  form-control-sm" name="country" id="country2" >
                                              <option value="">Country</option>
                                              @foreach ($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                              @endforeach
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-6">
                                          <div class="form-group">
                                            <label for="">State</label>
                                            <select class="form-control form-control-sm" name="state" id="state2">
                                              <option value="">State</option>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-6">
                                          <div class="form-group">
                                            <select class="form-control  form-control-sm" name="model" id="model" >
                                              <option value="">Model</option>
                                              @foreach ($brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                              @endforeach
                                            </select>
                                          </div>
                                         </div>
                                         <div class="col-6">
                                          <div class="form-group">

                                            <select class="form-control  form-control-sm" name="type" id="type">
                                              <option value="">Type</option>
                                              <option value="Nigeria Used">Nigeria Used</option>
                                              <option value="Belgium Tokunbo">Belgium Tokunbo</option>
                                              <option value="Brand New">Brand New</option>
                                            </select>
                                            </div>
                                         </div>
                                      </div>
                                      <div class="form-group">
                                        <button type="submit" class="btn btn-sm btn-block btn-warning text-white">Filter</button>
                                      </div>
                                    </form>
                              </div>


                          {{-- <h3 class="mt-3" style="text-transform: capitalize">{{$title}} ({{$product_count}} results)</h3> --}}

                          <div class="col-12">
                              <h6 style="font-weight:300; color:#919191; font-size:14px; text-transform:capitalize;"><b class="text-secondary" style="font-weight:601">{{$title}}</b> ({{$product_count}} results)</h6>
                          </div>

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

                          <div class="row">
                            <div class="col-12 ml-auto">
                               <div class="float-right"> {{ $products->links()}}</div>
                            </div>
                        </div>
                          @endif

                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        jQuery(document).ready(function(){

          $('#country').val(160);


          var country = 160;

          $.ajax({
                  method: 'get',
                  url:"{{route('getstate')}}",
                  data:{id:country},
                  success: function(data){
                      console.log(data);
                      $('#state').html('<option value="">Select State</option>');
                          $.each(data, function(key, value){
                          $('#state').append('<option value = '+value.id+ '>'+value.name+'</option>');
                      });
                  }
              });

              $('#country2').val(160);

                $.ajax({
                    method: 'get',
                    url:"{{route('getstate')}}",
                    data:{id:country},
                    success: function(data){
                        console.log(data);
                        $('#state2').html('<option value="">Select State</option>');
                            $.each(data, function(key, value){
                            $('#state2').append('<option value = '+value.id+ '>'+value.name+'</option>');
                        });
                    }
                });



              $.ajax({
                  method: 'get',
                  url:"{{route('getstate')}}",
                  data:{id:country},
                  success: function(data){
                      console.log(data);
                      $('#state').html('<option value="">Select State</option>');
                          $.each(data, function(key, value){
                          $('#state').append('<option value = '+value.id+ '>'+value.name+'</option>');
                      });
                  }
              });



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

            $('#country2').on('change', function(){
              var id = $(this).val();
              alert(id);
                $.ajax({
                    method: 'get',
                    url:"{{route('getstate')}}",
                    data:{id:id},
                    success: function(data){
                        console.log(data);
                        $('#state2').html('<option value="">Select State</option>');
                            $.each(data, function(key, value){
                            $('#state2').append('<option value = '+value.id+ '>'+value.name+'</option>');
                        });
                    }
                });
            });


            });
    </script>
@endsection

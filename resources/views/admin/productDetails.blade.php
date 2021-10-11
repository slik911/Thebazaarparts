@extends('layouts.app')
@section('title')
    Dashboard - {{$product->name}}
@endsection
@section('header')
    {{$product->name}}
@endsection
@section('content')
    <div id="product_content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 bg-white pt-3 pb-3">
                <div class="row">
                    <div class="col-md-8 order-lg-0 order-1">
                        <div class="form-group">
                            <label for="">Product Name</label>
                              <input type="text" name="" id="" class="form-control" readonly style="color:#111" placeholder="" aria-describedby="helpId" value="{{$product->name}}">
                          </div>
                          <div class="row">
                              <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">category</label>
                                      <input type="text" name="" id="" class="form-control" readonly style="color:#111" placeholder="" aria-describedby="helpId" value="{{$product->category_name}}">
                                  </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Sub category</label>
                                      <input type="text" name="" id="" class="form-control" readonly style="color:#111" placeholder="" aria-describedby="helpId" value="{{$product->subcategory_name}}">
                                  </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Brand</label>
                                      <input type="text" name="" id="" class="form-control" readonly style="color:#111" placeholder="" aria-describedby="helpId" value="{{$product->brand_name}}">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Country</label>
                                      <input type="text" name="" id="" class="form-control" readonly style="color:#111" placeholder="" aria-describedby="helpId" value="{{$product->country_name}}">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">State</label>
                                      <input type="text" name="" id="" class="form-control" readonly style="color:#111" placeholder="" aria-describedby="helpId" value="{{$product->state_name}}">
                                  </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Price</label>
                                      <input type="text" name="" id="" class="form-control" readonly style="color:#111" placeholder="" aria-describedby="helpId" value="{{number_format($product->price)}}">
                                  </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Type</label>
                                      <input type="text" name="" id="" class="form-control" readonly style="color:#111" placeholder="" aria-describedby="helpId" value="{{$product->type}}">
                                  </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Part Number</label>
                                      <input type="text" name="" id="" class="form-control" readonly style="color:#111" placeholder="" aria-describedby="helpId" value="{{$product->part_no}}">
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                    <label for="">Description</label>
                                  <textarea class="form-control" readonly style="color:#111" name="" id="" rows="8">{{$product->description}}</textarea>
                                  </div>
                              </div>


                          </div>

                    </div>
                    <div class="col-md-3 order-0 mt-md-5 mt-0 mb-4">
                       <center>
                        <img src="{{asset('images/products/'.$product->image)}}" class="img-fluid" style="width: 200px; height:200px; object-fit:contain; object-position:center; border:1px solid #dddbdd" alt="">
                       </center>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.master')
@section('title')
   Sellers
@endsection

@section('content')
@include('includes.header')
    <div id="content" class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    
                    <h5 style="font-size:16px; font-weight:600">REGISTERED SELLER</h5>
                    <hr>
                  <div class="row">
                    @foreach ($sellers as $seller)
                       <div class="col-md-3 col-6 sha">
                        <div class="card seller" style="border:none;">
                            <center><img class="card-img-top p-2 pt-3" src="{{asset('images/company_logo/'.$seller->logo)}}" alt="" style=" border-radius:0px;  width:100%; height:100px; object-fit:contain"></center>
                            <div class="card-body" style="padding:3px;">
                            <h4 class="card-title text-center mt-1" style="font-size:12px; font-weight:601"><a href="{{route('parts.company_profile', ['slug'=>$seller->slug])}}" style="color:#333; text-transform:uppercase; text-decoration:none; font-weight:600">{{$seller->name}}</a></h4>
                            </div>
                        </div>
                       </div>
                    @endforeach
                  </div>
                  <div class="row">
                    <div class="col-12 ml-auto">
                       <div class="float-right"> {{ $sellers->links()}}</div>
                    </div>
                </div>
                </div>
                @include('includes.sidebar')
            </div>
        </div>
    </div>
@endsection
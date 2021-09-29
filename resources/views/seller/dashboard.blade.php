@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('header')
    Dashboard
@endsection
@section('content')

@if ($profile_complete)
    @if (!$profile_complete->status)
        <p class="text-center bg-white shadow-sm p-3" style="">To complete your company profile registration <a href="{{route('seller.profile')}}" style="color:red">CLICK HERE</a> before you continue.</p>  
    @endif
@endif

<div class="row">
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    @if ($verification_status)
                        @if ($verification_status->verified)
                        <div class="col-icon">
                            <img src="{{asset('images/verification/verified.png')}}" style="width:70px; height:70px;" alt="">
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Verified </p>
                                    <small>Account has been verified</small>
                                </div>
                            </div>
                        @else
                        <div class="col-icon">
                            <a href="{{route('verification.index')}}" style="text-decoration:none" data-toggle="tooltip" data-placement="top" title="Verify your account">
                            <img src="{{asset('images/verification/no_verified.png')}}" style="width:70px; height:70px;" alt="">
                            </a>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <a href="{{route('verification.index')}}" style="text-decoration:none" data-toggle="tooltip" data-placement="top" title="Verify your account">
                                <div class="numbers" >
                                    <p class="card-category text-danger">Not Verified </p>
                                    <small class="text-secondary">Account has not been verified</small>
                                </div>
                            </a>
                        </div>
                            
                        @endif  
                    @else
                    <div class="col-icon">
                        <a href="{{route('verification.index')}}" style="text-decoration:none" data-toggle="tooltip" data-placement="top" title="Verify your account">
                        <img src="{{asset('images/verification/no_verified.png')}}" style="width:70px; height:70px;" alt="">
                        </a>
                    </div>
                    <div class="col col-stats ml-3 ml-sm-0">
                        <a href="{{route('verification.index')}}" style="text-decoration:none" data-toggle="tooltip" data-placement="top" title="Verify your account">
                            <div class="numbers" >
                                <p class="card-category text-danger">Not Verified </p>
                                <small class="text-secondary">Account has not been verified</small>
                            </div>
                        </a>
                    </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body ">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-warning bubble-shadow-small">
                            <i class="fa fa-th-list" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                            <p class="card-category">Regular Slots</p>
                        <h4 class="card-title">{{$regular_count}} <span style="font-size:12px;">Remaining</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-info bubble-shadow-small">
                            <i class="fa fa-th-list" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                            <p class="card-category">Featured Slots</p>
                        <h4 class="card-title">{{$featured_count}} <span style="font-size:12px;">Remaining</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-success bubble-shadow-small">
                            <i class="fa fa-th-list" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                            <p class="card-category">Hotlist Slots</p>
                        <h4 class="card-title">{{$hotlist_count}} <span style="font-size:12px;">Remaining</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  

        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-layers text-warning"></i>
                            </div>
                        </div>
                        <div class="col col-stats">
                            <div class="numbers">
                                <p class="card-category">Active Products</p>
                            <h4 class="card-title">{{$product}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-layers text-success"></i>
                            </div>
                        </div>
                        <div class="col col-stats">
                            <div class="numbers">
                                <p class="card-category">Active Featured</p>
                                <h4 class="card-title">{{$featured}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-layers text-danger"></i>
                            </div>
                        </div>
                        <div class="col col-stats">
                            <div class="numbers">
                                <p class="card-category">Active Hotlists</p>
                                <h4 class="card-title">{{$hotlist}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="
                                flaticon-chat-4 text-primary"></i>
                            </div>
                        </div>
                        <div class="col col-stats">
                            <div class="numbers">
                                <p class="card-category">Reviews</p>
                                <h4 class="card-title">{{number_format($reviews)}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
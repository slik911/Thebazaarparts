@extends('layouts.master')
@section('title')
    Categories
@endsection
@section('content')
    <div class="" id="category" style="margin-top:50px;  ">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pt-3 pb-3 mt-4" style="background:#3d1c65;">
                    <a href="{{route('products', ["category"=>$category->name, "subcategory_slug"=>null])}}" style="color:#fff; font-size:18px; text-transform:capitalize; text-decoration:none"></i> {{$category->name}} <i class="fa fa-angle-right float-right mt-1" aria-hidden="true"></i></a>
                   
                </div>
                @foreach ($subcategories as $sub)
                <div class="col-md-12 pr-3 mt-2" style="border-bottom:1px solid #ccc; ">
                    <a href="{{route('products', ["category"=>$category->name, "subcategory_slug"=>$sub->slug])}}">
                     <p style="font-size:16px; color:rgb(80, 80, 80); text-transform:capitalize;  text-decoration:none">   {{$sub->name}} <i class="fa fa-angle-right float-right mt-3" aria-hidden="true"></i>
                    </p>
                <p style="margin-top:-15px; color:rgb(139, 139, 139)">{{number_format($sub->count)}}ads</p> 
                    </a>
                </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
@extends('layouts.master')
@section('title')
Categories
@endsection
@section('content')
    <div class="" id="category" style="margin-top:70px;  ">
        <div class="container">
            <div class="row">

                @foreach ($categories as $category)
                <div class="col-md-12 pr-3 mt-4 pb-4" style="border-bottom:1px solid #ccc; ">
                    <a href="{{route('categories', ["category"=>$category->name])}}"  style="font-size:16px; color:rgb(80, 80, 80); text-transform:capitalize;  text-decoration:none" >
                        <img src="{{asset('images/category/'.$category->image)}}" style="width:30px; height:30px; object-fit:contain" alt=""> {{$category->name}}
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-right float-right pt-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                          </svg>
                    </a>
                </div>
                @endforeach



            </div>
        </div>
    </div>
@endsection

@extends('layouts.master')
@section('title')
    Manage Account
@endsection
@section('header')
   Manage Account
@endsection
@section('content')
@include('includes.header')
    <div id="content_verification">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto bg-white  p-5 mt-5">
                    <h6>Account deactivation means to delete your account.</h6>
                    <p style="font-size:13px;">You will not be able to log in to your profile anymore and account history will be deleted without the possiblity to restore</p>
                    <p>
                        <form action="{{route('delete.buyerAccount')}}" method="post">
                            @csrf
                            <button type="submit" onclick="return confirm('Are you sure you want to deactivate your account')" class="btn btn-danger" style="font-size: 14px;">CONTINUE TO DELETE MY ACCOUNT</button>
                        </form>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

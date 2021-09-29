@extends('layouts.app')
@section('title')
    Manage Account
@endsection
@section('header')
   Manage Account
@endsection
@section('content')
    <div id="content_verification">
        <div class="container">
            <div class="row">
                <div class="col-md-12 bg-white pt-3 pb-3">
                    <h4>Account deactivation means to delete your account.</h4>
                    <p>You will not be able to log in to your profile anymore,  all your post and account history will be deleted without the possiblity to restore</p>
                    <p>
                        <form action="{{route('delete.sellerAccount')}}" method="post">
                            @csrf
                            <button type="submit" onclick="return confirm('Are you sure you want to deactivate your account')" class="btn btn-danger">CONTINUE TO DELETE MY ACCOUNT</button>
                        </form>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

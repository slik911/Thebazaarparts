@extends('layouts.master')
@section('title')
   Login
@endsection

@section('content')
@include('includes.header') 
<nav class="breadcrumb bg-light justify-content-center" style="font-size:13px;">
<a class="breadcrumb-item" href="{{route('parts')}}" style="color:#54268c; text-decoration:none">Home</a>
    <span class="breadcrumb-item active">Login</span>
</nav>

<div class="wrapper wrapper-login " style=" margin-top:20px; ">
    <div class="container container-login animated fadeIn">
        <h5 class="text-center ">Login In To The Bazaar Parts</h5>
        
        <div class="row">
            <div class="col-md-5 mt-4 mx-auto">
            <div class="row">
                <div class="col-6">
                    <a href="{{ url('auth/google') }}" class="btn btn-outline btn-block pt-2 pb-2 shadow-sm" style="border:1px solid #ccc;">
                        <img src="{{asset('images/google.svg')}}" alt="" width="20px" height="20px" style="margin-left:-20px; margin-top:-5px;"> <span style="font-family: sans-serif; font-weight:500; margin-left:5px;">  Google</span>
                        </a>
                </div>
                <div class="col-6">
                    <a href="{{ url('auth/facebook') }}" class="btn btn-outline btn-block p-2" style="border:1px solid #ccc; background:#3b5999">
                        <img src="{{asset('images/facebook.svg')}}" alt="" width="20px" height="20px" style="margin-top:-8px;"> <span style="font-family: sans-serif; font-weight:500; margin-left:5px;">  <b class="text-white" style="margin-top:20px;" >Facebook</b></span>
                    </a>
                </div>
                <div class="col-12">
                    <p class="text-center" style="margin-bottom:-10px; margin-top:10px"><em>Or</em></p>
                </div>
            </div>
                
            </div>
        </div>
        <form action="{{route('login')}}" method="post">
        @csrf
        <div class="row">
          
            <div class="col-md-5 mx-auto">
             <div class="login-form">
                 <div class="form-group">
                     <label for="email" class="placeholder"><b>Email</b></label>
                     <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                 </div>
                 <div class="form-group">
                     <label for="password" class="placeholder"><b>Password</b></label>

                     @if (Route::has('password.request'))
                     <a href="{{ route('password.request') }}" class="link float-right text-secondary" style="font-size:14px;">{{ __('Forgot Your Password?') }}</a>
                 @endif
                     
                     <div class="position-relative">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                         <div class="show-password">
                             <i class="flaticon-interface"></i>
                         </div>
                     </div>
                 </div>
                 <div class="form-group form-action-d-flex mb-3">
                     <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                       
                         <label class="custom-control-label m-0" for="remember">Remember Me</label>
                     </div>
                     <button type="submit" href="#" class="btn btn-warning text-white col-md-5 float-right mt-3 mt-sm-0 fw-bold mb-md-0 mb-4">Sign In</button>
                 </div>
                 <!-- 				<div class="form-action">
                     <a href="#" class="btn btn-primary btn-rounded btn-login">Sign In</a>
                 </div> -->
                 <div class="login-account ">
                     <span class="msg">Don't have an account yet ?</span>
                     <a href="{{route('register')}}"  class="link" style="color:#54268c">Sign Up</a>
                 </div>
             </div>
            </div>
        </div>
        </form>
    </div>

</div>
@endsection


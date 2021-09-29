<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}"/>
        <title>@yield('title')</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/custom.css')}}">
        <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
        @yield('cssfiles')
    </head>
    <style>
        ::placeholder{
        color:#919191 !important;

        font-size:13px;
    }
    ::-moz-placeholder{
        color:#919191 !important;

        font-size:13px !important;
    }
    ::-webkit-input-placeholder{
        color:#919191 !important;

        font-size:13px !important;
    }

    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="datetime"]:focus,
    input[type="datetime-local"]:focus,
    input[type="date"]:focus,
    input[type="month"]:focus,
    input[type="time"]:focus,
    input[type="week"]:focus,
    input[type="number"]:focus,
    input[type="email"]:focus,
    input[type="url"]:focus,
    input[type="search"]:focus,
    input[type="tel"]:focus,
    input[type="color"]:focus,
    input[type="file"]:focus,
    .uneditable-input:focus {   
    border-color: rgba(84,38,140, .7);
    box-shadow: 0 1px 1px rgba(84,38,140, 0.075) inset, 0 0 8px rgba(84,38,140, 0.6);
    outline: 0 none;
    }

   
    #category:focus{
        border-color: rgba(84,38,140, .7);
    box-shadow: 0 1px 1px rgba(84,38,140, 0.075) inset, 0 0 8px rgba(84,38,140, 0.6);
    outline: 0 none;
    }
    </style>
    <body  style="background:#f9fbfd">


    <nav class="navbar navbar-expand-sm navbar-light bg-white fixed-top shadow-sm" style="font-size:14px;">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{asset('images/b2plogo.png')}}" class="img-fluid" alt="">
                </a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                    aria-expanded="false" aria-label="Toggle navigation" style="border:none;">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item"> 
                            <a href="" class="nav-link pl-2" style="color:#fff; background:#54268c; border-radius:25px;">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-globe" fill="currentColor" style="margin-top:-2px;" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4H2.255a7.025 7.025 0 0 1 3.072-2.472 6.7 6.7 0 0 0-.597.933c-.247.464-.462.98-.64 1.539zm-.582 3.5h-2.49c.062-.89.291-1.733.656-2.5H3.82a13.652 13.652 0 0 0-.312 2.5zM4.847 5H7.5v2.5H4.51A12.5 12.5 0 0 1 4.846 5zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5H7.5V11H4.847a12.5 12.5 0 0 1-.338-2.5zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12H7.5v2.923c-.67-.204-1.335-.82-1.887-1.855A7.97 7.97 0 0 1 5.145 12zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11H1.674a6.958 6.958 0 0 1-.656-2.5h2.49c.03.877.138 1.718.312 2.5zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12h2.355a7.967 7.967 0 0 1-.468 1.068c-.552 1.035-1.218 1.65-1.887 1.855V12zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5h-2.49A13.65 13.65 0 0 0 12.18 5h2.146c.365.767.594 1.61.656 2.5zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4H8.5V1.077c.67.204 1.335.82 1.887 1.855.173.324.33.682.468 1.068z"/>
                                  </svg>

                                  Visit Bazaar Community
                            </a>
                        </li>
                   
                        @if (Auth::check())
                        @if ( Auth::user()->role == 'seller' || Auth::user()->role == 'admin' )

                        <li class="nav-item order-lg-1">
                            <a class="nav-link" href="{{route('home')}}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear" fill="currentColor" style="margin-top:-2px;" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"/>
                                    <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"/>
                                  </svg>
                                Dashboard</a>
                        </li>
                        @endif
                        @endif

                        @if (Auth::check())
                        @if ( Auth::user()->role == 'buyer')
                        <li class="nav-item order-lg-1">
                            <a class="nav-link" href="{{route('register.company')}}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart4" fill="currentColor" style="margin-top:-3px;" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                                  </svg>
                                  </svg>
                                Become a Seller</a>
                        </li>
                        @endif
                        @endif

                        <li class="nav-item dropdown d-block d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-list" fill="currentColor" style="margin-top:-3px;" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                    <path fill-rule="evenodd" d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z"/>
                                    <circle cx="3.5" cy="5.5" r=".5"/>
                                    <circle cx="3.5" cy="8" r=".5"/>
                                    <circle cx="3.5" cy="10.5" r=".5"/>
                                  </svg>
                                Categories</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownId">
                                @foreach ($categories as $category)
                            <a class="dropdown-item" style="font-size: 14px; text-transform:capitalize" href="{{route('products', ["category"=>$category->name, "subcategory_slug"=>null])}}">{{$category->name}}</a>
                                @endforeach
                            </div>
                        </li>


                        @guest
                        <li class="nav-item dropdown order-lg-2">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" style="margin-top:-3px;"  xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                  </svg>
                                Account</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownId">
                                <a class="dropdown-item" style="font-size: 14px;" href="{{route('login')}}">Login</a>
                                <a class="dropdown-item" style="font-size:14px;" href="{{route('register')}}">Register</a>
                            </div>
                        </li>    
                        @else
                        <li class="nav-item dropdown order-lg-2">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-transform: capitalize">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" style="margin-top:-3px;"  xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                  </svg>
                                {{Auth::user()->name}}</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownId">
                                @if (Auth::user()->role == "buyer")
                                    <a class="dropdown-item" style="font-size: 14px;" href="{{route('buyer.profile')}}">Profile</a>
                                    <a class="dropdown-item" style="font-size: 14px;" href="{{route('buyer.manageAccount')}}">Manage Account</a>
                                @else
                                    @if (Auth::user()->role == "seller")
                                        <a class="dropdown-item" style="font-size: 14px;" href="{{route('seller.profile')}}">Profile</a>
                                    @else
                                        <a class="dropdown-item" style="font-size: 14px;" href="{{route('admin.profile')}}">Profile</a>
                                    @endif
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
        </div>
    </nav>

    <div id="main">
        @yield('content')
    </div>


    <div id="footer" style="background:#3d1c65;" class=" pt-5 pb-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                  <h5 style="font-size:16px; font-weight:501; color:#fff" class="mb-4">CONTACT INFO</h5>
                  <p style="font-size:15px; color:#ddd; font-weight:400"><i class="fa fa-map-marker" aria-hidden="true"></i> Address:</p>
                  <p style="font-size:14px; color:#ddd; margin-top:-15px;  font-weight:400">Plot 16 House 1 Oduguwa Ogunsanya Green Estate Amuwo Odofin Lagos.a</p>
  
                  <p style="font-size:15px; color:#ddd;  font-weight:400"><i class="fa fa-envelope" aria-hidden="true"></i> Email:</p>
                  <p style="font-size:14px; color:#ddd; margin-top:-15px;"  font-weight:400>enquiry@bazaarplus.com</p>
  
                  <p style="font-size:15px; color:#ddd;  font-weight:400"><i class="fa fa-phone" aria-hidden="true"></i> Phone:</p>
                  <p style="font-size:14px; color:#ddd;  font-weight:400; margin-top:-15px;">+234 806 3815290</p>
                  <p style="font-size:14px; color:#ddd; margin-top:-15px;  font-weight:400">+234 810 7215634</p>
                  
                  
                </div>
                
              <div class="col-md-3 mt-md-0 mt-4">
               
                      <h5 style="font-size:16px; font-weight:501; color:#fff" class="mb-4">QUICK LINKS</h5>
              <p><a href="{{route('about')}}" style="font-size:15px;  font-weight:400; color:#ddd; text-decoration:none; margin:0px 0px 15px;"><i class="fa fa-angle-right " aria-hidden="true"></i> About</a></p>
                    <p><a href="{{route('registered.sellers')}}" style="font-size:15px;  font-weight:400; color:#ddd; text-decoration:none; margin:0px 0px 15px;"><i class="fa fa-angle-right " aria-hidden="true"></i> Sellers</a></p>
                      <p><a href="{{route('terms')}}" style="font-size:15px;  font-weight:400; color:#ddd; text-decoration:none; margin:0px 0px 15px;"><i class="fa fa-angle-right " aria-hidden="true"></i> Terms and Condition</a></p>
                      <p><a href="{{route('terms')}}" style="font-size:15px;  font-weight:400; color:#ddd; text-decoration:none; margin:0px 0px 15px;"><i class="fa fa-angle-right " aria-hidden="true"></i> Privacy Policy</a></p>
                  
              </div>
              <div class="col-md-3 mt-md-0 mt-4">
                  <h5 style="font-size:16px; font-weight:501; color:#fff" class="mb-4">SUPPORT</h5>
                  <p><a href="{{route('faq')}}" style="font-size:15px;  font-weight:400; color:#ddd; text-decoration:none; margin:0px 0px 15px;"><i class="fa fa-angle-right " aria-hidden="true"></i> FAQ</a></p>
              <p><a href="{{route('safety')}}" style="font-size:15px;  font-weight:400; color:#ddd; text-decoration:none; margin:0px 0px 15px;"><i class="fa fa-angle-right " aria-hidden="true"></i> Safety Tips</a></p>
              <p><a href="{{route('contact')}}" style="font-size:15px;  font-weight:400; color:#ddd; text-decoration:none; margin:0px 0px 15px;"><i class="fa fa-angle-right " aria-hidden="true"></i> Contact Us</a></p>
              </div>
              <div class="col-md-3 mt-md-0 mt-4 p-0">
                  <form >
                      <div class="form-group col-md-12">
                          <label for="newsletter" class="text-white">Subscribe for NewsLetter</label>
                        <input type="text" class="form-control" style="width:100%" id="newsletter" placeholder="Search">
                      </div>
   
                        <button type="submit" class="btn btn-warning btn-sm text-white " style="margin-left:15px;"><i class="fa fa-paper-plane" aria-hidden="true"></i> Subscribe</button>
                 
                    </form>
                    <div class="f-social">
                      <ul class="list-unstyled list-inline">
                          <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                          <li class="list-inline-item"><a href="https://www.instagram.com/thebazaarplus_official/" target="blank"><i class="fa fa-instagram"></i></a></li>
                      </ul>
                    </div>
              </div>
            </div>
        </div>
    </div>
        <script src="{{asset('bootstrap/js/jquery.3.2.1.min.js')}}"></script>
        <script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
        <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/toastr.min.js')}}"></script>
        <script>
            $(document).ready(function() {
                @if(Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
                @endif

                @if(Session::has('info'))
                toastr.info("{{ Session::get('info') }}");
                @endif

                @if(Session::has('warning'))
                toastr.warning("{{ Session::get('warning') }}");
                @endif


                @if(Session::has('error'))
                toastr.error("{{ Session::get('error') }}");
                @endif


            });
        </script>
        @yield('jsfiles')
        @yield('js')
    </body>
</html>

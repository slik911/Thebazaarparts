
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>@yield('title')</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/azzara.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Lato', sans-serif;
        }
        .dropdown-item:hover{
            color:#3d1c65 !important;
            background: #fff;
		}
		.nav-item a p:hover{
			color:ghostwhite !important;
		}
    </style>
	@yield('cssfiles')
    <body>
	<div class="wrapper">
		<div class="main-header" data-background-color="purple" >
			<div class="logo-header" data-background-color="purple" >
				
			<a href="/" class="logo">
				<img src="{{asset('images/BAZAARPLUS.png')}}" style="width:100px; height:30px;" alt="">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="fa fa-bars"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
				<div class="navbar-minimize">
					<button class="btn btn-minimize btn-rounded">
						<i class="fa fa-bars"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" style="background: white !important; box-shadow: 0 5px 10px 0 rgba(138, 155, 165, 0.15);">
				
				<div class="container-fluid">
					<div class="collapse" id="search-nav">
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
						
						@if (Auth::user()->role == 'admin')
							@if ($data['total_count'] <= 0)
							<li class="nav-item dropdown hidden-caret">
								<a class="nav-link" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-bell" style="color: #3d1c65 !important"></i>
								</a>
							</li>
							@else
							<li class="nav-item dropdown hidden-caret">
								<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-bell" style="color:#3d1c65 !important"></i>
									<span class="notification">{{$data['total_count']}}</span>
								</a>
								<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
									<li>
										<div class="dropdown-title">You have {{$data['total_count']}} new notification</div>
									</li>
									<li>
										<div class="notif-scroll scrollbar-outer">
											<div class="notif-center">
												@if ($data['profile_count'] > 0)
													<a href="{{route('sellers')}}">
														<div class="notif-icon notif-secondary"> <i class="fa fa-user"></i> </div>
														<div class="notif-content">
															<span class="block">
																you have {{$data['profile_count']}} pending profile verification
															</span>
														</div>
													</a>
												@endif
									
												@if ($data['verification_count'] > 0)
													<a href="{{route('verification.manage')}}">
														<div class="notif-icon notif-success"> <i class="fa fa-user-plus" aria-hidden="true"></i> </div>
														<div class="notif-content">
															<span class="block">
																you have {{$data['verification_count']}} pending company verification
															</span>
														</div>
													</a>
												@endif
												@if ($data['regular_approval'] > 0)
													<a href="{{route('product.manager')}}">
														<div class="notif-icon notif-warning">  <i class="fa fa-cart-plus" aria-hidden="true"></i> </div>
														<div class="notif-content">
															<span class="block">
																you have {{$data['regular_approval']}} pending regular product confirmation
															</span>
														</div>
													</a>
												@endif
												@if ($data['featured_approval'] > 0)
													<a href="{{route('featured_product.manager')}}">
														<div class="notif-icon notif-success">  <i class="fa fa-cart-plus" aria-hidden="true"></i> </div>
														<div class="notif-content">
															<span class="block">
																you have {{$data['featured_approval']}} pending featured product confirmation
															</span>
														</div>
													</a>
												@endif
												@if ($data['hotlist_approval'] > 0)
													<a href="{{route('hotlist_product.manager')}}">
														<div class="notif-icon notif-info">  <i class="fa fa-cart-plus" aria-hidden="true"></i> </div>
														<div class="notif-content">
															<span class="block">
																you have {{$data['hotlist_approval']}} pending hotlist product confirmation
															</span>
														</div>
													</a>
												@endif
							

											</div>
										</div>
									</li>

								</ul>
							</li>
							@endif
						@else
							@if ($slot_data['total_count'] <= 0)
							<li class="nav-item dropdown hidden-caret">
								<a class="nav-link" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-bell" style="color:#3d1c65 !important"></i>
								</a>
							</li>
							@else
							<li class="nav-item dropdown hidden-caret">
								<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-bell" style="color:#3d1c65 !important"></i>
									<span class="notification">{{$slot_data['total_count']}}</span>
								</a>
								<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
									<li>
										<div class="dropdown-title">You have {{$slot_data['total_count']}} new notification</div>
									</li>
									<li>
										<div class="notif-scroll scrollbar-outer">
											<div class="notif-center">
												@if ($slot_data['regular_approval'] > 0)
													<a href="{{route('product.manage')}}">
														<div class="notif-icon notif-warning">  <i class="fa fa-cart-plus" aria-hidden="true"></i> </div>
														<div class="notif-content">
															<span class="block">
																you have {{$slot_data['regular_approval']}} declined regular product 
															</span>
														</div>
													</a>
												@endif
												@if ($slot_data['featured_approval'] > 0)
													<a href="{{route('featured_product.manage')}}">
														<div class="notif-icon notif-success">  <i class="fa fa-cart-plus" aria-hidden="true"></i> </div>
														<div class="notif-content">
															<span class="block">
																you have {{$slot_data['featured_approval']}} declined featured product 
															</span>
														</div>
													</a>
												@endif
												@if ($slot_data['hotlist_approval'] > 0)
													<a href="{{route('hotlist_product.manage')}}">
														<div class="notif-icon notif-info">  <i class="fa fa-cart-plus" aria-hidden="true"></i> </div>
														<div class="notif-content">
															<span class="block">
																you have {{$slot_data['hotlist_approval']}} declined hotlist product 
															</span>
														</div>
													</a>
												@endif

											</div>
										</div>
									</li>

								</ul>
							</li>
							@endif
						@endif
					
							
						
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                               {{-- @if (Auth::user()->image)
							<img src="{{asset('images/profile/'.Auth::user()->image)}}" class="img-fluid rounded-circle" style="width:2em; height:2em; object-fit:cover" alt="">
							   @else --}}
							   <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-person-fill" style="color:#3d1c65; margin-top:-3px;" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
							  </svg>
							  {{-- @endif --}}
							 
                                <i class="fa fa-angle-down text-white" aria-hidden="true" style="color:#3d1c65 !important"></i>
								
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
							@if (Auth::check())
							@if (Auth::user()->role == "seller")
							<a class="dropdown-item" href="{{route('seller.profile')}}">My Profile</a>	
							<a class="dropdown-item" href="{{route('seller.manageAccount')}}">Manage Account</a>	
							@else
								<a class="dropdown-item" href="{{route('admin.profile')}}" >My Profile</a>	
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
							</li>
							</ul>
						</li>
				
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar" style="background: #3d1c65">
			
			<div class="sidebar-background"></div>
			<div class="sidebar-wrapper scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							{{-- @if (Auth::user()->image)
								<img src="{{asset('images/profile/'.Auth::user()->image)}}" class="img-fluid rounded-circle" style="width:3em; height:3em; object-fit:cover" alt="">
							@else --}}
								<i class="fa fa-user-circle fa-3x" aria-hidden="true" style="color:#fff !important"></i>
							{{-- @endif --}}
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span style="text-transform: uppercase; color:#fff">
									{{Auth::user()->name}}
								<span class="user-level"  style="color:#fff">@if (Auth::check())
									{{Auth::user()->role}}
								@endif</span>
									<span class="caret" style="color:#fff"></span>
								</span>
						
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li >
										@if (Auth::check())
											@if (Auth::user()->role == "seller")
											<a class="dropdown-item" href="{{route('seller.profile')}}"  style="color:#fff">My Profile</a>	
											@else
											<a class="dropdown-item" href="{{route('admin.profile')}}" >My Profile</a>	
											@endif
										@endif
                                    </li>
                                    
                                    <li >
										<a class="dropdown-item text-white" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
									</li>
									
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav">
						<li class="nav-item active">
							<a href="{{route('parts')}}" >
								<p  style="color:#fff !important">Home</p>
							</a>
						</li>
						<li class="nav-item active">
						<a href="{{route('home')}}" >
							<p  style="color:#fff !important">Dashboard</p>
						</a>
					
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section"  style="color:#fff !important">Setups</h4>
                        </li>
						@if (Auth::user()->role == 'admin')
						<li class="nav-item">
							<a data-toggle="collapse" href="#base">
								<p  style="color:#fff">Collections</p>
								<span class="caret"  style="color:#fff !important"></span>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">
									<li>
									<a href="{{route('category')}}"   style="color:#fff !important">
											<span class="sub-item">Categories</span>
										</a>
									</li>
									
									<li>
									<a href="{{route('subcategory')}}"   style="color:#fff !important">
											<span class="sub-item">Sub Categories</span>
										</a>
									</li>

									<li>
										<a href="{{route('brand')}}"   style="color:#fff !important">
											<span class="sub-item">Brand</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#users">
								<p  style="color:#fff">Users</p>
								<span class="caret"  style="color:#fff !important"></span>
							</a>
							<div class="collapse" id="users">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{route('buyers')}}" style="color:#fff !important">
											<span class="sub-item">Manage Buyers</span>
										</a>
									</li>

									<li>
										<a href="{{route('sellers')}}" style="color:#fff !important">
											<span class="sub-item">Manage Sellers</span>
										</a>
									</li>
									<li>
										<a href="{{route('verification.manage')}}"   style="color:#fff !important">
											<span class="sub-item">Verification</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#product">
								<p  style="color:#fff">Product Manager</p>
								<span class="caret"  style="color:#fff !important"></span>
							</a>
							<div class="collapse" id="product">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{route('product.manager')}}" style="color:#fff !important">
											<span class="sub-item">Regular Products</span>
										</a>
									</li>

									<li>
										<a href="{{route('featured_product.manager')}}" style="color:#fff !important">
											<span class="sub-item">Featured Products</span>
										</a>
									</li>
									<li>
										<a href="{{route('hotlist_product.manager')}}"   style="color:#fff !important">
											<span class="sub-item">Hotlist Products</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
						<a href="{{route('payment.manager')}}">
								<p  style="color:#fff !important">Payments</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('premium.members')}}">
								<p  style="color:#fff !important">Premium Members</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="{{route('review.all')}}">
								<p  style="color:#fff !important">Review</p>
							</a>
						</li>

						@else
					
						<li class="nav-item">
							<a href="{{route('product.new')}}">
								<p  style="color:#fff !important">New Product</p>
							</a>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#base">
	
								<p  style="color:#fff">Manage Products</p>
								<span class="caret"  style="color:#fff !important"></span>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">
									<li>
									<a href="{{route('product.manage')}}"   style="color:#fff !important">
											<span class="sub-item">Regular Products</span>
										</a>
									</li>
									<li>
									<a href="{{route('featured_product.manage')}}"   style="color:#fff !important">
											<span class="sub-item">Featured Products</span>
										</a>
									</li>
									<li>
									<a href="{{route('hotlist_product.manage')}}"   style="color:#fff !important">
												<span class="sub-item">Hotlisted Products</span>
											</a>
										</li>
								</ul>
							</div>
						</li>

						<li class="nav-item">
							<a data-toggle="collapse" href="#package">
	
								<p  style="color:#fff">Buy Packages</p>
								<span class="caret"  style="color:#fff !important"></span>
							</a>
							<div class="collapse" id="package">
								<ul class="nav nav-collapse">
									<li>
									<a href="{{route('buy.economic_package')}}"   style="color:#fff !important">
											<span class="sub-item">Ecomomic Packages</span>
										</a>
									</li>
									<li>
									<a href="{{route('buy.membership_package')}}"   style="color:#fff !important">
											<span class="sub-item">Membership Packages</span>
										</a>
									</li>
			
								</ul>
							</div>
						</li>
						
						<li class="nav-item">
							<a data-toggle="collapse" href="#pm">
	
								<p  style="color:#fff">Package Manager</p>
								<span class="caret"  style="color:#fff !important"></span>
							</a>
							<div class="collapse" id="pm">
								<ul class="nav nav-collapse">
									<li>
									<a href="{{route('manage.economic_package')}}" style="color:#fff !important">
											<span class="sub-item">Ecomomic Packages</span>
										</a>
									</li>
									<li>
									<a href="{{route('manage.membership_package')}}"   style="color:#fff !important">
											<span class="sub-item">Membership Packages</span>
										</a>
									</li>
			
								</ul>
							</div>
						</li>

						<li class="nav-item">
							<a href="{{route('review.seller')}}">
								<p  style="color:#fff !important">Product Reviews</p>
							</a>
						</li>

						@endif

					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">
							@yield('header')
						</h4>
					
					</div>
                    @yield('content')
				</div>
			</div>
			
		</div>


	</div>
</div>
<!--   Core JS Files   -->
<script src="{{asset('bootstrap/js/jquery.3.2.1.min.js')}}"></script>
<script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
<script src="{{asset('js/bootstrap-toggle/bootstrap-toggle.min.js')}}"></script>
<script src="{{asset('js/ready.min.js')}}"></script>
<script src="{{asset('js/toastr.min.js')}}"></script>
@yield('jsfiles')
@yield('js')
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
</body>
</html>
@extends('layouts.app')
@section('title')
Membership Package
@endsection
@section('jsfiles')
<script src="https://js.paystack.co/v1/inline.js"></script>
@endsection
@section('header')
   Membership Package
@endsection
@section('content')
    <div id="product_manager_content">
        <div class="container">

            <div class="row">

                <div class="col-12 bg-white pt-5 pb-5">
					<h3 class="pl-4">Notice:</h3>
					<ul>
						<li>Company Profile must be verified before purchasing this package</li>
						<li>You must be a verified user before purchasing this package</li>
					</ul>
					<h4 class="page-title text-center">Pricing</h4>
				<form action="{{route('save.membership_package')}}" method="post" id="form">
					@csrf
					<input type="hidden" name="name" id="name" value="{{Auth::user()->name}}" >
					<input type="hidden" name="email" id="email" value="{{Auth::user()->email}}" >
					<input type="hidden" name="price" id="price">
					<input type="hidden" name="package" id="package_name">
					<input type="hidden" name="payment_reference" id="payment_reference">
					<div class="row justify-content-center align-items-center">
						<div class="col-md-3 pl-md-0">
							<div class="card card-pricing">
								<div class="card-header">
									<h5 class="card-title"  style="font-size:18px">Gold Package</h5>
									<div class="card-price">
										<span class="price" style="font-size:25px">&#8358; 180,000</span>
										<span class="text">/mo</span>
									</div>
								</div>
								<div class="card-body">
									<ul class="specification-list">

										<li>
											<span class="name-specification">Duration</span>
											<span class="status-specification">1 Year</span>
                                        </li>

                                        <li>
											<span class="name-specification">35 Regular Slots</span>
											<span class="status-specification">1 Year</span>
                                        </li>
                                        <li>
											<span class="name-specification">2 Hotlist Slot</span>
											<span class="status-specification">2 Month</span>
                                        </li>
                                        <li>
											<span class="name-specification">1 Featured Slot</span>
											<span class="status-specification">1 Month</span>
                                        </li>

									</ul>
								</div>
								<div class="card-footer">
									@if ($profile_verification)
										@if ($profile_verification->verified)
											@if ($verification)
												@if ($verification->status)
													<button type="submit" class="btn btn-secondary btn-block btn-sm paystack" data-id="180000" data-package="Gold" id="" onclick="return confirm('Do you want to continue ?')"> Purchase Plan </button>
												@else
													<a href="#" class="btn btn-secondary btn-block btn-sm" id="" onclick="return confirm('Please be patient while we verify your account')"> Account Verification Pending </a>
												@endif
											@else
											<a href="{{route('verification.index')}}" class="btn btn-secondary btn-block btn-sm" id="" onclick="return confirm('Your account has not been verified, Do you want to verify your account?')"> Verify Account</a>
											@endif
										@else
											<a href="{{route('seller.profile')}}" class="btn btn-secondary btn-block btn-sm" id="" onclick="return confirm('Your account has not been verified, Do you want to complete or modify your profile?')"> Verify Profile</a>
										@endif
									@else
									<a href="{{route('seller.profile')}}" class="btn btn-secondary btn-block btn-sm" id="" onclick="return confirm('Your profile has not been verified, Do you want to complete or modify your profile?')"> Verify Profile</a>
									@endif
								</div>
							</div>
						</div>
						<div class="col-md-3 pl-md-0 pr-md-0">
							<div class="card card-pricing card-pricing-focus card-secondary">
								<div class="card-header">
									<h4 class="card-title"  style="font-size:18px">Silver Package</h4>
									<div class="card-price">
										<span class="price"  style="font-size:25px">&#8358; 100,000</span>
										<span class="text">/mo</span>
									</div>
								</div>
								<div class="card-body">
									<ul class="specification-list">
										<li>
											<span class="name-specification">Duration</span>
											<span class="status-specification">6 Months</span>
										</li>
                                        <li>
											<span class="name-specification">25 Regular Slots</span>
											<span class="status-specification">6 Months</span>
                                        </li>
                                        <li>
											<span class="name-specification">1 Hotlist Slot</span>
											<span class="status-specification">1 Month</span>
										</li>
									</ul>
								</div>
								<div class="card-footer">
									@if ($profile_verification)
										@if ($profile_verification->verified)
											@if ($verification)
												@if ($verification->status)
												<button type="submit" class="btn btn-light btn-block btn-sm paystack" data-id="100000" data-package="Silver" id="" onclick="return confirm('Do you want to continue ?')"> Purchase Plan </button>
												@else
													<a href="#" class="btn btn-secondary btn-block btn-sm" id="" onclick="return confirm('Please be patient while we verify your account')"> Account Verification Pending </a>
												@endif
											@else
											<a href="{{route('verification.index')}}" class="btn btn-secondary btn-block btn-sm" id="" onclick="return confirm('Your account has not been verified, Do you want to verify your account?')"> Verify Account</a>
											@endif
										@else
											<a href="{{route('seller.profile')}}" class="btn btn-secondary btn-block btn-sm" id="" onclick="return confirm('Your profile has not been verified, Do you want to complete or modify your profile?')"> Verify Profile</a>
										@endif
									@else
									<a href="{{route('seller.profile')}}" class="btn btn-secondary btn-block btn-sm" id="" onclick="return confirm('Your profile has not been verified, Do you want to complete or modify your profile?')"> Verify Profile</a>
									@endif


								</div>
							</div>
						</div>
						<div class="col-md-3 pr-md-0">
							<div class="card card-pricing">
								<div class="card-header">
									<h4 class="card-title"  style="font-size:18px">Platinum Package</h4>
									<div class="card-price">
										<span class="price"  style="font-size:25px"> &#8358; 280,000</span>
										<span class="text">/mo</span>
									</div>
								</div>
								<div class="card-body">
									<ul class="specification-list">
                                        <li>
											<span class="name-specification">Duration</span>
											<span class="status-specification">1 Year</span>
                                        </li>

                                        <li>
											<span class="name-specification">45 Regular Slots</span>
											<span class="status-specification">1 Year</span>
                                        </li>
                                        <li>
											<span class="name-specification">3 Hotlist Slot</span>
											<span class="status-specification">3 Month</span>
                                        </li>
                                        <li>
											<span class="name-specification">2 Featured Slot</span>
											<span class="status-specification">2 Month</span>
                                        </li>
									</ul>
								</div>
								<div class="card-footer">

									@if ($profile_verification)
										@if ($profile_verification->verified)
											@if ($verification)
												@if ($verification->status)
												<button type="submit" class="btn btn-secondary btn-block btn-sm paystack" data-id="280000" data-package="Platinum" id="" onclick="return confirm('Do you want to continue ?')"> Purchase Plan </button>
												@else
													<a href="#" class="btn btn-secondary btn-block btn-sm" id="" onclick="return confirm('Please be patient while we verify your account')"> Account Verification Pending </a>
												@endif
											@else
											<a href="{{route('verification.index')}}" class="btn btn-secondary btn-block btn-sm" id="" onclick="return confirm('Your account has not been verified, Do you want to verify your account?')"> Verify Account</a>
											@endif
										@else
											<a href="{{route('seller.profile')}}" class="btn btn-secondary btn-block btn-sm" id="" onclick="return confirm('Your profile has not been verified, Do you want to complete or modify your profile?')"> Verify Profile</a>
										@endif
									@else
									<a href="{{route('seller.profile')}}" class="btn btn-secondary btn-block btn-sm" id="" onclick="return confirm('Your profile has not been verified, Do you want to complete or modify your profile?')"> Verify Profile</a>
									@endif


								</div>
							</div>
						</div>
					</div>
				</form>

                </div>
            </div>
        </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $('.blk').click(function(){
                toastr.error('Please Verify your account before becoming a premium member');
            });

            $('.paystack').click(function(){
                event.preventDefault();
				var price = $(this).attr('data-id');
				var package = $(this).attr('data-package');
				var data = [price, package]
				// console.log(package);
				// alert(package);
                payWithPaystack(data);
            });

            const paymentForm = document.getElementById('form');
            form.addEventListener("submit", payWithPaystack, false);
            function payWithPaystack(data) {
            event.preventDefault();
            let handler = PaystackPop.setup({
                key: 'pk_test_fd9b91bf407680d2d6a0ac9841aa7a0b8beb90bc', // Replace with your public key
                email: document.getElementById("email").value,
                amount: data[0] * 100,
                ref: ''+Math.floor((Math.random() * 1000000000) + 1),
                metadata: {
                    custom_fields:[
                        {
                            display_name: "Customer Name",
                            variable_name: "Customer_name",
                            value: document.getElementById("name").value
                        },

						{
                            display_name: "Package Description",
                            variable_name: "package_description",
                            value: "Membership Package"
                        },

                        {
                            display_name: "Package Type",
                            variable_name: "package_type",
                            value: data[1]
                        }
                    ]
                },
                currency: 'NGN',

                onClose: function(){
                alert('Window closed.');
                },
                callback: function(response){
                let message = 'Payment complete! Reference: ' + response.reference;
                    $('#payment_reference').val(response.reference);
					$('#price').val(data[0]);
					$('#package_name').val(data[1]);
					// alert(data[1]);
                    $('#form').submit();
                }
            });
            handler.openIframe();
            }
        });
    </script>
@endsection


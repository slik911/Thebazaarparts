@extends('layouts.app')
@section('title')
Economic Package
@endsection
@section('jsfiles')
<script src="https://js.paystack.co/v1/inline.js"></script>
@endsection
@section('header')
   Economic Package
@endsection
@section('content')
    <div id="product_manager_content">
        <div class="container">

            <div class="row">
                <div class="col-12 bg-white pt-5 pb-5">
					<h4 class="page-title text-center">Pricing</h4>
				<form action="{{route('save.economic_package')}}" method="post" id="form">
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
									<h4 class="card-title">Regular Slots</h4>
									<div class="card-price">
										<span class="price">&#8358; 20,000</span>
										<span class="text">/mo</span>
									</div>
								</div>
								<div class="card-body">
									<ul class="specification-list">
										<li class="text-center">
											<span class="name-specification">5 Slots per Interval</span>
										</li>
										<li class="text-center">
											<span >Ads apears only on product page</span>

										</li>
										<li>
											<span class="name-specification">Duration</span>
											<span class="status-specification">1 Month</span>
										</li>

									</ul>
								</div>
								<div class="card-footer">
									<button type="submit" class="btn btn-secondary btn-block btn-sm paystack" data-id="20000" data-package="Regular" id="" onclick="return confirm('Do you want to continue ?')"> Purchase Plan </button>
								</div>
							</div>
						</div>
						<div class="col-md-3 pl-md-0 pr-md-0">
							<div class="card card-pricing card-pricing-focus card-secondary">
								<div class="card-header">
									<h4 class="card-title">Featured Slots</h4>
									<div class="card-price">
										<span class="price">&#8358; 30,000</span>
										<span class="text">/wk</span>
									</div>
								</div>
								<div class="card-body">
									<ul class="specification-list">
										<li class="text-center">
											<span class="name-specification">1 Slot</span>
										</li>
										<li class="text-center">
											<span >Ads apears on all pages and home page</span>

										</li>
										<li>
											<span class="name-specification">Duration</span>
											<span class="status-specification">1 Week</span>
										</li>
									</ul>
								</div>
								<div class="card-footer">

									<button type="submit" class="btn btn-light btn-block btn-sm paystack" data-id="30000" data-package="Featured" id="" onclick="return confirm('Do you want to continue ?')"> Purchase Plan </button>
								</div>
							</div>
						</div>
						<div class="col-md-3 pr-md-0">
							<div class="card card-pricing">
								<div class="card-header">
									<h4 class="card-title">Hot Listing Slots</h4>
									<div class="card-price">
										<span class="price"> &#8358; 15,000</span>
										<span class="text">/wk</span>
									</div>
								</div>
								<div class="card-body">
									<ul class="specification-list">
										<li class="text-center">
											<span class="name-specification">1 Slot</span>
										</li>
										<li class="text-center">
											<span >Ads apears only on Home page</span>

										</li>
										<li>
											<span class="name-specification">Duration</span>
											<span class="status-specification">1 Week</span>
										</li>
									</ul>
								</div>
								<div class="card-footer">
									<button type="submit" class="btn btn-secondary btn-block btn-sm paystack" data-id="15000" data-package="Hotlist" id="" onclick="return confirm('Do you want to continue ?')"> Purchase Plan </button>

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
                            value: "Economic Package"
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


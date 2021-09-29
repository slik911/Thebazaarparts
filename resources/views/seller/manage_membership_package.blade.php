@extends('layouts.app')
@section('title')
Membership Package Manager
@endsection
@section('header')
Membership Package Manager
@endsection
@section('jsfiles')
<script src="{{asset('js/datatables.min.js')}}"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 bg-white pt-3 pb-3">

                <div class="table-responsive">
                    <table id="add-row" class="display nowrap table table-bordered table-striped table-hover table-responsive-sm" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>S/No</th>
                                <th>Date Created</th>
                                <th>Payment Reference</th>
                                <th>Package</th>
                                <th>Package Type</th>
                                <th>Price</th>

                                <th>Expiry Date</th>
                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $n = 1
                            @endphp
                           @if ($packages)
                           @foreach ($packages as $ad)
                           <tr>
                            <td>
                                {{$n++}}
                            </td>
                            <td>
                                {{\Carbon\Carbon::parse($ad->created_at)->format('d / m / Y')}}
                            </td>
                            <td>
                                {{$ad->payment_reference}}
                            </td>

                            <td>
                               <span style="text-transform: capitalize"> {{$ad->package}}</span>
                            </td>

                            <td>
                                {{$ad->package_type}}
                            </td>

                            <td>
                                {{$ad->price}}
                            </td>



                            <td>
                                <span class="text-danger">{{\Carbon\Carbon::parse($ad->expiry_date)->format('d / m / Y')}}</span>
                            </td>

                            <td>

                                @if ($ad->diffInDays <= 3 && $ad->diffInDays >= 1)

                                <form action="{{route('renew.membership_package')}}" method="post" id="form{{$n}}">
                                        @csrf
                                        <input type="hidden" id="id" name="id" value="{{$ad->id}}">
                                        <input type="hidden" name="old_reference" id="old_reference" value="{{$ad->payment_reference}}">
                                        <input type="hidden" name="payment_reference" id="payment_reference{{$n}}">
                                        <input type="hidden" name="email" id="email{{$n}}" value="{{Auth::user()->email}}">
                                        <input type="hidden" name="user_id" id="user_id{{$n}}" value="{{Auth::user()->id}}">
                                        <input type="hidden" name="package_type" id="package_type{{$n}}" value="{{$ad->package_type}}">
                                        @if ($ad->package_type == "Silver")
                                    <input type="hidden" name="price" id="price{{$n}}" value="100000">
                                        @endif

                                        @if ($ad->package_type == "Gold")
                                    <input type="hidden" name="price" id="price{{$n}}" value="180000">
                                        @endif

                                        @if ($ad->package_type == "Platinum")
                                    <input type="hidden" name="price" id="price{{$n}}" value="280000">
                                        @endif

                                    <button type="submit" class="btn btn-secondary text-white btn-sm paystack"  data-id="{{$n}}" onclick="return confirm('Do you want to continue ?')"> Renew Plan </button>
                                    </form>

                                @else
                                 {{-- @if ($ad->diffInDays < 1)
                                        <a href="#"  class="btn btn-danger disabled btn-sm">
                                            Expired
                                        </a>

                                    @else
                                    <a href="#"  class="btn btn-secondary disabled btn-sm">
                                        Active
                                    </a>
                                    @endif --}}

                                    @if (\Carbon\Carbon::now() <= \Carbon\Carbon::parse($ad->expiry_date))
                                    <a href="#"  class="btn btn-secondary disabled btn-sm">
                                        Expired
                                     </a>
                                    @else
                                    <a href="#"  class="btn btn-secondary disabled btn-sm">
                                        Active
                                     </a>
                                    @endif
                                @endif



                            </td>

                        </tr>
                           @endforeach
                           @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->


@endsection

@section('js')
    <script>
         $(document).ready(function () {

            $('#add-row').DataTable({
                "bSort":false
            });

            $('.paystack').click(function(){
                event.preventDefault();
                var id = $(this).attr('data-id');
                payWithPaystack(id);
            });

            // const paymentForm = document.getElementById('form');
            // form.addEventListener("submit", payWithPaystack, false);
            function payWithPaystack(id) {

            event.preventDefault();
            let handler = PaystackPop.setup({
                key: 'pk_test_fd9b91bf407680d2d6a0ac9841aa7a0b8beb90bc', // Replace with your public key
                email: document.getElementById("email"+id).value,
                amount: document.getElementById("price"+id).value * 100,
                ref: ''+Math.floor((Math.random() * 1000000000) + 1),
                metadata: {
                    custom_fields:[
                        {
                            display_name: "Payment Description",
                            variable_name: "payment_description",
                            value: "Membership  Renewal"
                        },

                        {
                            display_name: "Package ",
                            variable_name: "package",
                            value: document.getElementById("package_type"+id).value
                        }
                    ]
                },
                currency: 'NGN',

                onClose: function(){
                alert('Window closed.');
                },
                callback: function(response){
                let message = 'Payment complete! Reference: ' + response.reference;
                    $('#payment_reference'+id).val(response.reference);
                    $('#form'+id).submit();
                }
            });
            handler.openIframe();
            }

        })



    </script>
@endsection

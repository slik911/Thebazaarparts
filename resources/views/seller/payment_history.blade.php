@extends('layouts.app')
@section('title')
Payment History
@endsection
@section('header')
Payment History
@endsection
@section('jsfiles')
<script src="{{asset('js/datatables.min.js')}}"></script>
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
                                <th>Status</th>
                        
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $n = 1
                            @endphp
                           @if ($payments)
                           @foreach ($payments as $payment)
                           <tr>
                            <td>
                                {{$n++}}
                            </td>
                            <td>
                                {{\Carbon\Carbon::parse($payment->created_at)->format('d / m / Y')}}
                            </td>
                            <td>
                                <b>{{$payment->payment_reference}}</b>
                            </td>
                  
                            <td>
                                <span style="text-transform:capitalize">{{$payment->package}}</span>
                            </td>

                            <td>
                                {{$payment->package_type}}
                            </td>
                            <td>
                                {{number_format($payment->price)}}
                            </td>
                            <td>
                                @if ($payment->refunded == false)
                                <span class="text-success">Completed</span>
                                @else
                                    <span class="text-danger">Refunded</span>
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


    
  

@endsection

@section('js')
    <script>
         $(document).ready(function () {
             
            $('#add-row').DataTable({
                "bSort":false
            });

        
        })

            
       
    </script>
@endsection
@extends('layouts.app')
@section('title')
Payment Manager
@endsection
@section('header')
Payment Manager
@endsection
@section('jsfiles')
<script src="{{asset('js/datatables.min.js')}}"></script>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 bg-white pt-3 pb-3">

                <div class="table-responsive">
                    <table id="add-row" class="display nowrap table table-bordered table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>S/No</th>
                                <th>Date Created</th>
                                <th>Payment Reference</th>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Package</th>
                                <th>Package Type</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th></th>
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
                                <span style="text-transform:capitalize"> {{$payment->user_name}} </span>
                            </td>
                            <td>
                                {{$payment->user_email}}
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

           
                            <td>
                            @if ($payment->refunded == false)
                                <form action="{{route('payment.refund')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$payment->id}}">
            
                                <button type="submit" class="btn btn-sm btn-secondary text-white " onclick="return confirm('sure you want to refund this ?')"><i class="fa fa-refresh" aria-hidden="true"></i> Refund</button>
                                </form> 
                            @else
                            <button  class="btn btn-sm btn-secondary disabled" ><i class="fas fa-times-circle "></i> Refunded</button>
                            @endif   
                            </td>
                            <td>
                                <form action="{{route('payment.delete')}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{$payment->id}}">
            
                                <button type="submit" class="btn btn-sm btn-danger " onclick="return confirm('sure you want to delete this ?')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                </form> 
                              
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
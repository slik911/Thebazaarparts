@extends('layouts.app')
@section('title')
    Dashboard - Product Manager
@endsection
@section('jsfiles')
<script src="{{asset('js/datatables.min.js')}}"></script>
@endsection
@section('header')
    Manage Products
@endsection
@section('content')
    <div id="product-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pt-4 pb-3 bg-white">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>S/No</th>
                                    <th>Date Created</th>
                                    
                                    <th>Company</th>
                                    <th>Product ID</th>
                                    <th>Product</th>
                                    <th>Status</th>
                                    <th>Expiry Date</th>
                                    <th>Action</th>
                                    <th></th>
                                    <th></th>
                            
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $n = 1
                                @endphp
      
                              @foreach ($products as $product)
                              <tr>
                               <td>
                                   {{$n++}}
                               </td>
                               <td>
                                {{\Carbon\Carbon::parse($product->created_at)->format('d / m / Y')}}
                               </td>
                              

                               <td>
                                   {{$product->company_name}}
                               </td>
                               <td>
                                   <b class="text-secondary">
                                    {{$product->product_id}}
                                   </b>
                               </td>
                               <td>
                                {{$product->name}}
                                </td>
                               
                               <td>
                                   @if ($product->status == false && $product->rejected == false)
                                       <span class="text-danger">Pending</span>
                                   @endif
                                   @if ($product->status == false && $product->rejected == true)
                                       <span class="text-danger">Rejected</span>
                                   @endif
                                   @if ($product->status == true && $product->rejected == false)
                                       <span class="text-success">Approved</span>
                                   @endif
                               </td>

                               <td>
                                @if ($product->expiry_date == null)
                                    <span class="text-center">-</span>
                                @else
                                {{\Carbon\Carbon::parse($product->expiry_date)->format('d/m/Y')}}
                                @endif
                               </td>
                               <td>
                               <a  class="btn btn-info btn-sm" href="{{route('product.viewDetails', ['slug'=>$product->slug])}}">
                                    <i class="fa fa-eye" aria-hidden="true"></i> Details 
                                </a>
                               </td>
                               <td>
                                <form action="{{route('product.approve')}}" method="post">
                                    @csrf
                                <input type="hidden" name="id" value="{{$product->id}}">

                                @if ($product->status == false && $product->rejected == false)
                                <button type="submit" class="btn btn-sm btn-success " onclick="return confirm('sure you want to approve this item ?')">Approve </button>
                                @endif
                                @if ($product->status == false && $product->rejected == true)
                                <a class="btn btn-sm btn-success text-white disabled"> Approve </a> 
                                @endif
                                @if ($product->status == true && $product->rejected == false)
                                <a class="btn btn-sm btn-success text-white disabled"> Approved </a> 
                                @endif
                                
                                
                                </form> 
                               </td>
                               <td>
                                <form action="{{route('product.reject')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$product->id}}">

                                    @if ($product->status == false && $product->rejected == false)
                                    <button type="submit" class="btn btn-sm btn-danger " onclick="return confirm('sure you want to reject this item profile ?')">Reject </button>
                                    @endif
                                    @if ($product->status == false && $product->rejected == true)
                                    <a class="btn btn-sm btn-danger disabled text-white" >Rejected </a>  
                                    @endif
                                    @if ($product->status == true && $product->rejected == false)
                                    <a class="btn btn-sm btn-danger disabled text-white" >Reject </a>  
                                    @endif
                                    
                            
                                    </form> 
                               </td>
               
                           </tr>
                              @endforeach
                        
                            </tbody>
                        </table>
                    </div>
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
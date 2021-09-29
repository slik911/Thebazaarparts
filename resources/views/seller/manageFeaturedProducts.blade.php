@extends('layouts.app')
@section('title')
 Featured Products
@endsection

@section('jsfiles')
<script src="{{asset('js/datatables.min.js')}}"></script>
@endsection
@section('header')
    Featured Product Manager
@endsection
@section('content')
    <div id="product_manager_content">
        <div class="container">
     
            <div class="row">
                <div class="col-12 bg-white pt-3 pb-3">
                    
                    <div class="d-flex">
        
                        <a href="{{route('product.new')}}" class="btn btn-secondary btn-sm ml-auto mb-3">
                                Add New Product
                            </a>

                        </div>
                    
                    <!-- Table -->
                    <div class="table-responsive-sm" >
                        <table id="add-row" class="display table nowrap table-striped table-hover text-center" cellspacing="0" width="100%"  style="overflow-x:auto;">
                            <thead>
                                <tr>
                                    <th>S/No</th>
                                    <th >Date Created</th>
                                    <th>Product ID</th>
                                    <th class="text-left">Product Name</th>
                                    <th>Price</th>
                                    <th>Availability</th>
                                    <th>status</th>  
                                    <th>Expiry Date</th>             
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                     <th></th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $n = 1
                                @endphp
                              @if ($products)
                              @foreach ($products as $product)
                              <tr>
                               <td>
                                   {{$n++}}
                               </td>
                               <td width="20%">
                                {{\Carbon\Carbon::parse($product->created_at)->format('d/m/Y')}}
                               </td>
                               
                               <td>
                               <b class="text-secondary">{{$product->product_id}}</b>
                               </td>
                               <td style="width:100px" class="text-left">
                                   {{$product->name}}
                               </td>
                               <td>
                                {{number_format($product->price)}}
                                </td>
                                <td>
                                    @if ($product->availability)
                                        <span class="text-success">In stock</span>
                                    @else
                                    <span class="text-danger">Out of Stock</span>
                                    @endif
                                </td>
                                <td>
                                    
                                    @if ($product->status == true && $product->rejected == false)
                                    <span class="text-success">Approved</span>
                                    @endif
                                    @if ($product->status == false && $product->rejected == true)
                                    <span class="text-danger">Rejected</span>
                                    @endif
                                    @if ($product->status == false && $product->rejected == false)
                                    <span class="text-danger">Pending</span>
                                    @endif
                                </td>
                                <td width="20%" class="text-secondary">
                                    {{\Carbon\Carbon::parse($product->expiry_date)->format('d / m / Y')}}
                                </td>
                            
                                <td>
                                    <a href="{{route('featured_product.edit', ["slug" => $product->slug])}}" class="btn btn-sm btn-info" > <i class="fa fa-edit"></i> Edit</a>
                                </td>
                                

                               <td>
                                <form action="{{route('update.featuredavailability')}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    @if($product->availability)
                                    <button type="submit" class="btn btn-sm btn-warning " onclick="return confirm('sure you want to do this ?')"><i class="fa fa-times-circle "></i> Out of Stock</button>
                                    @else
                                    <button type="submit" class="btn btn-sm btn-success " onclick="return confirm('sure you want to do this ?')"><i class="fa fa-times-check "></i> In Stock</button>
                                    @endif
                                       
                                    </form>
                               </td>

                               <td>
                                <a href="{{route('product.viewFeaturedDetails', ['slug'=>$product->slug])}}" class="btn btn-sm btn-secondary">Preview</a>
                               </td>

                               <td>
                                <form action="{{route('delete.featuredproduct')}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{$product->product_id}}">
                               
                                 <button type="submit" class="btn btn-sm btn-danger " onclick="return confirm('sure you want to delete this ?')"><i class="fa fa-times-circle "></i> Delete</button>
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
         });

    </script>
@endsection


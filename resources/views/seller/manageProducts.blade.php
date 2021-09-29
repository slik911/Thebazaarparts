@extends('layouts.app')
@section('title')
    Products
@endsection
@section('jsfiles')
<script src="{{asset('js/datatables.min.js')}}"></script>
@endsection
@section('header')
    Product Manager
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
                    <div class="table-responsive-sm">
                        <table id="add-row" class="display nowrap table table-striped table-hover text-center table-responsive" cellspacing="0" width="100%"  style="overflow-x:auto;">
                            <thead>
                                <tr>
                                    <th>S/No</th>
                                    <th>Date Created</th>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Availability</th>
                                    <th>status</th>
                                    <th>Expiry Date</th>
                                    <th></th>
                                    <th></th>
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
                               <td>
                                {{\Carbon\Carbon::parse($product->created_at)->format('d/m/Y')}}
                               </td>
                              
                               
                               <td>
                               <b class="text-secondary">{{$product->product_id}}</b>
                               </td>
                               <td>
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

                                <td>
                                    @if ($product->expiry_date == null)
                                  <span class="text-center">-</span>
                                    @else
                                    {{\Carbon\Carbon::parse($product->expiry_date)->format('d / m / Y')}}
                                    @endif
                                </td>
                                <td>
                                    @if ($product->featured == null)
                                <a href="#" class="btn btn-sm" style="color:white; background:#ccc" data-toggle="tooltip" data-placement="top" title="Add To Featured List" onclick="event.preventDefault(); document.getElementById('featured-upload{{$n}}').submit();"><i class="fa fa-star" aria-hidden="true"></i></a> 
                                    @else
                                <a href="#" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Remove from Featured List" onclick="event.preventDefault(); document.getElementById('featured-delete{{$n}}').submit();"><i class="fa fa-star" aria-hidden="true"></i></a>  
                                    @endif
                                   
                                <form id="featured-upload{{$n}}" action="{{route('upload_existing.featured')}}" method="POST" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="product_id" id="product_id" value="{{$product->product_id}}">
                                    </form>

                                <form id="featured-delete{{$n}}" action="{{route('delete.featuredproduct')}}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" id="id" value="{{$product->product_id}}">
                                    </form>



                                </td>
                                <td>
                                    @if ($product->hotlist == null)
                                    <a href="" class="btn btn-sm" style="color:white; background:#ccc" data-toggle="tooltip" data-placement="top" title="Add To hotlist" onclick="event.preventDefault(); document.getElementById('hotlist-upload{{$n}}').submit();"><i class="fa fa-fire" aria-hidden="true"></i></a>
                                    @else
                                    <a href="" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Remove from hotlist" onclick="event.preventDefault(); document.getElementById('hotlist-delete{{$n}}').submit();"><i class="fa fa-fire" aria-hidden="true"></i></a>
                                    @endif

                                    <form id="hotlist-upload{{$n}}" action="{{route('upload_existing.hotlist')}}" method="POST" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="product_id" id="product_id" value="{{$product->product_id}}">
                                    </form>

                                    <form id="hotlist-delete{{$n}}" action="{{route('delete.hotlistproduct')}}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" id="id" value="{{$product->product_id}}">
                                    </form>

                                </td>


                                <td>
                                    <a href="{{route('product.edit', ["slug" => $product->slug])}}" class="btn btn-sm btn-info" > <i class="fa fa-edit"></i> Edit</a>
                                </td>
                                

                               <td>
                                <form action="{{route('update.availability')}}" method="post">
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
                                <a href="{{route('product.viewDetails', ['slug'=>$product->slug])}}" class="btn btn-sm btn-secondary">Preview</a>
                               </td>

                               <td>
                                <form action="{{route('delete_seller.product')}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{$product->id}}">
                               
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


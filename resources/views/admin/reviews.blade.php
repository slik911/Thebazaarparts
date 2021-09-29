@extends('layouts.app')
@section('title')
Reviews
@endsection
@section('header')
    Product Reviews
@endsection
@section('jsfiles')
<script src="{{asset('js/datatables.min.js')}}"></script>
@endsection
@section('content')
    <div id="economic-plan">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pt-3 pb-3 bg-white">
                    <div class="table-responsive">
                        <table id="add-row" class="display nowrap table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>S/No</th>
                                    <th>Date Created</th>
                                    <th>Product ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Review</th>    
                                    <th>Action</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $n = 1
                                @endphp
                              @if ($reviews)
                              @foreach ($reviews as $review)
                              <tr>
                               <td>
                                   {{$n++}}
                               </td>
                               
                                <td>
                                    {{\Carbon\Carbon::parse($review->created_at)->format('d/m/Y')}}
                                   </td>
                        
                               <td>
                                   {{$review->product_id}}
                               </td>
                               <td>
                               <span style="text-transform: capitalize">{{$review->full_name}}</span>
                               </td>
                               <td>
                                <span>{{$review->email}}</span>
                               </td>
                               <td>
                                {{substr($review->review, 0, 10)}}...
                               </td>
        
                               <td>
                                   @if ($review->product_slug && $review->featured_slug)
                                    <a href="{{route('product.viewDetails', ['slug'=>$review->product_slug])}}" class="btn btn-sm btn-secondary">Preview Product</a>
                                   @endif
                                   @if($review->product_slug && $review->hotlist_slug)
                                   <a href="{{route('product.viewDetails', ['slug'=>$review->product_slug])}}" class="btn btn-sm btn-secondary">Preview Product</a>
                                   @endif
                                   @if ($review->featured_slug && !$review->product_slug && !$review->hotlist_slug)
                                   <a href="{{route('product.viewFeaturedDetails', ['slug'=>$review->featured_slug])}}" class="btn btn-sm btn-secondary">Preview Product</a>
                                   @endif
                                   @if (!$review->featured_slug && !$review->product_slug && $review->hotlist_slug)
                                   <a href="{{route('product.viewhotlistDetails', ['slug'=>$review->hotlist_slug])}}" class="btn btn-sm btn-secondary">Preview Product</a>
                                  @endif
                               </td>
                               <td>
                                <button type="button" class="btn btn-warning btn-sm review" data-id="{{$review->id}}" data-toggle="modal" data-target="#modelId">
                                    Review
                                  </button>
                            </td>
                               <td>
                                <form action="{{route('change.reviewStatus')}}" method="post">
                                    @csrf
                             
                                    <input type="hidden" name="id" value="{{$review->id}}">
                                     @if ($review->status == false)
                                     <button type="submit" class="btn btn-sm btn-warning " onclick="return confirm('Do you want to hide this review')">Hide </button>
                                     @else
                                     <button type="submit" class="btn btn-sm btn-success " onclick="return confirm('Do you want to unhide this review')">Unhide </button>  
                                     @endif
                                    </form>  
                               </td>

                               <td>
                                <form action="{{route('review.delete')}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{$review->id}}">
                   
                                    
                                     @if ($review->deleted == false)
                                     <button type="submit" class="btn btn-sm btn-danger " onclick="return confirm('Do you want to delete this review')">Delete </button>
                                     @else
                                     <a href="" class="btn btn-success btn-sm disabled">Delete</a> 
                                     @endif

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
    </div>

        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body" id="review_text">
                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                   
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
            
            $('#add-row').on('click', '.review', function(){
                var id = $(this).attr('data-id');
    
                $.ajax({
                    method: 'get',
                    url:"{{route('get.review')}}",
                    data:{id:id},
                    success: function(data){
                        console.log(data);
                        $('#review_text').text(data.review);
                 
                    }
                });
        

            });
        })

       
    </script>
@endsection
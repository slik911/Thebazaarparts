@extends('layouts.app')
@section('title')
Category
@endsection
@section('header')
    Category
@endsection
@section('jsfiles')
<script src="{{asset('js/datatables.min.js')}}"></script>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 bg-white pt-3 pb-3">
                <div class="d-flex">
                    <button class="btn btn-secondary btn-sm ml-auto mb-3" data-toggle="modal" data-target="#addRowModal">
                        <i class="fa fa-plus"></i>
                        Add Row
                    </button>
                </div>
                
                <!-- Modal -->
                <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header no-bd">
                                <h5 class="modal-title">
                                    <span class="fw-mediumbold">
                                    Category</span>
        
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="small">Create a new category using this form, make sure you fill them all</p>
                            <form role="form" method="post" action="{{route('new.category')}}" id="form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Fill category name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-12">
                                        <div class="form-group">
                                          <label for="">ICON</label>
                                          <input type="file" class="form-control-file p-3" style="border: 1px solid #dddbdb" name="image" id="image" placeholder="" aria-describedby="fileHelpId">
                                          <small id="fileHelpId" class="form-text text-muted">max 100kb (<em>png, jpg, jpeg</em>)</small>
                                        </div>
                                    </div>
                                   
                               
                            </div>
                            <div class="modal-footer no-bd">
                                <button type="submit"  class="btn btn-info btn-sm" id="save">Add</button>
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                </div>
                
                <!-- Table -->
                <div class="table-responsive">
                    <table id="add-row" class="display nowrap table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>S/No</th>
                                <th>Date Created</th>
                                <th width=50%>Name</th>
                
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $n = 1
                            @endphp
                          @if ($categories)
                          @foreach ($categories as $category)
                          <tr>
                           <td>
                               {{$n++}}
                           </td>
                           <td>
                            {{\Carbon\Carbon::parse($category->created_at)->format('d / m / Y')}}
                           </td>
                           <td>
                               {{$category->name}}
                           </td>
                           <td>
                            <button type="button" class="btn btn-info btn-sm edit" data-id="{{$category->id}}" data-toggle="modal" data-target="#editCategory">
                                <i class="fa fa-edit"></i> Edit
                            </button> 
                           </td>
                           <td>
                               
                           {{-- <a href="" class="btn btn-info btn-sm"><i class="fas fa-edit    "></i></a>   --}}
                           <form action="{{route('delete.category')}}" method="post">
                           @csrf
                           @method('DELETE')
                           <input type="hidden" name="id" value="{{$category->id}}">
                          
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

    <div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                        Edit Category</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" method="post" action="{{route('update.category')}}" id="form2" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="eid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group ">
                                        <label for="category_name">Name</label>
                                        <input id="category_name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="fill category name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <div class="form-group" >
                                  <label for="category_image">ICON</label>
                                  <input type="file" class="form-control-file p-3" style="border: 1px solid #dddbdb" name="image" id="category_image" placeholder="" aria-describedby="fileHelpId">
                                  <small id="fileHelpId" class="form-text text-muted">max 100kb (<em>png, jpg, jpeg</em>)</small>
                                </div>
                            </div>
                           
                       
                    </div>
                    <div class="modal-footer no-bd">
                        <button type="submit"  class="btn btn-info btn-sm" id="save2">Save Changes</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
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

            $('.edit').on('click', function(){
                var id = $(this).attr('data-id');
                 //   console.log(id);
                $.ajax({
                    method: 'get',
                    url:"{{route('get.category')}}",
                    data:{id:id},
                    success: function(data){         
                    $('#eid').val(data.id);
                    $('#category_name').val(data.name);
                    $('#category_status').val(data.status);
                    }
                });
            });

            $('#save').click(function(){
                event.preventDefault();
                var ext = $('#image').val().split('.').pop().toLowerCase();
                var name = $('#name').val();
                var icon = $('#image').val();
                if(name == ''){
                    toastr.error("Category name is required"); 
                }
                else if(icon == ''){
                    toastr.error("Category Icon is required"); 
                }
                else if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1){
                    toastr.error("file must be an image");
                }
                else{
                    var file = $('#image')[0].files[0];

                    if(file.size > 100000){
                        toastr.error("Maximum file size is 100kb");
                    }
                    else{
                        $('#form').submit();
                    }
                    
                }
                    
            });


            $('#save2').click(function(){
                event.preventDefault();
                var ext = $('#category_image').val().split('.').pop().toLowerCase();
                var name = $('#category_name').val();
                var icon = $('#category_image').val();
                if(name == ''){
                    toastr.error("Category name is required"); 
                }
                else{
                    if(icon != ''){
                        if ($.inArray(ext, ['gif','png','jpg','jpeg']) == -1){
                            toastr.error("file must be an image");
                        }
                        else {
                            var file = $('#category_image')[0].files[0];

                            if(file.size > 100000){
                                    toastr.error("Maximum file size is 100kb");
                            }
                            else{
                                $('#form2').submit();
                            }
                        }
                            
                    }
                    else{
                        $('#form2').submit();
                    }
                }
                    
            });
        })
       
    </script>
@endsection
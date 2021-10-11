@extends('layouts.app')
@section('title')
Brands
@endsection
@section('header')
    Brands
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
                                    brand</span>

                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="small">Create a new brand using this form, make sure you fill them all</p>
                            <form role="form" method="post" action="{{route('new.brand')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group ">
                                                <label for="category">Category</label>
                                                <select class="form-control pb-1" id="category" name="category" required>
                                                    <option value="">Select category</option>
                                                   @if ($categories)
                                                   @foreach ($categories as $category)
                                                   <option value="{{$category->slug}}">{{$category->name}}</option>
                                                   @endforeach
                                                   @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="fill brand name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                            </div>
                            <div class="modal-footer no-bd">
                                <button type="submit"  class="btn btn-info btn-sm">Add</button>
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table id="add-row" class="display nowrap table table-bordered table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>S/No</th>
                                <th>Date Created</th>
                                <th width=20%>Category</th>
                                <th width=30%>brand Name</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $n = 1
                            @endphp
                           @if ($brands)
                           @foreach ($brands as $brand)
                           <tr>
                            <td>
                                {{$n++}}
                            </td>
                            <td>
                                {{\Carbon\Carbon::parse($brand->created_at)->format('d, M Y')}}
                            </td>
                            <td>
                                {{$brand->category_name}}
                            </td>
                            <td>
                                {{$brand->name}}
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm edit" data-id="{{$brand->id}}" data-toggle="modal" data-target="#editCategory">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                            </td>
                            <td>
                            <form action="{{route('delete.brand')}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{$brand->id}}">

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
                        Edit brand</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form role="form" method="post" action="{{route('update.brand')}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="eid">
                            <div class="row">
                               <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="ecategory">Category</label>
                                                <select class="form-control pb-1" id="ecategory" name="category" required>
                                                    <option value="">Select category</option>
                                                   @if ($categories)
                                                   @foreach ($categories as $category)
                                                   <option value="{{$category->slug}}">{{$category->name}}</option>
                                                   @endforeach
                                                   @endif
                                                </select>
                                            </div>
                                        </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input id="brand_name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="fill brand name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer no-bd">
                        <button type="submit"  class="btn btn-info btn-sm">Save Changes</button>
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
                $.ajax({
                    method: 'get',
                    url:"{{route('get.brand')}}",
                    data:{id:id},
                    success: function(data){
                    $('#eid').val(data.id);
                    $('#ecategory').val(data.category_id)
                    $('#brand_name').val(data.name);
                    }
                });
            });
        })

    </script>
@endsection

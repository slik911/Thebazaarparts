@extends('layouts.master')
@section('title')
    Profile
@endsection
@section('content')
@include('includes.header')

    <div id="content-profile" class=" p-3">
        <div class="container">

                    <div class="row">
                        <div class="col-md-8  mt-3 mx-auto">
                            <h5 style="font-weight: 500">PERSONAL INFORMATION</h5>
                        <form action="{{route('profile.update')}}" method="post" >
                                @csrf
                                @method("PUT")
                                <div class="row">
                                    <div class="col-md-12">
                                    <input type="hidden" name="id" id="id" class="form-control" placeholder="" value="{{Auth::user()->id}}" aria-describedby="helpId">
                                        <div class="form-group">
                                        <label for="">Full Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="" aria-describedby="helpId" value="{{Auth::user()->name}}" required>
                                        </div>
                                    </div>
                 
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="">Phone Number</label>
                                        <input type="text" name="phone" id="phone" value="{{Auth::user()->phone}}" class="form-control" placeholder="" aria-describedby="helpId" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{Auth::user()->email}}" placeholder="" aria-describedby="helpId" required readonly>
                                        </div> 
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <input type="text" name="address" id="address" value="{{Auth::user()->address}}" class="form-control" placeholder="" aria-describedby="helpId" required>
                                            </div> 
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Country</label>
                                            <select class="form-control pb-1" name="country" id="country" required>
                                                @foreach ($country as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>    
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">State</label>
                                            <select class="form-control pb-1" name="state" id="state" required>
                                                @foreach ($state as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-warning text-white">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            var id = $('#id').val();
          
                $.ajax({
                    method: 'get',
                    url:"{{route('get.region')}}",
                    data:{id:id},
                    success: function(data){   
             
                    $('#state').val(data.state_id);
                    $('#country').val(data.country_id);
                    }
                });

                $('#country').on('change', function(){
                var id = $(this).val();
                $.ajax({
                    method: 'get',
                    url:"{{route('getstate')}}",
                    data:{id:id},
                    success: function(data){
                        console.log(data);
                        $('#state').html('<option value="">Select State</option>');
                            $.each(data, function(key, value){
                            $('#state').append('<option value = '+value.id+ '>'+value.name+'</option>');
                        });
                    }
                });
            });

        });  

         
    
    </script>
@endsection
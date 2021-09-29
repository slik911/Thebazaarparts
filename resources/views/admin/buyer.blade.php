@extends('layouts.app')
@section('title')
   Buyers
@endsection
@section('jsfiles')
<script src="{{asset('js/datatables.min.js')}}"></script>
@endsection
@section('header')
    Buyers - Table
@endsection
@section('content')
    <div id="seller_Content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 bg-white pt-3 pb-3">
                    <div class="table-responsive">
                        <table id="add-row" class="display table nowrap table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>S/No</th>
                                    <th>Date Created</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $n = 1
                                @endphp
                              @if ($users)
                              @foreach ($users as $user)
                              <tr>
                               <td>
                                   {{$n++}}
                               </td>
                               
                                <td>
                                    {{\Carbon\Carbon::parse($user->created_at)->format('d / M / Y')}}
                                   </td>
                            
                               <td>
                                   <span style="text-transform:capitalize">{{$user->name}}</span>
                               </td>
                               <td>
                                   {{$user->email}}
                               </td>
                               
                               <td>
                                   @if ($user->status == false)
                                       <span class="text-success">Active</span>
                                   @else
                                   <span class="text-danger">Blocked</span>
                                   @endif
                               </td>
                               <td>
                               <a  class="btn btn-info btn-sm" href="{{route('seller.viewDetails', ['email'=>$user->email])}}">
                                    <i class="fa fa-eye" aria-hidden="true"></i> View Profile
                                </a>
                               </td>
                               <td>
                                <form action="{{route('block.user')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$user->id}}">
                                    
                                     @if ($user->status == false)
                                     <button type="submit" class="btn btn-sm btn-secondary " onclick="return confirm('sure you want to block this user ?')">Block User</button>
                                     @else
                                     <button type="submit" class="btn btn-sm btn-success " onclick="return confirm('sure you want to block this user ?')">Activate User</button>  
                                     @endif
                                    </form> 
                               </td>
                               {{-- <td>
                               <form action="{{route('delete.user')}}" method="post">
                               @csrf
                               @method('DELETE')
                               <input type="hidden" name="id" value="{{$user->id}}">
                               
                                <button type="submit" class="btn btn-sm btn-danger " onclick="return confirm('sure you want to delete this ?')"><i class="fa fa-times-circle "></i> Delete</button>
                               </form>    
                               </td> --}}
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
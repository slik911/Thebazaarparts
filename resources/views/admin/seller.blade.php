@extends('layouts.app')
@section('title')
    Sellers
@endsection
@section('jsfiles')
<script src="{{asset('js/datatables.min.js')}}"></script>
@endsection
@section('header')
    Sellers - Table
@endsection
@section('content')
    <div id="seller_Content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 bg-white pt-3 pb-3">
                    <div class="table-responsive">
                        <table id="add-row" class="display nowrap table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>S/No</th>
                                    <th>Date Created</th>
                                    <th>Users Name</th>
                                    <th>Company Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th></th>
                                    <th></th>
                                    {{-- <th></th> --}}
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
                                {{\Carbon\Carbon::parse($user->created_at)->format('d / m / Y')}}
                               </td>
                               <td>
                                <span style="text-transform:capitalize">{{$user->name}}</span>
                               </td>
                               <td>
                                   @if($user->companyprofile)
                                   {{$user->companyprofile->name}}
                                   @else
                                   <span class="text-danger">No Profile</span>
                                   @endif
                                            
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
                                    <i class="fa fa-eye" aria-hidden="true"></i> View 
                                </a>
                               </td>
                               <td>
                                <form action="{{route('block.user')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$user->id}}">
                                    
                                     @if ($user->status == false)
                                     <button type="submit" class="btn btn-sm btn-secondary " onclick="return confirm('sure you want to block this user ?')">Block </button>
                                     @else
                                     <button type="submit" class="btn btn-sm btn-success " onclick="return confirm('sure you want to block this user ?')">Activate </button>  
                                     @endif
                                    </form> 
                               </td>
                               <td>
                                <form action="{{route('verify.profile')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$user->id}}">
                                    
                                     @if($user->companyprofile)
                                     @if ($user->companyprofile->verified == false && $user->companyprofile->status == false)
                                     <a class="btn btn-sm btn-success disabled text-white" >No Profile </a> 
                                     @endif

                                     @if ($user->companyprofile->verified == false && $user->companyprofile->status == true)
                                     <button type="submit" class="btn btn-sm btn-success " onclick="return confirm('sure you want to verify this user profile ?')">Verify Profile </button>
                                     @endif

                                     @if ($user->companyprofile->verified == true && $user->companyprofile->status == true)
                                     <a class="btn btn-sm btn-success disabled text-white" >Verified </a>  
                                     @endif
                                     @else
                                      <a class="btn btn-sm btn-success disabled text-white" >No Profile </a>
                                     @endif
                                    </form> 
                               </td>
                               {{-- <td>
                               <form action="{{route('delete.user')}}" method="post">
                               @csrf
                               @method('DELETE')
                               <input type="hidden" name="id" value="{{$user->id}}">
                               
                                @if($user->companyprofile)
                                 @if ($user->companyprofile->verified == true)
                                    <a href="" class="btn btn-sm btn-danger disabled"><i class="fa fa-times-circle "></i> Delete</a>
                                @else
                                <button type="submit" class="btn btn-sm btn-danger " onclick="return confirm('sure you want to delete this ?')"><i class="fa fa-times-circle "></i> Delete</button>
                                @endif
                                @else
                                 <a href="" class="btn btn-sm btn-danger disabled"><i class="fa fa-times-circle "></i> Delete</a>
                                @endif
                               
                               
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
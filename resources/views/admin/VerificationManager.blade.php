@extends('layouts.app')
@section('title')
Verification Manager
@endsection
@section('jsfiles')
<script src="{{asset('js//datatables.min.js')}}"></script>
@endsection
@section('header')
Verification Manager
@endsection
@section('content')
    <div id="product-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pt-3 pb-3 bg-white">
                    <div class="table-responsive">
                        <table id="add-row" class="display nowrap table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>S/No</th>
                                    <th>Date Uploaded</th>
                                    <th>Full Name</th>
                                    <th>Company Name</th>
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
      
                              @foreach ($details as $detail)
                              <tr>
                               <td>
                                   {{$n++}}
                               </td>
                               <td>
                                {{\Carbon\Carbon::parse($detail->created_at)->format('d / m / Y')}}
                               </td>
                               <td style="text-transform: uppercase">
                                {{$detail->name}}
                               </td>
                               <td  style="text-transform: uppercase">
                                   {{$detail->company_name}}
                               </td>
                               <td>
                               <a href="{{asset('images/verifications/'.$detail->trade_license)}}" class="btn btn-secondary btn-sm">Preview Trade License</a>
                               </td>
                               <td>
                                <a href="{{asset('images/verifications/'.$detail->identification)}}" class="btn btn-secondary btn-sm">Preview Valid ID</a>
                               </td>
          
                               
              
                               <td>
                                <form action="{{route('verification.approve')}}" method="post">
                                    @csrf
                                <input type="hidden" name="id" value="{{$detail->id}}">

                                @if ($detail->status == false)
                                <button type="submit" class="btn btn-sm btn-success " onclick="return confirm('sure you want to approve this form ?')">Approve </button>
                                @endif
                                @if ($detail->status == true)
                                <a class="btn btn-sm btn-secondary text-white disabled"> Approved </a> 
                                @endif
                
                                
                                
                                </form> 
                               </td>
                               <td>
                                <form action="{{route('verification.reject')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$detail->id}}">

                                    @if ($detail->status == false )
                                    <button type="submit" class="btn btn-sm btn-danger " onclick="return confirm('sure you want to deny this form ?')">Deny</button>
                                    @endif
               
                                    @if ($detail->status == true )
                                    <a class="btn btn-sm btn-secondary disabled text-white" >Approved </a>  
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
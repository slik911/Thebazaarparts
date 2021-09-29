@extends('layouts.app')
@section('title')
Premium Members
@endsection
@section('header')
Premium Members
@endsection
@section('jsfiles')
<script src="{{asset('js/datatables.min.js')}}"></script>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 bg-white pt-3 pb-3">

                <div class="table-responsive">
                    <table id="add-row" class="display nowrap table table-bordered table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>S/No</th>
                                <th>User's Name</th>
                                <th>Email</th>
                                <th>Company Name</th>
                                <th>Verified</th>
                                <th>Silver Member</th>
                                <th>Expiry Date</th>
                                <th>Gold Member</th>
                                <th>Expiry Date</th>
                                <th>Platinum Member</th>
                                <th>Expiry Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $n = 1
                            @endphp
                           @if ($members)
                           @foreach ($members as $member)
                           <tr>
                            <td>
                                {{$n++}}
                            </td>
                            <td>
                                <span style="text-transform:capitalize"> {{$member->name}} </span>
                            </td>
                            <td>
                                {{$member->email}}
                            </td>
                            <td>
                                <span style="text-transform:capitalize"> {{$member->company_name}} </span>
                            </td>
                            <td>
                                @if ($member->verified)
                                    <center>
                                        <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                    </center>
                                @else
                                    <center>
                                        <i class="fa fa-times-circle text-danger" aria-hidden="true"></i>
                                    </center>
                                @endif
                            </td>
                            <td>
                                
                                    @if ($member->silver)
                                    <center>
                                        <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                    </center>
                                @else
                                    <center>
                                        <i class="fa fa-times-circle text-danger" aria-hidden="true"></i>
                                    </center>
                                @endif    
                                
                            </td>

                            <td>
                                @if ($member->silver)
                                <center>
                                    {{\Carbon\Carbon::parse($member->silver_expiry_date)->format('d / m / Y')}}
                                </center>
                                @else
                                    <center>
                                        -
                                    </center>
                                @endif
                                
                            </td>
                            <td>
                               
                                    @if ($member->gold)
                                    <center>
                                        <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                    </center>
                                @else
                                    <center>
                                        <i class="fa fa-times-circle text-danger" aria-hidden="true"></i>
                                    </center>
                                @endif    
                             
                            </td>

                            <td>
                                @if ($member->gold)
                                <center>
                                    {{\Carbon\Carbon::parse($member->gold_expiry_date)->format('d / m / Y')}}
                                </center>
                                @else
                                    <center>
                                        -
                                    </center>
                                @endif
                                
                            </td>
                            <td>
                               
                                @if ($member->platinum)
                                <center>
                                    <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                </center>
                            @else
                                <center>
                                    <i class="fa fa-times-circle text-danger" aria-hidden="true"></i>
                                </center>
                            @endif    
                         
                        </td>

                        <td>
                            @if ($member->platinum)
                            <center>
                                {{\Carbon\Carbon::parse($member->platinum_expiry_date)->format('d / m / Y')}}
                            </center>
                            @else
                                <center>
                                    -
                                </center>
                            @endif
                            
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

        
        })

            
       
    </script>
@endsection
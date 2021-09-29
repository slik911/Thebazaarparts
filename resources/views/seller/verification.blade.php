@extends('layouts.app')
@section('title')
    Verification
@endsection
@section('header')
   Company Verification
@endsection
@section('content')
    <div id="content_verification">
        <div class="container">
            <div class="row">
                <div class="col-md-12 bg-white pt-3 pb-3">
                    <div class="row">
                        @if ($data)
                        <div class="col-12 pt-4 pb-4">
                           <center>
                            @if ($data->status == true)
                                
                            <i class="fa fa-check-circle fa-4x text-success " aria-hidden="true" ></i>
                            <p style="font-size: 18px">Your Account has been successfully Verified</p>
                            @else
                            <i class="fa fa-info-circle fa-4x text-info"></i>
                            <p style="font-size: 18px">You have pending confirmation for the verification form.</p>
                            @endif
                           </center>
                        </div>
                        @else
                        <div class="col-md-6">
                            {{-- <p style="font-size: 18px">Update Your Company Profile before sending this form</p> --}}
                            <form action="{{route('upload.verification')}}" id="form" method="post" enctype="multipart/form-data">
                                    @csrf
                                      <div class="form-group">
                                        <label for="">Trade License <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control-file p-1" name="trade_license" style="border:1px solid #dddbdd; border-radius:5px;" id="trade_license" placeholder="" aria-describedby="fileHelpId" required>
                                        <small id="fileHelpId" class="form-text text-muted">Pdf, jpg, png max2mb</small>
                                      </div>
    
                                      <div class="form-group">
                                        <label for="">Valid Identity card  <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control-file p-1" name="id_card" id="id_card" placeholder=""  style="border:1px solid #dddbdd; border-radius:5px;" aria-describedby="fileHelpId" required>
                                        <small class="mt-3">National ID, Voters card, International Passport, Drivers License</small>
                                   
                                      </div>
    
                                      <div class="form-group">
                                        <button type="submit" class="btn btn-sm btn-secondary" id="upload" onclick="return confirm('Do you want to continue?')">Upload Verification</button>
                                      </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $('#upload').click(function(){
                event.preventDefault();
               
                var trade_license = $('#trade_license').val();
                var id_card = $('#id_card').val();
                var ext = $('#trade_license').val().split('.').pop().toLowerCase();
                var ext2 = $('#id_card').val().split('.').pop().toLowerCase();
                
                if(trade_license == ""){
                    toastr.error("Please upload trade license");
                }
                else if(id_card == ""){
                    toastr.error("Please upload a valid ID card");
                }
                else if ($.inArray(ext, ['gif','png','jpg','jpeg','pdf']) == -1){
                    toastr.error("file extension not supported");
                }
                else if($.inArray(ext2, ['gif','png','jpg','jpeg','pdf']) == -1){
                    toastr.error("file extension not supported");
                }
                else{
                    var file1 = $('#trade_license')[0].files[0];
                    var file2 = $('#id_card')[0].files[0];

                    if(file1.size > 2000000){
                        toastr.error("Maximum file size is 2mb");
                    }
                    else if(file2.size > 2000000){
                        toastr.error("Maximum file size is 2mb");
                    }
                    else{
                        $('#form').submit();
                    }
                }
                    
            });
        });
    </script>
@endsection
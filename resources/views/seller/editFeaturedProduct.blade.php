@extends('layouts.app')
@section('title')
    Dashboard - {{$product->name}}
@endsection
@section('header')
    Edit Product
@endsection
@section('content')
  <div id="product_content" class="bg-white">
      <div class="container">
      <form action="{{route('featured_product.update')}}" id="form" method="post" enctype="multipart/form-data">
              @csrf 
              @method('PUT')
              <div class="row p-4">
                  <div class="col-md-7">
                  <input type="hidden" name="id" id="id" value="{{$product->id}}" class="form-control" placeholder="" aria-describedby="helpId">
                    <div class="form-group">
                      <label for="">Product Name</label>
                      <input type="text" name="name" id="name" class="form-control" placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                              <label for="">Category</label>
                              <select class="form-control pb-1" name="category" id="category">
                                <option value="">Select category...</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Sub category</label>
                                <select class="form-control pb-1" name="subcategory" id="subcategory" required>
                                  <option value="">Select sub category...</option>
                                  @foreach ($subcategories as $subcategory)
                                <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                @endforeach

                                </select>
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Brand</label>
                                <select class="form-control pb-1" name="brand" id="brand" required>
                                  <option value="">Select Brand...</option>
                                  @foreach ($brands as $brand)
                                  <option value="{{$brand->id}}">{{$brand->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Country </label>
                                <select  class="form-control pb-1"   autocomplete="country" name="country" id="country" required>
                                    <option value="" >Select Country...</option>
                                    @foreach ($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>State </label>
                                <select  name="state" id="state"  class="form-control pb-1" name="state"  autocomplete="state" required>
                                    <option value="">Choose State</option>
                                    @foreach ($states as $state)
                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                @endforeach
                                  </select>

                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                              <label for="description">Description</label>
                              <textarea class="form-control" name="description" id="description" placeholder="Emails and Phone numbers are not allowed" rows="3" required></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="price">Price</label>
                              <input type="text" name="price" id="price" class="form-control" placeholder="" aria-describedby="helpId" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Type</label>
                              <select class="form-control pb-1" name="type" id="type">
                                <option value="Nigeria Used">Nigeria Used</option>
                                <option value="Belgium Tokunbo">Belgium Tokunbo</option>
                                <option value="Brand New">Brand New</option>
                              </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                              <label for="price">Part Number <small>(if any)</small></label>
                              <input type="text" name="part_no" id="part_no" class="form-control" placeholder="" aria-describedby="helpId" >
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                              <label for=""></label>
                              <input type="file" class="form-control-file" name="image" id="image"  onchange="readURL(this);" placeholder="" aria-describedby="fileHelpId">
                              <small id="fileHelpId" class="form-text text-muted">max 2mb</small>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary" id="save_changes">
                                    Save Changes
                                </button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </div>

                    </div>
                  </div>
                  <div class="col-md-4  offset-md-1 mt-3" >
                   <div style="border:1px solid #ccc; width:200px; height:200px;">
                    <img id="blah"  src="" alt="your image" style="width:200px; height:200px; object-fit:cover; object-position:center; "/>
                   </div>
                  </div>
              </div>
          </form>
      </div>
  </div>
@endsection
@section('js')
    <script>
         $(document).ready(function () {
                $('#category').on('change', function(){
                    var id = $('#category').val();
                    $.ajax({
                        method: 'get',
                        url:"{{route('getSubCategoryBrand')}}",
                        data:{id:id},
                        success: function(data){
                            // console.log(data.sub);


                            $('#subcategory').html('<option value="">Select subcategory...</option>');
                                $.each(data.sub, function(key, value){
                                $('#subcategory').append('<option value = '+value.id+ '>'+value.name+'</option>');
                            });

                            $('#brand').html('<option value="">Select brand...</option>');
                                $.each(data.brand, function(key, value){
                                $('#brand').append('<option value = '+value.id+ '>'+value.name+'</option>');
                            });
                        }
                    });
                });

                $('#description').bind('input propertychange', function() {
                $(this).val($(this).val().replace(/\d{8,}|\S+@\S+\.\S+/g,''));
            });

                var id = $('#id').val();
                 
                $.ajax({
                    method: 'get',
                    url:"{{route('get.Featuredproduct')}}",
                    data:{id:id},
                    success: function(data){    
                        console.log(data.name);     
                        $('#name').val(data.name);
                        $('#category').val(data.category_id);
                        $('#subcategory').val(data.subcategory_id);
                        $('#brand').val(data.brand);
                        $('#state').val(data.state_id);
                        $('#country').val(data.country_id);
                        $('#description').val(data.description);
                        $('#price').val(data.price);
                        $('#type').val(data.type);   
                        $('#part_no').val(data.part_no);
                        $('#blah').attr('src', '/images/products/'+data.image)         ;          
                    }
                
            });

            $('#country').on('change', function(){
                var id = $(this).val();
                $.ajax({
                    method: 'get',
                    url:"{{route('getstate')}}",
                    data:{id:id},
                    success: function(data){
                        // console.log(data);
                        $('#state').html('<option value="">Select State</option>');
                            $.each(data, function(key, value){
                            $('#state').append('<option value = '+value.id+ '>'+value.name+'</option>');
                        });
                    }
                });
            });

            $('#save_changes').click(function(){
                event.preventDefault();
                var ext = $('#image').val().split('.').pop().toLowerCase();
                var name = $('#name').val();
                var category = $('#category').val();
                var subcategory = $('#subcategory').val();
                var brand = $('#brand').val();
                var country = $('#country').val();
                var desc = $('#description').val();
                var state = $('#state').val();
                var price = $('#price').val();
                var type = $('#type').val();
                var image = $('#image').val();


                if(name == ''){
                    toastr.error("Product name is required"); 
                }
                else if(category == ''){
                    toastr.error("Category is required");
                }
                else if(subcategory == ''){
                    toastr.error("Sub-category is required");
                }
                else if(brand == ''){
                    toastr.error("brand is required");
                }
                else if(country == ''){
                    toastr.error("country is required");
                }
                else if(desc == ''){
                    toastr.error("description is required");
                }
                else if(state == ''){
                    toastr.error("state is required");
                }
                else if(price == ''){
                    toastr.error("price is required");
                }
                else if(type == ''){
                    toastr.error("type is required");
                }
               
                else{
                    if(image != ''){
               
                        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1){
                        toastr.error("file must be an image");
                        }
                        else{
                            var file = $('#image')[0].files[0];
                            if(file.size > 2000000){
                                toastr.error("Maximum file size is 2mb");
                            
                            }
                            else{
                                $('#form').submit();
                            }
                        }

                    }
                    else{
                        $('#form').submit();
                    }
                    
                }
                    
            });

        });

       
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

       
       
    </script>
@endsection

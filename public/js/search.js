
                $(document).ready(function(){
                  $.ajaxSetup({
                    headers:{
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                  });
                    $('#search_product').click(function(){
                      event.preventDefault();
                      var search = $('#search').val();
                      var category = $('#category').val();
                      // let _token = $('meta[name="csrf-token"]').attr('content');
                      if(search== ""){
                        toastr.error('Please fill required fields');
                      }
                      else{
                        $.ajax({
                        type:'POST',
                        url:"{{route('search.product')}}",
                        data:{
                          search:search,
                          category:category
                          },
                        success:function(data){
                          alert(data.success);
                        }
                      });
                      }
                    });
          
                    $('#search_buyer').click(function(){
                      event.preventDefault();
                      var search = $('#search').val();
                      var category = $('#category').val();
                      // let _token = $('meta[name="csrf-token"]').attr('content');
                      if(search== ""){
                        toastr.error('Please fill required fields');
                      }
                      else{
                        $.ajax({
                        type:'POST',
                        url:"{{route('search.buyer')}}",
                        data:{
                          search:search,
                          category:category
                          },
                        success:function(data){
                          alert(data.success);
                        }
                      });
                      }
                    });
                });
              </script>
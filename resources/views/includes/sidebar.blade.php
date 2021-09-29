<div class="col-md-3 d-none d-sm-block">
    <div  id="side_sticky_nav">
       <h6 style="color:#fff; font-size:13px; font-weight:600; background:#3d1c65;" class="pt-3 pb-4 pl-3" ><i class="
        fas fa-layer-group"></i> CATEGORIES</h6>
        <div style=" padding:0px; margin-top:-20px;">
               
            @foreach ($categories as $category)
            <a href="{{route('products', ["category"=>$category->name, "subcategory_slug"=>null])}}" style="text-transform:capitalize">
                    {{$category->name}}
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-right float-right pt-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                      </svg>
                </a>
            @endforeach
        </div>
          <section id="advert">
              <div class="row">
                  <div class="col-12 mt-4">
                      <img src="{{asset('images/side1.jpg')}}" class="img-fluid" alt="">
                  </div>
                  <div class="col-12 mt-4">
                      <img src="{{asset('images/side2.jpg')}}" class="img-fluid" alt="">
                  </div>
              </div>
          </section>
  </div>
 
</div>
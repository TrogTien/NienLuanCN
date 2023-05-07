@extends('layout')
@section('content')
@foreach ($detail_product as $key => $value)
    
<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <img src="{{URL::to('public/uploads/product/'.$value->product_image)}}" alt="" />
        </div>
       

    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
            <h2>{{$value->product_name}}</h2>
            <img src="images/product-details/rating.png" alt="" />
            <form action="{{URL::to('/save-cart')}}" method="post">
                {{ csrf_field() }}
                <span>
                    <span>{{$value->product_price}} $</span>
                    <label>Quantity:</label>
                    <input name="quantity" type="number" min="1" value="1" />
                    <input name="product_id_hidden" type="hidden" value="{{$value->product_id}}" />
                    <button type="submit" class="btn btn-default cart">
                        <i class="fa fa-shopping-cart"></i>
                        Thêm giỏ hàng
                    </button>
                </span>
            </form>
            <p><b>Brand:</b> {{$value->brand_name}}</p>
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->


<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Mô tả</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="details" >
            <textarea disabled rows="20">{!!$value->product_description!!}</textarea>
            
            
        </div>
        
        <div class="tab-pane fade" id="companyprofile" >
            <textarea disabled rows="6">{!!$value->product_content!!}</textarea>
            
            
        </div>
        
        
        
        
        
    </div>
</div><!--/category-tab-->
@endforeach

<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Sản phẩm liên quan</h2>
    
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach ($related_product as $key => $relate)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{URL::to('public/uploads/product/'.$relate->product_image)}}" alt="" />
                                <h2>{{$relate->product_price}} $</h2>
                                <p>{{$relate->product_name}}</p>
                                <form action="{{URL::to('/save-cart')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input name="quantity" type="hidden" value="1" />
                                    <input name="product_id_hidden" type="hidden" value="{{$relate->product_id}}" />
                                    <button type="submit" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </form>                            
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach	
            </div>
            
            
            
        </div>
         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>			
    </div>
</div><!--/recommended_items-->
@endsection

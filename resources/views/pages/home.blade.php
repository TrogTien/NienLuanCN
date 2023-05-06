@extends('layout')
@section('content')
    
             
                    <div class="features_items"><!--features_items-->
						<h2 class="title text-center">Sản phẩm mới</h2>
						@foreach ($all_product as $key=>$product)
							
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
												<img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
												<p>{{$product->product_name}}</p>
											</a>
											<h2>{{$product->product_price}} $</h2>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										
								</div>
								
							</div>
						</div>
						@endforeach
						
					</div><!--features_items-->

                    

                    
@endsection 
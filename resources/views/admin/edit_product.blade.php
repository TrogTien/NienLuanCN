@extends('admin_layout')
@section('admin_content')
    
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật sản phẩm
                </header>
                <div class="panel-body">

                    <?php
                        $message = Session::get('message');
                        if (isset($message)) {
                            echo $message;
                            Session::put('message', null);
                        }    
                    ?>
                    <div class="position-center">
                        @foreach ($edit_product as $key => $product)
                            
                        <form role="form" action="{{URL::to('/update-product/'.$product->product_id)}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" name="product_name" value="{{$product->product_name}}" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" name="product_price" value="{{$product->product_price}}" class="form-control" id="exampleInputEmail1" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            <input type="file" name="product_image"  class="form-control" id="exampleInputEmail1">
                            <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" width="140px" height="100px" alt="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea name="product_description" class="form-control" id="exampleInputPassword1" placeholder="Mô tả sản phẩm">{{$product->product_description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea name="product_content" class="form-control" id="exampleInputPassword1" placeholder="Nội dung sản phẩm">{{$product->product_content}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputSelect">Danh mục</label>
                            <select class="form-control input-sm m-bot15" name="category_id" id="exampleInputSelect">
                                @foreach ($categorys as $key => $cate)
                                    @if ($cate->category_id == $product->category_id)
                                        <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                    @else
                                        <option  value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputSelect">Thương hiệu</label>
                            <select class="form-control input-sm m-bot15" name="brand_id" id="exampleInputSelect">
                                @foreach ($brands as $key => $brand)
                                    @if ($brand->brand_id == $product->brand_id)
                                        <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    @else
                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputSelect">Hiển thị</label>
                            <select class="form-control input-sm m-bot15" name="product_status" id="exampleInputSelect">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện</option>
                            </select>
                        </div>

                        <button type="submit" name="add_product" class="btn btn-info">Cập nhật sản phẩm</button>
                    </form>
                    @endforeach

                </div>

                </div>
            </section>

    </div>
    
</div>

@endsection

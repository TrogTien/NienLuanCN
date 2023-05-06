@extends('admin_layout')
@section('admin_content')
    
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê sản phẩm
      </div>
      
      <div class="table-responsive">
        <?php
          $message = Session::get('message');
          if (isset($message)) {
              echo $message;
              Session::put('message', null);
          }    
        ?>

        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              
              <th>Tên sản phẩm</th>
              <th>Giá</th>
              <th>Hình ảnh</th>
              <th>Danh mục</th>
              <th>Thương hiệu</th>
              <th>Hiển thị</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_product as $key => $product)
                
            <tr>
              <td>{{ $product->product_name}}</td>
              <td>{{ $product->product_price}}</td>
              <td><img src="public/uploads/product/{{ $product->product_image}}" width="140px" height="100px" alt=""></td>
              <td>{{ $product->category_name}}</td>
              <td>{{ $product->brand_name}}</td>
              <td>
                <span class="text-ellipsis">
                    <?php
                        if ($product->product_status == 0) {
                    ?>
                        <a href="{{URL::to('/active-product/'.$product->product_id)}}">Đang ẩn</a>
                    <?php
                        } else {
                    ?>
                    
                        <a href="{{URL::to('/unactive-product/'.$product->product_id)}}">Đang hiện</a>

                    <?php
                        }
                    ?>
                </span>
              </td>
              <td>
                <a href="{{URL::to('/edit-product/'.$product->product_id)}}" class="active" ui-toggle-class="">
                  <i class="fa fa-pencil text-success text-active"></i>
                </a>
                <a href="{{URL::to('/delete-product/'.$product->product_id)}}" onclick="return confirm('Bạn có muốn xóa sản phẩm này không')">
                  <i class="fa fa-times text-danger text"></i>
                </a>
              </td>
            </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
      
    </div>
</div>

@endsection

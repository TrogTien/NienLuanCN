@extends('admin_layout')
@section('admin_content')
    
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê danh mục
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
              
              <th>Tên danh mục</th>
              <th>Hiển thị</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_category_product as $key => $cate_product)
                
            <tr>
              <td>{{ $cate_product->category_name}}</td>
              <td>
                <span class="text-ellipsis">
                    <?php
                        if ($cate_product->category_status == 0) {
                    ?>
                        <a href="{{URL::to('/active-category-product/'.$cate_product->category_id)}}">Đang ẩn</a>
                    <?php
                        } else {
                    ?>
                    
                        <a href="{{URL::to('/unactive-category-product/'.$cate_product->category_id)}}">Đang hiện</a>

                    <?php
                        }
                    ?>
                </span>
              </td>
              <td>
                <a href="{{URL::to('/edit-category-product/'.$cate_product->category_id)}}" class="active" ui-toggle-class="">
                  <i class="fa fa-pencil text-success text-active"></i>
                </a>
                <a href="{{URL::to('/delete-category-product/'.$cate_product->category_id)}}" onclick="return confirm('Bạn có muốn xóa danh mục này không')">
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

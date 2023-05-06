@extends('admin_layout')
@section('admin_content')
    
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê thương hiệu
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
              
              <th>Tên thương hiệu</th>
              <th>Hiển thị</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_brand_product as $key => $brand_product)
                
            <tr>
              <td>{{ $brand_product->brand_name}}</td>
              <td>
                <span class="text-ellipsis">
                    <?php
                        if ($brand_product->brand_status == 0) {
                    ?>
                        <a href="{{URL::to('/active-brand-product/'.$brand_product->brand_id)}}">Đang ẩn</a>
                    <?php
                        } else {
                    ?>
                    
                        <a href="{{URL::to('/unactive-brand-product/'.$brand_product->brand_id)}}">Đang hiện</a>

                    <?php
                        }
                    ?>
                </span>
              </td>
              <td>
                <a href="{{URL::to('/edit-brand-product/'.$brand_product->brand_id)}}" class="active" ui-toggle-class="">
                  <i class="fa fa-pencil text-success text-active"></i>
                </a>
                <a href="{{URL::to('/delete-brand-product/'.$brand_product->brand_id)}}" onclick="return confirm('Bạn có muốn xóa thương hiệu này không')">
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

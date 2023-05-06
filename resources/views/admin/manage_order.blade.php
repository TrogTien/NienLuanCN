@extends('admin_layout')
@section('admin_content')
    
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê đơn hàng
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
              
              <th>Tên người mua</th>
              <th>Tổng giá tiền</th>
              <th>Tình trạng</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_order as $key => $order)
                
            <tr>
              <td>{{ $order->customer_name}}</td>
              <td>{{ $order->order_total}}</td>
              <td>{{ $order->order_status}}</td>
              <td>
                <a href="{{URL::to('/view-order/'.$order->order_id)}}" class="active" ui-toggle-class="">
                  <i class="fa fa-pencil text-success text-active"></i>
                </a>
                <a href="{{URL::to('/delete-order/'.$order->order_id)}}" onclick="return confirm('Bạn có muốn xóa không?')">
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

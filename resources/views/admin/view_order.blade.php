@extends('admin_layout')
@section('admin_content')
    
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông tin người mua
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
              <th>Số điện thoại</th>
            </tr>
          </thead>
          <tbody>
                
            <tr>
              <td>{{$order_by_id[0]->customer_name}}</td>
              <td>{{$order_by_id[0]->customer_phone}}</td>
              
            </tr>
            
            
          </tbody>
        </table>
      </div>
      
    </div>
</div>
<br>
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông tin vận chuyển
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
              
              <th>Tên người nhận</th>
              <th>Địa chỉ</th>
              <th>Số điện thoại</th>
            </tr>
          </thead>
          <tbody>
                
            <tr>
              <td>{{$order_by_id[0]->shipping_name}}</td>
              <td>{{$order_by_id[0]->shipping_address}}</td>
              <td>{{$order_by_id[0]->shipping_phone}}</td>
              
            </tr>
            
            
          </tbody>
        </table>
      </div>
      
    </div>
</div>
<br>
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Chi tiết đơn hàng
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
             
              <th>Tên sản phẩn</th>
              <th>Số lượng</th>
              <th>Giá</th>
              <th>Tổng tiền</th>
              <th>Thuế 10%</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($order_by_id as $value)
                 
            <tr>
              <td>{{$value->product_name}}</td>
              <td>{{$value->product_sales_quantity}}</td>
              <td>{{$value->product_price}}</td>
              <td>{{$value->product_price * $value->product_sales_quantity}} $</td> 
              <td>{{$value->product_price * $value->product_sales_quantity /10}} $</td> 
              
            </tr>
            @endforeach   
            <tr>
              <td class="text-center danger" colspan="5">
                <h3>Tổng cộng: {{$order_by_id[0]->order_total}} $</h3>
              </td>
            </tr>
            
          </tbody>
        </table>
      </div>
      
    </div>
</div>

@endsection

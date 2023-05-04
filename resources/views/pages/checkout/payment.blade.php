@extends('layout')
@section('content')
    
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
              <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div><!--/breadcrums-->


        
        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>
        <div class="table-responsive cart_info">
            <?php
                $content = Cart::content();
            ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="name">Ảnh</td>
                        <td class="image">Tên</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Thành tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($content as $value)
                        
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{URL::to('public/uploads/product/'.$value->options->image)}}" width="50"  alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$value->name}}</a></h4>
                        </td>
                        <td class="cart_price">
                            <p>{{$value->price}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{URL::to('/update-cart-quantity')}}" method="POST">
                                    {{csrf_field()}}
                                    <input class="cart_quantity_input" type="number" name="cart_quantity" value="{{$value->qty}}" >
                                    <input type="hidden" value="{{$value->rowId}}" name="rowId_cart" >
                                    <input class="btn btn-default btn-sm" name="update_qty" type="submit"  value="Cập nhật" >
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                <?php
                                    $total = $value->price * $value->qty;
                                    echo number_format($total).''.'$';
                                ?>
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$value->rowId)}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach

                    
                </tbody>
            </table>
        </div>
        <h4 style="margin: 30px 0">Chọn hình thức thanh toán</h4>
        <form action="{{URL::to('/order-place')}}" method="POST">
            {{ csrf_field() }}
            <div class="payment-options">
                    <span>
                        <label><input name="payment_option" value="chuyen_khoan" type="checkbox"> Chuyển khoản</label>
                    </span>
                    <span>
                        <label><input name="payment_option" value="tien_mat" type="checkbox"> Thanh toán tiền mặt</label>
                    </span>
                    <input type="submit" value="Đặt hàng" class="btn btn-primary btn-sm">
            </div>
        </form>
    </div>
</section> <!--/#cart_items-->

@endsection

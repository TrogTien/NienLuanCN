@extends('layout')
@section('content')
    
<section id="cart_items">
    <div class="container">
       
        <div class="table-responsive cart_info">
            <?php
                $content = Cart::content();
            ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Ảnh</td>
                        <td class="name">Tên</td>
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
                            <a href=""><img src="{{URL::to('public/uploads/product/'.$value->options->image)}}" width="70px"  alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$value->name}}</a></h4>
                        </td>
                        <td class="cart_price">
                            <p>{{$value->price}} $</p>
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
    </div>
</section> <!--/#cart_items-->
<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Tổng <span>{{Cart::priceTotal(0)}} $</span></li>
                        <li>Thuế <span>{{Cart::tax(0)}} $ (10%)</span></li>
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>Thành tiền <span>{{Cart::total(0)}} $</span></li>
                    </ul>
                    <?php 
                        $customer_id = Session::get('customer_id');
						$shipping_id = Session::get('shipping_id');
                        
                        if (isset($customer_id) && $shipping_id == null) {
                    ?>
                        <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh toán</a>
                        <?php
                        } elseif (isset($customer_id) && isset($shipping_id)) {
                    ?>
                        <a class="btn btn-default check_out" href="{{URL::to('/payment')}}">Thanh toán</a>
                        <?php 
                        } else {
                    ?>
                        <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
@endsection

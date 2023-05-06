@extends('layout')
@section('content')
    
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        
            

        <div class="register-req">
            <p>Hãy đăng nhập để thanh toán giỏ hàng</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                
                <div class="col-sm-10 clearfix">
                    <div class="bill-to">
                        <p>Điền thông tin</p>
                        <div class="form-one">
                            <form action="{{URL::to('/save-checkout')}}" method="POST">
                                {{csrf_field()}}
                                <input type="text" name="shipping_email" placeholder="Email*">
                                <input type="text" name="shipping_name" placeholder="Name *">
                                <input type="text" name="shipping_address" placeholder="Address *">
                                <input type="text" name="shipping_phone" placeholder="Phone">
                                <textarea name="shipping_note"  placeholder="Ghi chú" rows="16"></textarea>
                                <input type="submit" class="btn btn-primary btn-sm" value="Thanh toán">
                            </form>
                        </div>
                        
                    </div>
                </div>
                				
            </div>
        </div>
        

        
        
    </div>
</section> <!--/#cart_items-->

@endsection

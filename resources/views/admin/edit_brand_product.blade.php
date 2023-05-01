@extends('admin_layout')
@section('admin_content')
    
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa thương hiệu
                </header>
                <div class="panel-body">

                    <?php
                        $message = Session::get('message');
                        if (isset($message)) {
                            echo $message;
                            Session::put('message', null);
                        }    
                    ?>
                    @foreach ($edit_brand_product as $key => $value)
                        
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update-brand-product/'.$value->brand_id)}}" method="POST">
                                {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên thương hiệu</label>
                                <input type="text" name="brand_product_name" value="{{$value->brand_name}}" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                                <textarea name="brand_product_description"  class="form-control" id="exampleInputPassword1" placeholder="Mô tả thương hiệu">{{$value->brand_description}}
                                </textarea>
                            </div>
                            

                            <button type="submit" name="update_brand_product" class="btn btn-info">Cập nhật thương hiệu</button>
                        </form>
                    </div>
                    @endforeach


                </div>
            </section>

    </div>
    
</div>

@endsection

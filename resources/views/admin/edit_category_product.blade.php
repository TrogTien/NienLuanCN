@extends('admin_layout')
@section('admin_content')
    
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa danh mục
                </header>
                <div class="panel-body">

                    <?php
                        $message = Session::get('message');
                        if (isset($message)) {
                            echo $message;
                            Session::put('message', null);
                        }    
                    ?>
                    @foreach ($edit_category_product as $key => $value)
                        
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update-category-product/'.$value->category_id)}}" method="POST">
                                {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục</label>
                                <input type="text" name="category_product_name" value="{{$value->category_name}}" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả danh mục</label>
                                <textarea name="category_product_description"  class="form-control" id="exampleInputPassword1" placeholder="Mô tả danh mục">{{$value->category_description}}
                                </textarea>
                            </div>
                            

                            <button type="submit" name="update_category_product" class="btn btn-info">Cập nhật danh mục</button>
                        </form>
                    </div>
                    @endforeach


                </div>
            </section>

    </div>
    
</div>

@endsection

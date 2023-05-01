@extends('admin_layout')
@section('admin_content')
    
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm danh mục
                </header>
                <div class="panel-body">

                    <?php
                        $message = Session::get('message');
                        if (isset($message)) {
                            echo $message;
                            Session::put('message', null);
                        }    
                    ?>
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/save-category-product')}}" method="POST">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea name="category_product_desciption" class="form-control" id="exampleInputPassword1" placeholder="Mô tả danh mục">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputSelect">Hiển thị</label>
                            <select class="form-control input-sm m-bot15" name="category_product_status" id="exampleInputSelect">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện</option>
                            </select>
                        </div>

                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm danh mục</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
    
</div>

@endsection

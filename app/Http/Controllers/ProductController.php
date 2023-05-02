<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function authLogin() {
        $admin_id = Session::get('admin_id');
        if (isset($admin_id)) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function add_product() {
        $this->authLogin();
        
        $categorys = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brands = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        return view('admin.add_product')->with('categorys',$categorys)->with('brands',$brands);
    }

    public function all_product() {
        $this->authLogin();

        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product', $manager_product);

    }

    public function save_product(Request $request) {
        $this->authLogin();

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_description'] = $request->product_description;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_status'] = $request->product_status;

        $get_image = $request->file('product_image');
        if (isset($get_image)) {
            $current = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $h = Carbon::now('Asia/Ho_Chi_Minh')->hour; //giờ
            $m = Carbon::now('Asia/Ho_Chi_Minh')->minute; //phút
            $s = Carbon::now('Asia/Ho_Chi_Minh')->second; //giây
            $get_name_image = $get_image->getClientOriginalName();
            $new_image = $current.'_'.$h.$m.$s.'_'.$get_name_image;
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message', 'Thêm sản phẩm thành công');
            return Redirect::to('/add-product');
        }

        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);
        Session::put('message', 'Thêm sản phẩm thành công');
        return Redirect::to('/add-product');
    }

    public function active_product($product_id) {
        $this->authLogin();

        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Hiện sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    public function unactive_product($product_id) {
        $this->authLogin();

        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Ẩn sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    public function edit_product($product_id) {
        $this->authLogin();

        $categorys = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brands = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)
            ->with('categorys',$categorys)->with('brands',$brands);
        return view('admin_layout')->with('admin.edit_product', $manager_product);

    }

    public function update_product(Request $request, $product_id) {
        $this->authLogin();

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_description'] = $request->product_description;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_status'] = $request->product_status;
        
        $get_image = $request->file('product_image');
        if (isset($get_image)) {
            $current = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $h = Carbon::now('Asia/Ho_Chi_Minh')->hour; //giờ
            $m = Carbon::now('Asia/Ho_Chi_Minh')->minute; //phút
            $s = Carbon::now('Asia/Ho_Chi_Minh')->second; //giây
            $get_name_image = $get_image->getClientOriginalName();
            $new_image = $current.'_'.$h.$m.$s.'_'.$get_name_image;
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message', 'Cập nhật sản phẩm thành công');
            return Redirect::to('/all-product');
        }
        // Nếu không chọn ảnh thì giữ nguyên ảnh cũ
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    public function delete_product($product_id) {
        $this->authLogin();


        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message', 'Xóa sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    //Trang chu
    public function detail_product($productid) {
        $categorys = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id','desc')->get();
        $brands = DB::table('tbl_brand')->where('brand_status',1)->orderby('brand_id','desc')->get();

        return view('pages.product.detail_product')
            ->with('categorys',$categorys)
            ->with('brands',$brands);
    }
}

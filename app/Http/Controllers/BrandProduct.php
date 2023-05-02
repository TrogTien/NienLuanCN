<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class BrandProduct extends Controller
{
    public function authLogin() {
        $admin_id = Session::get('admin_id');
        if (isset($admin_id)) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function add_brand_product() {
        $this->authLogin();
        return view('admin.add_brand_product');
    }

    public function all_brand_product() {
        $this->authLogin();
        $all_brand_product = DB::table('tbl_brand')->get();
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product', $manager_brand_product);

    }

    public function save_brand_product(Request $request) {
        $this->authLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_description'] = $request->brand_product_description;
        $data['brand_status'] = $request->brand_product_status;

        DB::table('tbl_brand')->insert($data);

        Session::put('message', 'Thêm thương hiệu sản phẩm thành công');
        return Redirect::to('/add-brand-product');
    }

    public function active_brand_product($brand_product_id) {
        DB::table(' $this->authLogin();tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('message','Hiện thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }

    public function unactive_brand_product($brand_product_id) {
        DB::table(' $this->authLogin();tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
        Session::put('message','Ẩn thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }

    public function edit_brand_product($brand_product_id) {
        $this->authLogin();
        $edit_brand_product = DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);

    }

    public function update_brand_product(Request $request, $brand_product_id) {
        $this->authLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_description'] = $request->brand_product_description;
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
        Session::put('message', 'Cập nhật thương hiệu thành công');
        return Redirect::to('/all-brand-product');
    }

    public function delete_brand_product($brand_product_id) {
        $this->authLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
        Session::put('message', 'Xóa thương hiệu thành công');
        return Redirect::to('/all-brand-product');
    }
}

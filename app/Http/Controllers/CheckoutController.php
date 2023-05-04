<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Cart;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();


class CheckoutController extends Controller
{
    public function login_checkout() {
        $categorys = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id','desc')->get();
        $brands = DB::table('tbl_brand')->where('brand_status',1)->orderby('brand_id','desc')->get();

        return view('pages.checkout.login_checkout')->with('categorys',$categorys)->with('brands',$brands);
    }

    public function add_customer(Request $request) {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;

        $customer_id = DB::table('tbl_customer')->insertGetId($data);

        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->customer_name);
        return Redirect::to('/checkout');

    }

    public function checkout() {
        $categorys = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id','desc')->get();
        $brands = DB::table('tbl_brand')->where('brand_status',1)->orderby('brand_id','desc')->get();


        return view('pages.checkout.checkout')
            ->with('categorys',$categorys)
            ->with('brands',$brands);
    }

    public function save_checkout(Request $request) {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_note'] = $request->shipping_note;

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

        Session::put('shipping_id',$shipping_id);

        return Redirect::to('/payment');
    }

    public function payment() {
        $categorys = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id','desc')->get();
        $brands = DB::table('tbl_brand')->where('brand_status',1)->orderby('brand_id','desc')->get();


        return view('pages.checkout.payment')
            ->with('categorys',$categorys)
            ->with('brands',$brands);
    }

    public function logout_customer() {
        Session::flush();
        return Redirect::to('login-checkout');
    }

    public function login_customer(Request $request) {
        $email = $request->email;
        $password = md5($request->password);
        
        $result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$password)->first();

        Session::put('customer_id',$result->customer_id);

        return Redirect::to('/checkout');
    }

    public function order_place(Request $request) {
        //insert payment_method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';

        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';

        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //insert order_details
        $content = Cart::content();
        foreach ($content as $value) {
            $order_details_data = array();
            $order_details_data['order_id'] = $order_id;
            $order_details_data['product_id'] = $value->id;
            $order_details_data['product_name'] = $value->name;
            $order_details_data['product_price'] = $value->price;
            $order_details_data['product_sales_quantity'] = $value->qty;
            DB::table('tbl_order_details')->insert($order_details_data);
            
        }

        if ($data['payment_method'] == 'ATM') {
            echo 'Thanh toán thẻ ATM';
        } else  {
            echo 'Tiền mặt';
        } 

        return Redirect::to('/payment');

    }
}

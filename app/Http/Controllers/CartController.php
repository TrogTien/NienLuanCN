<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;

class CartController extends Controller
{
    public function save_cart(Request $request) {

        
        $product_id = $request->product_id_hidden;
        $quantity = $request->quantity;

        $product_info = DB::table('tbl_product')->where('product_id',$product_id)->first();
        

        $data['id'] = $product_id;
        $data['qty'] = $quantity;
        $data['price'] = $product_info->product_price;
        $data['name'] = $product_info->product_name;
        $data['weight'] = '1';
        $data['options']['image'] = $product_info->product_image;

        Cart::add($data);
        return Redirect::to('show-cart');
        
    }

    public function show_cart() {
        $categorys = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id','desc')->get();
        $brands = DB::table('tbl_brand')->where('brand_status',1)->orderby('brand_id','desc')->get();
        
        return view('pages.cart.show_cart')
        ->with('categorys',$categorys)
        ->with('brands',$brands);
    }

    public function delete_to_cart($rowId) {
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
    }

    public function update_cart_quantity(Request $request) {
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId, $qty);
        return Redirect::to('/show-cart');

    }
}

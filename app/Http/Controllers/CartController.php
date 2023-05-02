<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
class CartController extends Controller
{
    public function save_cart(Request $request) {

        $categorys = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id','desc')->get();
        $brands = DB::table('tbl_brand')->where('brand_status',1)->orderby('brand_id','desc')->get();
        
        $product_id = $request->product_id_hidden;
        $quantity = $request->quantity;

        $data = DB::table('tbl_product')->where('product_id',$product_id)->get();
        
        return view('pages.cart.show_cart')
            ->with('categorys',$categorys)
            ->with('brands',$brands);
    }
}

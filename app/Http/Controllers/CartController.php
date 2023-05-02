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
        $product_id = $request->product_id_hidden;
        $quantity = $request->quantity;

        $data = DB::table('tbl_product')->where('product_id',$product_id)->get();
    }
}

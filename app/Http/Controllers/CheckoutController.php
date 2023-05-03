<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    public function login_checkout() {
        $categorys = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id','desc')->get();
        $brands = DB::table('tbl_brand')->where('brand_status',1)->orderby('brand_id','desc')->get();

        return view('pages.checkout.login_checkout')->with('categorys',$categorys)->with('brands',$brands);
    }
}

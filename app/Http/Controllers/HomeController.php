<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
class HomeController extends Controller
{
    public function index() {
        //Hiện những cái có status = 1
        $categorys = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id','desc')->get();
        $brands = DB::table('tbl_brand')->where('brand_status',1)->orderby('brand_id','desc')->get();

        $all_product = DB::table('tbl_product')->where('product_status',1)->orderby('product_id','desc')->limit(4)->get();
        return view('pages.home')->with('categorys',$categorys)->with('brands',$brands)->with('all_product',$all_product);
    }

    public function search(Request $request) {
        $keywords = $request->keywords;

        $categorys = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id','desc')->get();
        $brands = DB::table('tbl_brand')->where('brand_status',1)->orderby('brand_id','desc')->get();
        
        $result_search = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();

        return view('pages.product.search')
            ->with('categorys',$categorys)
            ->with('brands',$brands)
            ->with('result_search',$result_search);

    }
}

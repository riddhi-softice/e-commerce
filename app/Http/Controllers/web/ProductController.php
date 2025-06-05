<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use DB;

class ProductController extends Controller
{
    public function home_page()
    { 
        $data['product_type'] = DB::table('types')->get();
        // dd($data);

        return view('web.index', compact('data'));
    }


}

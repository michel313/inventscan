<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\View\View;

class SearchController extends Controller
{
    /**
     * method search
     * @param $request
     * @return View
    **/
    public function search(Request $request) {
      $query = request()->q;

      $products = Product::where('title', 'LIKE', '%'.$query.'%')->orWhere('sku', 'LIKE', '%'.$query.'%')->get();

      return view('search', compact('products'));
    }
}

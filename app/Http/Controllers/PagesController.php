<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{

    /**
     * method construct
    **/
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * method export
    **/
    public function export()
    {
      return view('export');
    }
}

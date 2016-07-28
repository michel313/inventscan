<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\View\View;

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
     * @return View
    **/
    public function export()
    {
      return view('export');
    }
}

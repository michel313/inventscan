<?php

namespace App\Http\Controllers;

use App\Subcategory;
use Illuminate\Http\Request;
use App\Http\Requests;

class SubcategoriesController extends Controller
{
  
  
  public function __construct()
  {
      $this->middleware('auth');
  }
  
  
  

  public function index()
  {
    $subcategories = Subcategory::all()->sortBy('title');
    return view('subcategories.index', compact('subcategories'));
  }
  
  
  

  public function new()
  {
    return view('subcategories.new');
  }
  
  

  public function edit(Subcategory $subcategory)
  {
    return view('subcategories.edit', compact('subcategory'));
  }
  
  
  
  

  public function store(Request $request, Subcategory $subcategory)
  {
    $this->validate($request, [
      'title' => 'required|unique:subcategories,title'
    ]);

    $subcategory->create($request->all());

    flash()->success('Subcategory has been saved successfully');

    return redirect('subcategories');
  }

  
  
  
  public function update(Request $request, Subcategory $subcategory)
  {
    $this->validate($request, [
      'title' => 'required|unique:subcategories,title'
    ]);
    
    $subcategory->update($request->all());

    flash()->success('Subcategory has been updated successfully');

    return redirect('subcategories');
  }
  
  
  

  public function destroy(Request $request, Subcategory $subcategory)
  {
    $subcategory->delete();

    flash()->success('Subcategory has been removed successfully');

    return redirect('subcategories');
  }
}

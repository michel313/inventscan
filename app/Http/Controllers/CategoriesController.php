<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CategoriesController extends Controller
{
  /**
   * method __construct
  **/
  public function __construct()
  {
      $this->middleware('auth');
  }
  
  /**
   *  method index
   * @return View
   **/
  public function index()
  {
    $categories = Category::all()->sortBy('title');
    return view('categories.index', compact('categories'));
  }
  
  /**
   *  method new
   * @return View
   **/
  public function new()
  {
    return view('categories.new');
  }
  
  /**
   * method edit
   * @param $category
   * @return View
   **/
  public function edit(Category $category)
  {
    return view('categories.edit', compact('category'));
  }
  
  /**
   *  method store
   *  @param $request
   *  @param $category
   *  @return Redirect
   **/
  public function store(Request $request, Category $category)
  {
    $this->validate($request, [
      'title' => 'required|unique:categories,title',
    ]);

    $category->create($request->all());

    flash()->success('Category has been saved successfully');

    return redirect('categories');
  }
  
  /**
   *  method update
   * @param  $request;
   * @param  $category
   * @return View
   * 
   **/
  public function update(Request $request, Category $category)
  {
    $this->validate($request, [
      'title' => 'required|unique:categories,title',
    ]);
    
    $category->update($request->all());

    flash()->success('Category has been updated successfully');

    return redirect('categories');
  }
  
  /**
   *  method destroy
   * @param $request
   * @param $category
   * @return Redirect
   **/
  public function destroy(Request $request, Category $category)
  {
    $category->delete();

    flash()->success('Category has been removed successfully');

    return redirect('categories');
  }

}

<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests;

class CategoriesController extends Controller
{

  /**
   *
  **/
  public function __construct()
  {
      $this->middleware('auth');
  }


  /**
   *  method index
   **/
  public function index()
  {
    $categories = Category::all()->sortBy('title');
    return view('categories.index', compact('categories'));
  }


  /**
   *  method new
   **/
  public function new()
  {
    return view('categories.new');
  }


  /**
   * method edit
   * @param $category
   **/
  public function edit(Category $category)
  {
    return view('categories.edit', compact('category'));
  }


  /**
   *  method store
   *  @param $request
   *  @param $category
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
   **/
  public function destroy(Request $request, Category $category)
  {
    $category->delete();

    flash()->success('Category has been removed successfully');

    return redirect('categories');
  }
  public  function checkGit()
  {
    
  }
}

<?php

namespace App\Http\Controllers;

use App\Subcategory;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SubcategoriesController extends Controller
{
  /**
   * SubcategoriesController constructor.
   */
  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
   * method index
   * @return View
   */
  public function index()
  {
    $subcategories = Subcategory::all()->sortBy('title');
    return view('subcategories.index', compact('subcategories'));
  }

  /**
   * method new
   * @return View
   */
  public function new()
  {
    return view('subcategories.new');
  }

  /**
   * method edit
   * @param Subcategory $subcategory
   * @return View
   */
  public function edit(Subcategory $subcategory)
  {
    return view('subcategories.edit', compact('subcategory'));
  }

  /**
   * method store
   * @param Request $request
   * @param Subcategory $subcategory
   * @return Redirect
   */
  public function store(Request $request, Subcategory $subcategory)
  {
    $this->validate($request, [
      'title' => 'required|unique:subcategories,title'
    ]);

    $subcategory->create($request->all());

    flash()->success('Subcategory has been saved successfully');

    return redirect('subcategories');
  }

  /**
   * method update
   * @param Request $request
   * @param Subcategory $subcategory
   * @return Redirect
   */
  public function update(Request $request, Subcategory $subcategory)
  {
    $this->validate($request, [
      'title' => 'required|unique:subcategories,title'
    ]);
    
    $subcategory->update($request->all());

    flash()->success('Subcategory has been updated successfully');

    return redirect('subcategories');
  }

  /**
   * method destroy
   * @param Request $request
   * @param Subcategory $subcategory
   * @return Redirect
   */
  public function destroy(Request $request, Subcategory $subcategory)
  {
    $subcategory->delete();

    flash()->success('Subcategory has been removed successfully');

    return redirect('subcategories');
  }
}

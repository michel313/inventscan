<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SuppliersController extends Controller
{
  /**
   * SuppliersController constructor.
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
    $suppliers = Supplier::all()->sortBy('title');
    return view('suppliers.index', compact('suppliers'));
  }

  /**
   * method index
   * @return View
   */
  public function new()
  {
    return view('suppliers.new');
  }

  /**
   * method edit
   * @param Supplier $supplier
   * @return View
   */
  public function edit(Supplier $supplier)
  {
    return view('suppliers.edit', compact('supplier'));
  }

  /**
   * method store
   * @param Request $request
   * @param Supplier $supplier
   * @return Redirect
   */
  public function store(Request $request, Supplier $supplier)
  {
    $this->validate($request, [
      'title'     => 'required|unique:suppliers,title',
      'shortcode' => 'required',
    ]);

    $supplier->create($request->all());

    flash()->success('Supplier has been saved successfully');

    return redirect('suppliers');
  }

  /**
   * method update
   * @param Request $request
   * @param Supplier $supplier
   * @return Redirect
   */
  public function update(Request $request, Supplier $supplier)
  {
    $this->validate($request, [
      'title'     => 'required|unique:suppliers,title',
      'shortcode' => 'required',
    ]);
    
    $supplier->update($request->all());

    flash()->success('Supplier has been updated successfully');

    return redirect('suppliers');
  }

  /**
   * method destroy
   * @param Request $request
   * @param Supplier $supplier
   * @return Redirect
   */
  public function destroy(Request $request, Supplier $supplier)
  {
    $supplier->delete();

    flash()->success('Supplier has been removed successfully');

    return redirect('suppliers');
  }




}

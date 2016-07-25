<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests;

class SuppliersController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }



  
  public function index()
  {
    $suppliers = Supplier::all()->sortBy('title');
    return view('suppliers.index', compact('suppliers'));
  }




  public function new()
  {
    return view('suppliers.new');
  }




  public function edit(Supplier $supplier)
  {
    return view('suppliers.edit', compact('supplier'));
  }




  public function store(Request $request, Supplier $supplier)
  {
    $this->validate($request, [
      'title' => 'required|unique:suppliers,title',
    ]);

    $supplier->create($request->all());

    flash()->success('Supplier has been saved successfully');

    return redirect('suppliers');
  }




  public function update(Request $request, Supplier $supplier)
  {
    $this->validate($request, [
      'title' => 'required|unique:suppliers,title',
    ]);
    
    $supplier->update($request->all());

    flash()->success('Supplier has been updated successfully');

    return redirect('suppliers');
  }



  public function destroy(Request $request, Supplier $supplier)
  {
    $supplier->delete();

    flash()->success('Supplier has been removed successfully');

    return redirect('suppliers');
  }

}

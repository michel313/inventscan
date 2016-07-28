<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class LocationsController extends Controller
{
  /**
   * method construct
  **/
  public function __construct()
  {
      $this->middleware('auth');
  }
  
  /**
   * method index
   * @return View
   **/
  public function index()
  {
    $locations = Location::all()->sortBy('location_id');
    return view('locations.index', compact('locations'));
  }
  
  /**
   * method new
   * @return View
   **/
  public function new()
  {
    return view('locations.new');
  }
  
  /**
   * method edit
   * @param $location
   * @return View
   **/
  public function edit(Location $location)
  {
    return view('locations.edit', compact('location'));
  }
  
  /**
   * method store
   * @param $request
   * @param $location
   * @return Redirect
   **/
  public function store(Request $request, Location $location)
  {
    $this->validate($request, [
      'location_id' => 'required|unique:locations,location_id',
      'shorcode'    => 'required',
    ]);

    $location->create($request->all());

    flash()->success('Location has been saved successfully');

    return redirect('locations');
  }
  
  /**
   * method update
   * @param $request
   * @param $location
   * @return Redirect
   **/
  public function update(Request $request, Location $location)
  {
    $this->validate($request, [
      'location_id'  => 'required|unique:locations,location_id',
      'shorcode'     => 'required',
    ]);
    
    $location->update($request->all());

    flash()->success('Location has been updated successfully');

    return redirect('locations');
  }
  
  /**
   * method destroy
   * @param $request
   * $param $location
   * @return Redirect
   **/
  public function destroy(Request $request, Location $location)
  {
    $location->delete();

    flash()->success('Location has been removed successfully');

    return redirect('locations');
  }
}

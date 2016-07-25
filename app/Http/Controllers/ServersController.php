<?php

namespace App\Http\Controllers;

use App\Server;
use Illuminate\Http\Request;
use App\Http\Requests;

class ServersController extends Controller
{



  public function __construct()
  {
      $this->middleware('auth');
  }




  public function index()
  {
    $servers = Server::all()->sortBy('location_id');
    return view('servers.index', compact('servers'));
  }



  /**
   * method new
   **/
  public function new()
  {
    return view('servers.new');
  }



  /**
   * method store
   * @param $server
   **/
  public function edit(Server $server)
  {
    return view('servers.edit', compact('server'));
  }



  /**
   * method store
   * @param $request
   * @param $server
   **/
  public function store(Request $request, Server $server)
  {
    $this->validate($request, [
      'location_id' => 'required',
      'type' => 'required',
      'server' => 'required',
      'username' => 'required',
      'password' => 'required'
    ]);

    $server->create($request->all());

    flash()->success('Server has been saved successfully');

    return redirect('servers');
  }




  /**
   * method update
   * @param $request
   * @param $server
  **/
  public function update(Request $request, Server $server)
  {
    $this->validate($request, [
      'location_id' => 'required',
      'type' => 'required',
      'server' => 'required',
      'username' => 'required',
      'password' => 'required'
    ]);
    
    $server->update($request->all());

    flash()->success('Server has been updated successfully');

    return redirect('servers');
  }



  /**
   * method destroy
   * @param $request
   * @param $server
  **/
  public function destroy(Request $request, Server $server)
  {
    $server->delete();

    flash()->success('Server has been removed successfully');

    return redirect('servers');
  }


}
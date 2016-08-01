<?php

namespace App\Http\Controllers;

use App\Server;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ServersController extends Controller
{
  /**
   * ServersController constructor.
   */
  public function __construct()
  {
      $this->middleware('auth');
  }
  
  /** method index
   * @return View
   */
  public function index()
  {
    $servers = Server::all()->sortBy('location_id');
    return view('servers.index', compact('servers'));
  }
  
  /**
   * method create
   * @return View
   **/
  public function create()
  {
    return view('servers.new');
  }

  /**
   * method store
   * @param $request
   * @param $server
   * @return Redirect
   **/
  public function store(Request $request, Server $server)
  {
    $this->validate($request, [
        'location_id' => 'required',
        'type'        => 'required',
        'server'      => 'required',
        'username'    => 'required',
        'password'    => 'required'
    ]);

    $server->create($request->all());

    flash()->success('Server has been saved successfully');

    return redirect('servers');
  }

  /**
   * method edit
   * @param $server
   * @param $id
   * @return View
   **/
  public function edit($id = false,Server $server)
  {
    $server = $server->find($id);

    return view('servers.edit', compact('server'));
  }

  /**
   * method update
   * @param $request
   * @param $server
   * @param $id
   * @return Redirect
  **/
  public function update($id = false,Request $request, Server $server)
  {
    $this->validate($request, [
      'location_id' => 'required',
      'type'        => 'required',
      'server'      => 'required',
      'username'    => 'required',
      'password'    => 'required'
    ]);

    $input = $request->except('_method','_token');
    $server->where('id',$id)->update($input);

    flash()->success('Server has been updated successfully');

    return redirect('servers');
  }
  
  /**
   * method destroy
   * @param $request
   * @param $server
   * @return Redirect
  **/
  public function destroy(Request $request, Server $server)
  {
    
    if ($request->ajax()) {

      $server_id = $request['deleteID'];
      $result    = $server->find($server_id)->delete();

      return response()->json(['status' => 'success']);

      exit;

    }else{

      return redirect('servers');

    }

  }

}

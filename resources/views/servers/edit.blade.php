@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Server</div>

                <div class="panel-body">
                  @include ('partials.form_errors')
                  <form class="" action="/servers/{{ $server->id }}" method="post">
                    {{ method_field('patch') }}

                    <div class="form-group">
                      <label for="">Location ID</label>
                      <input type="text" name="location_id" value="{{ $server->location_id }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="">Type</label>
                      <select name="type" class="form-control">
                        <option value="FTP">FTP</option>
                        <option value="SMTP">SMTP</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="">Server</label>
                      <input type="text" name="server" value="{{ $server->server}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="">Username</label>
                      <input type="text" name="username" value="{{ $server->username}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="">Password</label>
                      <input type="text" name="password" value="{{ $server->password }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="">Param 1 <small>(optional)</small></label>
                      <input type="text" name="param1" value="{{ $server->param1 }}" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="">Param 2 <small>(optional)</small></label>
                      <input type="text" name="param2" value="{{ $server->param2 }}" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="">Param 3 <small>(optional)</small></label>
                      <input type="text" name="param3" value="{{ $server->param3 }}" class="form-control">
                    </div>
                    <div class="form-group">
                      <input type="submit" value="Update server" class="btn btn-primary">
                    </div>
                    {{ csrf_field() }}
                  </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

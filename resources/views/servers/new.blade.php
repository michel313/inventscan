@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">New Server</div>

                <div class="panel-body">
                  @include ('partials.form_errors')
                  <form class="" action="/servers" method="post">
                    <div class="form-group">
                      <label for="">Location ID</label>
                      <input type="text" name="location_id" value="{{ old('location_id') }}" class="form-control" required="">
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
                      <input type="text" name="server" value="{{ old('server') }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="">Username</label>
                      <input type="text" name="username" value="{{ old('username') }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="">Password</label>
                      <input type="text" name="password" value="{{ old('password') }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="">Param 1 <small>(optional)</small></label>
                      <input type="text" name="param1" value="{{ old('param1') }}" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="">Param 2 <small>(optional)</small></label>
                      <input type="text" name="param2" value="{{ old('param2') }}" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="">Param 3 <small>(optional)</small></label>
                      <input type="text" name="param3" value="{{ old('param3') }}" class="form-control">
                    </div>
                    <div class="form-group">
                      <input type="submit" value="Save server" class="btn btn-primary">
                    </div>
                    {{ csrf_field() }}
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

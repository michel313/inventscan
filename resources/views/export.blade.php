@extends('layouts.app')

@section('content')

<input type="hidden" class="token" value="{{csrf_token()}}">
<span class="download"></span>
<div class="container">
    <div class="row">
      <div class="col-md-12 ">
        <div class="row">
            <div class="col-md-6">
                <h1>Export</h1>
            </div>
            <div class="col-md-6 text-right export-right">
                <a class="btn-primary btn" href="{{url('/export-path')}}">Export Paths</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3 col-md-offset-9">
                @if(count($paths))
                    <div class="form-group">
                        <label for="path">Choose Path</label>
                        <select id="path" class="form-control">
                            <option disabled value="0" selected>select path</option>
                            @foreach($paths as $path)
                                <option value="{{$path->path}}">{{$path->path}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-md-12 export-page">

            <div class="panel panel-default">
                <div class="panel-heading">Export products without formula</div>

                <div class="panel-body">
                    <a href="{{url('export/product/without-formula')}}" class="btn btn-default"><span class="glyphicon glyphicon-download" aria-hidden="true"></span> Export products to computer</a>
                    <a href="{{url('export/product/without-formula/server')}}" class="btn btn-default"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Export products to server</a>

                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Export products with formula</div>

                <div class="panel-body">
                    <a href="{{url('export/product/formula')}}" class="btn btn-default"><span class="glyphicon glyphicon-download" aria-hidden="true"></span> Export products to computer</a>
                    <a href="{{url('export/product/formula/server')}}" class="btn btn-default"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Export products to server</a>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Export locations</div>

                <div class="panel-body">
                    <a href="{{ url('export/locations') }}" class="btn btn-default"><span class="glyphicon glyphicon-download" aria-hidden="true"></span> Export locations to computer</a>
                    <a href="{{ url('export/locations/server') }}" class="btn btn-default"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Export locations to server</a>

                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Export servers</div>

                <div class="panel-body">
                    <a href="{{url('export/servers')}}" class="btn btn-default"><span class="glyphicon glyphicon-download" aria-hidden="true"></span> Export servers to computer</a>
                    <a href="{{ url('export/servers/server')}}" class="btn btn-default"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Export servers to server</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

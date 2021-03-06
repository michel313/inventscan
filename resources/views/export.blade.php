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
        </div>
        <hr>
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

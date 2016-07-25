@extends('layouts.app')

@section('content')


<?php
    $mainProduct = true;
?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          @include ('partials.form_errors')
            <div class="panel panel-default">
                <div class="panel-heading">New Product</div>
                <div class="panel-body">
                  <form class="" action="/products" method="post">

                    @include ('products.create-product-child')

                    <div class="form-group">
                      <input type="submit" value="Save product" class="btn btn-primary">
                    </div>
                    {{ csrf_field() }}
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

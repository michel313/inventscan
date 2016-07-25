@extends('layouts.app')

<?php
   $editMainProduct = true;
?>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          @include ('partials.form_errors')
          <div class="row">
              <div class="col-md-2 col-md-offset-10 href-button">
                 <a href="{{url('products/'.$product->id.'/child')}}" class="btn btn-primary btn-block btn-h1-spacing btn-">Child Products</a>
              </div>
          </div>
            <div class="panel panel-default clearfix">
                <div class="panel-heading">Edit Product</div>

                <div class="panel-body">

                  <form class="" action="/products/{{ $product->id }}" method="post">
                    {{ method_field('patch') }}
                      @include ('products.forms.edit-product-child')

                      <div class="form-group">
                        <input type="submit" value="Update product" class="btn btn-primary">
                      </div>

                    {{ csrf_field() }}
                  </form>
                  <div class="pull-right">
                    <form class="" action="/products/{{ $product->id }}" method="post">
                      {{ method_field('delete') }}
                      {{ csrf_field() }}
                      <input type="submit" value="Delete product" class="btn btn-danger">
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection







































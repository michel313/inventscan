@extends('layouts.app')

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
                    <div class="form-group">
                      <label for="">ArtID</label>
                      <input type="text" name="sku" value="{{ $product->sku }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="">Omschrijving</label>
                      <input type="text" name="title" value="{{ $product->title }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="">Eenheid <small>(optional)</small></label>
                      <input type="text" name="unit" value="{{ $product->unit }}" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="">Inhoud <small>(optional)</small></label>
                      <input type="text" name="content" value="{{ $product->content }}" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="">Prijs</label>
                      <div class="input-group">
                        <div class="input-group-addon">&euro;</div>
                        <input type="text" name="price" value="{{ $product->price }}" class="form-control" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="">EAN Code</label>
                      <input type="text" name="ean_code" value="{{ $product->ean_code }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="">Supplier <small>(optional)</small></label>
                      <input type="text" name="supplier_id" value="{{ $product->supplier_id }}" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="">Category <small>(optional)</small></label>
                      <input type="text" name="category_id" value="{{ $product->category_id }}" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="">Subcategory <small>(optional)</small></label>
                      <input type="text" name="subcategory_id" value="{{ $product->subcategory_id }}" class="form-control">
                    </div>
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







































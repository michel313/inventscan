@extends('layouts.app')

<?php
    $editChildProduct = true;
?>

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include ('partials.form_errors')
                <div class="panel panel-default">
                    <div class="panel-heading">Update Child Product</div>
                    <div class="panel-body">

                        {!! Form::open(array('url' => '/child-product/update', 'method' => 'patch')) !!}

                        <input type="hidden"  name="childID" value="{{ $product->id }}">
                        <input type="hidden" id="mainProductID" name="mainProductID" value="{{ $product->mainProduct }}">

                        @include ('products.forms.edit-product-child')

                        <button class="btn btn-success">Update</button>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

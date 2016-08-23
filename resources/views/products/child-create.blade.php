@extends('layouts.app')

<?php
    $childProduct = true;
?>

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include ('partials.form_errors')
                <div class="panel panel-default">
                    <div class="panel-heading">New Child Product</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="bord-right">Next Child Product SKU is - <b>{{$productInfo['sku']  .'.'.$productInfo['childSkuNumber']}}</b></h4>
                            </div>
                            <div class="col-md-6">
                                <h4 class="text-right">Current Main Product SKU is - <b>{{$productInfo['sku'] }}({{$productInfo['childCount']}})</b></h4>
                            </div>
                        </div>
                        <hr>

                        {!! Form::open(array('url' => '/child-product/create', 'method' => 'post')) !!}

                            <input type="hidden" name="sku" value="{{$productInfo['sku'] .'.'.$productInfo['childSkuNumber']}}">


                            @include ('products.forms.create-product-child')

                            <button class="btn btn-success">Add new Child</button>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
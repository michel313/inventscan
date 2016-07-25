@extends('layouts.app')



@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1>Child Products</h1>
            </div>
            <div class="col-md-2">
                <a href="{{ url('/products/'.$product_id.'/child/create') }}" class="btn btn-primary btn-block btn-h1-spacing btn-">Add new child
                    product</a>
            </div>
            <div class="col-md-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if(count($productChildList))
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ArtID</th>
                                <th>Secondary Price.</th>
                                <th>Main Price.</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($productChildList as $productChild)
                                    <tr>
                                        <td>{{$productChild->sku}}</td>
                                        <td>&euro; {{$productChild->secondaryPrice}}</td>
                                        <td>&euro; {{$productChild->mainPrice}}</td>
                                        <td class="text-right"><a href="{{ url('/products/'.$product_id.'/child/'.$productChild->id.'/edit') }}" class="btn edit-check"> <i class="fa fa-pencil"></i></a> <a href="" class="btn remove-cancel"> <i class="fa fa-remove"></i> </a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">

                        </div>
                    </div>
                </div>
                @else
                    <h2 class="no-information"><i>No Information yet</i></h2>
                @endif
            </div>
        </div>
    </div>
@endsection






























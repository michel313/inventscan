@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-10">
        <h1>All products</h1>
      </div>
      <div class="col-md-2">
        <a href="{{ url('/products/new') }}" class="btn btn-primary btn-block btn-h1-spacing btn-">Add new product</a>
      </div>

      <div class="col-md-12">
        <hr>
      </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>ArtID</th>
                          <th>Omschrijving</th>
                          <th>Eenh.</th>
                          <th>Inh.</th>
                          <th>Prijs</th>
                          <th>EAN Code</th>
                          <th>Lev.</th>
                          <th>Cat.</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($products as $product)
                          <tr>
                            <td>{{ $product->sku }}</td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->unit }}</td>
                            <td>{{ $product->content }}</td>
                            <td>&euro; {{ $product->price }}</td>
                            <td>{{ $product->ean_code }}</td>
                            <td>{{ $product->supplier_id }}</td>
                            <td>{{ $product->category_id }}</td>
                            <td class="text-right">
                                <a href="/products/{{ $product->id }}/edit" class="btn edit-check"> <i class="fa fa-pencil"></i></a>
                                <a href="javascript:void(0)" class="btn remove-cancel  deleteAjax"
                                   data-token="{{ csrf_token() }}"
                                   data-id="{!! $product->id !!}"
                                   data-type="deleteProduct"> <i class="fa fa-remove"></i> </a>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="text-center">
                      {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

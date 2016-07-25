@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-10">
        <h1>Search products</h1>
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
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($products as $product)
                          <tr>
                            <td>{{ $product->sku }}</td>
                            <td><a href="/products/{{ $product->id }}/edit">{{ $product->title }}</a></td>
                            <td>{{ $product->unit }}</td>
                            <td>{{ $product->content }}</td>
                            <td>&euro; {{ $product->price }}</td>
                            <td>{{ $product->ean_code }}</td>
                            <td>{{ $product->supplier_id }}</td>
                            <td>{{ $product->category_id }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

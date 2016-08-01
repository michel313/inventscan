@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-10">
        <h1>All products</h1>
      </div>
      <div class="col-md-2">
        <a href="{{ url('/products/new') }}" class="btn btn-primary btn-block btn-h1-spacing btn-">Add new product</a>
          <a href="{{ url('/products/import/csv') }}" class="btn btn-primary btn-block btn-h1-spacing btn-">Import CSV</a>
      </div>

      <div class="col-md-12">
        <hr>
      </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if(count($products))
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
                            <td>{{ $product->unit}}</td>
                            <td>{{ $product->content }}</td>
                            <td>
                                &euro;
                                @if(!empty($product->FormulaPrice))
                                    <?= number_format($product->FormulaPrice, 2, '.', ','); ?>
                                    -
                                @endif

                                @if(!empty($product->mainPrice))
                                    @if(strpos($product->mainPrice,'/') || strpos($product->mainPrice,'*'))
                                        {{ $product->mainPrice }}
                                    @else
                                        <?= number_format((float)$product->mainPrice, 2, '.', ','); ?>
                                    @endif
                                @endif

                            </td>
                            <td>{{ $product->ean_code }}</td>
                            <td>{{ @$product->supplier_name }}</td>
                            <td>{{ $product->category_name }}</td>
                            <td class="text-right">

                                <a
                                   @if(is_null($product->child_id))
                                        href="/products/{{ $product->product_id }}/edit"
                                   @else
                                        href="{{ url('/products/'.$product->product_id.'/child/'.$product->child_id.'/edit') }}"
                                   @endif
                                   class="btn edit-check"> <i class="fa fa-pencil"></i>
                                </a>

                                <a href="javascript:void(0)" class="btn remove-cancel  deleteAjax"
                                   data-token="{{ csrf_token() }}"

                                   @if(is_null($product->child_id))
                                        data-type="deleteProduct"
                                        data-id="{!! $product->product_id !!}"
                                   @else
                                        data-id="{!! $product->child_id !!}"
                                        data-type="deleteChildProduct"
                                   @endif


                                   > <i class="fa fa-remove"></i>
                                </a>

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
            @else
                <h2 class="no-information"><i>No Information yet</i></h2>
            @endif
        </div>
    </div>
</div>
@endsection
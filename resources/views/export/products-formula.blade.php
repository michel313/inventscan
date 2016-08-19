    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>

                                <tr>
                                    <th>ArtikelID</th>
                                    <th>Omschrijving</th>
                                    <th>Eenheid</th>
                                    <th>Inhoud</th>
                                    <th>Prijs</th>
                                    <th>Barcode</th>
                                    <th>Leverancier</th>
                                    <th>Categorie</th>
                                    <th>Subcategorie</th>
                                    @if(!empty(session('formula')))
                                        <th>Formula</th>
                                    @endif

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)

                                    <tr>
                                        <td>{{ $product['sku']}}</td>
                                        <td>{{ $product['title'] }}</td>
                                        <td>{{ $product['unit']}}</td>
                                        <td>{{ $product['content'] }}</td>
                                        <td>{{ $product['price']}}</td>
                                        <td>{{ $product['ean_code'] }}</td>
                                        <td>{{ $product['supplier_title'] }}</td>
                                        <td>{{ $product['category_title'] }}</td>
                                        <td>{{ $product['subcategory_id'] }}</td>
                                        @if(!empty($product['formula']))
                                            <td>{{ $product['formula'] }}</td>
                                        @endif

                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


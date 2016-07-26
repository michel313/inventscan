<div class="form-group">
    <label for="">ArtID</label>
    <input type="text" @if(!empty($editChildProduct)) {{'disabled'}} @endif name="sku" value="{{ $product->sku }}" class="form-control" required>
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

@if(!empty($editMainProduct))
    <div class="form-group">
        <label for="">Prijs</label>
        <div class="input-group">
            <div class="input-group-addon">&euro;</div>
            <input type="text" name="price" value="{{ $product->price }}" class="form-control" required>
        </div>
    </div>
@endif

@if(!empty($editChildProduct))

    <div class="form-group">
        <label for="mainPrice">Main Prijs</label>
        <div class="input-group">
            <div class="input-group-addon">&euro;</div>
            <input type="text" name="mainPrice" value="{{ $product->mainPrice }}" class="form-control" id="mainPrice" required>
        </div>
    </div>

    <div class="form-group">
        <label for="price_formula">Formula Secondary Price</label>
        <input type="text" name="priceFormula" value="{{ $product->priceFormula }}" class="form-control" id="price_formula" data-token="{{csrf_token()}}" required>
    </div>

    <div class="form-group">
        <label for="secondaryPrice">Secondary Price</label>
        <input disabled type="text" name="secondaryPrice" value="{{ $product->secondaryPrice }}" class="form-control" id="secondaryPrice" data-token="{{csrf_token()}}" required>
    </div>


@endif

<div class="form-group">
    <label for="pr-ean_code">EAN Code</label>
    <input type="text" name="ean_code" value="{{ $product->ean_code }}" class="form-control" id="pr-ean_code" required>
</div>

<div class="form-group">
    <label for="sel_supp">Supplier <small>(optional)</small></label>

    <select class="form-control" name="supplier_id" id="sel_supp">
        <option disabled selected>Select supplier</option>
        @if (count($selectCats['suppliersList']))
            @foreach($selectCats['suppliersList'] as $supplier)
                <option @if($supplier['id'] == $product->supplier_id ) {{ 'selected' }} @endif  value="{{$supplier['id']}}">{{$supplier['title']}}</option>
            @endforeach
        @endif
    </select>
</div>


<div class="form-group">

    <label for="sel_cat">Category <small>(optional)</small></label>

    <select class="form-control" name="category_id" id="sel_cat">
        <option disabled selected>Select Category</option>
        @if (count($selectCats['categoryList']))
            @foreach($selectCats['categoryList'] as $category)

                <option @if($category['id'] == $product->category_id ) {{ 'selected' }} @endif  value="{{$category['id']}}">{{$category['title']}}</option>
            @endforeach
        @endif
    </select>

</div>



<div class="form-group">
    <label for="sel_subCat">Subcategory<small>(optional)</small></label>

    <select class="form-control" name="subcategory_id" id="sel_subCat">
        <option disabled selected>Select Subcategory</option>
        @if (count($selectCats['subCategoryList']))
            @foreach($selectCats['subCategoryList'] as $subcategory)
                <option @if($subcategory['id'] == $product->subcategory_id ) {{ 'selected' }} @endif value="{{$subcategory['id']}}">{{$subcategory['title']}}</option>
            @endforeach
        @endif
    </select>
</div>






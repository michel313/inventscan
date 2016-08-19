    @if(!empty($mainProduct))
        <div class="form-group">
            <label for="pr-sku">ArtID</label>
            <input type="text" name="sku" value="{{ old('sku') }}" class="form-control" id="pr-sku" required>
        </div>
    @endif

    <div class="form-group">
        <label for="pr-title">Omschrijving</label>
        <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="pr-title" required>
    </div>

    <div class="form-group">
        <label for="pr-unit">Eenheid <small>(optional)</small></label>
        <input type="text" name="unit" value="{{ old('unit') }}" class="form-control" id="pr-unit">
    </div>

    <div class="form-group">
        <label for="pr-content">Inhoud <small>(optional)</small></label>
        <input type="text" name="content" value="{{ old('content') }}" class="form-control" id="pr-content">
    </div>


    <div class="form-group">
        <label for="pr-price">Prijs</label>
        <div class="input-group">
            <div class="input-group-addon">&euro;</div>
            <input type="text" name="price" value="{{ old('price') }}" class="form-control" id="pr-price" required>
        </div>
    </div>


    <div class="form-group">
        <label for="pr-ean_code">EAN Code</label>
        <input type="text" name="ean_code" value="{{ old('ean_code') }}" class="form-control" id="pr-ean_code" required>
    </div>

    <div class="form-group">
        <label for="sel_supp">Supplier <small>(optional)</small></label>

        <select class="form-control" name="supplier_id" id="sel_supp">
            <option disabled selected>Select supplier</option>
            @if (count($selectCats['suppliersList']))
                @foreach($selectCats['suppliersList'] as $supplier)
                    <option value="{{$supplier['id']}}">{{$supplier['title']}}</option>
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
                    <option value="{{$category['id']}}">{{$category['title']}}</option>
                @endforeach
            @endif
        </select>

    </div>



    <div class="form-group">
        <label for="sel_subCat">Subcategory<small>(optional)</small></label>

        <select class="form-control" name="subcategory_id" id="sel_subCat">
            <option disabled selected>Select Subcategory</option>
            @if (count($selectCats['subCategoryList']))
                @foreach($selectCats['subCategoryList'] as $Subcategory)
                    <option value="{{$Subcategory['id']}}">{{$Subcategory['title']}}</option>
                @endforeach
            @endif
        </select>
    </div>
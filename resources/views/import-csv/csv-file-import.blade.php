
<div class="panel-heading">Import CSV file</div>
<div class="panel-body">



    @if(!empty($supplierID))

        {!! Form::open(array('url' => 'supplier/'.$supplierID.'/import/csv', 'method' => 'post','files' => true)) !!}

        <input type="hidden" value="{{$supplierID}}" name="supplierID">
        <label for="csv">Select CSV File</label>
        <input id="csv" type="file" name="import_file_csv" />
        <br>
        <button class="btn btn-primary">Import File</button>

        {!! Form::close() !!}

    @elseif(!empty($supplierInfo))

        {!! Form::open(array('url' => 'supplier/import/csv', 'method' => 'post','files' => true)) !!}


            <div class="col-md-8">
                <label for="csv">Select CSV File</label>
                <input id="csv" type="file" name="import_file_csv" />
            </div>
            <div class="col-md-4">
                <label for="suppliers">Select Supplier</label>
                <select id="suppliers" name="supplierID" class="form-control">

                    @foreach($supplierInfo as $supplier)

                        <option value="{{$supplier['id']}}">{{ $supplier['title'] }}</option>

                    @endforeach

                </select>
            </div>

            <div class="col-md-12">
                <hr>
                <button class="btn btn-primary">Import File</button>
            </div>



        {!! Form::close() !!}

    @endif



</div>
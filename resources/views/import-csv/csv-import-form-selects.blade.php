<div class="panel-body csv-part">

    {!! Form::open(array('url' => 'import/store', 'method' => 'post','files' => true,'class' => 'import_form')) !!}

    <input type="hidden"  name="fileName" value="{{$data['fileName']}}">
    <input type="hidden"  name="supplierID" value="{{$data['supplierID']}}">

    <table class="table">
        <thead>
        <tr>
            <th>Database Row</th>
            <th>CSV Row</th>
        </tr>
        </thead>

        @foreach($data['fillProducts'] as $fills)

            <tbody>
            <tr>
                <td>{{$fills}}</td>
                <td>

                    <select class="form-control" multiple name="{{$fills}}[]">
                        @if(!empty($data['columnsNames']) )
                            @foreach($data['columnsNames'] as $columnsNumber => $columnsName)
                                <option
                                        <?php
                                        if(!empty($rememberSupplier)):

                                            if(strpos($rememberSupplier[$fills],','))  {

                                                $option = explode(',',$rememberSupplier[$fills]);

                                                if($option[0] == $columnsNumber || $option[1] == $columnsNumber ){
                                                    echo  'selected';
                                                };

                                            }else{

                                                if($rememberSupplier[$fills] == $columnsNumber ){
                                                    echo  'selected';
                                                };

                                            }

                                        endif;
                                        ?>

                                        @if(!empty($columnsName))

                                        value="{{$columnsNumber}}">{{$columnsName}}

                                    @endif

                                </option>
                            @endforeach
                        @endif
                    </select>

                </td>
            </tr>
            </tbody>
        @endforeach

    </table>

    <button class="create_import btn btn-primary">Import Csv</button>

    {!! Form::close() !!}



    <div id="status"></div>
</div>
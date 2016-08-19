<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>

                        <tr>
                            <th>Location ID</th>
                            <th>Shortcode</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($locations as $location)

                                <tr>
                                    <td>{{ $location['location_id']}}</td>
                                    <td>{{ $location['shortcode'] }}</td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


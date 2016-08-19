<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>

                        <tr>
                            <th>Location ID</th>
                            <th>Type</th>
                            <th>Server</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Param 1</th>
                            <th>Param 2</th>
                            <th>Param 3</th>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach($servers as $server)

                            <tr>
                                <td>{{ $server['location_id']}}</td>
                                <td>{{ $server['type'] }}</td>
                                <td>{{ $server['server'] }}</td>
                                <td>{{ $server['username'] }}</td>
                                <td>{{ $server['password'] }}</td>
                                <td>{{ $server['param1'] }}</td>
                                <td>{{ $server['param2'] }}</td>
                                <td>{{ $server['param3'] }}</td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


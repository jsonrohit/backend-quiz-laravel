<html>
    <head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
    <body>
    <!-- Main content -->
    <section class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                 
                        <h3 class="box-title">
                            <a href="/" style="color:green;">
                                <i class="fa fa-plus"></i> Back
                            </a>
                            </h3>
                            <h3 class="box-title">
                            <a href="{{ route('user.add')}}" style="color:green;">
                                <i class="fa fa-plus"></i>Add User
                            </a>
                            </h3>
            
                    <div class="box-body table-responsive">
                        <table id="datatable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Email</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $key => $test )
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$test->email}}</td>
                                     
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.content -->

    </body>
</html>
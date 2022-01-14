
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Main content -->
    <section class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <a href="{{ route('user.list')  }}" style="color:green;">
                                <i class="fa fa-plus"></i> <span>Add User</span>
                            </a>
                            </h3>
                            <h3 class="box-title">
                            <a href="{{ route('question-editadd')  }}" style="color:green;">
                                <i class="fa fa-plus"></i> <span>Add Question</span>
                            </a>
                        </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="datatable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Question</th>
                                    <th>Answer A</th>
                                    <th>Answer B</th>
                                    <th>Answer C</th>
                                    <th>Answer</th>
                                    <th>Coin</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tests as $key => $test )
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$test->qustion}}</td>
                                        <td>{{$test->option_a}}</td>
                                        <td>{{$test->option_b}}</td>
                                        <td>{{$test->option_c}}</td>
                                        <td>{{$test->answer}}</td>
                                        <td>{{$test->coins}}</td>
                                        <td>{{$test->date}}</td>
                                        <td>  <form action="{{route('question-editadd',$test->id)}}" method="get">
                                            {{csrf_field()}}
                                            <input type="submit" class="btn btn-primary btn-sm" value="Edit">
                                        </form></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.content -->


<html>
    <head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
    <body>

<div class="container">
<h3 class="box-title">
                            <a href="/" style="color:green;">
                                <i class="fa fa-plus"></i> Back
                            </a>
                            </h3>
<div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <form method="POST" id="validate3" action="{{ route('user.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="question">email</label>
                                        <input  name="email" class="form-control" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="question">password</label>
                                        <input  name="password" class="form-control" value="" required>
                                    </div>
                                </div>
                              
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
                
    </body>
</html>
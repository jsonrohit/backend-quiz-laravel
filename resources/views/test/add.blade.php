<html>
    <head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
    <body>

<div class="container">
<h3 class="box-title">
                            <a href="/" style="color:green;">
                                <i class="fa fa-plus"></i> <span>Back</span>
                            </a>
                            </h3>
<div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <form method="POST" id="validate3" action="{{ route('question-add') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="id" value="{{$item->id ?? ''}}" hidden>
                            <div class="row">
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="question">Test Name</label>
                                        <input type="text" name="testid" class="form-control" value="quiz" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="question">Question</label>
                                        <textarea name="qustion" rows="2" class="form-control  " required>{{$item->qustion ?? ''}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="option_a">Option A</label>
                                        <textarea name="option_a" class="form-control  " required>{{$item->option_a ?? ''}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="option_b">Option B</label>
                                        <textarea name="option_b"  class="form-control  " required >{{$item->option_b ?? ''}}</textarea>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="option_c">Option C</label>
                                        <textarea name="option_c"  class="form-control  " required>{{$item->option_c ?? ''}}</textarea>
                                      
                                    </div>
                                </div>
                               
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="answer">Right Answer</label>
                                        <select name="answer" id="answer" class="form-control " required required>
                                            <option value="">-- Select Answer --</option>
                                            <option value="A" {{(($item->answer ?? '') == 'A') ? 'selected' : ''}}>A</option>
                                            <option value="B" {{(($item->answer ?? '') == 'B') ? 'selected' : ''}}>B</option>
                                            <option value="C" {{(($item->answer ?? '') == 'C') ? 'selected' : ''}}>C</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" name="date" value="{{$item->date ?? ''}}" class="form-control">
                                      
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Coin">Coin</label>
                                        <input type="text" name="coins" value="{{$item->coins ?? ''}}" class="form-control">
                                      
                                    </div>
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
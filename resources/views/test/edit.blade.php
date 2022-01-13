@extends('admin::layouts.master')
@section('admin::content')
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tests<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard')  }}"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="{{ route('test_listing')  }}"><i class="fa fa-user"></i>Tests</a></li>
            <li class="active">Edit Question</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <form method="POST" id="validate3" action="{{ route('question-edit-post') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $question->id }}"/>
                            <input type="hidden" name="testId" value="{{ $question->testId }}"/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="question">Question</label>
                                        <textarea name="question" rows="2" id="question" class="form-control summerNoteEditor required">{{$question->question}}</textarea>
                                        @if ($errors->has('question'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('question') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="optionA">Option A</label>
                                        <textarea name="optionA" id="optionA" class="form-control summerNoteEditor required">{{$question->optionA}}</textarea>
                                        @if ($errors->has('optionA'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('optionA') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="optionB">Option B</label>
                                        <textarea name="optionB" id="optionB" class="form-control summerNoteEditor required">{{$question->optionB}}</textarea>
                                        @if ($errors->has('optionB'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('optionB') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="optionC">Option C</label>
                                        <textarea name="optionC" id="optionC" class="form-control summerNoteEditor required">{{$question->optionC}}</textarea>
                                        @if ($errors->has('optionC'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('optionC') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="optionD">Option D</label>
                                        <textarea name="optionD" id="optionD" class="form-control summerNoteEditor required">{{$question->optionD}}</textarea>
                                        @if ($errors->has('optionD'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('optionD') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Explanation</label>
                                        <textarea name="description" rows="4" id="description" class="form-control summerNoteEditor required">{{$question->description}}</textarea>
                                        @if ($errors->has('description'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="answer">Right Answer</label>
                                        <select name="answer" id="answer" class="form-control required" required>
                                            <option value="">-- Select Answer --</option>
                                            <option value="A"{{$question->answer=='A' ? 'selected' : ''}}>A</option>
                                            <option value="B"{{$question->answer=='B' ? 'selected' : ''}}>B</option>
                                            <option value="C"{{$question->answer=='C' ? 'selected' : ''}}>C</option>
                                            <option value="D"{{$question->answer=='D' ? 'selected' : ''}}>D</option>
                                        </select>
                                        @if ($errors->has('answer'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('answer') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                                
                            

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">
                                    @if($id) Update @else Save @endif
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->
@endsection
@section('admin::custom_js')
<script type="text/javascript">
    $('#validate3').validate();
</script>
@endsection

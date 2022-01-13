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
            <li><a href="{{ route('test_listing')  }}"><i class="fa fa-dashboard"></i>Test</a></li>
            <li class="active">Questions</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <a href="{{route('question-add',[$test->slug])}}" style="color:green;">
                                <i class="fa fa-plus"></i> <span>Add Question</span>
                            </a>
                        </h3>
                        <a href="{{route('question-export-excel',[$test->id])}}" class="btn btn-sm btn-info pull-right" style="margin: 10px 10px 0px 0px;">
                            Download Questions
                        </a>
                        <button href="#" type="button" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#uplaodByExcel" style="margin: 10px 10px 0px 0px;">
                            Uploud Questions
                        </button>
                        <a href="{{url('storage/test-upload-sample/dummy-upload.xlsx')}}" class="btn btn-sm btn-light pull-right" style="margin: 10px 10px 0px 0px;" target="_blank" download>
                            Download Sample Excel
                        </a>

                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="datatable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Question</th>
                                    <th>Option A</th>
                                    <th>Option B</th>
                                    <th>Option C</th>
                                    <th>Option D</th>
                                    <th>Answer</th>
                                    <th>Explanation</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($questions as $key => $question )
                                    <tr>
                                        <td>{{$key+1}}</td>
                           <td>
<?php
 $que = strip_tags($question->question);
    if (strlen($que) > 50) {
        $queCut = substr($que, 0, 50);
        $endPoint = strrpos($queCut, ' ');
        $que = $endPoint? substr($queCut, 0, $endPoint) : substr($queCut, 0);
    }
    echo $que.'...';
?>
</td>
<td>
<?php
$optionA = strip_tags($question->optionA);
    if (strlen($optionA) > 50) {
        $optionACut = substr($optionA, 0, 50);
        $endPoint = strrpos($optionACut, ' ');
        $optionA = $endPoint? substr($optionACut, 0, $endPoint) : substr($optionACut, 0);
    }
    echo $optionA.'...';
?>
</td>
<td>
<?php
 $optionB = strip_tags($question->optionB);
    if (strlen($optionB) > 50) {
        $optionBCut = substr($optionB, 0, 50);
        $endPoint = strrpos($optionBCut, ' ');
        $optionB = $endPoint? substr($optionBCut, 0, $endPoint) : substr($optionBCut, 0);
    }
    echo $optionB.'...';
?>
</td>
<td>
<?php
$optionC = strip_tags($question->optionC);
    if (strlen($optionC) > 50) {
        $optionCCut = substr($optionC, 0, 50);
        $endPoint = strrpos($optionCCut, ' ');
        $optionC = $endPoint? substr($optionCCut, 0, $endPoint) : substr($optionCCut, 0);
    }
    echo $optionC.'...';
?>
</td>
<td>
<?php
$optionD = strip_tags($question->optionD);
    if (strlen($optionD) > 50) {
        $optionDCut = substr($optionD, 0, 50);
        $endPoint = strrpos($optionDCut, ' ');
        $optionD = $endPoint? substr($optionDCut, 0, $endPoint) : substr($optionDCut, 0);
    }
    echo $optionD.'...';
?>
</td>
<td>
<?php
$answer = strip_tags($question->answer);
    if (strlen($answer) > 50) {
        $answerCut = substr($answer, 0, 50);
        $endPoint = strrpos($answerCut, ' ');
        $answer = $endPoint? substr($answerCut, 0, $endPoint) : substr($answerCut, 0);
    }
    echo $answer.'...';
?>
</td>
<td>
<?php
if($question->description){
$description = strip_tags($question->description);
    if (strlen($description) > 50) {
        $descriptionCut = substr($description, 0, 50);
        $endPoint = strrpos($descriptionCut, ' ');
        $description = $endPoint? substr($descriptionCut, 0, $endPoint) : substr($descriptionCut, 0);
    }
    echo $description.'...';
}
    
?>
</td>
                                        <td>
                                            <a href="{{route('question-edit', [$question->id])}}" class="action-button-light">
                                                <i class="fa fa-eye" aria-hidden="true" style="color: blue;"></i>
                                            </a>
                                            <a href="javascript:void(0);" onclick='GetAction("{{route('question-delete', [$question->id])}}")' class="action-button-light">
                                                <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
    <!-- Modal -->
    <div class="modal fade" id="uplaodByExcel" tabindex="-1" role="dialog" aria-labelledby="uplaodByExcelTitle" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="uplaodByExcelTitle">Uploud Questions By EXCEL</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('question-add-by-excel',[$test->slug])}}" id="uplaodByExcelForm" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="excelFile">FIle</label>
                    <input type="file" name="excelFile" id="excelFile" class="form-control">
                </div>
                
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="checkFile" class="btn btn-primary" onclick="checkFile();">Uploud</button>
          </div>
        </div>
      </div>
    </div>
</aside><!-- /.right-side -->
@endsection
@section('admin::custom_js')
<script type="text/javascript">
    $(function() {
        $('#datatable').dataTable({
    //         dom: 'Bfrtip',
    //   buttons: [
    //   {
    //     extend: 'collection',
    //     text: 'Export',
    //     buttons: [
    //       'excel',
    //       'csv',
    //       'pdf',
    //     ]
    //   }         
    // ]
        });
    });

    function checkFile(){
        var fileMimeTypeArr = ["text/comma-separated-values", "text/csv", "application/csv", "application/vnd.ms-excel",'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        if($('#excelFile').val())
        {
            var excelFile = $('#excelFile')[0].files[0];
            if($.inArray(excelFile.type, fileMimeTypeArr) !== -1){
                console.table(excelFile);
                $('#uplaodByExcelForm').submit();
            }
            else{
                console.log(excelFile.type);
              Lobibox.notify('error', {
                rounded: false,
                delay: 4000,
                delayIndicator: true,
                msg: "File not Supported!"
            });  
            }  
        }
        else
        {
            Lobibox.notify('warning', {
                rounded: false,
                delay: 4000,
                delayIndicator: true,
                msg: "Please select a File!"
            });
        }
    }

    function GetAction(param) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to perform this action? This action cannot be undone.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        Swal.fire(
                            'Deleted!',
                            'Test has been deleted.',
                            'success'
                        )
                        window.location = param
                    }
            })
        }
</script>
@endsection

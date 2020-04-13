@extends('layout.master')

@section('header')
<!-- DataTables -->
<link rel="stylesheet" href="adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@stop

@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                @if ($sukses = Session::get('sukses'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $sukses }}</strong>
                    </div>
                @endif
 
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel-heading">
                            <h3 class="box-title">IMPORT FILE</h3>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">IMPORT EXCEL (XLSX/XLS/CSV)</h3>
                            </div>
                            <div class="box-body">
                                <form action="{{ route('subject.importAssesment') }}" method="POST"  enctype="multipart/form-data">
                                    
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group{{ $errors->has('assesment_import') ? 'has-error' : '' }} ">
                                        <input name="assesment_import" type="file" class="form-control">
                                        @if($errors->has('assesment_import'))
                                            <span class="help-block">{{$errors->first('assesment_import')}}</span>
                                        @endif
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>              
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel-heading">
                            <h3 class="box-title">ACTIVITIES STUDENTS SCORE</h3>            
                        </div>
                        <div class="box">                        
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>SUBJECT NAME</th>
                                            <th>STUDENT NAME</th>
                                            <th>ACTIVITY NAME</th>
                                            <th>SCORE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1 @endphp
                                    @foreach($aktivitas_siswa as $as)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{$as->subject->DESCRIPTION}}</td>
                                            <td>{{$as->student->FNAME}}{{" "}}{{$as->student->LNAME}}</td>
                                            <td>{{$as->activity->MODULE}}</td>
                                            <td>{{$as->SCORE}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop

@section('footer')
<script>    
    $(function () {
        $('#example1').DataTable()
            $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
            })
        })
</script>
@stop





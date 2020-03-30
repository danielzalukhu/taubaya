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
                            <h3 class="box-title">IMPORT STUDENT ASSESMENT</h3>            
                        </div>
                        <div class="box">
                            <div class="box-body">
                                <form action="{{ route('subject.importAssesment') }}" method="POST"  enctype="multipart/form-data">
                                    
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    
                                    <!-- <div class="form-group{{ $errors->has('assesment_subject_name') ? 'has-error' : '' }} ">
                                        <label>Subject Name</label>
                                        <select name="assesment_subject_name" class="form-control">
                                           
                                        </select>
                                        @if($errors->has('assesment_subject_name'))
                                            <span class="help-block">{{$errors->first('assesment_subject_name')}}</span>
                                        @endif
                                    </div>              -->

                                    <div class="form-group{{ $errors->has('assesment_import') ? 'has-error' : '' }} ">
                                        <label>Import file (.xls/.csv)</label>
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
                                            <th>STUDENTS_ID</th>
                                            <th>ACTIVITES_ID</th>
                                            <th>SUBJECTS_ID</th>
                                            <th>SCORE</th>
                                            <th>EDIT</th>
                                            <th>DELETE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1 @endphp
                                    @foreach($aktivitas_siswa as $as)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{$as->STUDENTS_ID}}</td>
                                            <td>{{$as->ACTIVITIES_ID}}</td>
                                            <td>{{$as->SUBJECTS_ID}}</td>
                                            <td>{{$as->SCORE}}</td>
                                            <td><a href= "#" class="btn btn-primary btn-sm">EDIT</td>
                                            <td>
                                                <form action="#" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    {{ method_field("DELETE" )}}
                                                    {{ csrf_field() }}
                                                    <input type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" value="DELETE">
                                                </form>
                                            </td>
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




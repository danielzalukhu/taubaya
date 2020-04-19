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
                @elseif($error = Session::get('error'))    
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $error }}</strong>
                    </div> 
                @elseif($error = Session::get('error'))    
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $error }}</strong>
                    </div>                                
                @endif
 
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel-heading">
                            <h3 class="box-title">IMPORT FILE</h3>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">IMPORT EXCEL (XLSX/XLS)</h3>
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
                                    <table id="example1" class="table table-hover table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NISN</th>
                                            <th>NAMA SISWA</th>
                                            <th>TUGAS</th>
                                            <th>ULANGAN HARIAN</th>
                                            <th>UJIAN TENGAH SEMESTER</th>
                                            <th>UJIAN AKHIR SEMESTER</th>
                                            <th>NILAI AKHIR</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1 @endphp
                                        @foreach($laporan_mapel as $lm)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $lm->subjectrecord->student->NISN }}</td>
                                            <td>
                                                {{ $lm->subjectrecord->student->FNAME }}
                                                {{" "}}
                                                {{ $lm->subjectrecord->student->LNAME}}
                                            </td>
                                            <td>
                                                <table class="table table-hover table-dark">
                                                    <tr>
                                                        <th>T 1</th>
                                                        <th>T 2</th>
                                                        <th>T 3</th>
                                                    </tr>
                                                    <tr>
                                                        <td>80</td>
                                                        <td>90</td>
                                                        <td>100</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table class="table table-hover table-dark">
                                                    <tr>
                                                        <th>PH 1</th>
                                                        <th>PH 2</th>
                                                        <th>PH 3</th>
                                                    </tr>
                                                    <tr>
                                                        <td>80</td>
                                                        <td>90</td>
                                                        <td>100</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table class="table table-hover table-dark">
                                                    <tr>
                                                        <th>NILAI UTS</th>
                                                    </tr>
                                                    <tr>
                                                        <td>80</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table class="table table-hover table-dark">
                                                    <tr>
                                                        <th>NILAI UAS</th>
                                                    </tr>
                                                    <tr>
                                                        <td>70</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>{{ $lm->FINAL_SCORE }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>NO</th>
                                            <th>NISN</th>
                                            <th>STUDENT NAME</th>
                                            <th>TUGAS</th>
                                            <th>ULANGAN HARIAN</th>
                                            <th>UJIAN TENGAH SEMESTER</th>
                                            <th>UJIAN AKHIR SEMESTER</th>
                                            <th>NILAI AKHIR</th>
                                        </tr>
                                    </tfoot>
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





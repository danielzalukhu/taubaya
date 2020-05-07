@extends('layout.master')

@section('header')
    <link rel="stylesheet" href="{{asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

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
                            <h3 class="box-title">DAFTAR NILAI SISWA</h3>            
                        </div>
                        <div class="box">   
                            <div class="box-header">
                                <div class="right">
                                    @if($is_verified == 0)
                                    <a href="{{ route('subject.setStatus') }}?status=1" 
                                        class="btn btn-success btn-sm pull-right"  
                                        id="buttonVerifikasi" onclick="return confirm('Are you sure?')">
                                            <i class="fa fa-check"></i> VERIFIKASI NILAI
                                    </a>    
                                    @endif
                                </div>
                            </div>                     
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-hover table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NISN</th>
                                            <th>NAMA SISWA</th>
                                            <th>NAMA MAPEL</th>
                                            <th>TUGAS</th>
                                            <th>ULANGAN HARIAN</th>
                                            <th>UJIAN TENGAH SEMESTER</th>
                                            <th>UJIAN AKHIR SEMESTER</th>
                                            <th>NILAI AKHIR</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-assesment">
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
                                            <td>{{ $lm->subject->DESCRIPTION }}</td>
                                            <td>
                                                <table class="table table-hover">
                                                    @php
                                                        $scores = json_decode($lm->TUGAS);
                                                    @endphp
                                                    @foreach($scores as $score)
                                                    <tr>
                                                        <tr>{{ $score }}{{" | "}}</tr>                                                        
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table class="table table-hover">
                                                    @php
                                                        $scores = json_decode($lm->PH);
                                                    @endphp
                                                    @foreach($scores as $score)
                                                    <tr>
                                                        <tr>{{ $score }}{{" | "}}</tr>                                                        
                                                    </tr>
                                                    @endforeach
                                                </table>                                                                                    
                                            </td>
                                            <td>
                                                <table class="table table-hover">
                                                    @php
                                                        $scores = json_decode($lm->PTS);
                                                    @endphp
                                                    @foreach($scores as $score)
                                                    <tr>
                                                        <tr>{{ $score }}</tr>                                                        
                                                    </tr>
                                                    @endforeach
                                                </table>                                            
                                            </td>
                                            <td>
                                                <table class="table table-hover">
                                                    @php
                                                        $scores = json_decode($lm->PAS);
                                                    @endphp
                                                    @foreach($scores as $score)
                                                    <tr>
                                                        <tr>{{ $score }}</tr>                                                        
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>                                                
                                            <td>{{ $lm->FINAL_SCORE }}</td>
                                            <td>
                                                @if($lm->IS_VERIFIED == 0)                                                                             
                                                    <a href="{{ route('subject.editAssesment', $lm->id) }}" class="btn btn-warning btn-sm">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('subject.destroyAssesment', $lm->id) }}" method="GET" class="inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" value="DELETE">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>      
                                                @endif
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
    $(document).ready(function(){
        $('#buttonVerifikasi').click(function(){
            $('#table-assesment').empty()
        });
    });
    
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






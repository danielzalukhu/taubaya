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
                @endif
                <div class="row" id="setting-bobot">
                    <div class="col-xs-6">
                        <div class="panel-heading">
                            <h3 class="box-title">SETTING BOBOT</h3>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">INPUT BOBOT</h3>
                            </div>
                            <div class="box-body">
                                <form class="form-horizontal" action="" method="POST"  enctype="multipart/form-data">                                    
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group{{ $errors->has('weight_subject_name') ? 'has-error' : '' }} ">
                                        <label class="col-sm-3 control-label">Mapel</label>
                                        <div class="col-sm-9">
                                            <select id="weight_subject_name" class="form-control">
                                                @foreach($mapel as $m)
                                                    <option value='{{ $m->id }}'>
                                                        {{ $m->DESCRIPTION }}
                                                    </option>                                                                        
                                                @endforeach
                                            </select>
                                            @if($errors->has('weight_subject_name'))
                                                <span class="help-block">{{$errors->first('weight_subject_name')}}</span>
                                            @endif                                            
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('weight_activity_name') ? 'has-error' : '' }} ">
                                        <label class="col-sm-3 control-label">Aktivitas</label>
                                        <div class="col-sm-9">
                                            <select id="weight_activity_name" class="form-control">
                                                @foreach($aktivitas as $a)
                                                    <option value='{{ $a->id }}'>
                                                        {{ $a->MODULE }}
                                                    </option>                                                                        
                                                @endforeach
                                            </select>
                                            @if($errors->has('weight_activity_name'))
                                                <span class="help-block">{{$errors->first('weight_activity_name')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('weight_percentage') ? 'has-error' : '' }} ">
                                        <label class="col-sm-3 control-label">Bobot (%) </label>
                                        <div class="col-sm-6">
                                            <input type="number" name="weight_percentage" class="form-control">
                                            @if($errors->has('weight_percentage'))
                                                <span class="help-block">{{$errors->first('weight_percentage')}}</span>
                                            @endif
                                        </div>        
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>              
                    </div>

                    <div class="col-xs-6" id="detail-bobot">
                        <div class="panel-heading">
                            <h3 class="box-title">DETAIL BOBOT</h3>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">BOBOT MATA PELAJARAN <b>NAMA MAPEL</b></h3>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table  class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>NAMA AKTIVITAS</th>
                                                <th>BOBOT</th>   
                                                <th>TAHUN AJARAN</th>                                      
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-detail-bobot-mapel">
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>              
                    </div>
                </div>

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
                
                <div class="row" id="table-daftar-nilai-siswa">
                    <div class="col-xs-12">
                        <div class="panel-heading">
                            <h3 class="box-title">DAFTAR NILAI SISWA</h3>            
                        </div>
                        <div class="box">   
                            <div class="box-header">
                                <h3 class="box-header-title" style="padding-left: 5px">KELAS: <b> {{ $kelas_guru }} </b>
                                    <span>
                                        <a href="{{ route('subject.setStatus') }}?status=1" 
                                            class="btn btn-success btn-sm pull-right"  
                                            id="button-verifikasi" 
                                            onclick="return confirm('Are you sure?')">
                                                <i class="fa fa-check"></i> VERIFIKASI NILAI
                                        </a> 
                                    </span>
                                </h3>
                            </div>                     
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="table-assesment" class="table table-hover table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
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
                                    <tbody>
                                        @php $i=1 @endphp
                                        @foreach($laporan_mapel as $lm)
                                            @if($lm->IS_VERIFIED == 0) 
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
                                            @endif
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
    $('#setting-bobot').hide()
    $('#detail-bobot').hide()

    var tbody = $('#table-daftar-nilai-siswa tbody')
    if(tbody.children().length == 0){
        $('#button-verifikasi').hide()
    }
    else {
        $('#button-verifikasi').show()
    }

    $(function () {
        $('#table-assesment').DataTable()
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






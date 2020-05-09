@extends('layout.master')

@section('header')
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
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
                            <h3 class="box-title">DETAIL MATA PELAJARAN </h3>
                        </div>
                        <div class="box">
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
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
                                        @foreach($detail_mapel as $dm)
                                            @if($dm->IS_VERIFIED == 1) 
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $dm->subjectrecord->student->NISN }}</td>
                                                    <td>
                                                        {{ $dm->subjectrecord->student->FNAME }}
                                                        {{" "}}
                                                        {{ $dm->subjectrecord->student->LNAME}}
                                                    </td>
                                                    <td>{{ $dm->subject->DESCRIPTION }}</td>
                                                    <td>
                                                        <table class="table table-hover">
                                                            @php
                                                                $scores = json_decode($dm->TUGAS);
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
                                                                $scores = json_decode($dm->PH);
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
                                                                $scores = json_decode($dm->PTS);
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
                                                                $scores = json_decode($dm->PAS);
                                                            @endphp
                                                            @foreach($scores as $score)
                                                            <tr>
                                                                <tr>{{ $score }}</tr>                                                        
                                                            </tr>
                                                            @endforeach
                                                        </table>
                                                    </td>                                                
                                                    <td>{{ $dm->FINAL_SCORE }}</td>
                                                    <td>
                                                        @if($dm->IS_VERIFIED == 0)                                                                             
                                                            <a href="{{ route('subject.editAssesment', $dm->id) }}" class="btn btn-warning btn-sm">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <form action="{{ route('subject.destroyAssesment', $dm->id) }}" method="GET" class="inline">
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
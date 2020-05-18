@extends('layout.master')

@section('header')
<link rel="stylesheet" href="{{asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@stop

@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                @if(session('sukses'))
                    <div class="alert alert-success" role="alert">
                        {{ session('sukses') }}
                    </div>
                @endif            
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel-heading">
                            <h3 class="box-title">DAFTAR EKSKUL-KU</h3>            
                        </div>
                        <div class="box">
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NAMA SISWA</th>
                                            <th>EKSKUL</th>
                                            <th>TAHUN AJARAN</th>
                                            <th>NILAI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1 @endphp
                                    @foreach($ekskulku as $e)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{ $e->extracurricularrecord->student->FNAME }}{{" "}}{{ $e->extracurricularrecord->student->LNAME }}</td>
                                            <td>{{ $e->extracurricular->NAME }}</td>
                                            <td>
                                                {{ $e->extracurricularrecord->academicyear->TYPE }}
                                                {{ " - " }}
                                                {{ $e->extracurricularrecord->academicyear->NAME }}
                                            </td>
                                            <td>{{ $e->SCORE }}</td>
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





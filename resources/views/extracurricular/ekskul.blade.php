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
                            <h3 class="box-title">DAFTAR EKSKUL</h3>            
                        </div>
                        <div class="box">
                            <div class="box-header">                                
                                <h5 class="box-header-title"><b>TAHUN AJARAN:</b>
                                    <span>
                                        <div class="btn-group">
                                            <select type="button" id="dropdown-ekskul-academic-year" class="btn btn-default dropdown-toggle">
                                                @foreach($tahun_ajaran as $ta)
                                                    <option value='{{ $ta->id }}' class="dropdown-academic-year" academic-year-id="{{$ta->id}}">
                                                        {{ $ta->TYPE}}{{" - "}}{{ $ta->NAME }}
                                                    </option>                                                                        
                                                @endforeach
                                            </select>                                            
                                        </div>
                                        <button type="button" class="btn btn-primary btn-sm pull-right" style="margin: 1px;">CUKUP</button>                                                                              
                                        <button type="button" class="btn btn-success btn-sm pull-right" style="margin: 1px;">BAIK</button>  
                                    </span>        
                                </h5>
                            </div>
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
                                    @foreach($ekskul as $e)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{ $e->student->FNAME }}{{" "}}{{ $e->student->LNAME }}</td>
                                            <td>{{ $e->EXTRACURRICULARS_ID }}</td>
                                            <td>
                                                {{ $e->academicyear->TYPE }}
                                                {{ "-" }}
                                                {{ $e->academicyear->NAME }}
                                            </td>
                                            <td>
                                                @if( $e->SCORE > 75 )
                                                    <div class="btn btn-success btn-sm">{{ $e->SCORE }}</div>
                                                @else
                                                    <div class="btn btn-info btn-sm">{{ $e->SCORE }}</div>
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

    $('#dropdown-ekskul-academic-year').val({{$academic_year_id}})    

    $('#dropdown-ekskul-academic-year').change(function(){
        var academicYearId = $(this).val()   
        var route =  "{{ route('extracurricular.ekskul') }}"  
        window.location = route+"?academicYearId="+academicYearId;        
    })

</script>
@stop





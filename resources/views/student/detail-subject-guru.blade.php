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
                            <h3 class="box-title">STATISTIK NILAI: <B>{{ $mapel->DESCRIPTION }}</B> </h3>            
                        </div>
                        <div class="box box-info">

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>

                            <div class="box-body">
                                <div id="gradeOfSubjectChart">

                                </div>
                            </div>

                            

                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="panel-heading">                      
                            <h3 class="box-title">DETAIL NILAI MATA PELAJARAN: <B>{{ $mapel->DESCRIPTION }}</B> </h3>
                        </div>
                        <div class="box">
                            <div class="box-header">                                
                                <h5 class="box-header-title"><b>TAHUN AJARAN:</b>
                                    <span>
                                        <div class="btn-group">
                                            <select type="button" id="dropdown-detail-subject-academic-year" class="btn btn-default dropdown-toggle">
                                                @foreach($tahun_ajaran as $ta)
                                                    <option value='{{ $ta->id }}' class="dropdown-academic-year" academic-year-id="{{$ta->id}}">
                                                        {{ $ta->TYPE}}{{" - "}}{{ $ta->NAME }}
                                                    </option>                                                                        
                                                @endforeach
                                            </select>
                                        </div>
                                    </span>        
                                </h5>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="table-detail-subject" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NISN</th>
                                            <th>NAMA SISWA</th>
                                            <th>TUGAS</th>
                                            <th>ULANGAN HARIAN</th>
                                            <th>UJIAN TENGAH SEMESTER</th>
                                            <th>UJIAN AKHIR SEMESTER</th>
                                            <th>NILAI AKHIR</th>                                            
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-detail-subject">
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
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
    $(function () {
        $('#table-detail-subject').DataTable()
            $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
            })
        })

    var subjectId = '{{ $mapel->id }}'

    $('#dropdown-detail-subject-academic-year').val({{$academic_year_id}})    

    $('#dropdown-detail-subject-academic-year').change(function(){
        var academicYearId = $(this).val()   
        var route =  "{{ route('subject.detail', ':id') }}"  
        route = route.replace(':id', '{{ $mapel->id }}')
        window.location = route+"?academicYearId="+academicYearId;        
    })

    Highcharts.chart('gradeOfSubjectChart', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Statistik Nilai Akhir Kelas Per Semester'
        },
        xAxis: { 
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Nilai'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Nilai Akhir',
            data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5]
        }, {
            name: 'KKM',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6]
        },{
            name: 'Nilai Rata-Rata Kelas',
            data: [5, 6, 7, 8, 10, 7, 5, 5]
        }]
    });

</script>
@stop
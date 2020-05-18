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
                                            <th>TUGAS</th>
                                            <th>ULANGAN HARIAN</th>
                                            <th>UJIAN TENGAH SEMESTER</th>
                                            <th>UJIAN AKHIR SEMESTER</th>
                                            <th>NILAI AKHIR</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-detail-subject">
                                        @php $i=1 @endphp
                                        @foreach($detail_mapel_ku as $dm)
                                            @if($dm->IS_VERIFIED == 1) 
                                                <tr>
                                                    <td>{{ $i++ }}</td>
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

    var studentId = '{{ $siswa->id }}'
    var subjectId = '{{ $mapel->id }}'

    $('#dropdown-detail-subject-academic-year').val({{$academic_year_id}})    

    $('#dropdown-detail-subject-academic-year').change(function(){
        var academicYearId = $(this).val()   
        var route =  "{{ route('subject.detail', ':id') }}"  
        route = route.replace(':id', '{{ $mapel->id }}')
        window.location = route+"?academicYearId="+academicYearId;        
    })

    var category = {!!json_encode($tahun_ajaran)!!}
    var kkm = {!! json_encode($kkm) !!}
    var finalScore = {!! json_encode($detail_mapel_ku) !!}

    var dataCategory = []
    var series1 = []
    var series2 = []
    var series3 = []

    category.forEach(function(item){
        var catName = item.NAME
        dataCategory.push(catName)
        
        kkm.forEach(function(item){
            var tmp_kkm = item.MINIMALPOIN
            series2.push(tmp_kkm)
        })        

    })

    Highcharts.chart('gradeOfSubjectChart', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Statistik Nilai Akhir Per Semester'
        },
        xAxis: { 
            categories: dataCategory
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
        series: [{
            name: 'Nilai Akhir',
            data: [75.0, 85, 90.5, 66, 72, 88, 67, 80]
        }, {
            name: 'KKM',
            data: series2
        },{
            name: 'Nilai Rata-Rata Kelas',
            data: [75.6, 82, 82, 74, 67.67, 77, 70, 70.8]
        }]
    });

</script>
@stop
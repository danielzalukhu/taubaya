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
                                <!-- <h5 class="box-header-title"><b>TAHUN AJARAN:</b> -->
                                    <span>
                                        <button type="button" class="btn btn-danger btn-sm pull-right" style="margin: 1px;">KURANG</button>
                                        <button type="button" class="btn btn-primary btn-sm pull-right" style="margin: 1px;">CUKUP</button>                                                                              
                                        <button type="button" class="btn btn-success btn-sm pull-right" style="margin: 1px;">BAIK</button>  
                                    </span>        
                                <!-- </h5> -->
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="table-detail-subject" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>TAHUN AJARAN</th>
                                            <th>TUGAS</th>
                                            <th>ULANGAN HARIAN</th>
                                            <th style="width:10%">UJIAN TENGAH SEMESTER</th>
                                            <th style="width:10%">UJIAN AKHIR SEMESTER</th>
                                            <th>KKM</th>
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
                                                        {{ $dm->subjectrecord->academicyear->TYPE }}
                                                        {{ "-" }}
                                                        {{ $dm->subjectrecord->academicyear->NAME }}
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
                                                    <td>{{ $dm->MINIMALPOIN }}</td>                                          
                                                    <td>
                                                        @if( $dm->FINAL_SCORE < $dm->MINIMALPOIN )
                                                            <div class="btn btn-danger btn-sm">{{ $dm->FINAL_SCORE }}</div>
                                                        @elseif( $dm->FINAL_SCORE == $dm->MINIMALPOIN )
                                                            <div class="btn btn-primary btn-sm">{{ $dm->FINAL_SCORE }}</div>
                                                        @elseif( $dm->FINAL_SCORE > $dm->MINIMALPOIN )
                                                            <div class="btn btn-success btn-sm">{{ $dm->FINAL_SCORE }}</div>
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

    var studentId = '{{ $siswa->id }}'
    var subjectId = '{{ $mapel->id }}'

    $('#dropdown-detail-subject-academic-year').val({{$academic_year_id}})    

    $('#dropdown-detail-subject-academic-year').change(function(){
        var academicYearId = $(this).val()   
        var route =  "{{ route('subject.detail', ':id') }}"  
        route = route.replace(':id', '{{ $mapel->id }}')
        window.location = route+"?academicYearId="+academicYearId;        
    })

    var categories = {!! json_encode($tahun_ajaran) !!}    
    var kkm = {!! json_encode($kkm) !!}
    var finalScore = {!! json_encode($data_final_score) !!}
    var averageScorePerClass = {!! json_encode($rata_kelas) !!}
    
    var category = []
    var series1 = []
    var series2 = []
    var series3 = []

    categories.forEach(function(item){

        finalScore.forEach(function(obj_score){            
            if(obj_score.ACADEMIC_YEAR_ID == item.id){
                var catName = item.TYPE + " " + item.NAME        
                category.push(catName)
                                                
                averageScorePerClass.forEach(function(obj_rata){
                    if(obj_rata.ACADEMIC_YEAR_ID == item.id){
                        var tmp_rata = obj_rata.RATAKELAS      
                        series3.push(tmp_rata);    
                        
                        kkm.forEach(function(obj_kkm){
                            var tmp_kkm = obj_kkm.MINIMALPOIN
                            series2.push(tmp_kkm)
                        })
                    }              
                })   

                var values = obj_score.FINAL_SCORE  
                series1.push(values);                     
            }
        })    
    })    

    console.log(series1)
    console.log(series2)
    console.log(series3)
    
    Highcharts.chart('gradeOfSubjectChart', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Statistik Nilai Akhir Per Semester'
        },
        xAxis: { 
            categories: category
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
                enableMouseTracking: true
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Nilai Akhir',
            data: series1
        }, {
            name: 'KKM',
            data: series2
        },{
            name: 'Nilai Rata-Rata Kelas',
            data: series3
        }]
    });

</script>
@stop
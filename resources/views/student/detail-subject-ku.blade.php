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

    var subjectId = '{{ $mapel->id }}'
    var studentId = '{{ $siswa->id }}'
    
    $('#dropdown-detail-subject-academic-year').val({{$academic_year_id}})    

    $('#dropdown-detail-subject-academic-year').change(function(){
        var academicYearId = $(this).val();

        $.ajax({
            url: '{{ route("subject.ajaxSubjectDetailKu") }}',
            type: 'get',
            data: {academicYearId: academicYearId, subjectId: subjectId, studentId: studentId},

            success: function(result){
                $('#tbody-detail-subject').empty()               
                console.log(result)
                               
            },
            error: function(err){
                console.log(err)
            }
        });
    });
    
    var category = {!!json_encode($tahun_ajaran)!!}
    var dataCategory = []
    category.forEach(function(item){
        var catName = item.NAME
        dataCategory.push(catName)
    })
    // console.log(dataCategory)
    

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
                text: 'Nilai Akhir'
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
            name: 'Nilai',
            data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 90, 18.3, 13.9, 9.6]
        }, {
            name: 'KKM',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
        },{
            name: 'Nilai Rata-Rata Kelas',
            data: [5, 6, 7, 8, 10, 7, 5, 5, 6, 10.5, 9.1, 7.3]
        }]
    });

</script>
@stop
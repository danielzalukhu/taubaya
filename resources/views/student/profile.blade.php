@extends('layout.master')

@section('header')

@stop

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          STUDENT PROFILE
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
          <li><a href="{{route('student.index')}}">STUDENT</a></li>
          <li class="active"><a href="#">PROFILE</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-md-3">
              <div class="box box-primary">
                  <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{$siswa->getPhoto()}}" alt="User profile picture">

                    <h3 class="profile-username text-center"><b>{{$siswa->FNAME}}{{" "}}{{$siswa->LNAME}}</b></h3>
                    <h5 class="text-muted text-center">{{$siswa->NISN}}</h5>
                    <!-- <p class="text-muted text-center">KELASNYA DIMANA</p> -->

                    <ul class="list-group list-group-unbordered">
                      <li class="list-group-item">
                        <b>MATA PELAJARAN</b> <a class="pull-right">JUMLAH</a>
                      </li>
                      <li class="list-group-item">
                        <b>ABSENT</b> <a class="pull-right"><b>BERAPA</b> % </a>
                      </li>
                      <li class="list-group-item">
                        <b>VIOLATIONS POINT</b> 
                        <a class="pull-right">{{$point_record}}</a>
                      </li>
                      <li class="list-group-item">
                        <b>ACHIEVEMENTS POINT</b> 
                        <a class="pull-right">{{$total_achievement_point}}</a>
                      </li>
                      <li class="list-group-item">
                        <b>TOTAL POINT</b> 
                        <a class="pull-right">
                            @if($point_record > 75)
                            {{$point_record - $total_achievement_point}}
                            @else
                            {{$point_record}}

                            @endif
                        </a>
                      </li>
                    </ul>

                    <!-- <a href="#" class="btn btn-success btn-block"><b>EDIT PROFILE</b></a> -->
                  </div>
              </div>
          </div>

          <div class="col-md-9">
              <div class="nav-tabs-custom">

                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#violation" data-toggle="tab">VIOLATION</a></li>
                    <li><a href="#achievement" data-toggle="tab">ACHIEVEMENT</a></li>
                    <li><a href="#absent" data-toggle="tab">ABSENT</a></li>
                  </ul>

                  <div class="tab-content">

                    <div class="tab-pane  active in" id="violation">
                        <div class="panel">
                            <div class="panel-heading">
                                <h1 class="panel-title">STUDENT VIOLATION RECORD</h1>
                            </div>
                            <div class="panel-heading">                                
                                <h5 class="panel-title"><b>ACADEMIC YEAR:</b>
                                    <span>
                                        <div class="btn-group">
                                            <select type="button" id="selector-dropdown-violation-year" class="btn btn-default dropdown-toggle">
                                                @foreach($tahun_ajaran as $ta)
                                                    <option value='{{ $ta->id }}' class="dropdown-violation-year" violation-academic-year-id="{{$ta->id}}">
                                                        {{ $ta->TYPE}}
                                                        {{ " - " }}
                                                        {{ strtok($ta->START_DATE, '-') }}
                                                        {{ " / " }}
                                                        {{ strtok($ta->END_DATE, '-') }}
                                                    </option>                                                                        
                                                @endforeach
                                            </select>
                                        </div>
                                    </span>        
                                </h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>DATE</th>
                                            <th>KODE</th>
                                            <th>DESCRIPTION</th>
                                            <th>POINT</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-violation-academic-year">
                                        @foreach($catatan_pelanggaran as $cp)
                                          <tr>
                                            <td>{{ date('d-m-Y', strtotime($cp->DATE)) }}</td>
                                            <td>{{ $cp->NAME }}</td>
                                            <td>{{ $cp->DESCRIPTION }}</td>
                                            <td>{{ $cp->TOTAL }}</td>
                                          </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel-heading">                                
                            <h5 class="panel-title"><b>ACADEMIC YEAR:</b>
                                <span>
                                    <div class="btn-group">
                                        <select type="button" id="select-dropdown-academicyear-graph-violation" class="btn btn-default dropdown-toggle">
                                            @foreach($tahun_ajaran as $ta)
                                                <option value='{{ $ta->id }}' class="dropdown-violation-year-graphic" violation-academic-year-id-graphic="{{$ta->id}}">
                                                    {{ $ta->TYPE}}
                                                    {{ " - " }}
                                                    {{ strtok($ta->START_DATE, '-') }}
                                                    {{ " / " }}
                                                    {{ strtok($ta->END_DATE, '-') }}
                                                </option>                                                                        
                                            @endforeach
                                        </select>
                                    </div>
                                </span>        
                            </h5>
                        </div>
                        <div class="panel-body">
                            <div id="chartViolation">

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="achievement">
                        <div class="panel">
                            <div class="panel-heading">
                                <h1 class="panel-title">STUDENT ACHIEVEMENT RECORD</h1>
                            </div>
                            <div class="panel-heading">                                
                                <h5 class="panel-title"><b>ACADEMIC YEAR:</b>
                                    <span>
                                        <div class="btn-group">
                                            <select type="button" id="selector-dropdown-achievement-year" class="btn btn-default dropdown-toggle">
                                                @foreach($tahun_ajaran as $ta)
                                                    <option value='{{ $ta->id }}' class="dropdown-achievement-year" achievement-academic-year-id="{{$ta->id}}">
                                                        {{ $ta->TYPE}}
                                                        {{ " - " }}
                                                        {{ strtok($ta->START_DATE, '-') }}
                                                        {{ " / " }}
                                                        {{ strtok($ta->END_DATE, '-') }}
                                                    </option>                                                                        
                                                @endforeach
                                            </select>
                                        </div>
                                    </span>        
                                </h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>DATE</th>
                                            <th>TYPE</th>
                                            <th>DESCRIPTION</th>                                            
                                            <th>POINT</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-achievement-academic-year">
                                        @foreach($catatan_penghargaan as $cp)
                                          <tr>
                                            <td>{{ date('d-m-Y', strtotime($cp->DATE)) }}</td>
                                            <td>{{ $cp->TYPE }}</td>
                                            <td>{{ $cp->DESCRIPTION }}</td>
                                            <td>{{ $cp->POINT }}</td>
                                          </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>  
                        <div class="panel-heading">                                
                            <h5 class="panel-title"><b>ACADEMIC YEAR:</b>
                                <span>
                                    <div class="btn-group">
                                        <select type="button" id="select-dropdown-academicyear-graph-achievement" class="btn btn-default dropdown-toggle">
                                            @foreach($tahun_ajaran as $ta)
                                                <option value='{{ $ta->id }}' class="dropdown-achievement-year-graphic" achievement-academic-year-id-graphic="{{$ta->id}}">
                                                    {{ $ta->TYPE}}
                                                    {{ " - " }}
                                                    {{ strtok($ta->START_DATE, '-') }}
                                                    {{ " / " }}
                                                    {{ strtok($ta->END_DATE, '-') }}
                                                </option>                                                                        
                                            @endforeach
                                        </select>
                                    </div>
                                </span>        
                            </h5>
                        </div>
                        <div class="panel-body">
                            <div id="chartAchievement">

                            </div>
                        </div>                  
                    </div>

                    <div class="tab-pane" id="absent">
                        <div class="panel">
                            <div class="panel-heading">
                                <h1 class="panel-title">STUDENT ABSENT RECORD</h1>
                            </div>
                            <div class="panel-heading">                                
                                <h5 class="panel-title"><b>ACADEMIC YEAR:</b>
                                    <span>
                                        <div class="btn-group">
                                            <select type="button" id="selector-dropdown-absent-year" class="btn btn-default dropdown-toggle">
                                                @foreach($tahun_ajaran as $ta)
                                                    <option value='{{ $ta->id }}' class="dropdown-absent-year" absent-academic-year-id="{{$ta->id}}">
                                                        {{ $ta->TYPE}}
                                                        {{ " - " }}
                                                        {{ strtok($ta->START_DATE, '-') }}
                                                        {{ " / " }}
                                                        {{ strtok($ta->END_DATE, '-') }}
                                                    </option>                                                                        
                                                @endforeach
                                            </select>
                                        </div>
                                    </span>        
                                </h5>
                            </div>
                        
                            <div class="panel-body">
                                <!-- <table class="table table-striped"> -->
                                <table id="example1" class="table table-bordered table-striped">    
                                    <thead>
                                        <tr>
                                            <th>TYPE</th>
                                            <th>DESCRIPTION</th>
                                            <th>DETAIL</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-absent-academic-year">
                                        @foreach($catatan_absen as $ca)
                                          <tr>
                                            <td>{{ $ca->TYPE }}</td>
                                            <td>{{ $ca->TOTAL }}{{" "}}{{"DAYS"}}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm button-detail" data-toggle="modal" data-target="#detailAbsentModal" absent-type="{{$ca->TYPE}}">SHOW</button>
                                            </td>
                                          </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div id="chartAbsent">

                            </div>
                        </div>
                    </div>

                    <!-- Modal Absent Detail-->
                    <div class="modal fade" id="modalAbsentDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title" id="exampleModalLabel">ABSENT DETAILS</h1>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table id="table-absent-detail" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>TYPE</th>
                                                <th>START DATE</th>
                                                <th>END DATE</th>
                                                <th>DESCRIPTION</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-absent-detail">
                                            <tr>
                                                <td>J</td>
                                                <td>ASD</td>
                                                <td>ASDASD</td>
                                                <td>ADFAFER</td>
                                            </tr>
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



    </section>
@stop

@section('footer')


<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
    var studentId = '{{ $siswa->id }}';

    $('#tbody-absent-academic-year').on('click', '.button-detail', (function(){
        var absentType = $(this).attr('absent-type');
        // var academicYearId = $(this).val();
        // console.log(academicYearId)
        $.ajax({
            url: '{{route("student.detailAbsent")}}', 
            type: 'get', 
            data: {studentId: studentId, absentType: absentType},

            success: function(result){
                $('#tbody-absent-detail').empty()
                
                result.forEach(function(obj){
                    // console.log(obj)
                    $('#tbody-absent-detail').append(
                        `
                        <tr>
                            <td>${obj.TYPE}</td>
                            <td>${obj.START_DATE}</td>
                            <td>${obj.END_DATE}</td>
                            <td>${obj.DESCRIPTION}</td>
                        </tr>

                        `
                    )
                })
                // console.log(result)
                $('#modalAbsentDetail').modal('show')
            },
            error: function(err){
                console.log(err)
            }
        })
    }))
   
    $('#selector-dropdown-violation-year').change(function(){

       // var academicYearId = $(this).attr('violation-academic-year-id');
        var academicYearId = $(this).val();
        console.log(academicYearId);

        $.ajax({
            url: '{{ route("violationrecord.academicYearAjax") }}',
            type: 'get',
            data: {academicYearId: academicYearId, studentId: studentId},

            success: function(result){
                $('#tbody-violation-academic-year').empty()

                result.forEach(function(obj){
                    // console.log(obj)
                    $('#tbody-violation-academic-year').append(
                        `
                        <tr>
                            <td>${obj.DATE}</td>
                            <td>${obj.NAME}</td>
                            <td>${obj.DESCRIPTION}</td>
                            <td>${obj.TOTAL}</td>
                        </tr>

                        `
                    )
                })
            },
            error: function(err){
                console.log(err)
            }
        })
    });

    $('#selector-dropdown-achievement-year').change(function(){
        // var academicYearId = $(this).attr('achievement-academic-year-id');
        var academicYearId = $(this).val();
        console.log(academicYearId);

        $.ajax({
            url: '{{ route("achievement.academicYearAjax") }}',
            type: 'get',
            data: {academicYearId: academicYearId, studentId: studentId},

            success: function(result){
                $('#tbody-achievement-academic-year').empty()

                result.forEach(function(obj){
                    // console.log(obj)
                    $('#tbody-achievement-academic-year').append(
                        `
                        <tr>
                            <td>${obj.DATE}</td>
                            <td>${obj.TYPE}</td>
                            <td>${obj.DESCRIPTION}</td>
                            <td>${obj.POINT}</td>
                        </tr>

                        `
                    )
                })
            },
            error: function(err){
                console.log(err)
            }
        })
    });

    $('#selector-dropdown-absent-year').change(function(){
        var academicYearId = $(this).val();
        // var academicYearId = $(this).attr('absent-academic-year-id');
        //console.log(academicYearId)

        $.ajax({
            url: '{{ route("absent.academicYearAjax") }}',
            type: 'get',
            data: {academicYearId: academicYearId, studentId: studentId},

            success: function(result){
                $('#tbody-absent-academic-year').empty()
                // console.log(result)
                result.forEach(function(obj){
                    // console.log(obj)
                    $('#tbody-absent-academic-year').append(
                        `
                        <tr>
                            <td>${obj.TYPE}</td>
                            <td>${obj.TOTAL} DAYS</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm button-detail" data-toggle="modal" data-target="#detailAbsentModal" absent-type=${obj.TYPE}>SHOW</button>
                            </td>
                        </tr>

                        `
                    )
                })
            },
            error: function(err){
                console.log(err)
            }
        })
    });

    // TAB VIOLATION //
    $('#select-dropdown-academicyear-graph-violation').change(function(){
        // var academicYearId = $(this).attr('violation-academic-year-id-graphic');
        var academicYearId = $(this).val();
        // console.log(academicYearId)

        window.location = "{{ route('student.profile', ['id'=>$siswa->id]) }}"+"?academicYearId="+academicYearId;
    })

    // $('#selector-dropdown-violation-year').val({{$academic_year_id}})
    $('#select-dropdown-academicyear-graph-violation').val({{$academic_year_id}})
    
    var categories = {!!json_encode($kategori)!!}
    var dataGraph = {!!json_encode($data)!!}
    var selectedTahunAjaran = {!!json_encode($selected_tahun_ajaran)!!}
    // console.log(categories)

    var startMonth = selectedTahunAjaran.STARTMONTH;
    var endMonth = selectedTahunAjaran.ENDMONTH;
    var dataSeries = [];
    var dataCategory = []

    categories.forEach(function(item){
        var values = []
        for(var i=startMonth; i <= endMonth; i++){
            values[i-startMonth] = 0
            dataCategory.push('Bulan '+ i)
        }
        
        dataGraph.forEach(function(obj){
            if(obj.KATEGORI == item.KATEGORI){
                values[obj.BULAN - startMonth] = obj.JUMLAH
            }
        })

        dataSeries.push({
            name: item.KATEGORI,
            data: values
        })
    })

    Highcharts.chart('chartViolation', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'STATISTIK PELANGGARAN YANG TERCATAT BERDASARKAN JENIS PELANGGARAN DAN PERIODE TAHUN AJARAN'
        },
        xAxis: {
            categories: dataCategory,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'JUMLAH PELANGGARAN TERJADI'
            }
        },
        credits: {
            enabled: false,
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: dataSeries
    });

    // TAB ACHIEVEMENT //
    
    $('#select-dropdown-academicyear-graph-achievement').change(function(){
        var academicYearId = $(this).val();
        // console.log(academicYearId)
        $.ajax({
            url: '{{ route("student.achievementChart") }}',
            type: 'get',
            data: {academicYearId: academicYearId, studentId: studentId},

            success: function(result){
               console.log(result)
               chartAchievement(result['type'], result['dataAchievement'], result['selected_tahun_ajaran'])

            },
            error: function(err){
                console.log(err)
            }
        })
    })

    // $('#selector-dropdown-achievement-year').val({{$academic_year_id}})
    $('#select-dropdown-academicyear-graph-achievement').val({{$academic_year_id}})

    var types = {!!json_encode($type)!!}
    var dataGraph = {!!json_encode($data)!!}
    var selectedTahunAjaran = {!!json_encode($selected_tahun_ajaran)!!}

    chartAchievement(types, dataGraph, selectedTahunAjaran)

    function chartAchievement(types, dataGraph, selectedTahunAjaran){
        $("#chartAchievement").empty()
        
        var startMonth = selectedTahunAjaran.STARTMONTH;
        var endMonth = selectedTahunAjaran.ENDMONTH;
        var dataSeries = []
        var dataCategory = []
        
        types.forEach(function(item){
            var values = []
            for(var i=startMonth; i <= endMonth; i++){
                values[i-startMonth] = 0
                dataCategory.push('Bulan ' + i)
            }

            dataGraph.forEach(function(obj){
                if(obj.TIPE == item.TIPE){
                    values[obj.BULAN - startMonth] = obj.JUMLAH
                }
            })

            dataSeries.push({
                name: item.TIPE,
                data: values
            })
        })
        
        Highcharts.chart('chartAchievement', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'STATISTIK PENGHARGAAN YANG TERCATAT BERDASARKAN JENIS PENGHARGAAN'
            },
            xAxis: {
                categories: dataCategory,
                crosshair: true,
            },
            yAxis: {
                min: 0,
                allowDecimals: false,
                tickInterval: 5,
                title: {
                    text: 'JUMLAH PENGHARGAAN TERCATAT'
                }
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false,
                    pointPadding: 0.1,
                    pointInterval: 1,
                    borderWidth: 0
                }
            },
            series: dataSeries
        });
    }


    // TAB ABSENT // 
    var types = {!!json_encode($tipeAbsen)!!}
    var dataGraph = {!!json_encode($dataAbsen)!!}

    // var minYear = selectedTahun.TAHUNTERKECIL
    // var maxYear = selectedTahun.TAHUNTERBESAR
    var dataSeries = []

    types.forEach(function(item){   
        dataGraph.forEach(function(obj){
            if(obj.TIPE == item.TIPE){
                // var values = obj.JUMLAH
                dataSeries.push({
                    name: item.TIPE,
                    y: obj.JUMLAH
                })
            }
        })
    })
    // console.log(dataGraph);

    // Highcharts.chart('chartAbsent', {
    //     chart: {
    //         plotBackgroundColor: null,
    //         plotBorderWidth: null,
    //         plotShadow: false,
    //         type: 'pie'
    //     },
    //     credits: {
    //         enabled: false
    //     },
    //     title: {
    //         text: 'PERSENTASE ABSENSI DALAM SATU PERIODE BERDASARKAN JENIS ABSENSI'
    //     },
    //     tooltip: {
    //         pointFormat: '{series.name}: <b>{point.percentage}%</b>'
    //     },
    //     plotOptions: {
    //         pie: {
    //             allowPointSelect: true,
    //             cursor: 'pointer',
    //             dataLabels: {
    //                 enabled: true,
    //                 format: '<b>{point.name}</b>: {point.percentage:.1f} %'
    //             },
    //             showInLegend: true
    //         }
    //     },
    //     series: [{
    //         name: 'TYPE',
    //         colorByPoint: true,
    //         data: dataSeries
    //     }]
    // });
</script>
@Stop

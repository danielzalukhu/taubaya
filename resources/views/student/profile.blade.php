@extends('layout.master')

@section('header')

@stop

@section('content')
    <section class="content-header">
        <h1>
          PROFIL SISWA
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
          <li><a href="{{route('student.index')}}">STUDENT</a></li>
          <li class="active"><a href="#">PROFILE</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
          <div class="col-md-3">
              <div class="box box-primary">
                  <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{$siswa->getPhoto()}}" alt="User profile picture">

                    <h3 class="profile-username text-center"><b>{{$siswa->FNAME}}{{" "}}{{$siswa->LNAME}}</b></h3>
                    <h5 class="text-muted text-center">
                        @if(Auth::guard('web')->user()->ROLE === "STUDENT")
                            <b> {{ Auth::user()->student->getGradeName() }} - {{ $siswa->NISN }} </b>
                        @elseif(Auth::guard('web')->user()->ROLE === "PARENT")
                            <b> {{ $student_grade_name }} - {{ $siswa->NISN }} </b>
                        @else
                            <b> {{ $student_grade_name }} - {{ $siswa->NISN }} </b>
                        @endif
                    </h5>                    

                    <ul class="list-group list-group-unbordered">
                      <li class="list-group-item">
                        POIN PELANGGARAN
                        <a class="pull-right">{{$violation_point}}</a>
                      </li>
                      <li class="list-group-item">
                        POIN PENGHARGAAN 
                        <p class="pull-right">{{$achievement_point}}</p>
                      </li>
                      <li class="list-group-item">
                        ABSENSI
                        <p class="pull-right"><b>{{ $kehadiran["kehadiran"] }} %</b></p>
                      </li>
                    </ul>
                  </div>
              </div>
          </div>

          <div class="col-md-9">
              <div class="nav-tabs-custom">

                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#violation" data-toggle="tab">PELANGGARAN</a></li>
                    <li><a href="#achievement" data-toggle="tab">PENGHARGAAN</a></li>
                    <li><a href="#absent" data-toggle="tab">PRESENSI</a></li>
                  </ul>

                  <div class="tab-content">

                    <div class="tab-pane  active in" id="violation">
                        <div class="panel">
                            <div class="panel-heading">
                                <h1 class="panel-title">CATATAN PELANGGARAN SISWA</h1>
                            </div>
                            <div class="panel-heading">                                
                                <h5 class="panel-title"><b>TAHUN AJARAN:</b>
                                    <span>
                                        <div class="btn-group">                                            
                                            <select type="button" id="selector-dropdown-violation-year" class="btn btn-default dropdown-toggle">
                                                @foreach($tahun_ajaran as $ta)
                                                    <option value='{{ $ta->id }}' class="dropdown-violation-year" violation-academic-year-id="{{$ta->id}}">
                                                        {{ $ta->TYPE}}{{" - "}}{{ $ta->NAME }}
                                                    </option>                                                                        
                                                @endforeach
                                            </select>
                                        </div>
                                    </span>        
                                </h5>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>TANGGAL</th>
                                                <th>KODE</th>
                                                <th>DESKRIPSI</th>
                                                <th>HUKUMAN</th>
                                                <th>POIN</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-violation-academic-year">
                                            @forelse($catatan_pelanggaran as $cp)
                                                <tr>
                                                    <td>{{ date('d-m-Y', strtotime($cp->DATE)) }}</td>
                                                    <td>{{ $cp->NAME }}</td>
                                                    <td>{{ $cp->DESCRIPTION }}</td>
                                                    <td>{{ $cp->PUNISHMENT }}</td>
                                                    <td>{{ $cp->TOTAL }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="12" class="text-center p-5">Belum ada data catatan pelanggaran</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>                            
                            </div>
                        </div>
                        <div class="panel-heading">                                
                            <h5 class="panel-title"><b>TAHUN AJARAN:</b>
                                <span>
                                    <div class="btn-group">
                                        <select type="button" id="select-dropdown-academicyear-graph-violation" class="btn btn-default dropdown-toggle">
                                            @foreach($tahun_ajaran as $ta)
                                                <option value='{{ $ta->id }}' class="dropdown-violation-year-graphic" violation-academic-year-id-graphic="{{$ta->id}}">
                                                    {{ $ta->TYPE}}{{" - "}}{{ $ta->NAME }}
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
                                <h1 class="panel-title">CATATAN PENGHARGAAN SISWA</h1>
                            </div>
                            <div class="panel-heading">                                
                                <h5 class="panel-title"><b>TAHUN AJARAN:</b>
                                    <span>
                                        <div class="btn-group">
                                            <select type="button" id="selector-dropdown-achievement-year" class="btn btn-default dropdown-toggle">
                                                @foreach($tahun_ajaran as $ta)
                                                    <option value='{{ $ta->id }}' class="dropdown-achievement-year" achievement-academic-year-id="{{$ta->id}}">
                                                        {{ $ta->TYPE}}{{" - "}}{{ $ta->NAME }}
                                                    </option>                                                                        
                                                @endforeach
                                            </select>
                                        </div>
                                    </span>        
                                </h5>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-borderd">
                                        <thead>
                                            <tr>
                                                <th>TANGGAL</th>
                                                <th>TINGKAT</th>
                                                <th>DESKRIPSI</th>                                            
                                                <th>POIN</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-achievement-academic-year">
                                            @forelse($catatan_penghargaan as $cp)
                                            <tr>
                                                <td>{{ date('d-m-Y', strtotime($cp->DATE)) }}</td>
                                                <td>{{ $cp->GRADE }}</td>
                                                <td>{{ $cp->DESCRIPTION }}</td>
                                                <td>{{ $cp->POINT }}</td>
                                            </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="12" class="text-center p-5">Belum ada data catatan penghargaan</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>  
                        <div class="panel-heading">                                
                            <h5 class="panel-title"><b>TAHUN AJARAN:</b>
                                <span>
                                    <div class="btn-group">
                                        <select type="button" id="select-dropdown-academicyear-graph-achievement" class="btn btn-default dropdown-toggle">
                                            @foreach($tahun_ajaran as $ta)
                                                <option value='{{ $ta->id }}' class="dropdown-achievement-year-graphic" achievement-academic-year-id-graphic="{{$ta->id}}">
                                                    {{ $ta->TYPE}}{{" - "}}{{ $ta->NAME }}
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
                                <h1 class="panel-title">CATATAN PRESENSI SISWA</h1>
                            </div>
                            <div class="panel-heading">                                
                                <h5 class="panel-title"><b>TAHUN AJARAN:</b>
                                    <span>
                                        <div class="btn-group">
                                            <select type="button" id="selector-dropdown-absent-year" class="btn btn-default dropdown-toggle">
                                                @foreach($tahun_ajaran as $ta)
                                                    <option value='{{ $ta->id }}' class="dropdown-absent-year" absent-academic-year-id="{{$ta->id}}">
                                                        {{ $ta->TYPE}}{{" - "}}{{ $ta->NAME }}
                                                    </option>                                                                        
                                                @endforeach
                                            </select>
                                        </div>
                                    </span>        
                                </h5>
                            </div>
                        
                            <div class="panel-body">
                                <table id="example1" class="table table-striped table-bordered">    
                                    <thead>
                                        <tr>
                                            <th>TIPE</th>
                                            <th>DESKRIPSI</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-absent-academic-year">
                                        @forelse($catatan_absen as $ca)
                                        <tr>
                                            <td>{{ $ca->TYPE }}</td>
                                            <td>{{ $ca->TOTAL }}{{" "}}{{"HARI"}}</td>
                                            <td>
                                                <button type="button" 
                                                        class="btn btn-primary btn-sm button-detail" 
                                                        data-toggle="modal" 
                                                        data-target="#detailAbsentModal" 
                                                        absent-type="{{$ca->TYPE}}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="12" class="text-center p-5">Belum ada data presensi</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel-heading">                                
                            <h5 class="panel-title"><b>TAHUN AJARAN:</b>
                                <span>
                                    <div class="btn-group">
                                        <select type="button" id="select-dropdown-academicyear-graph-absent" class="btn btn-default dropdown-toggle">
                                            @foreach($tahun_ajaran as $ta)
                                                <option value='{{ $ta->id }}' class="dropdown-absent-year-graphic" absent-academic-year-id-graphic="{{$ta->id}}">
                                                    {{ $ta->TYPE}}{{" - "}}{{ $ta->NAME }}
                                                </option>                                                                        
                                            @endforeach
                                        </select>
                                    </div>
                                </span>        
                            </h5>
                        </div>                        
                        <div class="panel-body">
                            <div id="chartAbsent">

                            </div>
                        </div>
                    </div>

                    <!-- Modal Detail Absen-->
                    <div class="modal fade" id="modalAbsentDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title" id="exampleModalLabel">DETAIL PRESENSI: <b>{{$siswa->FNAME}}{{" "}}{{$siswa->LNAME}}</b></h1>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table id="table-absent-detail" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>TIPE</th>
                                                <th>TANGGAL AWAL</th>
                                                <th>TANGGAL AKHIR</th>
                                                <th>DESKRIPSI</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-absent-detail">
                                            <tr>
                                                <td>X</td>
                                                <td>X</td>
                                                <td>X</td>
                                                <td>X</td>
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
   
    $('#selector-dropdown-violation-year').val({{$academic_year_id}})

    $('#selector-dropdown-violation-year').change(function(){
        var academicYearId = $(this).val();

        $.ajax({
            url: '{{ route("violationrecord.academicYearAjax") }}',
            type: 'get',
            data: {academicYearId: academicYearId, studentId: studentId},

            success: function(result){
                $('#tbody-violation-academic-year').empty()
                
                result.forEach(function(obj){
                    $('#tbody-violation-academic-year').append(                        
                        `
                        <tr>
                            <td>${obj.DATE}</td>
                            <td>${obj.NAME}</td>
                            <td>${obj.DESCRIPTION}</td>
                            <td>${obj.PUNISHMENT}</td>
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

    $('#selector-dropdown-achievement-year').val({{$academic_year_id}})

    $('#selector-dropdown-achievement-year').change(function(){
        var academicYearId = $(this).val();

        $.ajax({
            url: '{{ route("achievement.academicYearAjax") }}',
            type: 'get',
            data: {academicYearId: academicYearId, studentId: studentId},

            success: function(result){
                $('#tbody-achievement-academic-year').empty()

                result.forEach(function(obj){
                    console.log(result)
                    $('#tbody-achievement-academic-year').append(
                        `
                        <tr>
                            <td>${obj.DATE}</td>
                            <td>${obj.GRADE}</td>
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

    $('#selector-dropdown-absent-year').val({{ $academic_year_id }})

    $('#selector-dropdown-absent-year').change(function(){
        var academicYearId = $(this).val();
        
        $.ajax({
            url: '{{ route("absent.academicYearAjax") }}',
            type: 'get',
            data: {academicYearId: academicYearId, studentId: studentId},

            success: function(result){
                $('#tbody-absent-academic-year').empty()
                result.forEach(function(obj){
                    $('#tbody-absent-academic-year').append(
                        `
                        <tr>
                            <td>${obj.TYPE}</td>
                            <td>${obj.TOTAL} HARI</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm button-detail" data-toggle="modal" data-target="#detailAbsentModal" absent-type=${obj.TYPE}><i class="fa fa-eye"></i></button>
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

    $('#tbody-absent-academic-year').on('click', '.button-detail', (function(){
        var absentType = $(this).attr('absent-type');
        var academicYearId = $('#selector-dropdown-absent-year').val();
        // console.log(academicYearId)
        $.ajax({
            url: '{{route("student.detailAbsent")}}', 
            type: 'get', 
            data: {studentId: studentId, absentType: absentType, academicYearId: academicYearId},

            success: function(result){
                $('#tbody-absent-detail').empty()
                
                result.forEach(function(obj){
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
                $('#modalAbsentDetail').modal('show')
            },
            error: function(err){
                console.log(err)
            }
        })
    }))

    // TAB VIOLATION GRAFIK

    $('#select-dropdown-academicyear-graph-violation').val({{$academic_year_id}})

    $('#select-dropdown-academicyear-graph-violation').change(function(){
        var academicYearId = $(this).val();
        // window.location = "{{ route('student.profile', ['id'=>$siswa->id]) }}"+"?academicYearId="+academicYearId;
        $.ajax({
            url: '{{ route("student.violationChart") }}',
            type: 'get',
            data: {academicYearId: academicYearId, studentId: studentId},

            success: function(result){
                console.log(result)
                chartViolation(result['category'], result['dataViolation'], result['selected_tahun_ajaran'])
            },
            error: function(err){
                console.log(err)
            }
        })
    })
    
    var categories = {!!json_encode($kategori)!!}
    var dataGraph = {!!json_encode($data)!!}
    var selectedTahunAjaran = {!!json_encode($selected_tahun_ajaran)!!}

    chartViolation(categories, dataGraph, selectedTahunAjaran)

    function chartViolation(types, dataGraph, selecetedTahunAjaran){
        $("#chartViolation").empty()

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

        Highcharts.setOptions({
            colors: ['#F21402', '#D1EE18', '#000000']
        });
        
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
                allowDecimals: false,
                title: {
                    text: 'JUMLAH PELANGGARAN TERCATAT'
                }
            },
            credits: {
                enabled: false,
            },
            plotOptions: {
                column: {
                    pointPadding: 0.08,
                    borderWidth: 0
                }
            },
            series: dataSeries
        });         
    }
    
    // TAB ACHIEVEMENT GRAFIK
    
    $('#select-dropdown-academicyear-graph-achievement').val({{$academic_year_id}})

    $('#select-dropdown-academicyear-graph-achievement').change(function(){
        var academicYearId = $(this).val();
        $.ajax({
            url: '{{ route("student.achievementChart") }}',
            type: 'get',
            data: {academicYearId: academicYearId, studentId: studentId},

            success: function(result){
               // console.log(result)
               chartAchievement(result['type'], result['dataAchievement'], result['selected_tahun_ajaran'])

            },
            error: function(err){
                console.log(err)
            }
        })
    })

    var types = {!!json_encode($type)!!}
    var dataGraph = {!!json_encode($dataAchievement)!!}
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
                dataCategory.push('Bulan '+ i)
            }
            
            dataGraph.forEach(function(obj){
                if(obj.TINGKAT == item.TINGKAT){
                    values[obj.BULAN - startMonth] = obj.JUMLAH
                }
            })

            dataSeries.push({
                name: item.TINGKAT,
                data: values
            })
        })

        // console.log(dataSeries)
        Highcharts.setOptions({
            colors: ['#fc0202', '#3fe13a', '#e9eb6a', '#4e45d5']
        });
        
        Highcharts.chart('chartAchievement', {
            chart: {
                type: 'column'
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

    // TAB ABSENT GRAFIK

    $('#select-dropdown-academicyear-graph-absent').val({{$academic_year_id}})

    $('#select-dropdown-academicyear-graph-absent').change(function(){
        var academicYearId = $(this).val();
        $.ajax({
            url: '{{ route("student.absentChart") }}',
            type: 'get',
            data: {academicYearId: academicYearId, studentId: studentId},

            success: function(result){
            //    console.log(result)
               chartAbsent(result['type'], result['dataAbsent'], result['count_total_day_each_ay'])
            },
            error: function(err){
                console.log(err)
            }
        })
    })
    
    var types = {!!json_encode($tipeAbsen)!!}
    var dataGraph = {!!json_encode($dataAbsen)!!}
    var totalDayEachAcademicYear = {!! json_encode($count_total_day_each_ay) !!}

    chartAbsent(types, dataGraph, totalDayEachAcademicYear)

    function chartAbsent(types, dataGraph, totalDayEachAcademicYear){
        $('#chartAbsent').empty()

        var totalAmountExceptPresent = 0
        var present_percentage = 0

        var dataSeries = []
        var obj_present = {}
        
        types.forEach(function(item){   
            dataGraph.forEach(function(obj){        
                if(obj.TIPE == item.TIPE){
                    dataSeries.push({
                        name: item.TIPE,
                        y: obj.JUMLAH
                    })

                    totalAmountExceptPresent = totalAmountExceptPresent + obj.JUMLAH
                    present_percentage = totalDayEachAcademicYear - totalAmountExceptPresent                   
                } 
            })            
        })

        if(Array.isArray(dataGraph) == dataGraph.length){
            obj_present = {name: 'PRESENT', y: present_percentage, sliced: true, selected: true}        
            dataSeries.push(obj_present)    

            Highcharts.setOptions({
                colors: ['#F21402', '#2ECC71 ', '#E4F202 ', '#2874A6']
            });       
        }
        else {
            obj_present = {name: 'PRESENT', y: totalDayEachAcademicYear, sliced: true, selected: true}        
            dataSeries.push(obj_present)                 

            Highcharts.setOptions({
                colors: ['#2874A6']
            });
        }
        
        Highcharts.chart('chartAbsent', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            credits: {
                enabled: false
            },
            title: {
                text: 'PERSENTASE PRESENSI DALAM SATU PERIODE BERDASARKAN JENIS ABSENSI'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Persentase',
                colorByPoint: true,
                data: dataSeries
            }]
        });
    }
    
</script>
@Stop


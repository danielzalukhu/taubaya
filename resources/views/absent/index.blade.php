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
                            <h3 class="box-title"></h3>            
                        </div>                        
                        <div class="box box-info">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>                    
                            <div class="panel-heading">                                
                                <h5 class="panel-title"><b>TAHUN AJARAN:</b>
                                    <span>
                                        <div class="btn-group">
                                            <select type="button" id="selector-dropdown-absentrecord-year" class="btn btn-default dropdown-toggle">
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
                                <div id="absentChartStatistic"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="panel-heading">
                            <h3 class="box-title">DAFTAR ABSEN</h3>            
                        </div>
                        <div class="box">
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            @if(Auth::guard('web')->user()->staff->ROLE === "TEACHER")
                                                <th>#</th>
                                                <th>TIPE ABSEN</th>
                                                <th>TOTAL KETIDAKHADIRAN</th>
                                                <th></th>
                                            @else
                                                <th>#</th>                                                
                                                <th>NAMA KELAS</th>
                                                <th>TOTAL KETIDAKHADIRAN</th>
                                                <th></th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-daftar-absen">
                                    @php $i=1 @endphp
                                    @foreach($catatan_absen as $ca)
                                        <tr>
                                            @if(Auth::guard('web')->user()->staff->ROLE === "TEACHER")
                                                <td>{{$i++}}</td>
                                                <td>{{$ca->TYPE}}</td>
                                                <td>{{$ca->ABSENPERTIPE}}</td>
                                                <td>
                                                    <button type="button" 
                                                            class="btn btn-primary btn-sm button-detail-tipe-absen" 
                                                            data-toggle="modal" 
                                                            data-target="#detailAbsentByType" 
                                                            grade-id="{{$ca->GRADES_ID}}"
                                                            absent-type="{{$ca->TYPE}}">
                                                        <i class="fa fa-eye"></i>
                                                    </button>                                          
                                                </td>
                                            @else
                                                <td>{{$i++}}</td>
                                                <td>{{$ca->NAMAKELAS}}</td>
                                                <td>{{$ca->TOTALKETIDAKHADIRANPERKELAS}}</td>
                                                <td>
                                                    <button type="button" 
                                                            class="btn btn-primary btn-sm button-detail-absen-per-kelas" 
                                                            data-toggle="modal" 
                                                            data-target="#detailAbsentEachGrade" 
                                                            grade-id="{{$ca->GRADES_ID}}">
                                                        <i class="fa fa-eye"></i>
                                                    </button>                                          
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Absen PER Kelas-->
                    <div class="modal fade bd-example-modal-lg" id="modalAbsentEachGrade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title" id="modalTitle">DAFTAR ABSEN KELAS</b></h1>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table id="table-absent-each-grade-list" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>TIPE ABSENSI</th>
                                                <th>JUMLAH KETIDAKHADIRAN/TIPE</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-absent-each-grade-list">
                                            <tr>
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

                    <!-- Modal Detail Absen PER Tipe-->
                    <div class="modal fade bd-example-modal-lg" id="modalDetailAbsentEachType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title" id="modalTitle">DETAIL ABSEN</b></h1>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table id="table-absent-each-grade-list" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>NAMA SISWA</th>
                                                <th>TIPE ABSENSI</th>
                                                <th>TAHUN AJARAN</th>
                                                <th>TANGGAL AWAL</th>
                                                <th>TANGGAL AKHIR</th>
                                                <th>KETERANGAN</th>
                                                @if(Auth::guard('web')->user()->staff->ROLE != "HEADMASTER")
                                                    <th></th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-detail-absent-each-type-list">
                                            <tr>
                                                <td>X</td>
                                                <td>X</td>
                                                <td>X</td>
                                                <td>X</td>
                                                <td>X</td>
                                                <td>X</td>
                                                <td>X</td>
                                                <td></td>
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
    </div>
@stop

@section('footer')
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
    // ROLE TEACHER
    $('#tbody-daftar-absen').on('click', '.button-detail-tipe-absen', (function(){
        var absentType = $(this).attr('absent-type')
        var gradeId = $(this).attr('grade-id')
        var academicYearId = $('#selector-dropdown-absentrecord-year').val()
        $.ajax({
            url: '{{ route("absent.detailAbsentEachType") }}',
            type: 'get',
            data: {absentType: absentType, gradeId: gradeId, academicYearId: academicYearId},

            success: function(result){
                $('#tbody-detail-absent-each-type-list').empty()            

                result.forEach(function(obj){
                    var route =  "{{ route('absent.edit', ':id') }}"  
                    route = route.replace(':id', `${obj.id}`)
                    
                    var route_del = "{{ route ('absent.destroy', ':id' )}}"
                    route_del = route_del.replace(':id', `${obj.id}`)

                    $('#tbody-detail-absent-each-type-list').append(
                        `
                        <tr>
                            <td style="width: 30px">${obj.id}</td>
                            <td style="width: 110px">${obj.FNAME} ${obj.LNAME}</td>
                            <td style="width: 80px">${obj.TYPE}</td>
                            <td style="width: 100px">${obj.TIPETHNAJARAN}-${obj.NAME}</td>
                            <td style="width: 75px">${obj.START_DATE}</td>
                            <td style="width: 75px">${obj.END_DATE}</td>
                            <td style="width: 150px">${obj.DESCRIPTION}</td>      
                            <td style="width: 70px">                            
                                <a href=${route}  class="btn btn-warning btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <form action=${route_del} method="POST" class="inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" value="DELETE">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>                      
                        </tr>
                        `
                    )
                })
                $('#modalDetailAbsentEachType').modal('show')
            },
            error: function(err){
                console.log(err)
            }
        })
    }))
    // END ROLE

    // ROLE HEADMASTER
    $('#tbody-daftar-absen').on('click', '.button-detail-absen-per-kelas', (function(){
        var gradeId = $(this).attr('grade-id');       
        var academicYearId = $('#selector-dropdown-absentrecord-year').val()

        $.ajax({
            url: '{{ route("absent.absentEachGrade") }}',
            type: 'get',
            data: {gradeId: gradeId, academicYearId: academicYearId},

            success: function(result){
                $('#tbody-absent-each-grade-list').empty()
            
                result.forEach(function(obj){
                    $('#tbody-absent-each-grade-list').append(
                        `
                        <tr>
                            <td style="width: 50px">${obj.TYPE}</td>
                            <td style="width: 50px">${obj.ABSENPERTIPE}</td>
                            <td style="width: 50px">                            
                                <button type="button" 
                                        class="btn btn-primary btn-sm button-detail" 
                                        absent-type=${obj.TYPE} 
                                        grade-id=${obj.GRADES_ID}>
                                            <i class="fa fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        `
                    )                    
                })
                $('#modalAbsentEachGrade').modal('show')
            },
            error: function(err){
                console.log(err)
            }
        })
    }))

    $('#tbody-absent-each-grade-list').on('click', '.button-detail', (function(){
        var absentType = $(this).attr('absent-type')
        var gradeId = $(this).attr('grade-id')
        var academicYearId = $('#selector-dropdown-absentrecord-year').val()
        
        $.ajax({
            url: '{{ route("absent.detailAbsentEachType") }}',
            type: 'get',
            data: {absentType: absentType, gradeId: gradeId, academicYearId: academicYearId},

            success: function(result){
                $('#tbody-detail-absent-each-type-list').empty()            
                
                result.forEach(function(obj){
                    $('#tbody-detail-absent-each-type-list').append(
                        `
                        <tr>
                            <td style="width: 30px">${obj.id}</td>
                            <td style="width: 110px">${obj.FNAME} ${obj.LNAME}</td>
                            <td style="width: 80px">${obj.TYPE}</td>
                            <td style="width: 100px">${obj.TIPETHNAJARAN}-${obj.NAME}</td>
                            <td style="width: 75px">${obj.START_DATE}</td>
                            <td style="width: 75px">${obj.END_DATE}</td>
                            <td style="width: 150px">${obj.DESCRIPTION}</td>                           
                        </tr>
                        `
                    )
                })
                $('#modalDetailAbsentEachType').modal('show')
            },
            error: function(err){
                console.log(err)
            }
        })
    }))
    // END ROLE

    $('#selector-dropdown-absentrecord-year').change(function(){
        var academicYearId = $(this).val()
        window.location = "{{ route('absent.index') }}"+"?academicYearId="+academicYearId;
    })

    $('#selector-dropdown-absentrecord-year').val({{$academic_year_id}})

    var types = {!! json_encode($type) !!}
    var dataGraph = {!! json_encode($data) !!}
    var totalDayEachAcademicYear = {!! json_encode($count_total_day_each_ay) !!}
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
    }
    else {
        obj_present = {name: 'PRESENT', y: totalDayEachAcademicYear, sliced: true, selected: true}        
        dataSeries.push(obj_present)      
    }  
    
    Highcharts.setOptions({
        colors: ['#F21402', '#2ECC71 ', '#E4F202 ', '#2874A6']
    });
    
    Highcharts.chart('absentChartStatistic', {
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
            text: 'PERSENTASE ABSENSI DALAM SATU PERIODE BERDASARKAN JENIS ABSENSI'
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
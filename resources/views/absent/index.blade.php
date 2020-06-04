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
                                            <th>#</th>
                                            <th>NAMA SISWA</th>
                                            <th>ALASAN</th>
                                            <th colspan="2">TANGGAL</th>
                                            <th>DESKRIPSI</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1 @endphp
                                    @foreach($absen as $a)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$a->student->FNAME }}{{" "}}{{$a->student->LNAME}}</td>
                                            <td>{{$a->TYPE}}</td>
                                            <td>{{date('d-m-Y', strtotime($a->START_DATE))}}</td>
                                            <td>{{date('d-m-Y', strtotime($a->END_DATE))}}</td>                                            
                                            <td>{{$a->DESCRIPTION}}</td>
                                            <td>
                                                <a href="{{ route ('absent.edit', $a->id )}}" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <form action="{{ route ('absent.destroy', $a->id )}}" method="POST" class="inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" value="DELETE">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>                                            
                                            </td>
                                        </td>
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
    
    console.log(totalDayEachAcademicYear)
    console.log(totalAmountExceptPresent)
    console.log(present_percentage)
    console.log(dataSeries)
    console.log(obj_present)

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
            name: 'JENIS ABSEN',
            colorByPoint: true,
            data: dataSeries
        }]
    });
</script>
@stop
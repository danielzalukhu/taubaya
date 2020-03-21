@extends('layout.master')

@section('header')
  <!-- DataTables -->
  <link rel="stylesheet" href="adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
                                <h5 class="panel-title"><b>ACADEMIC YEAR:</b>
                                    <span>
                                        <div class="btn-group">
                                            <select type="button" id="selector-dropdown-absentrecord-year" class="btn btn-default dropdown-toggle">
                                                @foreach($tahun_ajaran as $ta)
                                                    <option value='{{ $ta->id }}' class="dropdown-academic-year" academic-year-id="{{$ta->id}}">
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

                            <div class="box-body">
                                <div id="absentChartStatistic">

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="panel-heading">
                            <h3 class="box-title">ABSENT LIST</h3>            
                        </div>
                        <div class="box">
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th colspan="2">DATE</th>
                                            <th>STUDENT NAME</th>
                                            <th>REASON</th>
                                            <th>DESCRIPTION</th>
                                            <th>NOTED BY</th>
                                            <th>EDIT</th>
                                            <th>DELETE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($absen as $a)
                                        <tr>
                                            <td>{{date('d-m-Y', strtotime($a->START_DATE))}}</td>
                                            <td>{{date('d-m-Y', strtotime($a->END_DATE))}}</td>
                                            <td>{{$a->student->FNAME }}{{" "}}{{$a->student->LNAME}}</td>
                                            <td>{{$a->TYPE}}</td>
                                            <td>{{$a->DESCRIPTION}}</td>
                                            <td>{{$a->staff->NAME}}</td>
                                            <td><a href= "{{ route ('absent.edit', $a->id )}}" class="btn btn-primary btn-sm">EDIT</td>
                                            <td>
                                                <form action="{{ route ('absent.destroy', $a->id )}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    {{ method_field("DELETE" )}}
                                                    {{ csrf_field() }}
                                                    <input type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" value="DELETE">
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
        //console.log(academicYearId)
        window.location = "{{ route('absent.index') }}"+"?academicYearId="+academicYearId;
    })

    $('#selector-dropdown-absentrecord-year').val({{$academic_year_id}})

    var types = {!!json_encode($type)!!}
    var dataGraph = {!!json_encode($datas)!!}
    console.log(dataGraph)

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

    // console.log(countDay)

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
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'TYPE',
            colorByPoint: true,
            data: dataSeries
        }]
    });
</script>
@stop

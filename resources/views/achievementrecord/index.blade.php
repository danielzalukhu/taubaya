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
                                            <select type="button" id="selector-dropdown-achievementrecord-year" class="btn btn-default dropdown-toggle">
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
                                <div id="achievementChartStatistic">

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="panel-heading">
                            <h3 class="box-title">STUDENT ACHIEVEMENT LIST</h3>            
                        </div>
                        <div class="box">
                            <div class="box-header">
                                <div class="right">
                                    <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#exampleModal">CREATE NEW</button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>STUDENT NAME</th>
                                            <th>DATE</th>
                                            <th>ACHIVEMENT NAME</th>
                                            <th>DESCRIPTION</th>
                                            <th>RANK</th>
                                            <th>EDIT</th>
                                            <th>DELETE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($catatan_penghargaan as $cp)
                                        <tr>
                                            <td>{{$cp->student->FNAME}}{{" "}}{{$cp->student->LNAME}}</td>
                                            <td>{{date('d-m-Y', strtotime($cp->DATE))}}</td>
                                            <td>{{$cp->achievement->TYPE}}{{" - "}}{{$cp->achievement->DESCRIPTION}}</td>
                                            <td>{{$cp->DESCRIPTION}}</td>
                                            <td>{{$cp->RANK}}</td>
                                            <td><a href= "{{ route ('achievementrecord.edit', $cp->id )}}" class="btn btn-primary btn-sm">EDIT</td>
                                            <td>
                                                <form action="{{ route ('achievementrecord.destroy', $cp->id )}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    {{ method_field("DELETE" )}}
                                                    {{ csrf_field() }}
                                                    <input type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" value="DELETE">
                                                </form>
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

    <!-- Modal Create New-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">RECORD STUDENT ACHIEVEMENT</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('achievementrecord.store') }}" method="post"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <div class="form-group{{ $errors->has('ar_student_name') ? 'has-error' : '' }} ">
                            <label>Student Name</label>
                            <select name="ar_student_name" class="form-control" id="inputGroupSelect01">
                                @foreach($siswa as $s)
                                    <option value='{{ $s->id }}'>{{ $s->FNAME }}{{" "}}{{$s->LNAME}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('a_type'))
                                <span class="help-block">{{$errors->first('ar_student_name')}}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('ar_date') ? 'has-error' : '' }} ">
                            <label>Date</label>
                            <input name="ar_date" type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('ar_date')}}">            
                            @if($errors->has('ar_date'))
                                <span class="help-block">{{$errors->first('ar_date')}}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('ar_academic_year') ? 'has-error' : '' }} ">
                            <label>Academic Year</label>
                            <select name="ar_academic_year" class="form-control" id="inputGroupSelect01">
                                @foreach($tahun_ajaran as $ta)
                                    <option value='{{ $ta->id }}'>
                                        {{ $ta->TYPE}}
                                        {{ " - " }}
                                        {{ strtok($ta->START_DATE, '-') }}
                                        {{ " / " }}
                                        {{ strtok($ta->END_DATE, '-') }}
                                    </option>                                                                        
                                @endforeach
                            </select>
                            @if($errors->has('ar_academic_year'))
                                <span class="help-block">{{$errors->first('ar_academic_year')}}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('ar_achievement_name') ? 'has-error' : '' }} ">
                            <label>Achievement Name</label>
                            <select name="ar_achievement_name" class="form-control" id="inputGroupSelect01">
                                @foreach($penghargaan as $p)
                                    <option value='{{ $p->id }}'>{{$p->TYPE}}{{" - "}}{{ $p->DESCRIPTION }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('ar_achievement_name'))
                                <span class="help-block">{{$errors->first('ar_achievement_name')}}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('ar_desc') ? 'has-error' : '' }} ">
                            <label>Description</label>            
                            <textarea name="ar_desc" class="form-control" id="exampleFormControlTextarea1" rows="3">{{old('ar_desc')}}</textarea>
                            @if($errors->has('ar_desc'))
                                <span class="help-block">{{$errors->first('ar_desc')}}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('ar_rank') ? 'has-error' : '' }} ">
                            <label>Rank</label>
                            <input name="ar_rank"type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('ar_rank')}}">            
                            @if($errors->has('ar_rank'))
                                <span class="help-block">{{$errors->first('ar_rank')}}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('ar_noted_by') ? 'has-error' : '' }} ">
                            <label>Noted By</label>
                            <select name="ar_noted_by" class="form-control" id="inputGroupSelect01">
                                @foreach($karyawan as $k)
                                    <option value='{{ $k->id }}'>{{ $k->NAME }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('ar_noted_by'))
                                <span class="help-block">{{$errors->first('ar_noted_by')}}</span>
                            @endif
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
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
    
    $('#selector-dropdown-achievementrecord-year').change(function(){
        var academicYearId = $(this).val()
        // console.log(academicYearId)

        window.location = "{{ route('achievementrecord.index') }}"+"?academicYearId="+academicYearId;
    })

    $('#selector-dropdown-achievementrecord-year').val({{$academic_year_id}})

    var types = {!!json_encode($type)!!}
    var dataGraph = {!!json_encode($data)!!}
    var selectedTahunAjaran = {!!json_encode($selected_tahun_ajaran)!!}
    // console.log(dataGraph)

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

    // console.log(dataSeries)

    Highcharts.chart('achievementChartStatistic', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'STATISTIK PENGHARGAAN YANG TERCATAT BERDASARKAN JENIS PENGHARGAAN'
        },
        xAxis: {
            categories: dataCategory,
            crosshair: true
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
            enabled: false,
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false,
                pointPadding: 0.1,
                borderWidth: 0
            }
        },
        series: dataSeries
    });
</script>
@stop
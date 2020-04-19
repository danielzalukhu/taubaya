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
                @elseif(session('error'))
                    <div class="alert alert-warning" role="alert">
                        {{ session('error') }}
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
                                            <select type="button" id="selector-dropdown-violationrecord-year" class="btn btn-default dropdown-toggle">
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
                                <div id="violationChartStatistic">

                                </div>
                            </div>

                            

                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="panel-heading">
                            <h3 class="box-title">DAFTAR CATATAN PELANGGARAN SISWA</h3>            
                        </div>
                        <div class="box">
                            <div class="box-header">
                                @if(Auth::guard('web')->user()->ROLE === "STAFF")
                                <div class="right">
                                    <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#exampleModal">BUAT CATATAN PELANGGARAN</button>
                                </div>
                                @endif
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NAMA SISWA</th>
                                        <th>TANGGAL</th>
                                        <th>TAHUN AJARAN</th>
                                        <th>NAMA PELANGGARAN</th>
                                        <th>HUKUMAN</th>
                                        <th>POIN</th>
                                        <th>AKSI</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1 @endphp
                                    @foreach($catatan_pelanggaran as $cp)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td><a href="{{ route('student.profile', ['id'=>$cp->student->id]) }}">{{$cp->student->FNAME}}{{" "}}{{$cp->student->LNAME}}</td>
                                            <td>{{date('d-m-Y', strtotime($cp->DATE))}}</td>
                                            <td>
                                                {{$cp->academicyear->TYPE}}
                                                {{ " - " }}
                                                {{$cp->academicyear->NAME}}
                                            </td>
                                            <td>{{$cp->violation->DESCRIPTION}}</td>
                                            <td>{{$cp->PUNISHMENT}}</td>
                                            <td>{{$cp->TOTAL}}</td>
                                            <td>
                                                <a href="{{ route ('violationrecord.edit', $cp->id )}}" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <form action="{{ route ('violationrecord.destroy', $cp->id )}}" method="POST" class="inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" value="DELETE">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
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
                    <h1 class="modal-title" id="exampleModalLabel">BUAT CATATAN PELANGGARAN</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('violationrecord.store') }}" method="post"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group{{ $errors->has('vr_date') ? 'has-error' : '' }} ">
                            <label>Tanggal</label>
                            <input name="vr_date" type="date" class="form-control input-violation-date" aria-describedby="emailHelp" value="{{old('vr_date')}}">            
                            @if($errors->has('vr_date'))
                                <span class="help-block">{{$errors->first('vr_date')}}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('vr_student_name') ? 'has-error' : '' }} ">
                            <label>Nama Siswa</label>
                            <select name="vr_student_name" class="form-control" id="inputGroupSelect01">
                                @foreach($siswa as $s)
                                    <option value='{{ $s->id }}'>{{ $s->FNAME }}{{" "}}{{$s->LNAME}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('a_type'))
                                <span class="help-block">{{$errors->first('vr_student_name')}}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('vr_violation_name') ? 'has-error' : '' }} ">
                            <label>Nama Pelanggaran</label>
                            <select name="vr_violation_name" class="form-control" id="inputGroupSelect01">
                                @foreach($pelanggaran as $p)
                                    <option value='{{ $p->id }}'>{{$p->NAME}}{{" - "}}{{ $p->DESCRIPTION }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('vr_violation_name'))
                                <span class="help-block">{{$errors->first('vr_violation_name')}}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('vr_desc') ? 'has-error' : '' }} ">
                            <label>Deskripsi</label>            
                            <textarea name="vr_desc" class="form-control" id="exampleFormControlTextarea1" rows="3">{{old('vr_desc')}}</textarea>
                            @if($errors->has('vr_desc'))
                                <span class="help-block">{{$errors->first('vr_desc')}}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('vr_punishment') ? 'has-error' : '' }} ">
                            <label>Hukuman</label>
                            <textarea name="vr_punishment" class="form-control" id="exampleFormControlTextarea1" rows="3">{{old('vr_punishment')}}</textarea>
                            @if($errors->has('vr_punishment'))
                                <span class="help-block">{{$errors->first('vr_punishment')}}</span>
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
     
    $('#selector-dropdown-violationrecord-year').change(function(){
        var academicYearId = $(this).val()
        // console.log(academicYearId)

        window.location = "{{ route('violationrecord.index') }}"+"?academicYearId="+academicYearId;
    })
    
    $('#selector-dropdown-violationrecord-year').val({{$academic_year_id}})
    
    var categories = {!!json_encode($kategori)!!}
    var dataGraph = {!!json_encode($data)!!}
    var selectedTahunAjaran = {!!json_encode($selected_tahun_ajaran)!!}
    // console.log(dataGraph);

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

    console.log(dataCategory)

    
    Highcharts.chart('violationChartStatistic', {
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
</script>
@stop
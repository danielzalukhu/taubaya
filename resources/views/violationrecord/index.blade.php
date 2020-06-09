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

                    <div class="col-xs-4">
                        <div class="panel-heading">
                            <h3 class="box-title">PERSENTASE PELANGGARAN</h3>            
                        </div>
                        <div class="box">
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>KATEGORI</th>
                                                <th>JUMLAH</th>
                                                <th>PERSENTASE (%)</th>           
                                                <th></th>                                     
                                            </tr>
                                        </thead>
                                    <tbody id="tbody-persentase-pelanggaran">
                                        @php $i=1 @endphp
                                        @foreach($catatan_pelanggaran["data"] as $cp)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{ $cp->KATEGORI }}</td>
                                                <td>{{ $cp->JUMLAH }}</td>
                                                <td>%</td>
                                                <td>
                                                    <button type="button" 
                                                            class="btn btn-primary btn-sm button-detail-persentase" 
                                                            data-toggle="modal" 
                                                            data-target="#violationRecordList" 
                                                            violation-category="{{$cp->KATEGORI}}">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach                                        
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-8" id="detail-pelanggaran-berdasarkan-kategori">
                        <div class="panel-heading">
                            <h3 class="box-title">DETAIL PELANGGARAN BERDASARKAN KATEGORI</h3>            
                        </div>
                        <div class="box">
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>KODE PELANGGARAN</th>
                                                <th>NAMA PELANGGARAN</th>   
                                                <th></th>                                             
                                            </tr>
                                        </thead>
                                    <tbody id="tbody-detail-pelanggaran-berdasarkan-kategori">
                                       
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                     <!-- Modal Detail Daftar Pelanggaran Tercatat-->
                     <div class="modal fade" id="modalViolationRecordDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title" id="exampleModalLabel">DAFTAR PELANGGARAN TERCATAT</b></h1>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table id="table-violation-record-detail" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>NAMA SISWA</th>
                                                <th>TANGGAL</th>
                                                <th>TAHUN AJARAN</th>
                                                <th>HUKUMAN</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-violation-record">
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

                    <div class="col-xs-12">
                        <div class="panel-heading">
                            <h3 class="box-title">DAFTAR CATATAN PELANGGARAN SISWA</h3>            
                        </div>
                        <div class="box">
                            <div class="box-header">
                                @if(Auth::guard('web')->user()->staff->ROLE === "TEACHER")
                                    <div class="right">
                                        <a href="{{ route('violationrecord.create') }}" type="button" class="btn btn-primary btn-sm pull-right">BUAT DAFTAR PENGHARGAAN</a>
                                    </div>
                                @elseif(Auth::guard('web')->user()->staff->ROLE === "ADVISOR")                                    
                                    <div class="right">
                                        <a href="{{ route('violationrecord.create') }}" type="button" class="btn btn-primary btn-sm pull-right">BUAT DAFTAR PENGHARGAAN</a>
                                    </div>
                                @else

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
                                        @if(Auth::guard('web')->user()->staff->ROLE === "TEACHER")
                                            <th></th>   
                                        @elseif(Auth::guard('web')->user()->staff->ROLE === "ADVISOR")                                                
                                            <th></th>       
                                        @elseif(Auth::guard('web')->user()->staff->ROLE === "ADMIN")                                                
                                            <th></th>                                                                                          
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1 @endphp
                                    @foreach($catatan_pelanggaran["pelanggaran"] as $cp)
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
                                            @if(Auth::guard('web')->user()->staff->ROLE != "HEADMASTER")
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
                                            @endif
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
     
    $('#detail-pelanggaran-berdasarkan-kategori').hide();
    
    $('#tbody-persentase-pelanggaran').on('click', '.button-detail-persentase', (function(){
        var x = $(this).attr('violation-category')
        var res = x.split("")
        var violationName = res[0]
        
        $('#detail-pelanggaran-berdasarkan-kategori').show();
        
        $.ajax({
            url: '{{route("violationrecord.violationItem")}}', 
            type: 'get', 
            data: {violationName: violationName},

            success: function(result){
                $('#tbody-detail-pelanggaran-berdasarkan-kategori').empty()
                
                result.forEach(function(obj){
                    $('#tbody-detail-pelanggaran-berdasarkan-kategori').append(
                        `
                        <tr>                            
                            <td>${obj.NAME}</td>
                            <td>${obj.DESCRIPTION}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm button-detail" data-toggle="modal" data-target="#violationRecordList" violation-id=${obj.id}><i class="fa fa-eye"></i></button>
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

    }))

    $('#tbody-detail-pelanggaran-berdasarkan-kategori').on('click', '.button-detail', (function(){
        var violationId = $(this).attr('violation-id')

        $.ajax({
            url: '{{route("violationrecord.showViolationRecord")}}', 
            type: 'get', 
            data: {violationId: violationId},

            success: function(result){
                $('#tbody-violation-record').empty()
                
                result.forEach(function(obj){
                    $('#tbody-violation-record').append(
                        `
                        <tr>
                            <td>${obj.STUDENTS_ID}</td>
                            <td>${obj.DATE}</td>
                            <td>${obj.ACADEMIC_YEAR_ID}</td>
                            <td>${obj.PUNISHMENT}</td>
                        </tr>

                        `
                    )
                })
                $('#modalViolationRecordDetail').modal('show')
            },
            error: function(err){
                console.log(err)
            }
        })
    }))

    $('#selector-dropdown-violationrecord-year').change(function(){
        var academicYearId = $(this).val()        
        window.location = "{{ route('violationrecord.index') }}"+"?academicYearId="+academicYearId;
    })
    
    $('#selector-dropdown-violationrecord-year').val({{$academic_year_id}})

    var categories = {!!json_encode($kategori)!!}
    var dataGraph = {!!json_encode($data)!!}
    var selectedTahunAjaran = {!!json_encode($selected_tahun_ajaran)!!}

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
        colors: ['#F21402', '#028CF2 ', '#E4F202 ', '028CF2']
    });
    
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
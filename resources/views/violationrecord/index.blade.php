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
                                <div id="violationChartStatistic"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6" id="persentase-pelanggaran">
                        <div class="panel-heading">
                            <h3 class="box-title">PERSENTASE PELANGGARAN</h3>            
                        </div>
                        <div class="box box-warning">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                            <div class="panel-heading"></div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>KATEGORI</th>
                                                <th>JUMLAH TERCATAT</th>
                                                <th>PERSENTASE</th>           
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
                                                    <td>{{ $cp->PERSENTASE }} %</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-sm button-detail-persentase" 
                                                                violation-category="{{$cp->KATEGORI}}">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach                                        
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5"><i>*Keterangan: Persentase pelanggaran adalah berdasarkan jumlah pelanggaran 
                                                tercatat untuk setiap kategorinya yang dibagi dengan jumlah daftar pelanggaran yang berlaku</i></td>                                                
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6" id="detail-pelanggaran-berdasarkan-kategori">
                        <div class="panel-heading">
                            <h3 class="box-title">PELANGGARAN BERDASARKAN KATEGORI</h3>            
                        </div>
                        <div class="box box-warning">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                            <div class="panel-heading"></div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table  class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>KODE PELANGGARAN</th>
                                                <th>NAMA PELANGGARAN</th>   
                                                <th>JUMLAH TERJADI</th>
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
                     <div class="modal fade bd-example-modal-lg" id="modalViolationRecordDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title" id="modalTitle">DAFTAR PELANGGARAN TERCATAT</b></h1>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table id="table-violation-record-detail" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NAMA SISWA</th>
                                                <th>TANGGAL</th>
                                                <th>TAHUN AJARAN</th>
                                                <th>HUKUMAN</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-violation-record">
                                            <tr>
                                                <td>I</td>
                                                <td style="width: 90px">X</td>
                                                <td style="width: 20px">X</td>
                                                <td style="width: 60px">X</td>
                                                <td style="width: 110px">X</td>
                                            </tr>
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <div class="col-xs-12" id="daftar-catatan-pelanggaran-siswa">
                        <div class="panel-heading">
                            <h3 class="box-title">DAFTAR PELANGGARAN SISWA</h3>            
                        </div>
                        <div class="box">
                            <div class="box-header">                                
                                <span>
                                    <div class="btn-group">
                                        <button class="btn btn-success btn-sm" id="button-persen-pelanggaran">
                                            PERSENTASE PELANGGARAN
                                        </button>
                                    </div>
                                    @if(Auth::guard('web')->user()->staff->ROLE === "TEACHER")
                                        <a href="{{ route('violationrecord.create') }}" type="button" class="btn btn-primary btn-sm pull-right">BUAT DAFTAR PELANGGARAN</a>
                                    @elseif(Auth::guard('web')->user()->staff->ROLE === "ADVISOR")                                    
                                        <a href="{{ route('violationrecord.create') }}" type="button" class="btn btn-primary btn-sm pull-right">BUAT DAFTAR PELANGGARAN</a>
                                    @endif
                                </span>        
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NAMA SISWA</th>
                                        <th>KELAS SISWA</th>
                                        <th>JUMLAH PELANGGARAN</th>
                                        <th>POIN PELANGGARAN</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody-daftar-siswa-yang-ada-pelanggaran">
                                    @php $i=1 @endphp                                    
                                    @foreach($catatan_pelanggaran["pelanggaran"] as $cp)                                    
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td style="width: 300px">{{$cp->student->FNAME}}{{" "}}{{$cp->student->LNAME}}</td>
                                            <td style="width: 120px">{{$cp->student->getGradeName()}}</td>
                                            <td>{{$cp->JUMLAHPELANGGARAN}}</td>
                                            <td>
                                                @if($cp->POINPELANGGARAN < 50)
                                                    <div class="btn btn-success btn-sm">{{ $cp->POINPELANGGARAN }}</div>
                                                @elseif($cp->POINPELANGGARAN >= 50 && $cp->POINPELANGGARAN < 100)
                                                    <div class="btn btn-warning btn-sm">{{ $cp->POINPELANGGARAN }}</div>
                                                @elseif($cp->POINPELANGGARAN >= 100)
                                                    <div class="btn btn-danger btn-sm">{{ $cp->POINPELANGGARAN }}</div>
                                                @endif 
                                            </td>
                                            <td>
                                                <button type="button" 
                                                        class="btn btn-primary btn-sm button-detail-pelanggaran" 
                                                        data-toggle="modal" 
                                                        data-target="#detailViolationStudent" 
                                                        student-id="{{$cp->student->id}}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <a href="{{ route('student.profile', ['id'=>$cp->student->id]) }}" class="btn btn-default btn-sm">
                                                    <i class="fa fa-user"></i>
                                                </a>                                         
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Detail Pelanggaran Tiap Siswa-->
                    <div class="modal fade bd-example-modal-lg" id="modalDetailViolationEachStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title" id="modalTitle">PELANGGARAN YANG DILAKUKAN</b></h1>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table id="table-violation-record-detail" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NAMA SISWA</th>
                                                <th>TANGGAL</th>
                                                <th>TAHUN AJARAN</th>
                                                <th>NAMA PELANGGARAN</th>
                                                <th>HUKUMAN</th>
                                                <th>POIN PELANGGARAN</th>
                                                @if(Auth::guard('web')->user()->staff->ROLE != "HEADMASTER")
                                                    <th></th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-student-violation-list">
                                            <tr>
                                                <td>I</td>
                                                <td style="width: 90px">X</td>
                                                <td style="width: 20px">X</td>
                                                <td style="width: 40px">X</td>
                                                <td style="width: 110px">X</td>
                                                <td style="width: 110px">X</td>
                                                <td style="width: 40px">X</td>
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
    </div>    
@stop

@section('footer')
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>     
    $('#detail-pelanggaran-berdasarkan-kategori').hide();
    $('#persentase-pelanggaran').hide();

    $('#button-persen-pelanggaran').on('click', (function(){
        $('#persentase-pelanggaran').show();
    }))

    $('#tbody-persentase-pelanggaran').on('click', '.button-detail-persentase', (function(){
        var x = $(this).attr('violation-category')
        var res = x.split("")
        var violationName = res[0]
        var academicYearId = $('#selector-dropdown-violationrecord-year').val()
        
        $('#detail-pelanggaran-berdasarkan-kategori').show();        
        
        $.ajax({
            url: '{{route("violationrecord.violationItem")}}', 
            type: 'get', 
            data: {violationName: violationName, academicYearId: academicYearId},

            success: function(result){
                $('#tbody-detail-pelanggaran-berdasarkan-kategori').empty()
                
                result.forEach(function(obj){
                    $('#tbody-detail-pelanggaran-berdasarkan-kategori').append(
                        `
                        <tr>                            
                            <td>${obj.NAME}</td>
                            <td>${obj.DESCRIPTION}</td>
                            <td>${obj.JUMLAHPERPELANGGARAN}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm button-detail" violation-id=${obj.id}><i class="fa fa-eye"></i></button>
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
        var academicYearId = $('#selector-dropdown-violationrecord-year').val()

        $.ajax({
            url: '{{route("violationrecord.showViolationRecord")}}', 
            type: 'get', 
            data: {violationId: violationId, academicYearId: academicYearId},

            success: function(result){
                $('#tbody-violation-record').empty()
                
                result.forEach(function(obj){                      
                    var i = 1
                    $('#tbody-violation-record').append(                        
                        `
                        <tr>
                            <td style="width: 20px">${+i}</td>
                            <td style="width: 90px">${obj.FNAME} ${obj.LNAME}</td>
                            <td style="width: 20px">${obj.DATE}</td>
                            <td style="width: 60px">${obj.TYPE} - ${obj.NAME}</td>
                            <td style="width: 110px">${obj.PUNISHMENT}</td>
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

    $('#tbody-daftar-siswa-yang-ada-pelanggaran').on('click', '.button-detail-pelanggaran', (function(){
        var studentId = $(this).attr('student-id');
        var academicYearId = $('#selector-dropdown-violationrecord-year').val()
        
        $.ajax({
            url: '{{ route("violationrecord.studentDetailViolation") }}',
            type: 'get',
            data: {studentId: studentId, academicYearId: academicYearId},

            success: function(result){
                $('#tbody-student-violation-list').empty()         
                                    
                result.forEach(function(obj){        
                    var route =  "{{ route('violationrecord.edit', ':id') }}"  
                    route = route.replace(':id', `${obj.id}`)
                    
                    var route_del = "{{ route ('violationrecord.destroy', ':id' )}}"
                    route_del = route_del.replace(':id', `${obj.id}`)

                    var $role_teacher = "{{ Auth::guard('web')->user()->staff->ROLE === "TEACHER" }}"
                    var $role_headmaster = "{{ Auth::guard('web')->user()->staff->ROLE === "HEADMASTER" }}"
                    
                    if($role_teacher) {
                        $('#tbody-student-violation-list').append(                        
                            `
                            <tr>
                                <td style="width: 20px">${obj.id}</td>
                                <td style="width: 90px">${obj.FNAME} ${obj.LNAME}</td>
                                <td style="width: 20px">${obj.DATE}</td>
                                <td style="width: 60px">${obj.TYPE} - ${obj.NAME}</td>
                                <td style="width: 110px">${obj.DESCRIPTION}</td>
                                <td style="width: 110px">${obj.PUNISHMENT}</td>
                                <td style="width: 40px">${obj.POINT}</td>
                                <td style="width: 80px">                            
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
                    } else if ($role_headmaster) {
                        $('#tbody-student-violation-list').append(                        
                            `
                            <tr>
                                <td style="width: 20px">${obj.id}</td>
                                <td style="width: 90px">${obj.FNAME} ${obj.LNAME}</td>
                                <td style="width: 20px">${obj.DATE}</td>
                                <td style="width: 60px">${obj.TYPE} - ${obj.NAME}</td>
                                <td style="width: 110px">${obj.DESCRIPTION}</td>
                                <td style="width: 110px">${obj.PUNISHMENT}</td>    
                                <td style="width: 40px">${obj.POINT}</td>                            
                            </tr>

                            `
                        )
                    }
                    
                })
                $('#modalDetailViolationEachStudent').modal('show')
            },
            error: function(err){
                console.log(err)
            }
        })
    }));

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
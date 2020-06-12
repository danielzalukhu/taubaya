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
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove">
                                <i class="fa fa-times"></i>
                                </button>
                            </div>
                            <div class="panel-heading">                                
                                <h5 class="panel-title"><b>TAHUN AJARAN:</b>
                                    <span>
                                        <div class="btn-group">
                                            <select type="button" id="selector-dropdown-achievementrecord-year" class="btn btn-default dropdown-toggle">
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
                                <div id="achievementChartStatistic">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6" id="persentase-penghargaan">
                        <div class="panel-heading">
                            <h3 class="box-title">PERSENTASE PENGHARGAAN</h3>            
                        </div>
                        <div class="box box-success">
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
                                        <tbody id="tbody-persentase-penghargaan">
                                            @php $i=1 @endphp
                                            @foreach($catatan_penghargaan["data"] as $cp)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{ $cp->TINGKAT }}</td>
                                                    <td>{{ $cp->JUMLAH }}</td>
                                                    <td>{{ $cp->PERSENTASE }} %</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-sm button-detail-persentase" 
                                                                achievement-grade="{{$cp->TINGKAT}}">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach                                        
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5"><i>*Keterangan: Persentase penghagraan adalah berdasarkan jumlah penghargaan 
                                                tercatat untuk setiap tingkatnya yang dibagi dengan jumlah daftar penghargaan yang berlaku</i></td>                                                
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6" id="detail-penghargaan-berdasarkan-tingkat">
                        <div class="panel-heading">
                            <h3 class="box-title">PENGHARGAAN BERDASARKAN TINGKAT</h3>            
                        </div>
                        <div class="box box-success">
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
                                                <th>TINGKAT</th>
                                                <th>NAMA PENGHARGAAN</th>   
                                                <th>JUMLAH TERJADI</th>
                                                <th></th>                                             
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-detail-penghargaan-berdasarkan-tingkat">
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                     <!-- Modal Detail Daftar Penghargaan Tercatat-->
                     <div class="modal fade bd-example-modal-lg" id="modalAchievementRecordDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title" id="modalTitle">DAFTAR PENGHARGAAN TERCATAT</b></h1>
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
                                                <th>DESKRIPSI</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-achievement-record">
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

                    <div class="col-xs-12" id="daftar-catatan-penghargaan-siswa">
                        <div class="panel-heading">
                            <h3 class="box-title">DAFTAR PENGHARGAAN SISWA</h3>            
                        </div>
                        <div class="box">
                            <div class="box-header">
                                <span>
                                    <div class="btn-group">
                                        <button class="btn btn-success btn-sm" id="button-persen-penghargaan">
                                            PERSENTASE PENGHARGAAN
                                        </button>
                                    </div>
                                    @if(Auth::guard('web')->user()->staff->ROLE === "TEACHER")
                                        <a href="{{ route('achievementrecord.create') }}" type="button" class="btn btn-primary btn-sm pull-right">BUAT DAFTAR PENGHARGAAN</a>
                                    @elseif(Auth::guard('web')->user()->staff->ROLE === "ADVISOR")                                    
                                        <a href="{{ route('achievementrecord.create') }}" type="button" class="btn btn-primary btn-sm pull-right">BUAT DAFTAR PENGHARGAAN</a>
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
                                            <th>JUMLAH PENGHARGAAN</th>
                                            <th>POIN PENGHARGAAN</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-daftar-siswa-yang-ada-penghargaan">
                                    @php $i=1 @endphp
                                    @foreach($catatan_penghargaan["penghargaan"] as $cp)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td style="width: 300px">{{$cp->student->FNAME}}{{" "}}{{$cp->student->LNAME}}</td>
                                            <td style="width: 120px">{{$cp->student->getGradeName()}}</td>
                                            <td>{{$cp->JUMLAHPENGHARGAAN}}</td>
                                            <td>
                                                @if($cp->POINPENGHARGAAN < 50)
                                                    <div class="btn btn-info btn-sm">{{ $cp->POINPENGHARGAAN }}</div>
                                                @elseif($cp->POINPENGHARGAAN >= 50 )
                                                    <div class="btn btn-success btn-sm">{{ $cp->POINPENGHARGAAN }}</div>
                                                @endif 
                                            </td>
                                            <td>
                                                <button type="button" 
                                                        class="btn btn-primary btn-sm button-detail-penghargaan" 
                                                        data-toggle="modal" 
                                                        data-target="#detailAchievementStudent" 
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

                    <!-- Modal Detail Penghargaan Tiap Siswa-->
                    <div class="modal fade bd-example-modal-lg" id="modalDetailAchievementEachStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title" id="modalTitle">PENGHARGAAN YANG DIMILIKI</b></h1>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table id="table-achievement-record-detail" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NAMA SISWA</th>
                                                <th>TANGGAL</th>
                                                <th>TAHUN AJARAN</th>
                                                <th>TINGKAT</th>
                                                <th>NAMA PENGHARGAAN</th>
                                                <th>DESKRIPSI</th>
                                                <th>POIN PENGHARGAAN</th>
                                                @if(Auth::guard('web')->user()->staff->ROLE != "HEADMASTER")
                                                    <th></th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-student-achievement-list">
                                            <tr>
                                                <td>I</td>
                                                <td style="width: 90px">X</td>
                                                <td style="width: 20px">X</td>
                                                <td style="width: 40px">X</td>
                                                <td style="width: 20px">X</td>
                                                <td style="width: 110px">X</td>
                                                <td style="width: 110px">X</td>
                                                <td style="width: 20px">X</td>
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
    $('#detail-penghargaan-berdasarkan-tingkat').hide();
    $('#persentase-penghargaan').hide();

    $('#button-persen-penghargaan').on('click', (function(){
        $('#persentase-penghargaan').show();
    }))

    $('#tbody-persentase-penghargaan').on('click', '.button-detail-persentase', (function(){
        var achievementGrade = $(this).attr('achievement-grade')
        var academicYearId = $('#selector-dropdown-achievementrecord-year').val();

        $('#detail-penghargaan-berdasarkan-tingkat').show();

        $.ajax({
            url: '{{route("achievementrecord.achievementItem")}}',
            type: 'get',
            data: {achievementGrade: achievementGrade, academicYearId: academicYearId},

            success: function(result){
                $('#tbody-detail-penghargaan-berdasarkan-tingkat').empty()
                
                result.forEach(function(obj){
                    $('#tbody-detail-penghargaan-berdasarkan-tingkat').append(
                        `
                        <tr>                            
                            <td>${obj.GRADE}</td>
                            <td>${obj.DESCRIPTION}</td>
                            <td>${obj.JUMLAHPERPENGHARGAAN}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm button-detail" achievement-id=${obj.id}><i class="fa fa-eye"></i></button>
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

    $('#tbody-detail-penghargaan-berdasarkan-tingkat').on('click', '.button-detail', function(){
        var achievementId = $(this).attr('achievement-id')
        var academicYearId = $('#selector-dropdown-achievementrecord-year').val();
        
        $.ajax({
            url: '{{route("achievementrecord.showAchievementRecord")}}',
            type: 'get',
            data: {achievementId: achievementId, academicYearId: academicYearId},

            success: function(result){
                $('#tbody-achievement-record').empty()
                console.log(result)
                result.forEach(function(obj){
                    var i = 1
                    $('#tbody-achievement-record').append(                        
                        `
                        <tr>
                            <td style="width: 20px">${+i}</td>
                            <td style="width: 90px">${obj.FNAME} ${obj.LNAME}</td>
                            <td style="width: 20px">${obj.DATE}</td>
                            <td style="width: 60px">${obj.TYPE} - ${obj.NAME}</td>
                            <td style="width: 110px">${obj.DESCRIPTION}</td>
                        </tr>

                        `
                    )
                })
                $('#modalAchievementRecordDetail').modal('show')

            },
            error: function(err){
                console.log(err)
            }
        })
    })

    $('#tbody-daftar-siswa-yang-ada-penghargaan').on('click', '.button-detail-penghargaan', (function(){
        var studentId = $(this).attr('student-id');   
        var academicYearId = $('#selector-dropdown-achievementrecord-year').val();   
        
        $.ajax({
            url: '{{ route("achievementrecord.studentDetailAchievement") }}',
            type: 'get',
            data: {studentId: studentId, academicYearId: academicYearId},

            success: function(result){
                $('#tbody-student-achievement-list').empty()         
                
                result.forEach(function(obj){        
                    var route =  "{{ route('achievementrecord.edit', ':id') }}"  
                    route = route.replace(':id', `${obj.id}`)
                    
                    var route_del = "{{ route ('achievementrecord.destroy', ':id' )}}"
                    route_del = route_del.replace(':id', `${obj.id}`)

                    var $role_teacher = "{{ Auth::guard('web')->user()->staff->ROLE === "TEACHER" }}"
                    var $role_headmaster = "{{ Auth::guard('web')->user()->staff->ROLE === "HEADMASTER" }}"

                    if($role_teacher){
                        $('#tbody-student-achievement-list').append(                        
                            `
                            <tr>
                                <td style="width: 20px">${obj.id}</td>
                                <td style="width: 90px">${obj.FNAME} ${obj.LNAME}</td>
                                <td style="width: 20px">${obj.DATE}</td>
                                <td style="width: 60px">${obj.TYPE} - ${obj.NAME}</td>
                                <td style="width: 40px">${obj.GRADE}</td>
                                <td style="width: 200px">${obj.DESKRIPSI2}</td>
                                <td style="width: 200px">${obj.DESKRIPSI1}</td>
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
                        $('#tbody-student-achievement-list').append(                        
                            `
                            <tr>
                                <td style="width: 20px">${obj.id}</td>
                                <td style="width: 90px">${obj.FNAME} ${obj.LNAME}</td>
                                <td style="width: 20px">${obj.DATE}</td>
                                <td style="width: 60px">${obj.TYPE} - ${obj.NAME}</td>
                                <td style="width: 40px">${obj.GRADE}</td>
                                <td style="width: 200px">${obj.DESKRIPSI2}</td>
                                <td style="width: 200px">${obj.DESKRIPSI1}</td>        
                                <td style="width: 40px">${obj.POINT}</td>                        
                            </tr>
                            `
                        )
                    }
                })
                $('#modalDetailAchievementEachStudent').modal('show')
            },
            error: function(err){
                console.log(err)
            }
        })
    }));
    
    $('#selector-dropdown-achievementrecord-year').val({{$academic_year_id}})

    $('#selector-dropdown-achievementrecord-year').change(function(){
        var academicYearId = $(this).val()

        window.location = "{{ route('achievementrecord.index') }}"+"?academicYearId="+academicYearId;
    })

    var types = {!!json_encode($type)!!}
    var dataGraph = {!!json_encode($data)!!}
    var selectedTahunAjaran = {!!json_encode($selected_tahun_ajaran)!!}

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
            if(obj.TINGKAT == item.TINGKAT){
                values[obj.BULAN - startMonth] = obj.JUMLAH
            }
        })

        dataSeries.push({
            name: item.TINGKAT,
            data: values
        })
    })

    Highcharts.chart('achievementChartStatistic', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'STATISTIK PENGHARGAAN YANG TERCATAT BERDASARKAN JENIS PENGHARGAAN DAN PERIODE TAHUN AJARAN'
        },
        xAxis: {
            categories: dataCategory,
            crosshair: true
        },
        yAxis: {
            min: 0,
            allowDecimals: false,
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
                enableMouseTracking: true,
                pointPadding: 0.08
                
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
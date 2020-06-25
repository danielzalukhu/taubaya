@extends('layout.master')

@section('header')
    <link rel="stylesheet" href="{{asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@stop

@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                @if ($sukses = Session::get('sukses'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $sukses }}</strong>
                    </div>
                @elseif($error = Session::get('error'))    
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $error }}</strong>
                    </div> 
                @endif
                
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel-heading">
                            <h3 class="box-title">DAFTAR LAPORAN KETIDAKTUNTASAN SISWA</h3>        
                        </div>                                                 
                        <div class="box">                                                      
                            <div class="box-header">                             
                                @if(Auth::guard('web')->user()->staff->ROLE === "TEACHER")
                                    <div class="row">
                                        <a href="{{ route('subject.createIncomplete') }}" type="button" class="btn btn-primary btn-sm pull-right"  style="margin-right: 15px;">BUAT DAFTAR KETIDAKTUNTASAN</a>
                                    </div>                                             
                                @else
                                                                                 
                                @endif
                                <h5 class="box-header-title"><b>TAHUN AJARAN:</b>                                      
                                    <span>
                                        <div class="btn-group">
                                            <select type="button" id="dropdown-incomplete-academic-year" class="btn btn-default dropdown-toggle">
                                                @foreach($tahun_ajaran as $ta)
                                                    <option value='{{ $ta->id }}' class="dropdown-academic-year" academic-year-id="{{$ta->id}}">
                                                        {{ $ta->TYPE}}{{" - "}}{{ $ta->NAME }}
                                                    </option>                                                                        
                                                @endforeach
                                            </select>                                            
                                        </div>                                        
                                        <button type="button" class="btn btn-warning btn-sm pull-right" style="margin: 1px;">KURANG</button>
                                        <button type="button" class="btn btn-primary btn-sm pull-right" style="margin: 1px;">CUKUP</button>                                                                              
                                        <button type="button" class="btn btn-success btn-sm pull-right" style="margin: 1px;">BAIK</button>  
                                    </span>       
                                </h5>
                            </div>
                            
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>TANGGAL</th>
                                        <th>NAMA SISWA</th>                                        
                                        <th colspan="2">KODE - DEKSRIPSI</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1 @endphp
                                    @foreach($ketidaktuntasan as $tts)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td><b>{{date('d-m-Y', strtotime($tts->DATE))}}</b></td>
                                        <td>{{$tts->student->FNAME}}{{" "}}{{$tts->student->LNAME}}</td>
                                        <td>{{$tts->violation->NAME}}</td>
                                        <td>{{$tts->DESCRIPTION}}</td>
                                        <td>
                                            <a href="{{ route ('subject.editIncomplete', $tts->id )}}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <form action="{{ route ('subject.destroyIncomplete', $tts->id )}}" method="GET" class="inline">
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
@stop

@section('footer')
<script>    
    $('#dropdown-incomplete-academic-year').val({{$academic_year_id}})

    $('#dropdown-incomplete-academic-year').change(function(){
        var academicYearId = $(this).val()        
        
        var $role_staff = "{{ Auth::guard('web')->user()->ROLE === "STAFF" }}"
        var $role_student = "{{ Auth::guard('web')->user()->ROLE === "STUDENT" }}"
        
        if($role_staff){
            window.location = "{{ route('subject.incomplete') }}"+"?academicYearId="+academicYearId;
        } else if ($role_student){
            window.location = "{{ route('subject.incompleteku') }}"+"?academicYearId="+academicYearId;
        }
    })

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
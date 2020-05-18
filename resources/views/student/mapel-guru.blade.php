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
                @endif
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel-heading">
                            <h3 class="box-title">MATA PELAJARAN-GURU</h3>
                        </div>
                        <div class="box">
                            <div class="box-header">
                                <div class="right">
                                    @if(Auth::guard('web')->user()->staff->ROLE === "HEADMASTER")
                                        <h5 class="box-header-title"><b>DAFTAR KELAS: </b>
                                            <span>
                                                <div class="btn-group">
                                                    <select type="button" id="dropdown-daftar-kelas" class="btn btn-default dropdown-toggle">
                                                        @foreach($kelas as $k)
                                                            <option value='{{ $k->NAME }}' grade-id='{{$k->NAME}}'>
                                                                {{ $k->NAME }}
                                                            </option>                                                                        
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </span>        
                                        </h5>
                                    @elseif(Auth::guard('web')->user()->staff->ROLE === "TEACHER")
                                        <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#modalTambahSiswa">INPUT DAFTAR SISWA</button>
                                    @endif
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>KODE MAPEL</th>
                                            <th>NAMA MAPEL</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1 @endphp
                                    @foreach($subject as $s)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $s->CODE }}</td>
                                            <td>{{ $s->DESCRIPTION }}</td>
                                            <td>
                                                <a href="{{ route ('subject.detail', ['id' => $s->id] ) }}" class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <form action="#" method="POST" class="inline">
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
@stop

@section('footer')
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

    // $('#dropdown-daftar-kelas').val({{ $gid }})

    $('#dropdown-daftar-kelas').change(function(){
        var gradeName = $(this).val();
        // console.log(gradeName)
        var route =  "{{ route('student.mapelguru') }}"  
        window.location = route+"?gradeName="+gradeName;        
    })  
</script>
@stop
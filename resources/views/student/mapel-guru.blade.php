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
                                                <a href="{{ route ('subject.detail', ['id' => $s->id] ) }}" title="Detail Mapel" class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('subject.assesment') }}" title="Input Nilai" class="btn btn-success btn-sm">
                                                    <i class="fa fa-pencil"></i>
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
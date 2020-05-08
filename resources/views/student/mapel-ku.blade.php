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
                            <h3 class="box-title">MATA PELAJARAN-KU</h3>
                        </div>
                        <div class="box">
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NAMA MAPEL</th>
                                            <th>INFORMASI</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1 @endphp
                                    @foreach($selected_mapel as $sm)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $sm->DESCRIPTION }}</td>
                                            <td></td>
                                            <td>
                                                <a href="#" class="btn btn-info btn-sm">
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
</script>
@stop
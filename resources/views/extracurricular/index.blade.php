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
                            <h3 class="box-title">ACHIEVEMENT LIST</h3>            
                        </div>
                        <div class="box">
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>TYPE</th>
                                    <th>DESCRIPTION</th>
                                    <th>POINT</th>
                                    <th>EDIT</th>
                                    <th>DELETE</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($penghargaan as $pe)
                                    <tr>
                                        <td>{{$pe->TYPE}}</td>
                                        <td>{{$pe->DESCRIPTION}}</td>
                                        <td>{{$pe->POINT}}</td>
                                        <td><a href= "{{ route ('achievement.edit', $pe->id )}}" class="btn btn-primary btn-sm">EDIT</td>
                                        <td>
                                            <form action="{{ route ('achievement.destroy', $pe->id )}}" method="POST">
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
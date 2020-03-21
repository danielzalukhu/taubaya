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
                            <h3 class="box-title">VIOLATION LIST</h3>            
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
                                        <th>VIOLATION NAME</th>
                                        <th>DESCRIPTION</th>
                                        <th>POINT</th>
                                        <th>EDIT</th>
                                        <th>DELETE</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pelanggaran as $pl)
                                        <tr>
                                            <td>{{$pl->NAME}}</td>
                                            <td>{{$pl->DESCRIPTION}}</td>
                                            <td>{{$pl->POINT}}</td>
                                            <td><a href= "{{ route ('violation.edit', $pl->id )}}" class="btn btn-primary btn-sm">EDIT</td>
                                            <td>
                                                <form action="{{ route ('violation.destroy', $pl->id )}}" method="POST">
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
                    <h1 class="modal-title" id="exampleModalLabel">CREATE NEW MASTER VIOLATION</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('violation.store') }}" method="post"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <!-- {{csrf_field()}} -->
                        <div class="form-group{{ $errors->has('v_name') ? 'has-error' : '' }} ">
                            <label>Violation Name</label>
                            <input name="v_name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="R-01 OR B-01 OR SB-01" value="{{old('v_name')}}">            
                            @if($errors->has('v_name'))
                                <span class="help-block">{{$errors->first('v_name')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="v_desc" class="form-control" 
                            id="exampleFormControlTextarea1" rows="3">{{old('v_desc')}}</textarea>
                        </div>

                        <div class="form-group{{ $errors->has('v_point') ? 'has-error' : '' }} ">
                            <label>Point</label>
                            <input name="v_point"type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="0 untill 250" value="{{old('v_point')}}">            
                            @if($errors->has('v_point'))
                                <span class="help-block">{{$errors->first('v_point')}}</span>
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




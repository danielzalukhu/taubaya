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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">CREATE NEW MASTER ACHIEVEMENT</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('achievement.store') }}" method="post"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group{{ $errors->has('a_type') ? 'has-error' : '' }} ">
                            <label>Type</label>
                            <select name="a_type" class="form-control" id="inputGroupSelect01">
                                <option value="PR">PRESTASI</option>
                                <option value="NPR">NON-PRESTASI</option>
                            </select>
                            @if($errors->has('a_type'))
                                <span class="help-block">{{$errors->first('a_type')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="a_desc" class="form-control" 
                            id="exampleFormControlTextarea1" rows="3">{{old('a_desc')}}</textarea>
                        </div>

                        <div class="form-group{{ $errors->has('a_point') ? 'has-error' : '' }} ">
                            <label>Point</label>
                            <input name="a_point"type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="0 untill 250" value="{{old('a_point')}}">            
                            @if($errors->has('a_point'))
                                <span class="help-block">{{$errors->first('a_point')}}</span>
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
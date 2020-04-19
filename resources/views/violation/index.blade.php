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
                            <h3 class="box-title">DAFTAR PELANGGARAN</h3>            
                        </div>
                        <div class="box">
                            <div class="box-header">
                                <div class="right">
                                    <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#exampleModal">BUAT DAFTAR PELANGGARAN</button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NAMA PELANGGARAN</th>
                                            <th>DESKRIPSI</th>
                                            <th>POIN</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1 @endphp
                                    @foreach($pelanggaran as $pl)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$pl->NAME}}</td>
                                            <td>{{$pl->DESCRIPTION}}</td>
                                            <td>{{$pl->POINT}}</td>
                                            <td>
                                                <a href="{{ route ('violation.edit', $pl->id )}}" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <form action="{{ route ('violation.destroy', $pl->id )}}" method="POST" class="inline">
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

    <!-- Modal Create New-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">BUAT PELANGGARAN BARU</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('violation.store') }}" method="post"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <!-- {{csrf_field()}} -->
                        <div class="form-group{{ $errors->has('v_name') ? 'has-error' : '' }} ">
                            <label>Nama Pelanggaran</label>
                            <input name="v_name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="R-01/B-01/SB-01" value="{{old('v_name')}}">            
                            @if($errors->has('v_name'))
                                <span class="help-block">{{$errors->first('v_name')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="v_desc" class="form-control" 
                            id="exampleFormControlTextarea1" rows="3">{{old('v_desc')}}</textarea>
                        </div>

                        <div class="form-group{{ $errors->has('v_point') ? 'has-error' : '' }} ">
                            <label>Poin</label>
                            <input name="v_point"type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="0 s/d 250" value="{{old('v_point')}}">            
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




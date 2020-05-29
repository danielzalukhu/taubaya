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
                @endif
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel-heading">
                            <h3 class="box-title">DAFTAR EKSTRAKURIKULER</h3>            
                        </div>
                        <div class="box">
                            <div class="box-header">
                            @if(Auth::guard('web')->user()->staff->ROLE === "TEACHER" && Auth::guard('web')->user()->staff->getDepartmentName() == "Departemen PENJASKES")
                                <div class="right">
                                    <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#modalTambahEkskul">INPUT DAFTAR EKSUL</button>
                                </div>
                            @elseif(Auth::guard('web')->user()->staff->ROLE === "ADMIN")
                                <div class="right">
                                    <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#modalTambahEkskul">INPUT DAFTAR EKSUL</button>
                                </div>
                            @endif
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NAMA EKSKUL</th>
                                            <th>DESKRIPSI</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1 @endphp
                                    @foreach($ekskul as $e)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $e->NAME }}</td>
                                            <td>{{ $e->DESCRIPTION }}</td>
                                            <td>
                                                <a href="{{ route ('extracurricular.edit', $e->id )}}" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <form action="{{ route ('extracurricular.destroy', $e->id )}}" method="POST" class="inline">
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

    <!-- MODAL -->
    <div class="modal fade" id="modalTambahEkskul" tabindex="-1" role="dialog" aria-labelledby="modalTambahSiswaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">INPUT DAFTAR EKSTRAKURIKULER BARU</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route ('extracurricular.store', $e->id )}}" method="post"  enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <div class="form-group{{ $errors->has('e_name') ? 'has-error' : '' }} ">
                            <label>Nama Ekstrakurikuler</label>
                            <input name="e_name"type="text" class="form-control" id="namaEkstrakurikuler" aria-describedby="emailHelp" value="{{old('e_name')}}">            
                            @if($errors->has('e_name'))
                                <span class="help-block">{{$errors->first('e_name')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="e_desc" class="form-control" 
                            id="deskripsiEkskul" rows="3">{{old('e_desc')}}</textarea>
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
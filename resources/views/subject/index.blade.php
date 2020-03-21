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
                            <h3 class="box-title">SUBJECT LIST OF EACH PROGRAMS STUDY</h3>            
                        </div>
                        <div class="box">                        
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SUBJECT CODE</th>
                                            <th>SUBJECT NAME</th>
                                            <th>KKM</th>
                                            <th>TYPE</th>
                                            <th>EDIT</th>
                                            <th>DELETE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($mapel as $mp)
                                        <tr>
                                            <td><a href=""></a>{{$mp->CODE}}</td>
                                            <td>{{$mp->DESCRIPTION}}</td>
                                            <td>{{$mp->MINIMALPOIN}}</td>
                                            <td>{{$mp->TYPE}}</td>
                                            <td><a href= "{{ route ('subject.edit', $mp->id )}}" class="btn btn-primary btn-sm">EDIT</td>
                                            <td>
                                                <form action="{{ route ('subject.destroy', $mp->id )}}" method="POST">
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
                    <h1 class="modal-title" id="exampleModalLabel">CREATE NEW SUBJECT</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('subject.store') }}" method="post"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group{{ $errors->has('s_code') ? 'has-error' : '' }} ">
                            <label>SUBJECT CODE</label>
                            <input name="s_code" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('s_code')}}">            
                            @if($errors->has('s_code'))
                                <span class="help-block">{{$errors->first('s_code')}}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('s_desc') ? 'has-error' : '' }} ">
                            <label>SUBJECT NAME</label>
                            <input name="s_desc" type="text" class="form-control"  aria-describedby="emailHelp" value="{{old('s_desc')}}">     
                            @if($errors->has('s_desc'))
                                <span class="help-block">{{$errors->first('s_desc')}}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('s_kkm') ? 'has-error' : '' }} ">
                            <label>MINIMAL POINT</label>
                            <input name="s_kkm" type="number" class="form-control"  aria-describedby="emailHelp" value="{{old('s_kkm')}}">     
                            @if($errors->has('s_kkm'))
                                <span class="help-block">{{$errors->first('s_kkm')}}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('s_type') ? 'has-error' : '' }} ">
                            <label>SUBJECT CATEGORY</label>
                            <select name="s_type" class="form-control" id="inputGroupSelect01">
                                <option selected>Choose...</option>
                                <option value="MN">MUATAN NASIONAL</option>
                                <option value="MK">MUATAN KEWILAYAHAN</option>
                                <option value="MPK">MUATAN PEMINATAN KEJUJURAN</option>
                                <option value="DBK">DASAR BIDANG KEAHLIAN</option>
                                <option value="DPK">DASAR PROGRAM KEAHLIAN</option>
                                <option value="KK">KOMPETENSI KEAHLIAN</option>
                            </select>
                            @if($errors->has('s_type'))
                                <span class="help-block">{{$errors->first('s_type')}}</span>
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

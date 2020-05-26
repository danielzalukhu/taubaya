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
                    <div class="panel-heading">
                        <h3 class="box-title">INPUT NILAI EKSTRAKURIKULER</h3>     
                    </div>                    
                    <div class="col-xs-12">                        
                        <div class="box">
                            <div class="box-header with-border">
                                <div class="center">
                                    <h4 class="box-title">INPUT NILAI</h4>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove">
                                        <i class="fa fa-times"></i>
                                        </button>
                                    </div>       
                                </div>
                            </div>
                            <div class="box-body">
                                <form action="{{ route('extracurricular.storeAssesment') }}" method="post"  enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group{{ $errors->has('e_ekskul_name') ? 'has-error' : '' }} ">
                                        <label>Nama Ekstrakurikuler</label>
                                        <select name="e_ekskul_name" class="form-control">
                                            @foreach($ekskul as $e)
                                                <option value='{{ $e->id }}'>{{ $e->NAME }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('e_ekskul_name'))
                                            <span class="help-block">{{$errors->first('e_ekskul_name')}}</span>
                                        @endif
                                    </div>                                

                                    <div class="form-group{{ $errors->has('e_student_name') ? 'has-error' : '' }} ">
                                        <label>Nama Siswa</label>
                                        <select name="e_student_name" class="form-control">
                                            @foreach($siswa as $s)
                                                <option value='{{ $s->id }}'>{{ $s->FNAME }}{{" "}}{{ $s->LNAME }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('e_student_name'))
                                            <span class="help-block">{{$errors->first('e_student_name')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('e_nilai') ? 'has-error' : '' }} ">
                                        <label>Nilai</label>
                                        <input name="e_nilai" type="number" class="form-control" value="">            
                                        @if($errors->has('e_nilai'))
                                            <span class="help-block">{{$errors->first('e_nilai')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('e_desc') ? 'has-error' : '' }} ">
                                        <label>Deskripsi</label>            
                                        <textarea name="e_desc" class="form-control" id="exampleFormControlTextarea1" rows="3">{{old('e_desc')}}</textarea>
                                        @if($errors->has('e_desc'))
                                            <span class="help-block">{{$errors->first('e_desc')}}</span>
                                        @endif
                                    </div>

                                    <div class="box-footer clearfix">
                                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                    </div>
                                </form>                
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





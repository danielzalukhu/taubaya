@extends('layout.master')

@section('header')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('adminlte/bower_components/select2/dist/css/select2.min.css')}}">
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

                                    @if(Auth::guard('web')->user()->staff->ROLE === "ADVISOR")
                                    <div class="form-group{{ $errors->has('ar_student_name') ? 'has-error' : '' }} ">
                                        <label>Kelas</label>                
                                        <select id="selected_grade" class="form-control select2" style="width: 100%;">
                                            @foreach($kelas as $k)
                                                <option value='{{ $k->id }}'>{{ $k->NAME }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('a_type'))
                                            <span class="help-block">{{$errors->first('ar_student_name')}}</span>
                                        @endif
                                    </div>
                                    @endif

                                    <div class="form-group{{ $errors->has('e_student_name') ? 'has-error' : '' }} ">
                                        <label>Nama Siswa</label>
                                        <select name="e_student_name" class="form-control select2" style="width: 100%;">
                                            @foreach($siswa as $s)
                                                <option value='{{ $s->student->id }}'>{{ $s->student->FNAME }}{{" "}}{{$s->student->LNAME}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('a_type'))
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
<!-- Select2 -->
<script src="{{asset('adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script>    
    $(function () {    
        $('.select2').select2()
    })

    $('#selected_grade').change(function(){
        var gradeId = $(this).val()   
        var route =  "{{ route('extracurricular.assesment') }}"  
        window.location = route+"?gradeId="+gradeId;        
    })
</script>
@stop





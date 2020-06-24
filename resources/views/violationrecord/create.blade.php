@extends('layout.master')

@section('header')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('adminlte/bower_components/select2/dist/css/select2.min.css')}}">
@stop

@section('content')
    <div class="main">
        <div class="main-content">
            @if(session('sukses'))
                <div class="alert alert-success" role="alert">
                    {{ session('sukses') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-warning" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel-heading">
                            <h3 class="box-title">BUAT DAFTAR PELANGGARAN SISWA</h3>            
                        </div>
                        <div class="box">
                            <div class="box-body">
                                <form action="{{ route ('violationrecord.store') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
      
                                    <div class="form-group{{ $errors->has('vr_date') ? 'has-error' : '' }} ">
                                        <label>Tanggal</label>
                                        <input name="vr_date" type="date" class="form-control input-violation-date" aria-describedby="emailHelp" value="{{old('vr_date')}}">            
                                        @if($errors->has('vr_date'))
                                            <span class="help-block" style="color: red">*Tanggal wajib diisi</span>
                                        @endif
                                    </div>

                                    @if(Auth::guard('web')->user()->staff->ROLE === "ADVISOR")
                                    <div class="form-group">
                                        <label>Kelas</label>                
                                        <select id="selected_grade" class="form-control select2" style="width: 100%;">
                                            @foreach($kelas as $k)
                                                <option value='{{ $k->id }}'>{{ $k->NAME }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('a_type'))
                                            <span class="help-block" style="color: red">*Wajib pilih 1 kelas</span>
                                        @endif
                                    </div>
                                    @endif

                                    <div class="form-group{{ $errors->has('vr_student_name') ? 'has-error' : '' }} ">
                                        <label>Nama Siswa</label>
                                        <select name="vr_student_name" class="form-control select2" style="width: 100%;">
                                            @foreach($siswa as $s)
                                                <option value='{{ $s->student->id }}'>{{ $s->student->FNAME }}{{" "}}{{$s->student->LNAME}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('a_type'))
                                            <span class="help-block" style="color: red">*Wajib pilih 1 siswa</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('vr_violation_name') ? 'has-error' : '' }} ">
                                        <label>Pelanggaran</label>
                                        <select name="vr_violation_name" class="form-control select2" style="width: 100%;">
                                            @foreach($pelanggaran as $p)
                                                <option value='{{ $p->id }}'>{{$p->NAME}}{{" - "}}{{ $p->DESCRIPTION }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('vr_violation_name'))
                                            <span class="help-block" style="color: red">*Wajib pilih 1 daftar pelanggaran</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('vr_desc') ? 'has-error' : '' }} ">
                                        <label>Deskripsi</label>            
                                        <textarea name="vr_desc" class="form-control" id="exampleFormControlTextarea1" rows="3">{{old('vr_desc')}}</textarea>
                                        @if($errors->has('vr_desc'))
                                            <span class="help-block" style="color: red">*Deksripsi wajib diisi</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('vr_punishment') ? 'has-error' : '' }} ">
                                        <label>Hukuman</label>
                                        <textarea name="vr_punishment" class="form-control" id="exampleFormControlTextarea1" rows="3">{{old('vr_punishment')}}</textarea>
                                        @if($errors->has('vr_punishment'))
                                            <span class="help-block" style="color: red">*Hukuman wajib diisi</span>
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
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
        var route =  "{{ route('violationrecord.create') }}"  
        window.location = route+"?gradeId="+gradeId;        
    })
</script>
@stop

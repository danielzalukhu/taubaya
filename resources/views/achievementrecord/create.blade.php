@extends('layout.master')

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
                            <h3 class="box-title">BUAT DAFTAR PENGHARGAAN SISWA</h3>            
                        </div>
                        <div class="box">
                            <div class="box-body">
                                <form action="{{ route ('achievementrecord.store') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    
                                    <div class="form-group{{ $errors->has('ar_date') ? 'has-error' : '' }} ">
                                        <label>Tanggal</label>
                                        <input name="ar_date" type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('ar_date')}}">            
                                        @if($errors->has('ar_date'))
                                            <span class="help-block">{{$errors->first('ar_date')}}</span>
                                        @endif
                                    </div>

                                    @if(Auth::guard('web')->user()->staff->ROLE === "ADVISOR")
                                    <div class="form-group{{ $errors->has('ar_student_name') ? 'has-error' : '' }} ">
                                        <label>Kelas</label>
                                        <select id="selected_grade" class="form-control" id="inputGroupSelect01">
                                            @foreach($kelas as $k)
                                                <option value='{{ $k->id }}'>{{ $k->NAME }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('a_type'))
                                            <span class="help-block">{{$errors->first('ar_student_name')}}</span>
                                        @endif
                                    </div>
                                    @endif

                                    <div class="form-group{{ $errors->has('ar_student_name') ? 'has-error' : '' }} ">
                                        <label>Nama Siswa</label>
                                        <select name="ar_student_name" class="form-control" id="inputGroupSelect01">
                                            @foreach($siswa as $s)
                                                <option value='{{ $s->id }}'>{{ $s->FNAME }}{{" "}}{{$s->LNAME}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('a_type'))
                                            <span class="help-block">{{$errors->first('ar_student_name')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('ar_achievement_name') ? 'has-error' : '' }} ">
                                        <label>Penghargaan</label>
                                        <select name="ar_achievement_name" class="form-control" id="inputGroupSelect01">
                                            @foreach($penghargaan as $p)
                                                <option value='{{ $p->id }}'>{{$p->TYPE}}{{" - "}}{{ $p->DESCRIPTION }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('ar_achievement_name'))
                                            <span class="help-block">{{$errors->first('ar_achievement_name')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('ar_desc') ? 'has-error' : '' }} ">
                                        <label>Deskripsi</label>            
                                        <textarea name="ar_desc" class="form-control" id="exampleFormControlTextarea1" rows="3">{{old('ar_desc')}}</textarea>
                                        @if($errors->has('ar_desc'))
                                            <span class="help-block">{{$errors->first('ar_desc')}}</span>
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
<script>
    $('#selected_grade').change(function(){
        var gradeId = $(this).val()   
        var route =  "{{ route('achievementrecord.create') }}"  
        window.location = route+"?gradeId="+gradeId;        
    })
</script>
@stop

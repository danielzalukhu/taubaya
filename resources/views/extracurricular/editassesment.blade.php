@extends('layout.master')

@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                @if(session('error'))
                    <div class="alert alert-warning" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel-heading">
                            <h3 class="box-title">UBAH NILAI EKSTRAKURIKULER SISWA</h3>            
                        </div>
                        <div class="box">
                            <div class="box-body">
                                <form action="{{ route ('extracurricular.updateAssesment', $ekskul_report->id) }}" method="POST" enctype="multipart/form-data">
                                {{ method_field("PUT") }}
                                {{ csrf_field() }}

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">                                    
                                    
                                    <div class="form-group{{ $errors->has('e_ekskul_name') ? 'has-error' : '' }} ">
                                        <label>Nama Ekstrakurikuler</label>
                                        <select name="e_ekskul_name" class="form-control">
                                            @foreach($ekskul as $e)
                                                <option value="{{ $e->id }}" @if($ekskul_report->EXTRACURRICULARS_ID == $e->id) selected @endif>{{ $e->NAME }}</option>                                                    
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
                                                <option value="{{ $s->id }}" @if($ekskul_report->extracurricularrecord->STUDENTS_ID == $s->id) selected @endif>{{ $s->FNAME }}{{" "}}{{ $s->LNAME }}</option>                                                    
                                            @endforeach                                                
                                        </select>
                                        @if($errors->has('e_student_name'))
                                            <span class="help-block">{{$errors->first('e_student_name')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('e_nilai') ? 'has-error' : '' }} ">
                                        <label>Nilai</label>
                                        <input name="e_nilai" type="number" class="form-control" value="{{ $ekskul_report->SCORE }}">            
                                        @if($errors->has('e_nilai'))
                                            <span class="help-block">{{$errors->first('e_nilai')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('e_desc') ? 'has-error' : '' }} ">
                                        <label>Deskripsi</label>            
                                        <textarea name="e_desc" class="form-control" rows="3">{{ $ekskul_report->DESCRIPTION }}</textarea>
                                        @if($errors->has('e_desc'))
                                            <span class="help-block">{{$errors->first('e_desc')}}</span>
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-warning">Ubah</button>
                                </form>                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

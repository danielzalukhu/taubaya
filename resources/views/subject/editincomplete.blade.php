@extends('layout.master')

@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                @if ($sukses = Session::get('sukses'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $sukses }}</strong>
                    </div>
                @elseif($error = Session::get('error'))    
                    <div class="alert alert-warning alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $error }}</strong>
                    </div> 
                @endif
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel-heading">
                            <h3 class="box-title">UBAH LAPORAN KETIDAKTUNTASAN SISWA</h3>            
                        </div>
                        <div class="box">
                            <div class="box-body">
                            <form action="{{ route ('subject.updateIncomplete', $ketidaktuntasan->id) }}" method="post" enctype="multipart/form-data">
                                
                                {{ csrf_field() }}

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    
                                    <div class="form-group{{ $errors->has('vr_date') ? 'has-error' : '' }} ">
                                        <label>Tanggal</label>
                                        <input name="vr_date" type="date" class="form-control"  value="{{$ketidaktuntasan->DATE}}">            
                                        @if($errors->has('vr_date'))
                                            <span class="help-block" style="color: red">*Tanggal wajib diisi</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('vr_student_name') ? 'has-error' : '' }} ">
                                        <label>Nama Siswa</label>
                                        <select name="vr_student_name" class="form-control">
                                            @foreach($siswa as $s)
                                                <option value="{{ $s->id }}" @if($ketidaktuntasan->STUDENTS_ID == $s->id) selected @endif>{{ $s->FNAME }}{{" "}}{{$s->LNAME}}</option>                                                    
                                            @endforeach                                                
                                        </select>
                                        @if($errors->has('vr_student_name'))
                                            <span class="help-block">{{$errors->first('vr_student_name')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('vr_violation_name') ? 'has-error' : '' }} ">
                                        <label>Nama Pelanggaran</label>
                                        <select name="vr_violation_name" class="form-control">
                                            @foreach($pelanggaran as $p)
                                                <option value="{{ $p->id }}" @if($ketidaktuntasan->VIOLATIONS_ID == $p->id) selected @else disabled @endif>{{$p->NAME}}{{" - "}}{{ $p->DESCRIPTION }}</option>                                           
                                            @endforeach                                            
                                        </select>
                                        @if($errors->has('vr_violation_name'))
                                            <span class="help-block">{{$errors->first('vr_violation_name')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('vr_desc') ? 'has-error' : '' }} ">
                                        <label>Deskripsi</label>            
                                        <textarea name="vr_desc" class="form-control" rows="3">{{ $ketidaktuntasan->DESCRIPTION }}</textarea>
                                        @if($errors->has('vr_desc'))
                                            <span class="help-block" style="color: red">*Deskripsi wajib diisi</span>
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

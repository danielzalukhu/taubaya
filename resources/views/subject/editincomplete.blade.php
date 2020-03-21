@extends('layout.master')

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
                            <h3 class="box-title">EDIT STUDENT INCOMPLETE REPORT</h3>            
                        </div>
                        <div class="box">
                            <div class="box-body">
                            <form action="{{ route ('subject.updateIncomplete', $ketidaktuntasan->id) }}" method="post" enctype="multipart/form-data">
                                
                                {{ csrf_field() }}

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    
                                    <div class="form-group{{ $errors->has('vr_date') ? 'has-error' : '' }} ">
                                        <label>Date</label>
                                        <input name="vr_date" type="date" class="form-control"  value="{{$ketidaktuntasan->DATE}}">            
                                        @if($errors->has('vr_date'))
                                            <span class="help-block">{{$errors->first('vr_date')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('vr_academic_year') ? 'has-error' : '' }} ">
                                        <label>Academic Year</label>
                                        <select name="vr_academic_year" class="form-control">
                                            @foreach($tahun_ajaran as $ta)
                                                <option value="{{ $ta->id }}" 
                                                    @if($ketidaktuntasan->ACADEMIC_YEAR_ID == $ta->id) selected @endif>
                                                        {{ $ta->TYPE }}
                                                        {{ " - " }}
                                                        {{ strtok($ta->START_DATE, '-') }}
                                                        {{ " / " }}
                                                        {{ strtok($ta->END_DATE, '-') }}
                                                </option>                                                    
                                            @endforeach                                                
                                        </select>
                                        @if($errors->has('vr_academic_year'))
                                            <span class="help-block">{{$errors->first('vr_academic_year')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('vr_student_name') ? 'has-error' : '' }} ">
                                        <label>Student Name</label>
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
                                        <label>Violation Name</label>
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
                                        <label>Description</label>            
                                        <textarea name="vr_desc" class="form-control" rows="3">{{ $ketidaktuntasan->DESCRIPTION }}</textarea>
                                        @if($errors->has('vr_desc'))
                                            <span class="help-block">{{$errors->first('vr_desc')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('vr_noted_by') ? 'has-error' : '' }} ">
                                        <label>Noted By</label>
                                        <select name="vr_noted_by" class="form-control">
                                            @foreach($karyawan as $k)
                                                <option value="{{ $k->id }}" @if($ketidaktuntasan->STAFFS_ID == $k->id) selected @endif>{{ $k->NAME }}</option>                                                    
                                            @endforeach                                                
                                        </select>
                                        @if($errors->has('vr_noted_by'))
                                            <span class="help-block">{{$errors->first('vr_noted_by')}}</span>
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-warning">Update</button>
                                </form>                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

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
                            <h3 class="box-title">EDIT STUDENT VIOLATION RECORD</h3>            
                        </div>
                        <div class="box">
                            <div class="box-body">
                                <form action="{{ route ('achievementrecord.update', $catatan_penghargaan->id) }}" method="post" enctype="multipart/form-data">
                                {{ method_field("PUT") }}
                                {{ csrf_field() }}

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    
                                    <div class="form-group{{ $errors->has('ar_student_name') ? 'has-error' : '' }} ">
                                        <label>Student Name</label>
                                        <select name="ar_student_name" class="form-control">
                                            @foreach($siswa as $s)
                                                <option value="{{ $s->id }}" @if($catatan_penghargaan->STUDENTS_ID == $s->id) selected @endif>{{ $s->FNAME }}{{" "}}{{$s->LNAME}}</option>                                                    
                                            @endforeach                                                
                                        </select>
                                        @if($errors->has('ar_student_name'))
                                            <span class="help-block">{{$errors->first('ar_student_name')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('ar_date') ? 'has-error' : '' }} ">
                                        <label>Date</label>
                                        <input name="ar_date" type="date" class="form-control"  value="{{$catatan_penghargaan->DATE}}">            
                                        @if($errors->has('ar_date'))
                                            <span class="help-block">{{$errors->first('ar_date')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('ar_academic_year') ? 'has-error' : '' }} ">
                                        <label>Academic Year</label>
                                        <select name="ar_academic_year" class="form-control" id="inputGroupSelect01">
                                            @foreach($tahun_ajaran as $ta)
                                                <option value="{{ $ta->id }}" 
                                                    @if($catatan_penghargaan->ACADEMIC_YEAR_ID == $ta->id) selected @endif>
                                                        {{ $ta->TYPE }}
                                                        {{ " - " }}
                                                        {{ strtok($ta->START_DATE, '-') }}
                                                        {{ " / " }}
                                                        {{ strtok($ta->END_DATE, '-') }}
                                                </option> 
                                            @endforeach  
                                        </select>
                                        @if($errors->has('ar_academic_year'))
                                            <span class="help-block">{{$errors->first('ar_academic_year')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('ar_achievement_name') ? 'has-error' : '' }} ">
                                        <label>Achievement Name</label>
                                        <select name="ar_achievement_name" class="form-control">
                                            @foreach($penghargaan as $p)
                                                <option value="{{ $p->id }}" @if($catatan_penghargaan->ACHIEVEMENTS_ID == $p->id) selected @endif>{{ $p->TYPE }}{{" - "}}{{ $p->DESCRIPTION }}</option>                                                    
                                            @endforeach                                                
                                        </select>
                                        @if($errors->has('ar_achievement_name'))
                                            <span class="help-block">{{$errors->first('ar_achievement_name')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('ar_desc') ? 'has-error' : '' }} ">
                                        <label>Description</label>            
                                        <textarea name="ar_desc" class="form-control" rows="3">{{ $catatan_penghargaan->DESCRIPTION }}</textarea>
                                        @if($errors->has('ar_desc'))
                                            <span class="help-block">{{$errors->first('ar_desc')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('ar_rank') ? 'has-error' : '' }} ">
                                        <label>Rank</label>
                                        <input name="ar_rank" type="text" class="form-control"  value="{{$catatan_penghargaan->RANK}}">            
                                        @if($errors->has('ar_rank'))
                                            <span class="help-block">{{$errors->first('ar_rank')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('ar_noted_by') ? 'has-error' : '' }} ">
                                        <label>Noted By</label>
                                        <select name="ar_noted_by" class="form-control">
                                            @foreach($karyawan as $k)
                                                <option value="{{ $k->id }}" @if($catatan_penghargaan->STAFFS_ID == $k->id) selected @endif>{{ $k->NAME }}</option>                                                    
                                            @endforeach                                                
                                        </select>
                                        @if($errors->has('ar_noted_by'))
                                            <span class="help-block">{{$errors->first('ar_noted_by')}}</span>
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
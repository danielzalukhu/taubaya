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

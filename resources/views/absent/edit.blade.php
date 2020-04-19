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
                            <h3 class="box-title">UBAH ABSEN</h3>            
                        </div>
                        <div class="box">
                            <div class="box-body">
                                <form action="{{ route ('absent.update', $absen->id) }}" method="POST" enctype="multipart/form-data">
                                {{ method_field("PUT") }}
                                {{ csrf_field() }}

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    
                                    <div class="row">
                                        <div class="col-xs-6 form-group{{ $errors->has('a_start_date') ? 'has-error' : '' }}">
                                            <label>Tanggal Awal</label>
                                            <input name="a_start_date" type="date" class="form-control" value="{{$absen->START_DATE}}"> 
                                            @if($errors->has('a_start_date'))
                                                <span class="help-block">{{$errors->first('a_start_date')}}</span>
                                            @endif
                                        </div>
                                        <div class="col-xs-6 form-group{{ $errors->has('a_end_date') ? 'has-error' : '' }}">
                                            <label>Tanggal Akhir</label>
                                            <input name="a_end_date" type="date" class="form-control" value="{{$absen->END_DATE}}"> 
                                            @if($errors->has('a_end_date'))
                                                <span class="help-block">{{$errors->first('a_end_date')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('a_s_name') ? 'has-error' : '' }} ">
                                        <label>Nama Siswa</label>
                                        <select name="a_s_name" class="form-control">
                                            @foreach($siswa as $s)
                                                <option value="{{ $s->id }}" @if($absen->STUDENTS_ID == $s->id) selected @endif>{{ $s->FNAME }}{{" "}}{{$s->LNAME}}</option>                                                    
                                            @endforeach                                                
                                        </select>
                                        @if($errors->has('a_s_name'))
                                            <span class="help-block">{{$errors->first('a_s_name')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('a_type') ? 'has-error' : '' }} ">
                                        <label>Alasan</label>
                                        <select name="a_type" class="form-control" id="inputGroupSelect01">
                                                <option value="SICK" @if($absen->TYPE == 'SICK') selected @endif>SICK</option>
                                                <option value="LEAVE" @if($absen->TYPE == 'LEAVE') selected @endif>PERMISSION</option>
                                                <option value="ABSENT" @if($absen->TYPE == 'ABSENT') selected @endif>ABSENT</option>                                                
                                        </select>
                                        @if($errors->has('a_type'))
                                            <span class="help-block">{{$errors->first('a_type')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('a_desc') ? 'has-error' : '' }} ">
                                        <label>Deskripsi</label>
                                        <textarea name="a_desc" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$absen->DESCRIPTION}}</textarea>
                                        @if($errors->has('a_desc'))
                                            <span class="help-block">{{$errors->first('a_desc')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('a_image') ? 'has-error' : '' }} ">
                                        <label>Upload bukti ketidakhadiran</label>
                                        <input name="a_image" type="file" class="form-control">
                                        @if($errors->has('a_image'))
                                            <span class="help-block">{{$errors->first('a_image')}}</span>
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

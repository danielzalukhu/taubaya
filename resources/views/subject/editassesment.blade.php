@extends('layout.master')

@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                @if(session('sukses'))
                    <div class="alert alert-success" role="alert">
                        {{ session('sukses') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-warning" role="alert">
                        {{ session('error') }}
                    </div> 
                @endif
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel-heading">
                            <h3 class="box-title">UBAH DATA NILAI SISWA</h3>            
                        </div>
                        <div class="box">
                            <div class="box-body">
                            <form action="{{ route ('subject.updateAssesment', $laporan_mapel->id) }}" method="post" enctype="multipart/form-data">
                                
                                {{ csrf_field() }}

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">                                                                    

                                    <div class="form-group{{ $errors->has('a_subject_name') ? 'has-error' : '' }} ">
                                        @php
                                            $subjectLabel = "";
                                            $subjectId = "";
                                            foreach($mapel as $m){
                                                if($laporan_mapel->SUBJECTS_ID === $m->id){
                                                    $subjectId = $m->id;
                                                    $subjectLabel = $m->DESCRIPTION;
                                                }
                                            }
                                        @endphp
                                        <h4>Mata Pelajaran :  <b>{{ $subjectLabel }}</b> </h4>
                                        <input type="hidden" name="a_subject_id" value="<?php echo $subjectId; ?>">
                                        @if($errors->has('a_subject_name'))
                                            <span class="help-block">{{$errors->first('a_subject_name')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('a_student_name') ? 'has-error' : '' }} ">
                                        @php
                                            $studentLabel = "";
                                            foreach($siswa as $s){
                                                if($laporan_mapel->subjectrecord->STUDENTS_ID === $s->id){
                                                    $studentLabel = $s->FNAME . " " . $s->LNAME;
                                                }
                                            }
                                        @endphp
                                        <h4>Nama Siswa : <b> {{ $studentLabel }} </b> </h4>
                                        @if($errors->has('a_student_name'))
                                            <span class="help-block">{{$errors->first('a_student_name')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('a_nilai_tugas') ? 'has-error' : '' }} ">
                                        <label>Nilai Tugas</label>
                                            @php
                                                $scores = json_decode($laporan_mapel->TUGAS);
                                            @endphp
                                            @foreach($scores as $score)
                                                <input name="a_nilai_tugas[]" type="number" class="form-control" value="{{ $score }}">            
                                            @endforeach
                                        @if($errors->has('a_nilai_tugas'))
                                            <span class="help-block">{{$errors->first('a_nilai_tugas')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('a_nilai_ph') ? 'has-error' : '' }} ">
                                        <label>Nilai PH</label>
                                            @php
                                                $scores = json_decode($laporan_mapel->PH);
                                            @endphp
                                            @foreach($scores as $score)
                                                <input name="a_nilai_ph[]" type="number" class="form-control" value="{{ $score }}">            
                                            @endforeach
                                        @if($errors->has('a_nilai_ph'))
                                            <span class="help-block">{{$errors->first('a_nilai_ph')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('a_nilai_pts') ? 'has-error' : '' }} ">
                                        <label>Nilai PTS</label>
                                            @php
                                                $scores = json_decode($laporan_mapel->PTS);
                                            @endphp
                                            @foreach($scores as $score)
                                                <input name="a_nilai_pts[]" type="number" class="form-control" value="{{ $score }}">            
                                            @endforeach
                                        @if($errors->has('a_nilai_pts'))
                                            <span class="help-block">{{$errors->first('a_nilai_pts')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('a_nilai_pas') ? 'has-error' : '' }} ">
                                        <label>Nilai PAS</label>
                                            @php
                                                $scores = json_decode($laporan_mapel->PAS);
                                            @endphp
                                            @foreach($scores as $score)
                                                <input name="a_nilai_pas[]" type="number" class="form-control" value="{{ $score }}">            
                                            @endforeach
                                        @if($errors->has('a_nilai_pas'))
                                            <span class="help-block">{{$errors->first('a_nilai_pas')}}</span>
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

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
                            <h3 class="box-title">UBAH PENGHARGAAN</h3>            
                        </div>
                        <div class="box">
                            <div class="box-body">
                                <form action="{{ route ('achievement.update', $penghargaan->id) }}" method="POST" enctype="multipart/form-data">
                                {{ method_field("PUT") }}
                                {{ csrf_field() }}

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    
                                    <div class="form-group{{ $errors->has('a_type') ? 'has-error' : '' }} ">
                                        <label>Tipe</label>
                                        <select name="a_type" class="form-control" id="inputGroupSelect01">
                                                <option value="PR" @if($penghargaan->TYPE == 'PR') selected @endif>PRESTASI</option>                                                    
                                                <option value="NPR" @if($penghargaan->TYPE == 'NPR') selected @endif>NON-PRESTASI</option>
                                        </select>
                                        @if($errors->has('a_type'))
                                            <span class="help-block">{{$errors->first('a_type')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('a_desc') ? 'has-error' : '' }} ">
                                        <label>Deskripsi</label>
                                        <textarea name="a_desc" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$penghargaan->DESCRIPTION}}</textarea>
                                        @if($errors->has('a_desc'))
                                            <span class="help-block">{{$errors->first('a_desc')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('a_point') ? 'has-error' : '' }}">
                                        <label>Poin</label>
                                        <input name="a_point"type="text" class="form-control" value="{{ $penghargaan->POINT }}">            
                                        @if($errors->has('a_point'))
                                            <span class="help-block">{{$errors->first('a_point')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('a_grade') ? 'has-error' : '' }}">
                                        <label>Tingkat</label>
                                        <input name="a_grade"type="text" class="form-control" value="{{ $penghargaan->GRADE }}">            
                                        @if($errors->has('a_grade'))
                                            <span class="help-block">{{$errors->first('a_grade')}}</span>
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

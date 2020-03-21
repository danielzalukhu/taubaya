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
                            <h3 class="box-title">EDIT SUBJECTS</h3>            
                        </div>
                        <div class="box">
                            <div class="box-body">
                                <form action="{{ route ('subject.update', $mapel->id) }}" method="post" enctype="multipart/form-data">
                                {{ method_field("PUT") }}
                                {{ csrf_field() }}

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label>SUBJECT CODE</label>
                                        <input name="s_code"type="text" class="form-control" value="{{ $mapel->CODE }}">            
                                    </div>

                                    <div class="form-group">
                                        <label>SUBJECT NAME</label>
                                        <input name="s_desc" type="text" class="form-control" value="{{ $mapel->DESCRIPTION }}">            
                                    </div>

                                    <div class="form-group">
                                        <label>KKM</label>
                                        <input name="s_kkm"type="text" class="form-control" value="{{ $mapel->MINIMALPOIN }}">            
                                    </div>

                                    <div class="form-group{{ $errors->has('s_type') ? 'has-error' : '' }} ">
                                        <label>TYPE</label>
                                        <select name="s_type" class="form-control" id="inputGroupSelect01">
                                                <option value="MN" @if($mapel->TYPE == 'MN') selected @endif>MUATAN NASIONAL</option>                                                    
                                                <option value="MK" @if($mapel->TYPE == 'MK') selected @endif>MUATAN KEWILAYAHAN</option>
                                                <option value="MPK" @if($mapel->TYPE == 'MPK') selected @endif>MUATAN PEMINATAN KEJUJURAN</option>
                                                <option value="DBK" @if($mapel->TYPE == 'DBK') selected @endif>DASAR BIDANG KEAHLIAN</option>                                                
                                                <option value="DPK" @if($mapel->TYPE == 'DPK') selected @endif>DASAR PROGRAM KEAHLIAN</option>                                                
                                                <option value="KK" @if($mapel->TYPE == 'KK') selected @endif>KOMPETENSI KEAHLIAN</option>                                                
                                        </select>
                                        @if($errors->has('s_type'))
                                            <span class="help-block">{{$errors->first('s_type')}}</span>
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




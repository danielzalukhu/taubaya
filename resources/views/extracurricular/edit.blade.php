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
                            <h3 class="box-title">UBAH DATA EKSTRAKURIKULER</h3>            
                        </div>
                        <div class="box">
                            <div class="box-body">
                                <form action="{{ route ('extracurricular.update', $ekskul->id) }}" method="post" enctype="multipart/form-data">
                                {{ method_field("PUT") }}
                                {{ csrf_field() }}

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">                                    
                                    
                                    <div class="form-group{{ $errors->has('e_name') ? 'has-error' : '' }} ">
                                        <label>Nama Ekstrakurikuler</label>
                                        <input name="e_name" type="text" class="form-control" value="{{ $ekskul->NAME }}">            
                                        @if($errors->has('e_name'))
                                            <span class="help-block">{{$errors->first('e_name')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('e_desc') ? 'has-error' : '' }} ">
                                        <label>Deskripsi</label>            
                                        <textarea name="e_desc" class="form-control" rows="3">{{ $ekskul->DESCRIPTION }}</textarea>
                                        @if($errors->has('e_desc'))
                                            <span class="help-block">{{$errors->first('e_desc')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('e_staff_id') ? 'has-error' : '' }} ">
                                        <label>Nama Pembina</label>
                                        <select name="e_staff_id" class="form-control">
                                            @foreach($karyawan as $k)
                                                <option value="{{ $k->id }}" @if($ekskul->STAFFS_ID == $k->id) selected @endif>{{ $k->NAME }}</option>                                                    
                                            @endforeach                                                
                                        </select>
                                        @if($errors->has('e_staff_id'))
                                            <span class="help-block">{{$errors->first('e_staff_id')}}</span>
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

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
                            <h3 class="box-title">EDIT VIOLATION</h3>            
                        </div>
                        <div class="box">
                            <div class="box-body">
                                <form action="{{ route ('violation.update', $pelanggaran->id) }}" method="post" enctype="multipart/form-data">
                                {{ method_field("PUT") }}
                                {{ csrf_field() }}

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label>Violation Name</label>
                                        <input name="v_name" type="text" class="form-control" value="{{ $pelanggaran->NAME }}">            
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <input name="v_desc"type="text" class="form-control" value="{{ $pelanggaran->DESCRIPTION }}">            
                                    </div>

                                    <div class="form-group">
                                        <label>Point</label>
                                        <input name="v_point"type="text" class="form-control" value="{{ $pelanggaran->POINT }}">            
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




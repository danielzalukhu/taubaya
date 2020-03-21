@extends('layout.master')

@section('header')
<!-- DataTables -->
<link rel="stylesheet" href="adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@stop

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
                            <h3 class="box-title">INCOMPLETE SUBJECT LIST</h3>            
                        </div>
                        <div class="box">
                            <div class="box-header">
                                <div class="right">
                                    <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#exampleModal">CREATE NEW</button>
                                </div>
                            </div>
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>STUDENT NAME</th>
                                    <th>DATE</th>
                                    <th colspan="2">KODE - DESCRIPTION</th>
                                    <th>NOTED BY</th>
                                    <th>EDIT</th>
                                    <th>DELETE</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ketidaktuntasan as $tts)
                                    <tr>
                                        <td>{{$tts->student->FNAME}}{{" "}}{{$tts->student->LNAME}}</td>
                                        <td>{{date('d-m-Y', strtotime($tts->DATE))}}</td>
                                        <td>{{$tts->violation->NAME}}</td>
                                        <td>{{$tts->DESCRIPTION}}</td>
                                        <td>{{$tts->staff->NAME}}</td>
                                        <td><a href= "{{ route ('subject.editIncomplete', $tts->id )}}" class="btn btn-primary btn-sm">EDIT</td>
                                        <td>
                                            <form action="{{ route ('subject.destroyIncomplete', $tts->id )}}" method="GET">
                                                <input type="hidden" name="_method" value="DELETE">
                                                {{ method_field("DELETE" )}}
                                                {{ csrf_field() }}
                                                <input type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" value="DELETE">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Create New-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">INPUT INCOMPLETE REPORT</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('subject.storeIncomplete') }}" method="post"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group{{ $errors->has('vr_date') ? 'has-error' : '' }} ">
                            <label>Date</label>
                            <input name="vr_date" type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('vr_date')}}">            
                            @if($errors->has('vr_date'))
                                <span class="help-block">{{$errors->first('vr_date')}}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('vr_academic_year') ? 'has-error' : '' }} ">
                            <label>Academic Year</label>
                            <select name="vr_academic_year" class="form-control" id="inputGroupSelect01">
                                @foreach($tahun_ajaran as $ta)
                                    <option value='{{ $ta->id }}'>
                                        {{ $ta->TYPE}}
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
                            <select name="vr_student_name" class="form-control" id="inputGroupSelect01">
                                @foreach($siswa as $s)
                                    <option value='{{ $s->id }}'>{{ $s->FNAME }}{{" "}}{{$s->LNAME}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('a_type'))
                                <span class="help-block">{{$errors->first('vr_student_name')}}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('vr_violation_name') ? 'has-error' : '' }} ">
                            <label>Violation Name</label>
                            <select name="vr_violation_name" class="form-control" id="inputGroupSelect01">
                                @foreach($pelanggaran as $p)
                                    <option value="{{ $p->id }}" @if($p->NAME == 'TTS') selected @else disabled @endif>{{$p->NAME}}{{" - "}}{{ $p->DESCRIPTION }}</option>                                           
                                @endforeach
                            </select>
                            @if($errors->has('vr_violation_name'))
                                <span class="help-block">{{$errors->first('vr_violation_name')}}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('vr_description') ? 'has-error' : '' }} ">
                            <label>Description</label>
                            <textarea name="vr_description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{old('vr_desc')}}</textarea>
                            @if($errors->has('vr_description'))
                                <span class="help-block">{{$errors->first('vr_description')}}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('vr_noted_by') ? 'has-error' : '' }} ">
                            <label>Noted By</label>
                            <select name="vr_noted_by" class="form-control" id="inputGroupSelect01">
                                @foreach($karyawan as $k)
                                    <option value='{{ $k->id }}'>{{ $k->NAME }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('vr_noted_by'))
                                <span class="help-block">{{$errors->first('vr_noted_by')}}</span>
                            @endif
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
@stop

@section('footer')
<script>
    $(function () {
        $('#example1').DataTable()
            $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
            })
        })
</script>
@stop
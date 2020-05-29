@extends('layout.master')

@section('header')
    <link rel="stylesheet" href="{{asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@stop

@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                @if ($sukses = Session::get('sukses'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $sukses }}</strong>
                    </div>
                @endif
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel-heading">
                            <h3 class="box-title">DAFTAR NAMA SISWA</h3>            
                        </div>
                        <div class="box">
                            <div class="box-header">
                                <div class="right">
                                    @if(Auth::guard('web')->user()->staff->ROLE === "HEADMASTER")
                                        <h5 class="box-header-title"><b>DAFTAR KELAS: </b>
                                            <span>
                                                <div class="btn-group">
                                                    <select type="button" id="dropdown-daftar-kelas" class="btn btn-default dropdown-toggle">
                                                        @foreach($kelas as $k)
                                                            <option value='{{ $k->id }}' grade-id="{{$k->id}}">
                                                                {{ $k->NAME }}
                                                            </option>                                                                        
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </span>        
                                        </h5>                                    
                                    @elseif(Auth::guard('web')->user()->staff->ROLE === "ADMIN")
                                        <h5 class="box-header-title"><b>DAFTAR KELAS: </b>
                                            <span>
                                                <div class="btn-group">
                                                    <select type="button" id="dropdown-daftar-kelas" class="btn btn-default dropdown-toggle">
                                                        @foreach($kelas as $k)
                                                            <option value='{{ $k->id }}' grade-id="{{$k->id}}">
                                                                {{ $k->NAME }}
                                                            </option>                                                                        
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#modalTambahSiswa">INPUT DAFTAR SISWA</button>                                        
                                            </span>        
                                        </h5>                                        
                                    @elseif(Auth::guard('web')->user()->staff->ROLE === "TEACHER")
                                        <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#modalTambahSiswa">INPUT DAFTAR SISWA</button>
                                    @endif
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NISN</th>
                                            <th>NAMA SISWA</th>
                                            <th>KELAS</th>
                                            <th>ANGKATAN</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="list-student">
                                    @php $i=1 @endphp
                                    @foreach($siswa as $s)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $s->student->NISN }}</a></td>
                                            <td>{{ $s->student->FNAME }}{{" "}}{{ $s->student->LNAME }}</td>
                                            <td>{{ $s->grade->NAME }}</td>
                                            <td>{{ $s->student->academicyear->NAME }}</td>
                                            <td>
                                                <a href="{{ route('student.profile', ['id'=>$s->student->id]) }}" title="Profil Siswa" class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>  
                                                <a href="{{ route('subject.studentSubject', [$s->student->id, $s->grade->NAME]) }}" title="Mata Pelajaran" class="btn btn-default btn-sm">
                                                    <i class="fa fa-book"></i>
                                                </a>                                            
                                                <form action="{{ route ('student.destroy', $s->student->id )}}" method="POST" class="inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button title="Hapus" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" value="DELETE">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
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
    </div>

    <!-- MODAL -->
    <div class="modal fade" id="modalTambahSiswa" tabindex="-1" role="dialog" aria-labelledby="modalTambahSiswaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">INPUT DATA SISWA BARU</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('student.importStudent') }}" method="post"  enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <div class="form-group{{ $errors->has('student_import') ? 'has-error' : '' }} ">
                            <label>IMPORT EXCEL (XLSX/XLS)</label>
                            <input name="student_import" type="file" class="form-control">
                            @if($errors->has('student_import'))
                                <span class="help-block">{{$errors->first('student_import')}}</span>
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
        
    $('#dropdown-daftar-kelas').val({{$grade_id}});

    $('#dropdown-daftar-kelas').change(function(){
        var gradeId = $(this).val();
        var route =  "{{ route('student.index') }}"  
        window.location = route+"?gradeId="+gradeId;        
    })     
</script>
@stop
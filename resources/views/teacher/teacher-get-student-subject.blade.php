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
                            <h3 class="box-title">DAFTAR MATA PELAJARAN </h3>
                            <h4>NAMA SISWA: <b>{{ $siswa->FNAME }}{{" "}}{{ $siswa->LNAME }}</b></h4>                       
                        </div>
                        <div class="box">
                            <div class="box-header">
                                <div class="right">
                                    <h5 class="box-header-title"><b>RIWAYAT KELAS: </b>
                                        <span>
                                            <div class="btn-group">
                                                <select type="button" id="dropdown-catatan-kelas" onChange=loadPage() class="btn btn-default dropdown-toggle">
                                                    @foreach($grade_record as $gr)
                                                        <option value='{{ $gr->grade->NAME }}'>
                                                            {{ $gr->grade->NAME }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </span>        
                                    </h5>                           
                                </div
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>KODE MAPEL</th>
                                            <th>NAMA MAPEL</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1 @endphp
                                    @foreach($subject as $s)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $s->CODE }}</td>
                                            <td>{{ $s->DESCRIPTION }}</td>
                                            <td>
                                                <a href="{{route('subject.studentDetailSubject', [$siswa->id, $s->id])}}"  class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>                                         
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

    var code = '{{$s->CODE}}'
    var code1 = code.split("-")
    var res_code = code1[0] + "-" + code1[1] 
    
    $('#dropdown-catatan-kelas').val("{{$grade_name}}")

    $('#dropdown-catatan-kelas').change(function(){
        var gradeName = $(this).val();            
        var route =  "{{ route('subject.studentSubject', [':id', ':idm']) }}"
        var route1 = route.replace(':id', '{{$siswa->id}}')
        var route2 = route1.replace(':idm', res_code)
        // history.pushState({}, "", route2)        
        // console.log(route2)
        window.location = route2+"?filterGrade="+gradeName;     
    })
</script>
@stop

@extends('layout.master')

@section('header')
<!-- <?php 
//  $userRole =  Auth::guard('web')->user()->ROLE;
//  if($userRole == "STUDENT")
//  {
//    header("Location: ". route('student.profile'))
//  }
?> -->

@stop

@section('content')
<div class="main">
    <div class="main-content">
        <section class="content-header">
          <h1>SISTEM MONITORING PRESTASI SISWA
              <small>
              {{$tahun_ajaran[0]->TYPE}}{{" - "}}{{$tahun_ajaran[0]->NAME}}
              </small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <section class="content">
            <div class="row">
                @if(Auth::guard('web')->user()->ROLE === "STAFF")
                <div class="col-lg-3 col-xs-6">
                  <div class="small-box bg-blue">
                    <div class="inner">
                      <h3>{{$jumlah_siswa}}</h3>
                      <p>SISWA</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-users"></i>
                    </div>
                    <a href="{{route('student.index')}}" class="small-box-footer">Daftar Siswa.. <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                @else
                <div class="col-lg-3 col-xs-6">
                  <div class="small-box bg-blue">
                    <div class="inner">
                      <h3>PROFIL</h3>
                      <p>KU</p>
                    </div>
                    <div class="icon">
                      <a href="{{route('student.profile', ['id'=>request()->session()->get('session_student_id')])}}" class="small-box-footer">
                        <i class="fa fa-users"></i>
                      </a>
                    </div>                    
                  </div>
                </div>
                @endif

                @if(Auth::guard('web')->user()->ROLE === "STAFF")
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                      <div class="inner">
                        <h3>{{$jumlah_penghargaan}}</h3>
                        <p>PENGHARGAAN</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-trophy"></i>
                      </div>
                      <a href="{{route('achievementrecord.index')}}" class="small-box-footer">Daftar Penghargaan..<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @else
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                      <div class="inner">
                        <h3>{{$jumlah_penghargaan}}</h3>
                        <p>PENGHARGAAN</p>
                      </div>      
                      <div class="icon">
                        <a href="{{route('student.profile', ['id'=>request()->session()->get('session_student_id')])}}" class="small-box-footer">
                          <i class="ion ion-trophy"></i>
                        </a>
                      </div>      
                    </div>
                </div>
                @endif

                @if(Auth::guard('web')->user()->ROLE === "STAFF")
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                      <div class="inner">
                        <h3>{{$jumlah_pelanggaran}}</h3>
                        <p>PELANGGARAN</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-person-add"></i>
                      </div>
                      <a href="{{route('violationrecord.index')}}" class="small-box-footer">Daftar Pelanggaran.. <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @else
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                      <div class="inner">
                        <h3>{{$jumlah_pelanggaran}}</h3>
                        <p>PELANGGARAN</p>
                      </div>         
                      <div class="icon">
                        <a href="{{route('student.profile', ['id'=>request()->session()->get('session_student_id')])}}" class="small-box-footer">
                          <i class="ion ion-person-add"></i>
                        </a>
                      </div>                                      
                    </div>
                </div>
                @endif
                
                @if(Auth::guard('web')->user()->ROLE === "STAFF")
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                      <div class="inner">
                        <h3>{{date("D")}}<sup style="font-size: 20px"></sup></h3>
                        <p>{{date("d-m-Y")}}</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                      </div>
                      <a href="{{route('absent.index')}}" class="small-box-footer">Daftar Absensi..<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @else
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                      <div class="inner">
                        <h3>{{date("D")}}<sup style="font-size: 20px"></sup></h3>
                        <p>{{date("d-m-Y")}}</p>
                      </div>
                      <div class="icon">
                        <a href="{{route('student.profile', ['id'=>request()->session()->get('session_student_id')])}}" class="small-box-footer">
                          <i class="ion ion-pie-graph"></i>
                        </a>
                      </div>
                    </div>
                </div>
                @endif

            </div>

            @if(Auth::guard('web')->user()->ROLE === "STAFF")
            <div class="row"> 
              <div class="col-lg-12"> 
                <div class="box box-warning">
                  <div class="box-header with-border">
                      <h3 class="box-title">Daftar Siswa Bermasalah</h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove">
                          <i class="fa fa-times"></i>
                        </button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table no-margin">
                        <thead>
                          <tr>
                            <th>NISN</th>
                            <th>NAMA SISWA</th>
                            <th>TOTAL PELANGGARAN</th>
                            <th>TOTAL POIN</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($siswa_bermasalah as $sb)
                            <tr>
                              <td>{{ $sb->NISN }}</td>
                              <td>{{ $sb->FNAME }}{{" "}}{{ $sb->LNAME }}</td>
                              <td>{{ $sb->BANYAKPELANGGARAN }}</td>
                              <td>
                                  @if($sb->TOTALPOIN >= 50 && $sb->TOTALPOIN < 100)
                                      <div class="btn btn-warning btn-sm">{{ $sb->TOTALPOIN }}</div>
                                  @elseif($sb->TOTALPOIN >= 100)
                                      <div class="btn btn-danger btn-sm">{{ $sb->TOTALPOIN }}</div>
                                  @endif 
                              </td>
                            </tr>
                          @empty
                            <tr>
                                <td colspan="12" class="text-center p-5">Belum ada daftar siswa bermasalah</td>
                            </tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>                  
                  <div class="box-footer clearfix">
                    <a href="{{route('violationrecord.index')}}" class="btn btn-sm btn-info btn-flat pull-left">Buat Daftar Pelanggaran</a>
                    <a href="{{route('violationrecord.index')}}" class="btn btn-sm btn-default btn-flat pull-right">Lihat Daftar Pelanggaran</a>
                  </div>
              </div>
            </div>
            @endif
            
        </section>
    </div>
</div>

<div class="modal fade" id="alertModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">
            <div class="modal-header" style="padding:35px 50px;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="glyphicon glyphicon-warning-sign"></h4>
            </div>

            <div class="modal-body" style="padding:40px 50px;">
              <p id="judulPesan"><b>ATTENTION PLEASE</b></p>
              <p id="pesan">There is student who have point above 50, see it!</p>
            </div>

            <div class="modal-footer">
              <button type="submit" onclick="alertFunction()" id="tombolModal" class="btn btn-danger btn-default pull-right"><span class="glyphicon glyphicon-eye-open"></button>              
            </div>
        </div>

    </div>
</div>
@stop

@section('footer')
<script>
    // var tmp = <//?//php echo json_encode($siswa_bermasalah) ?>;
    // var arrID = "";

    // for(i = 0; i < tmp.length; i++)
    // {
    //   arrID = tmp[i]["IDSISWA"];
    //   console.log(arrID);
    //   if(arrID > 0)
    //   {
    //     $(document).ready(function(){
    //       //var hasShow = localStorage.getItem("is_dashboard_popup");
    //       // if(!hasShow){
    //       $('#alertModal').modal('show');
    //       //  localStorage.setItem("is_dashboard_popup", true);
    //       // }
    //     })
    //   }
    // }

    // function alertFunction()
    // {
    //   location.replace("http://localhost/tugasakhir/public/violationrecord");
    // }    
</script>
@stop 


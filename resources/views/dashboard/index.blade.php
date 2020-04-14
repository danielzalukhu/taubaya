@extends('layout.master')

@section('header')
<!-- <?php 
//  $userRole =  Auth::guard('web')->user()->ROLE;
//  if($userRole == "STUDENT")
//  {
//    header("Location: ". route('student.profile'))
//  }
?> -->

<style>
  .modal-header, h4, .close 
  {
    background-color:    #170f7f  ;
    color:white !important;
    text-align: center;
    font-size: 50px;
  }
  #judulPesan
  {
    text-align: center;
    font-size: 40px;
    color: #f60f24;
  }
  #pesan
  {
    color:black !important;
    text-align: center;
    font-size: 20px;
  }
  .modal-footer 
  {
    background-color: #f9f9f9;
    
  }
  #tombolModal
  {
    background-color:  #f9f508 ;
  }
</style>

@stop

@section('content')
<div class="main">
    <div class="main-content">
        <section class="content-header">
          <h1>SISTEM MONITORING PRESTASI SISWA</h1>
          <ol class="breadcrumb">
            <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                  <div class="small-box bg-blue">
                    <div class="inner">
                      <h3>{{$jumlah_siswa}}</h3>
                      <p>Students</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-users"></i>
                    </div>
                    <a href="{{route('student.index')}}" class="small-box-footer">More Students <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                      <div class="inner">
                        <h3>{{$jumlah_penghargaan}}</h3>
                        <p>Student Achievements</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-trophy"></i>
                      </div>
                      <a href="{{route('achievement.index')}}" class="small-box-footer">More Trophy<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                      <div class="inner">
                        <h3>{{$jumlah_pelanggaran}}</h3>
                        <p>Record Violations</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-person-add"></i>
                      </div>
                      <a href="{{route('violationrecord.index')}}" class="small-box-footer">More Violations <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                      <div class="inner">
                        <h3>..<sup style="font-size: 20px">%</sup></h3>

                        <p>Record Absents</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                      </div>
                      <a href="{{route('absent.index')}}" class="small-box-footer">More Absents <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="row"> 
              <div class="col-lg-8"> 
                <div class="box box-warning">
                  <div class="box-header with-border">
                      <h3 class="box-title">Trouble Student</h3>
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
                            <th>STUDENT NAME</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($siswa_bermasalah as $sb)
                            <tr>
                              <td>{{ $sb->student->NISN }}</td>
                              <td>{{ $sb->student->FNAME }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>                  
                  <div class="box-footer clearfix">
                    <a href="{{route('violationrecord.index')}}" class="btn btn-sm btn-info btn-flat pull-left">Record New Violation</a>
                    <a href="{{route('violationrecord.index')}}" class="btn btn-sm btn-default btn-flat pull-right">View All Violation Records</a>
                  </div>
              </div>
              <div class="col-lg-4">

              </div>
            </div>
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


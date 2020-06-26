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
              @if($tahun_ajaran[0]->TYPE == "EVEN")
                GENAP - {{$tahun_ajaran[0]->NAME}}
              @else
                GANJIL - {{$tahun_ajaran[0]->NAME}}
              @endif
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
                  <div class="small-box" style="background-color: #5B8E87">
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
                  <div class="small-box" style="background-color: #5B8E87">
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
                    <div class="small-box" style="background-color: #2B82B1">
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
                    <div class="small-box" style="background-color: #2B82B1">
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
                    <div class="small-box" style="background-color: #CA2414">
                      <div class="inner">
                        <h3>{{$jumlah_pelanggaran}}</h3>
                        <p>PELANGGARAN</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-exclamation-triangle"></i>
                      </div>
                      <a href="{{route('violationrecord.index')}}" class="small-box-footer">Daftar Pelanggaran.. <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @else
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box" style="background-color:#CA2414">
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
                    <div class="small-box" style="background-color:#F5B7B1">
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
                    <div class="small-box" style="background-color:#F5B7B1">
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
     
            <div class="row"> 
            @if(Auth::guard('web')->user()->ROLE === "STAFF")       
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
                            @if(Auth::guard('web')->user()->ROLE === "STAFF")
                              <th>KELAS</th>
                            @endif
                            <th>TOTAL PELANGGARAN</th>
                            <th>TOTAL POIN</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($siswa_bermasalah as $sb)
                            <tr>
                              <td>{{ $sb->NISN }}</td>
                              <td>{{ $sb->FNAME }}{{" "}}{{ $sb->LNAME }}</td>
                              @if(Auth::guard('web')->user()->ROLE === "STAFF")
                                <td>{{ $sb->NAMAKELAS }}</td>
                              @endif
                              <td>{{ $sb->BANYAKPELANGGARAN }}</td>
                              <td>
                                  @if($sb->TOTALPOIN >= 50 && $sb->TOTALPOIN < 100)
                                      <div class="btn btn-warning btn-sm">{{ $sb->TOTALPOIN }}</div>
                                  @elseif($sb->TOTALPOIN >= 100)
                                      <div class="btn btn-danger btn-sm">{{ $sb->TOTALPOIN }}</div>
                                  @endif 
                              </td>
                              <td>
                                <a href="{{ route('student.profile', ['id'=>$sb->id]) }}" title="Profil Siswa" class="btn btn-default btn-sm">
                                  <i class="fa fa-user"></i>
                                </a> 
                              </td>
                            </tr>
                          @empty
                            <tr>
                                <td colspan="6" class="text-center p-5">Belum ada daftar siswa bermasalah</td>
                            </tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>                  
                  <div class="box-footer clearfix">
                    <a href="{{route('violationrecord.index')}}" class="btn btn-sm btn-info  pull-right">Catatan Pelanggaran Lainnya..</a>
                  </div>
                <div>
              </div>
            @elseif(Auth::guard('web')->user()->ROLE === "STUDENT")
              <div class="col-lg-12">
                @if( $grafik_absen_data["kehadiran"] < 95)
                  <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> PERHATIAN!</h4>
                    Harap perhatikan kehadiaran Anda! Persentase kehadiran sekarang {{ $grafik_absen_data["kehadiran"] }} %, 
                    jangan sampai dibawah 90%
                  </div>
                @endif
              </div>
            @endif
            </div>

            <div class="row">
              <div class="col-lg-6">
                <div class="box box-default">
                  <div class="box-header with-border">
                    @if(Auth::guard('web')->user()->ROLE === "STAFF")
                      <h3 class="box-title">Daftar Laporan Ketidaktuntasan</h3>
                    @else
                      <h3 class="box-title">Laporan Ketidaktuntasan</h3>
                    @endif
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
                            <th>#</th>
                            <th>TANGGAL</th>
                            <th>NISN</th>
                            <th>NAMA SISWA</th>
                            @if(Auth::guard('web')->user()->ROLE === "STAFF")
                              <th>KELAS</th>
                            @endif
                            <th>KETERANGAN</th>                            
                          </tr>
                        </thead>
                        <tbody>
                        @php $i=1 @endphp
                        @forelse($daftar_ketidaktuntasan as $dk)
                          <tr>
                            <td>{{ $i++ }}</td>
                            <td><b>{{date('d-m-Y', strtotime($dk->DATE))}}</b></td>
                            <td>{{ $dk->student->NISN }}</td>
                            <td>{{ $dk->student->FNAME }}{{" "}}{{ $dk->student->LNAME }}</td>
                            @if(Auth::guard('web')->user()->ROLE === "STAFF")
                              <td>{{ $dk->NAMAKELAS }}</td>
                            @endif
                            <td>{{ $dk->DESCRIPTION }}</td>
                          </tr>
                        @empty
                          <tr>
                              <td colspan="12" class="text-center p-5">Belum ada daftar Ketidaktuntasan</td>
                          </tr>
                        @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div> 
                  <div class="box-footer clearfix">
                    <a href="{{route('subject.incompleteku')}}" class="btn btn-sm btn-info pull-right">Daftar Catatan Ketidaktuntasan Lainnya ..</a>
                  </div>   
                </div>
              </div>

              <div class="col-lg-6">
                <div class="box box-success">
                  <div class="box-header with-border">
                    @if(Auth::guard('web')->user()->ROLE === "STAFF")
                      <h3 class="box-title">Daftar Prestasi Siswa</h3>
                    @else
                      <h3 class="box-title">Prestasi-Ku</h3>
                    @endif
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
                            <th>#</th>
                            <th>NAMA SISWA</th>
                            @if(Auth::guard('web')->user()->ROLE === "STAFF")
                              <th>KELAS</th>
                            @endif
                            <th>JUMLAH PENGHARGAAN</th>
                            <th>POIN PENGHARGAAN</th>      
                            <th></th>                      
                          </tr>
                        </thead>
                        <tbody>
                        @php $i=1 @endphp
                        @forelse($daftar_penghargaan_siswa as $gad)
                          <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $gad->student->FNAME }}{{" "}}{{ $gad->student->LNAME }}</td>
                            @if(Auth::guard('web')->user()->ROLE === "STAFF")
                              <td>{{ $gad->NAMAKELAS }}</td>
                            @endif
                            <td>{{ $gad->BANYAKPENGHARGAAN }}</td>
                            <td>{{ $gad->POINPENGHARGAAN }}</td>
                            <td>
                              <a href="{{ route('student.profile', ['id'=>$gad->student->id]) }}" title="Profil Siswa" class="btn btn-default btn-sm">
                                <i class="fa fa-user"></i>
                              </a> 
                            </td>
                          </tr>
                        @empty
                          <tr>
                              <td colspan="12" class="text-center p-5">Belum ada daftar penghargaan</td>
                          </tr>
                        @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>   
                  <div class="box-footer clearfix">
                    <a href="{{route('achievementrecord.index')}}" class="btn btn-sm btn-info pull-right">Daftar Penghargaan Lainnya ..</a>
                  </div>  
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-lg-12">
                <div class="box box-info">
                  <div class="box-header with-border">
                    @if(Auth::guard('web')->user()->ROLE === "STAFF")
                      <h3 class="box-title">Absensi Kelas</h3>
                    @else
                      <h3 class="box-title">Absen-Ku</h3>
                    @endif
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
                              <th>#</th>
                              <th>TIPE ABSESNI</th>
                              <th>JUMLAH</th>
                              <th></th>                      
                            </tr>
                          </thead>
                          <tbody>
                          @php $i=1 @endphp
                          @forelse($grafik_absen_data["data"] as $gad)
                            <tr>
                              <td>{{ $i++ }}</td>
                              <td>{{ $gad->TIPE }}</td>
                              <td>{{ $gad->JUMLAH }}</td>
                              <td>
                                <a href="{{ route('absent.index') }}" title="Daftar Absen" class="btn btn-info btn-sm">
                                  <i class="fa fa-eye"></i>
                                </a> 
                              </td>
                            </tr>                            
                            @empty
                            <tr>
                                <td colspan="12" class="text-center p-5">Belum ada daftar penghargaan</td>
                            </tr>
                          @endforelse
                          </tbody>
                          @if(Auth::guard('web')->user()->ROLE === "STUDENT")
                          <tfoot>
                            <td colspan="2"> KEHADIRAN &nbsp <b>{{ $grafik_absen_data["kehadiran"] }} % </b></td>
                            <td colspan="2">KETIDAKHADIRAN &nbsp <b>{{ 100 - $grafik_absen_data["kehadiran"] }} % </b></td>
                          </tfoot>                          
                          @endif
                        </table>
                      </div>                      
                  </div>
                </div>
              </div>
            </div>     

        </section>
    </div>
</div>

@stop

@section('footer')

@stop 


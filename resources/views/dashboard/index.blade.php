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
                        <i class="ion ion-person-add"></i>
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
                <div>
              </div>
            @endif
            </div>

            <div class="row">
              <div class="col-lg-6">
                <div class="box box-default">
                  <div class="box-header with-border">
                    <h3 class="box-title">Daftar Ketidaktuntasan</h3>
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
                            <th>TANGGAL</th>
                            <th>KETERANGAN</th>                            
                          </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>    
                </div>
              </div>

              <div class="col-lg-6">
                <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">Daftar Siswa Berprestasi</h3>
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
                            <th>TANGGAL</th>
                            <th>KETERANGAN</th>                            
                          </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>    
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-lg-6">
                <div class="box box-info">
                  <div class="box-header with-border">
                      <h3 class="box-title">Pelanggaran Yang Sering Dilakukan</h3>
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
                      <div id="dashboardViolationListOftenOccurChart"></div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="box box-info">
                  <div class="box-header with-border">
                      <h3 class="box-title">Absensi Kelas</h3>
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
                      <div id="dashboardAbsentChart"></div>
                  </div>
                </div>
              </div>
            </div>     

        </section>
    </div>
</div>

@stop

@section('footer')
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
    Highcharts.chart('dashboardViolationListOftenOccurChart', {
        chart: {
            type: 'column'
        },
        title: {
            text: '5 Daftar Pelanggaran Yang Sering Dilakukan'
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Rainfall (mm)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Tokyo',
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

        }, {
            name: 'New York',
            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

        }, {
            name: 'London',
            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

        }, {
            name: 'Berlin',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

        }]
    });

    Highcharts.chart('dashboardAbsentChart', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'PERSENTASE ABSENSI DALAM SATU PERIODE BERDASARKAN JENIS ABSENSI'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        credits: {
            enabled: false
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'Chrome',
                y: 61.41,
                sliced: true,
                selected: true
            }, {
                name: 'Internet Explorer',
                y: 11.84
            }, {
                name: 'Firefox',
                y: 10.85
            }, {
                name: 'Edge',
                y: 4.67
            }, {
                name: 'Safari',
                y: 4.18
            }, {
                name: 'Other',
                y: 7.05
            }]
        }]
    });
</script>
@stop 


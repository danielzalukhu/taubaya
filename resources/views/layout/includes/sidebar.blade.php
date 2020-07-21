<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('adminlte/img/default.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::guard('web')->user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="{{route('dashboard.index')}}">
            <i class="fa fa-dashboard"></i> <span>DASHBOARD</span>
          </a>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>SISWA</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @if(Auth::guard('web')->user()->ROLE === "STAFF")
              <li><a href="{{route('student.index')}}"><i class="fa fa-user-plus"></i>DAFTAR SISWA</a></li>            
            @elseif(Auth::guard('web')->user()->ROLE === "STUDENT")
              <li><a href="{{route('student.profile', [ 'id'=>request()->session()->get('session_student_id') ])}} "><i class="fa fa-user"></i>PROFIL-KU</a></li>
            @elseif(Auth::guard('web')->user()->ROLE === "PARENT")
              <li><a href="{{route('student.profile', [ 'id'=>request()->session()->get('session_guardian_id') ])}} "><i class="fa fa-user"></i>PROFIL-SISWA</a></li>
            @endif                    
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>MATA PELAJARAN</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">          
            @if((Auth::guard('web')->user()->ROLE === "STUDENT"))
              <li><a href="{{route('student.mapelku')}}"><i class="fa fa-book"></i>MAPEL-KU</a></li>
              <li><a href="{{route('subject.incompleteku')}}"><i class="fa fa-thumbs-down"></i>LAPORAN KETIDAKTUNTASAN </a></li>
            @elseif((Auth::guard('web')->user()->ROLE === "PARENT"))
              <li><a href="{{route('student.mapelku')}}"><i class="fa fa-book"></i>MAPEL-SISWA</a></li>
              <li><a href="{{route('subject.incompleteku')}}"><i class="fa fa-thumbs-down"></i>LAPORAN KETIDAKTUNTASAN </a></li>
            @elseif(Auth::guard('web')->user()->staff->ROLE === "TEACHER")
              <li><a href="{{route('student.mapelguru')}}"><i class="fa fa-book"></i>MAPEL-GURU</a></li> 
              <li><a href="{{route('subject.incomplete')}}"><i class="fa fa-thumbs-down"></i>LAPORAN KETIDAKTUNTASAN </a></li>
              <li><a href="{{route('subject.assesment')}}"><i class="fa fa-pencil"></i>INPUT PENILAIAN</a></li>              
            @else
              <li><a href="{{route('subject.incomplete')}}"><i class="fa fa-thumbs-down"></i>LAPORAN KETIDAKTUNTASAN </a></li>
            @endif
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
              <i class="fa fa-heart"></i> <span>EKSTRAKURIKULER</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            @if(Auth::guard('web')->user()->ROLE === "STAFF" && Auth::guard('web')->user()->staff->getDepartmentName() === "Departemen PENJASKES")
              <li><a href="{{route('extracurricular.index')}}"><i class="fa fa-eye"></i>DAFTAR EKSTRAKURIKULER</a></li>
              <li><a href="{{route('extracurricular.assesment')}}"><i class="fa fa-pencil"></i>INPUT NILAI EKSKUL</a></li>                          
              <li><a href="{{route('extracurricular.ekskul')}}"><i class="fa fa-list"></i>DAFTAR NILAI EKSKUL </a></li>            
            @elseif(Auth::guard('web')->user()->ROLE === "STAFF")       
              @if(Auth::guard('web')->user()->staff->ROLE === "HEADMASTER")
                <li><a href="{{route('extracurricular.index')}}"><i class="fa fa-eye"></i> DAFTAR EKSTRAKURIKULER</a></li>
                <li><a href="{{route('extracurricular.ekskul')}}"><i class="fa fa-list"></i>EKSKUL SISWA</a></li>            
              @elseif(Auth::guard('web')->user()->staff->ROLE === "TEACHER")
                <li><a href="{{route('extracurricular.index')}}"><i class="fa fa-eye"></i> DAFTAR EKSTRAKURIKULER</a></li>
                <li><a href="{{route('extracurricular.assesment')}}"><i class="fa fa-pencil"></i>INPUT NILAI EKSKUL</a></li>            
                <li><a href="{{route('extracurricular.ekskul')}}"><i class="fa fa-list"></i>EKSKUL SISWA</a></li>  
              @endif
            @elseif(Auth::guard('web')->user()->ROLE === "STUDENT")
              <li><a href="{{route('extracurricular.ekskulKu')}}"><i class="fa fa-eye"></i>EKSKUL-KU</a></li>              
            @elseif(Auth::guard('web')->user()->ROLE === "PARENT")
              <li><a href="{{route('extracurricular.ekskulKu')}}"><i class="fa fa-eye"></i>EKSKUL-SISWA</a></li>              
            @endif
          </ul>
        </li>

        @if(Auth::guard('web')->user()->ROLE === "STAFF")
        <li class="treeview">
          <a href="#">
              <i class="fa fa-trophy"></i> <span>PENGHARGAAN</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="{{route('achievement.index')}}"><i class="fa fa-thumbs-up"></i>DAFTAR PENGHARGAAN</a></li>
              <li><a href="{{route('achievementrecord.index')}}"><i class="fa fa-list-ol"></i>CATAT PENGHARGAAN</a></li>
          </ul>
        </li>
        @endif

        @if(Auth::guard('web')->user()->ROLE === "STAFF")
        <li class="treeview">
          <a href="#">           
              <i class="fa fa-thumbs-down"></i> <span>PELANGGARAN</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('violation.index')}}"><i class="fa fa fa-warning"></i>DAFTAR PELANGGARAN</a></li>
            <li><a href="{{route('violationrecord.index')}}"><i class="fa fa-list-ol"></i>CATAT PELANGGARAN</a></li>
          </ul>
        </li>
        @endif

        @if(Auth::guard('web')->user()->ROLE === "STAFF")
        <li class="treeview">
          <a href="#">
              <i class="fa fa-hand-paper-o"></i> <span>PRESENSI</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('absent.index')}}"><i class="fa fa-list-ol"></i>DAFTAR PRESENSI</a></li>
          </ul>
        </li>
        @endif

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('adminlte/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::guard('web')->user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        @if(Auth::guard('web')->user()->ROLE === "STAFF")
        @endif
        
        <li>
          <a href="{{route('dashboard.index')}}">
            <i class="fa fa-dashboard"></i> <span>DASHBOARD</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>MASTER STUDENT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('student.index')}}"><i class="fa fa-user-plus"></i>STUDENT</a></li>
            <li><a href=#><i class="fa fa-book"></i>MY SUBJECT</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>MASTER SUBJECT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('subject.index')}}"><i class="fa fa-list-ol"></i>LIST OF SUBJECT</a></li>
            <li><a href="{{route('subject.incomplete')}}"><i class="fa fa-thumbs-down"></i>INCOMPLETE REPORT</a></li>
            <li><a href="{{route('subject.assesment')}}"><i class="fa fa-pencil"></i>SUBJECT ASSESSMENT</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-trophy"></i> <span>MASTER ACHIEVEMENT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('achievement.index')}}"><i class="fa fa-thumbs-up"></i>TYPES OF ACHIEVEMENTS</a></li>
            <li><a href="{{route('achievementrecord.index')}}"><i class="fa fa-list-ol"></i>RECORD ACHIEVEMENTS</a></li>
          </ul>
        </li>


        <li class="treeview">
          <a href="#">
            <i class="fa fa-thumbs-down"></i> <span>MASTER VIOLATION</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('violation.index')}}"><i class="fa fa fa-warning"></i>TYPES OF VIOLATIONS</a></li>
            <li><a href="{{route('violationrecord.index')}}"><i class="fa fa-list-ol"></i>RECORD STUDENT VIOLATIONS</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-hand-paper-o"></i> <span>MASTER ABSENT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('absent.index')}}"><i class="fa fa-list-ol"></i>ABSENT</a></li>
          </ul>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
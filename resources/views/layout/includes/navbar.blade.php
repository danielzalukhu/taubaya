<header class="main-header">
    <a href="{{route('dashboard.index')}}" class="logo">
        <span class="logo-mini"><b>S</b>MPS</span>
        <span class="logo-lg"><b>WELCOME!</b>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{asset('adminlte/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">Hi, {{Auth::guard('web')->user()->name}}</span>
                        <!-- {{Auth::guard('web')->check()}} -->
                    </a>
                    <ul class="dropdown-menu">                
                        <li class="user-header">
                            <img src="{{asset('adminlte/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                            <p>
                                {{Auth::guard('web')->user()->name}}
                                <small>
                                @if(Auth::guard('web')->user()->ROLE === "STAFF")
                                    {{Auth::guard('web')->user()->ROLE}}
                                @else
                                    NAMA SISWA DAN KELAS
                                @endif
                                </small>
                            </p>
                        </li>                
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="javascript:void(0)"  onclick="doLogout()" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                            <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<script>
    function doLogout(){
        // localStorage.removeItem("is_dashboard_popup");
        event.preventDefault();
        document.getElementById('logout-form').submit();
    }
</script>

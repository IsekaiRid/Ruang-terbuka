        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark-blue sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img class="rounded-circle" src="{{ asset('template') }}/img/LogoRuang.jpg" alt="logo"
                        width="50px" height="50px">
                </div>
                <div class="sidebar-brand-text mx-2">Ruang<sup>Terbuka</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('viewhome') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            @if (Auth::user()->role == 1)
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('viewuser') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Usert</span></a>
                </li>
            @endif
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('viewhome') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Testing Akun</span></a>
            </li>
        </ul>

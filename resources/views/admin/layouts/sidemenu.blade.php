<div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
        <li class="nav-header">
            <div class="dropdown profile-element">
                <img alt="image" class="rounded-circle" src="{{ asset('admin/img/avatar.png') }}" />
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <h3 class="block m-t-xs font-bold">{{ auth()->user()->nama }}</h3>
                    <span class="text-muted text-xs block">{{ auth()->user()->role }}</span>
                </a>
                {{-- <ul class="dropdown-menu animated fadeInRight m-t-xs">
                    <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                    <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                    <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
                    <li class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="login.html">Logout</a></li>
                </ul> --}}
            </div>
            <div class="logo-element">
                ID
            </div>
        </li>
        <li class="{{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
        </li>
        <li class="{{ Request::routeIs('admin.balita.index') ? 'active' : '' }}">
            <a href="{{ route('admin.balita.index') }}"><i class="fa fa-child"></i> <span class="nav-label">Data Balita</span></a>
        </li>
        <li class="{{ Request::routeIs('admin.ibu-hamil.index') ? 'active' : '' }}">
            <a href="{{ route('admin.ibu-hamil.index') }}"><i class="fa fa-female"></i> <span class="nav-label">Data Ibu Hamil</span></a>
        </li>
        <li class="{{ Request::routeIs('admin.gizi-balita.index') ? 'active' : '' }}">
            <a href="{{ route('admin.gizi-balita.index') }}"><i class="fa fa-child"></i> <span class="nav-label">Data Gizi Balita</span></a>
        </li>
        <li class="{{ Request::routeIs('admin.gizi-ibu-hamil.index') ? 'active' : '' }}">
            <a href="{{ route('admin.gizi-ibu-hamil.index') }}"><i class="fa fa-female"></i> <span class="nav-label">Data Gizi Ibu Hamil</span></a>
        </li>
    </ul>

</div>

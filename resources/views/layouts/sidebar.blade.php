@php
    $active = fn($var) => Request::is($var) ? 'active' : '';
@endphp

<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="/">Stisla</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
        @section('sidebar')
            <li class="menu-header">Employee</li>
            {{-- <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="index-0.html">General Dashboard</a></li>
                    <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
                </ul>
            </li> --}}
            <li class="{{ $active('employees') }}"><a class="nav-link" href="{{ url('employees') }}"><i class="fas fa-users"></i> <span>Employee</span></a></li>
        @show
    </ul>

</aside>

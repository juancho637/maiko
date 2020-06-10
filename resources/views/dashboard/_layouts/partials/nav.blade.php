<div class="sidebar-brand">
    <a href="{{ route('welcome') }}">{{ config('app.name') }}</a>
</div>
<div class="sidebar-brand sidebar-brand-sm">
    <a href="{{ route('welcome') }}">MIK</a>
</div>
<ul class="sidebar-menu">
    <li {{ request()->is('dashboard') ? 'class=active' : '' }}>
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    @can('view users')
        <li {{ request()->is('dashboard/users*') ? 'class=active' : '' }}>
            <a class="nav-link" href="{{ route('dashboard.users.index') }}">
                <i class="fas fa-users"></i>
                <span>{{ ucfirst(__("users")) }}</span>
            </a>
        </li>
    @endcan
    @can('view roles')
        <li {{ request()->is('dashboard/roles*') ? 'class=active' : '' }}>
            <a class="nav-link" href="{{ route('dashboard.roles.index') }}">
                <i class="fas fa-star"></i>
                <span>{{ ucfirst(__("roles")) }}</span>
            </a>
        </li>
    @endcan
</ul>

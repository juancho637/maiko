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
    {{-- || Auth::user()->can('view cities') --}}
    @if(Auth::user()->can('view countries') || Auth::user()->can('view states'))
        <li class="dropdown {{ request()->is('dashboard/zones*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown">
                <i class="fas fa-globe-americas"></i>
                <span>{{ ucfirst(__("zones")) }}</span>
            </a>
            <ul class="dropdown-menu">
                @can('view countries')
                    <li {{ request()->is('dashboard/zones/countries*') ? 'class=active' : '' }}>
                        <a class="nav-link" href="{{ route('dashboard.countries.index') }}">
                            <span>{{ ucfirst(__("countries")) }}</span>
                        </a>
                    </li>
                @endcan
                @can('view states')
                    <li {{ request()->is('dashboard/zones/states*') ? 'class=active' : '' }}>
                        <a class="nav-link" href="{{ route('dashboard.states.index') }}">
                            <span>{{ ucwords(__("states")) }}</span>
                        </a>
                    </li>
                @endcan
                @can('view cities')
                    <li {{ request()->is('dashboard/zones/cities*') ? 'class=active' : '' }}>
                        <a class="nav-link" href="{{ route('dashboard.cities.index') }}">
                            <span>{{ ucfirst(__("cities")) }}</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endif
</ul>

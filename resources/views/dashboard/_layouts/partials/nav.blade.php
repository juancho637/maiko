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
    @can('view work orders')
        <li {{ request()->is('dashboard/work_orders*') ? 'class=active' : '' }}>
            <a class="nav-link" href="{{ route('dashboard.work_orders.index') }}">
                <i class="fas fa-book-open"></i>
                <span>{{ ucfirst(__("ordenes de trabajo")) }}</span>
            </a>
        </li>
    @endcan
    @can('view companies')
        <li {{ request()->is('dashboard/companies*') ? 'class=active' : '' }}>
            <a class="nav-link" href="{{ route('dashboard.companies.index') }}">
                <i class="fas fa-building"></i>
                <span>{{ ucfirst(__("empresas")) }}</span>
            </a>
        </li>
    @endcan
    @can('view tanks')
        <li {{ request()->is('dashboard/tanks*') ? 'class=active' : '' }}>
            <a class="nav-link" href="{{ route('dashboard.tanks.index') }}">
                <i class="fab fa-bitbucket"></i>
                <span>{{ ucfirst(__("tanques")) }}</span>
            </a>
        </li>
    @endcan
    @can('view users')
        <li {{ request()->is('dashboard/users*') ? 'class=active' : '' }}>
            <a class="nav-link" href="{{ route('dashboard.users.index') }}">
                <i class="fas fa-users"></i>
                <span>{{ ucfirst(__("usuarios")) }}</span>
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
    @if(Auth::user()->can('view questions'))
        <li class="dropdown {{ request()->is('dashboard/settings*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown">
                <i class="fas fa-cogs"></i>
                <span>{{ ucfirst(__("ajustes")) }}</span>
            </a>
            <ul class="dropdown-menu">
                @can('view questions')
                    <li {{ request()->is('dashboard/settings/questions*') ? 'class=active' : '' }}>
                        <a class="nav-link" href="{{ route('dashboard.questions.index') }}">
                            <span>{{ ucfirst(__("preguntas")) }}</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endif
    @if(Auth::user()->can('view countries') || Auth::user()->can('view states') || Auth::user()->can('view cities'))
        <li class="dropdown {{ request()->is('dashboard/zones*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown">
                <i class="fas fa-globe-americas"></i>
                <span>{{ ucfirst(__("zonas")) }}</span>
            </a>
            <ul class="dropdown-menu">
                @can('view countries')
                    <li {{ request()->is('dashboard/zones/countries*') ? 'class=active' : '' }}>
                        <a class="nav-link" href="{{ route('dashboard.countries.index') }}">
                            <span>{{ ucfirst(__("países")) }}</span>
                        </a>
                    </li>
                @endcan
                @can('view states')
                    <li {{ request()->is('dashboard/zones/states*') ? 'class=active' : '' }}>
                        <a class="nav-link" href="{{ route('dashboard.states.index') }}">
                            <span>{{ ucwords(__("estados/departamentos")) }}</span>
                        </a>
                    </li>
                @endcan
                @can('view cities')
                    <li {{ request()->is('dashboard/zones/cities*') ? 'class=active' : '' }}>
                        <a class="nav-link" href="{{ route('dashboard.cities.index') }}">
                            <span>{{ ucfirst(__("ciudades")) }}</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endif
</ul>

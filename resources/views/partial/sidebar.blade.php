<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="shadow-bottom"></div>

        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu">
                <a href="{{ route('admin') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="home"></i>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>
            {{-- category --}}
            @can('show-category')
                <li class="menu">
                    <a href="#category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
                        <div class="">
                            <i data-feather="list"></i>
                            <span>Category</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </div>
                    </a>
                    <ul class="submenu list-unstyled collapse" id="category" data-parent="#accordionExample" style="">
                        @can('viewAny', App\Models\Province::class)
                            <li>
                                <a href="{{ route('province.index') }}"> Province </a>
                            </li>
                        @endcan
                        @can('viewAny', App\Models\District::class)
                            <li>
                                <a href="{{ route('district.index') }}"> District </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('show-system')
                <li class="menu">
                    <a href="#system" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
                        <div class="">
                            <i data-feather="cpu"></i>
                            <span>System</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </div>
                    </a>
                    <ul class="submenu list-unstyled collapse" id="system" data-parent="#accordionExample" style="">
                        {{-- @can('viewAny', App\User::class) --}}
                        <li>
                            <a href="{{ route('user.index') }}"> User </a>
                        </li>
                        {{-- @endcan --}}
                        {{-- @can('viewAny', App\Models\Role::class)
                        --}}
                        <li>
                            <a href="{{ route('role.index') }}"> Role </a>
                        </li>
                        {{-- @endcan --}}
                    </ul>
                </li>
            @endcan
        </ul>

    </nav>

</div>
<!--  END SIDEBAR  -->

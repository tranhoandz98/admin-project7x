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
            <li class="menu">
                <a href="{{ route('user.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="users"></i>
                        <span>User</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="{{ route('user.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="server"></i>
                        <span>User</span>
                    </div>
                </a>
            </li>
        </ul>

    </nav>

</div>
<!--  END SIDEBAR  -->

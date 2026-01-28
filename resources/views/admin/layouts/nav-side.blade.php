<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="admin/dist/img/kpn-logo.png" alt="KPN Logo" class="brand-image">
        <span class="brand-text">KPN Plantation</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.index') }}"
                        class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li
                    class="nav-item {{ request()->routeIs('admin.data-ffb') || request()->routeIs('admin.data-sales') || request()->routeIs('admin.data-transfer') || request()->routeIs('admin.data-others') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Data
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.data-ffb') }}"
                                class="nav-link {{ request()->routeIs('admin.data-ffb') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>FFB</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.data-sales') }}"
                                class="nav-link {{ request()->routeIs('admin.data-sales') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sales</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.data-others') }}"
                                class="nav-link {{ request()->routeIs('admin.data-others') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lain-lain</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.data-transfer') }}"
                                class="nav-link {{ request()->routeIs('admin.data-transfer') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Transfer</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- <li class="nav-item">
          <a href="" class="nav-link">
            <i class="nav-icon fas fas fa-search-plus"></i>
            <p>Details</p>
          </a>
        </li> -->
            </ul>
        </nav>
    </div>
</aside>

<!-- Add the following JavaScript to ensure the 'menu-open' class is toggled when a child item is active -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const activeLink = document.querySelector('.nav-link.active');
        if (activeLink) {
            const parent = activeLink.closest('.nav-item');
            if (parent) {
                parent.classList.add('menu-open');
            }
        }
    });
</script>

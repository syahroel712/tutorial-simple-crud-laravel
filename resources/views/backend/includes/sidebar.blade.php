                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ route('dashboard') }}">Swimoc</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ route('dashboard') }}">St</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Hallo Admin</li>
                        <li class="{{ ($active == 'home') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
                        <li class="nav-item dropdown {{ ($active == 'buku') ? 'active' : '' }}">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-box-open"></i> <span>Master Data</span></a>
                            <ul class="dropdown-menu">
                                <li class="{{ ($active == 'buku') ? 'active' : '' }}"><a class="nav-link" href="{{ route('buku') }}">CRUD Standart</a></li>
                                <li><a class="nav-link" href="layout-transparent.html">CRUD Modal</a></li>
                            </ul>
                        </li>
                        
                    </ul>
                </aside>
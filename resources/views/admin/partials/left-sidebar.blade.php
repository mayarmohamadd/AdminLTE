@php
    $current_route = request()->route()->getName();
@endphp
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('admin-assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Newspaper</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin-assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                @if (auth()->check())
                    <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                @else
                    <a href="#" class="d-block">Guest</a>
                @endif
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard Link -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ $current_route == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Articles Section -->
                <li class="nav-item {{ $current_route == 'articles.index' || $current_route == 'articles.create' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $current_route == 'articles.index' || $current_route == 'articles.create' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>Articles<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('articles.index') }}" class="nav-link {{ $current_route == 'articles.index' ? 'active' : '' }}">
                                <p>View Articles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('articles.create') }}" class="nav-link {{ $current_route == 'articles.create' ? 'active' : '' }}">
                                <p>Create Article</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Categories Section -->
                <li class="nav-item {{ $current_route == 'categories.index' || $current_route == 'categories.create' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $current_route == 'categories.index' || $current_route == 'categories.create' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Categories<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}" class="nav-link {{ $current_route == 'categories.index' ? 'active' : '' }}">
                                <p>View Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categories.create') }}" class="nav-link {{ $current_route == 'categories.create' ? 'active' : '' }}">
                                <p>Create Category</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

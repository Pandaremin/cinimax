@php
 $prefix = Request::route()->getPrefix();
 $route = Route::current()->getName();
@endphp

<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">
    @can('isAdmin')
      <li class="nav-item">
        <a class="nav-link {{ ($route == 'admin.index')?'':'collapsed' }}" href="{{ route('admin.index') }}">
        <i class="fa-solid fa-table-cells-large"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
    @endcan  
    <li class="nav-heading">Multimedia</li>
    <li class="nav-item">
      <a class="nav-link {{ ($route == 'movie.index')?'':'collapsed' }}" href="{{ route('movie.index') }}">
        <i class="fa-solid fa-layer-group"></i>
        <span>Movies</span>
      </a>
    </li><!-- End Movies Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('genre.index') }}">
        <i class="fa-solid fa-layer-group"></i>
        <span>Series</span>
      </a>
    </li><!-- End Series Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('genre.index') }}">
        <i class="fa-solid fa-layer-group"></i>
        <span>Episodes</span>
      </a>
    </li><!-- End Episodes  Nav -->

    <li class="nav-item">
      <a class="nav-link {{ ($route == 'genre.index')?'':'collapsed' }}" href="{{ route('genre.index') }}">
      <i class="fa-solid fa-layer-group"></i>
      <span>Genre</span>
      </a>
    </li><!-- End Genre Nav -->

    <li class="nav-item">
      <a class="nav-link {{ ($route == 'streamingservice.index')?'':'collapsed' }}" href="{{ route('streamingservice.index') }}">
      <i class="fa-solid fa-layer-group"></i>
      <span>Streaming Service</span>
      </a>
    </li><!-- End Streaming Service Nav -->

    <li class="nav-heading">User Management</li>
    <li class="nav-item">
      <a class="nav-link {{ ($route == 'admin.profile')?'':'collapsed' }}" href="{{ route('admin.profile') }}">
      <i class="far fa-user"></i>
        <span>Profile</span>
      </a>
    </li><!-- End Profile Nav -->

    <!-- Admin Access only -->
    @can('isAdmin')
      <li class="nav-item">
        <a class="nav-link {{ ($route == 'admin.users.view')?'':'collapsed' }}" href="{{ route('admin.users.view') }}">
          <i class="fas fa-users"></i>
          <span>Users</span>
        </a>
      </li><!-- End User list Nav -->

      <li class="nav-item">
        <a class="nav-link {{ ($route == 'content.manager.add')?'':'collapsed' }}" href="{{ route('content.manager.add') }}">
        <i class="fa-solid fa-user-pen"></i>
        <span>Add Content Manager</span>
        </a>
      </li><!-- End Add content manager Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="">
        <i class="fa-solid fa-user-pen"></i>
        <div class="row">
          <div class="col-10"><span>Pending user</span></div>
          <div class="col-2 d-flex justify-content-end"><span class="badge bg-danger ">3(Dummy)</span></div>
        </div>
        </a>
      </li><!-- End Pending user Nav -->

    @endcan
    <!-- Admin Access only -->

  </ul>

</aside>
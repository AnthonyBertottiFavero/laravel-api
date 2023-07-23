@php $user = Auth::user(); @endphp

<div class="container">
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('guest.home')}}">Portfolios</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

        <span class="navbar-toggler-icon"></span>

      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.dashboard')}}">Dashboard</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Portfolios
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{route('admin.portfolios.index')}}">Index</a></li>
              <li><a class="dropdown-item" href="{{route('admin.portfolios.create')}}">Add New Portfolio</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Types
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{route('admin.types.index')}}">Index</a></li>
              <li><a class="dropdown-item" href="{{route('admin.types.create')}}">Add New Type</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Technologies
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{route('admin.technologies.index')}}">Index</a></li>
              <li><a class="dropdown-item" href="{{route('admin.technologies.create')}}">Add New Technology</a></li>
            </ul>
          </li>
        </ul>

        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item dropdown me-5">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  {{ $user->name }}
              </a>
              <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Edit profile</a></li>

                  <li>
                      <form action="{{ route('logout') }}" method="post" class="ms-3">
                          @csrf
                          <button class="btn btn-primary btn-sm">Logout</button>
                      </form>
                  </li>
              </ul>
          </li>
      </ul>
      </div>
    </div>
  </nav>
</div>

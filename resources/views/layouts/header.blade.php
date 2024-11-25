  <!-- Navbar -->

  <nav
  class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
  id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="ti ti-menu-2 ti-md"></i>
    </a>
  </div>

  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    {{-- <!-- Search -->
    <div class="navbar-nav align-items-center">
      <div class="nav-item navbar-search-wrapper mb-0">
        <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
          <i class="ti ti-search ti-md me-2 me-lg-4 ti-lg"></i>
          <span class="d-none d-md-inline-block text-muted fw-normal">Search (Ctrl+/)</span>
        </a>
      </div>
    </div>
    <!-- /Search --> --}}

    <ul class="navbar-nav flex-row align-items-center ms-auto">
  

      <!-- Style Switcher -->
      {{-- <li class="nav-item dropdown-style-switcher dropdown">
        <a
          class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow"
          href="javascript:void(0);"
          data-bs-toggle="dropdown">
          <i class="ti ti-md"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
          <li>
            <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
              <span class="align-middle"><i class="ti ti-sun ti-md me-3"></i>Light</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
              <span class="align-middle"><i class="ti ti-moon-stars ti-md me-3"></i>Dark</span>
            </a>
          </li>
       
        </ul>
      </li> --}}
      <!-- / Style Switcher-->

      


      {{-- Expired documents notification --}}
      @include('layouts.notifications.expiredocumentsnotifications')

    
      <!-- Notification  -->
      @include('layouts.notifications.normal-Notification')
      
      <!--/ Notification -->


      
      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a
          class="nav-link dropdown-toggle hide-arrow p-0"
          href="javascript:void(0);"
          data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            @if (Auth::user()->picture)
            <img 
              src="{{ asset(Auth::user()->picture) }}" alt="User Avatar" class="rounded-circle" 
            />
          @else
            <i class="fas fa-user-circle fa-2x" ></i> 
          @endif
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item mt-0" href="#">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-2">
                  <div class="avatar avatar-online">
         
                    @if (Auth::user()->picture)
                    <img 
                      src="{{ asset(Auth::user()->picture) }}" alt="User Avatar" class="rounded-circle" 
                    />
                  @else
                    <i class="fas fa-user-circle fa-2x" ></i> 
                  @endif
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="mb-0">
                    <strong>
                      {{ Auth::user()->name }}

                    </strong>
                  </h6>
                  <small class="text-muted"> {{ Auth::user()->email }}</small>
                </div>
              </div>
            </a>
          </li>
          <li>
            <div class="dropdown-divider my-1 mx-n2"></div>
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('profile') }}">
              <i class="ti ti-user me-3 ti-md"></i><span class="align-middle">My Profile</span>
            </a>
          </li>
   
   
          <li>
            <div class="d-grid px-2 pt-2 pb-1">
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="btn btn-sm btn-danger w-100 d-flex">
                      <small class="align-middle">Logout</small>
                      <i class="ti ti-logout ms-2 ti-14px"></i>
                  </button>
              </form>
          </div>
          
          </li>
        </ul>
      </li>
      <!--/ User -->
    </ul>
  </div>

  <!-- Search Small Screens -->
  <div class="navbar-search-wrapper search-input-wrapper d-none">
    <input
      type="text"
      class="form-control search-input container-xxl border-0"
      placeholder="Search..."
      aria-label="Search..." />
    <i class="ti ti-x search-toggler cursor-pointer"></i>
  </div>
</nav>

<!-- / Navbar -->
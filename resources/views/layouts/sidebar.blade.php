 <!-- Menu -->

 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="/" class="menu-link">
        <img style="width: 200px; margin-top: 10px"  src="https://projects.multibizdev.com/tess_kyc/assets/img/tess_logo.png" alt="">
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
        <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- e-commerce-app menu end -->
    
      @canany(['addKYC', 'addDocuments','addSales','addServices'], App\Models\User::class)
      <li class="menu-item {{ Request::is('merchants') || Request::is('merchantskyc') || Request::is('merchantsdocuments') || Request::is('merchantsSales') ||  Request::is('merchantService') ? 'open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-components"></i>
            <div data-i18n="Merchants">Merchants</div>
        </a> 
      
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('merchants.index') ? 'active' : '' }}">
                <a href="{{ route('merchants.index') }}" class="menu-link">
                    <div data-i18n="All-Merchants">All Merchants</div>
                </a>
            </li>
            {{-- <li class="menu-item {{ request()->routeIs('create.merchants.kfc') ? 'active' : '' }}">
                <a href="{{ route('create.merchants.kfc') }}" class="menu-link">
                    <div data-i18n="Create-Merchants">Create Merchants</div>
                </a>
            </li> --}}
        </ul>
       
    </li>
    @endcanany

    @canany(['toggleCountriesSection', 'toggleDepartmentsSection', 'toggleDocumentsSection', 'toggleMerchantCategoriesSection', 'toggleActivityLogsSection'], App\Models\User::class)
    <li class="menu-header small text-uppercase text-muted fw-bold">Settings</li>
    @endcanany
    
    @can('toggleCountriesSection', App\Models\User::class)
 
    <li class="menu-item {{ request()->routeIs('countries.*') ? 'open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-world"></i>
        <div data-i18n="Country">Countries</div>
      </a>
      <ul class="menu-sub">
        @can('viewCountries', App\Models\User::class)
        <li class="menu-item {{ request()->routeIs('countries.index') ? 'active' : '' }}">
          <a href="{{ route('countries.index') }}" class="menu-link">
            <div data-i18n="All-Countries">All Countries</div>
          </a>
        </li>
        @endcan
      </ul>
    </li>
    @endcan
    

    

    @can('toggleDepartmentsSection', App\Models\User::class)

    <li class="menu-item {{ request()->routeIs('departments.*') ? 'open' : '' }}">

      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-building"></i>
        <div data-i18n="Departments">Departments</div>
      </a>

      <ul class="menu-sub">
        @can('viewdepartments', App\Models\User::class)
        <li class="menu-item {{ request()->routeIs('departments.index') ? 'active' : '' }}">
          <a href="{{ route('departments.index') }}" class="menu-link">
            <div data-i18n="All-Departments">All Departments</div>
          </a>
        </li>
        @endcan
      </ul>
    </li>
    
    @endcan


    @can('toggleDocumentsSection', App\Models\User::class)
    <li class="menu-item {{ request()->routeIs('documents.*') ? 'open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-file"></i>
        <div data-i18n="Documents">Document Types</div>
      </a>
      <ul class="menu-sub">
        @can('viewSideBarDocuments', App\Models\User::class)
        <li class="menu-item {{ request()->routeIs('documents.index') ? 'active' : '' }}">
          <a href="{{ route('alldocuments.index') }}" class="menu-link">
            <div data-i18n="All-Documents">All Documents</div>
          </a>
        </li>
        @endcan
      </ul>
    </li>
    @endcan
    
    @can('toggleMerchantCategoriesSection', App\Models\User::class)
    <li class="menu-item {{ request()->routeIs('merchant-categories.*') ? 'open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-color-swatch"></i>
        
        <div data-i18n="Merchant-Categories">Merchant Categories</div>
      </a>
      @can('viewMerchantCategories', App\Models\User::class)
      <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('merchant-categories.index') ? 'active' : '' }}">
          <a href="{{ route('merchant-categories.index') }}" class="menu-link">
            <div data-i18n="All-Merchant-Categories">All Merchant Categories</div>
          </a>
        </li>
      </ul>
      @endcan
    </li>
    @endcan

    @can('toggleServicesSection', App\Models\User::class)
    <li class="menu-item {{ request()->routeIs('services.*') ? 'open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-briefcase"></i>
        <div data-i18n="Services">Services Types</div>
      </a>
      @can('viewSideBarServices', App\Models\User::class)
      <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('services.index') ? 'active' : '' }}">
          <a href="{{ route('services.index') }}" class="menu-link">
            <div data-i18n="All-Services">All Services</div>
          </a>
        </li>
      </ul>
      @endcan
    </li>
    @endcan
    




    @can('toggleActivityLogsSection', App\Models\User::class)
      <li class="menu-item {{ request()->routeIs('activity.logs') ? 'open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-clipboard-list"></i>
            <div data-i18n="Activity Logs">Activity Logs</div>
        </a>
        <ul class="menu-sub">
          @can('addAllActivityLogs', App\Models\User::class)
            <li class="menu-item {{ request()->routeIs('activity.logs') ? 'active' : '' }}">
                <a href="{{ route('activity.logs') }}" class="menu-link">
                    <div data-i18n="All-Logs">All Logs</div>
                </a>
            </li>
          @endcan
            @can('viewMyActivityLogs', App\Models\User::class)
            <li class="menu-item {{ request()->routeIs('activity.my_logs') ? 'active' : '' }}">
              <a href="{{ route('activity.my_logs') }}" class="menu-link">
                  <div data-i18n="All-Logs">My Logs</div>
              </a>
          </li>
          @endcan
        </ul>
    </li>
    @endcan
    
    

    @can('toggleUsersSection', App\Models\User::class)
    <li class="menu-header small text-uppercase text-muted fw-bold">User Management</li>
    <li class="menu-item {{ request()->routeIs('users.*') ? 'open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-users"></i>
        <div data-i18n="Users">Users</div>
      </a>
      <ul class="menu-sub">
      
        @can('viewUsers', App\Models\User::class)
        <li class="menu-item {{ request()->routeIs('users.index') ? 'active' : '' }}">
          <a href="{{ route('users.index') }}" class="menu-link">
            <div data-i18n="All-Users">All Users</div>
          </a>
        </li>
        @endcan
    

       {{-- @can('addUser', App\Models\User::class)
        <li class="menu-item {{ request()->routeIs('users.create') ? 'active' : '' }}">
          <a href="{{ route('users.create') }}" class="menu-link">
            <div data-i18n="Create-User">Create User</div>
          </a>
        </li>
        @endcan --}}
 
      </ul>
    </li>
    @endcan

    </ul>
  </aside>
  <!-- / Menu -->
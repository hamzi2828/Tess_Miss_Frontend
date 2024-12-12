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

    <ul class="menu-inner py-5">
      <!-- e-commerce-app menu end -->
 
      <li class="menu-item ">
        <a href="{{ route('dashboard') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-layout-kanban"></i>
          <div data-i18n="Country">Dashboard</div>
        </a>
      </li>

      <li class="menu-item ">
        <a href="#" class="menu-link">
          <i class="menu-icon tf-icons ti ti-file"></i>
          <div data-i18n="Documentation">Documentation</div>
        </a>
      </li>

      <li class="menu-item ">
        <a href="{{ route('document.history') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-file-description"></i>
          <div data-i18n="Country">Document History</div>
        </a>
      </li>



      <li class="menu-item ">
        <a href="{{ route('faqs.index') }}"  class="menu-link">
          <i class="menu-icon tf-icons ti ti-components"></i>
          <div data-i18n="FAQs">FAQs</div>
        </a>
      </li>



        @php
          $user = Auth::user();
          $isMerchantApproved = $user->isMerchantApproved();
          $isMerchnatDocumentsApproved = $user->isMerchantDocumentApproved();
          $isMerchantSalesApproved = $user->isMerchantSaleApproved();
          $isMerchantServicesApproved = $user->isMerchantServiceApproved();
          $isAllApproved = $isMerchantApproved && $isMerchnatDocumentsApproved && $isMerchantSalesApproved && $isMerchantServicesApproved;
        @endphp
  
        @if ($isAllApproved)
          @foreach(App\Models\Page::where('status', 'active')->get() as $page)
              <li class="menu-item {{ request()->routeIs('pages.show') && request()->segment(2) == $page->slug ? 'active' : '' }}">
                  <a href="{{ route('pages.show', $page->slug) }}" class="menu-link">
                      <i class="menu-icon tf-icons ti ti-circle"></i>
                      <div data-i18n="{{ $page->id }}">{{ $page->name }}</div>
                  </a>
              </li>
          @endforeach
        @else
        @foreach(App\Models\Page::where('status', 'active')->where('display', 'unapproved')->get() as $page)
            <li class="menu-item {{ request()->routeIs('pages.show') && request()->segment(2) == $page->slug ? 'active' : '' }}">
                <a href="{{ route('pages.show', $page->slug) }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-circle"></i>
                    <div data-i18n="{{ $page->id }}">{{ $page->name }}</div>
                </a>
            </li>
        @endforeach
        @endif
    





      

     
    </ul>
  </aside>
  <!-- / Menu -->
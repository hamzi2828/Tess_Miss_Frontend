@if(auth()->user()->role === 'supervisor')
<li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
  <a
    class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow"
    href="javascript:void(0);"
    data-bs-toggle="dropdown"
    data-bs-auto-close="outside"
    aria-expanded="false">
    <span class="position-relative">
      <i class="ti ti-bell ti-md"></i>
      @if(auth()->user()->unreadNotifications->where('type', 'App\Notifications\ExpiredDocumentNotification')->count() > 0)
        <span class="badge rounded-pill bg-danger badge-dot badge-notifications border"></span>
      @endif
    </span>
  </a>
  <ul class="dropdown-menu dropdown-menu-end p-0">
    <li class="dropdown-menu-header border-bottom">
      <div class="dropdown-header d-flex align-items-center py-3">
        <h6 class="mb-0 me-auto">Expired Documents Notification</h6>
        <div class="d-flex align-items-center h6 mb-0">
          <span class="badge bg-label-primary me-2">
            {{ auth()->user()->unreadNotifications->where('type', 'App\Notifications\ExpiredDocumentNotification')->count() }} New
          </span>
          <a
            href="javascript:void(0)"
            class="btn btn-text-secondary rounded-pill btn-icon dropdown-notifications-all"
            data-bs-toggle="tooltip"
            data-bs-placement="top"
            title="Mark all as read"
            onclick="event.preventDefault(); document.getElementById('mark-all-as-read').submit();"
          >
            <i class="ti ti-mail-opened text-heading"></i>
          </a>
          <form id="mark-all-as-read" action="{{ route('notifications.markAllAsRead') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </div>
    </li>
    <li class="dropdown-notifications-list scrollable-container">
      <ul class="list-group list-group-flush">
        @foreach(auth()->user()->notifications->where('type', 'App\Notifications\ExpiredDocumentNotification')->take(10) as $notification)
          <li class="list-group-item list-group-item-action dropdown-notifications-item">
            <div class="d-flex">
              <div class="flex-grow-1">
                <a href="{{ route('notifications.read', ['id' => $notification->id, 'merchant_id' => $notification->data['merchant_id']]) }}" >
                  <h6 class="small mb-1">{{ $notification->data['message'] }}</h6>
                </a>
                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
              </div>
              
              <div class="flex-shrink-0 dropdown-notifications-actions">
                @if(is_null($notification->read_at))
                    <!-- Show dot for unread notifications -->
                    <a href="{{ route('notifications.read', ['id' => $notification->id, 'merchant_id' => $notification->data['merchant_id']]) }}" class="dropdown-notifications-read">
                        <span class="badge badge-dot bg-primary"></span>
                        unread
                    </a>
                @endif
                <a href="{{ route('notifications.read', ['id' => $notification->id, 'merchant_id' => $notification->data['merchant_id']]) }}" class="dropdown-notifications-archive">
                    <span class="ti ti-x"></span>
                </a>
            </div>
            
            </li>
          @endforeach
      </ul>
    </li>
    <li class="border-top">
      <div class="d-grid p-4">
        <a class="btn btn-primary btn-sm d-flex" href="{{ route('notifications.markAllAsRead') }}">
          <small class="align-middle">Read all notifications</small>
        </a>
      </div>
    </li>
  </ul>
</li>
@endif
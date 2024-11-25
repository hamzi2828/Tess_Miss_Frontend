<li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
  <a
    class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow"
    href="javascript:void(0);"
    data-bs-toggle="dropdown"
    data-bs-auto-close="outside"
    aria-expanded="false">
    <span class="position-relative">
      <i class="ti ti-bell ti-md"></i>
      @if(auth()->user()->unreadNotifications->count() > 0)
        <span class="badge rounded-pill bg-danger badge-dot badge-notifications border"></span>
      @endif
    </span>
  </a>
  <ul class="dropdown-menu dropdown-menu-end p-0">
    <li class="dropdown-menu-header border-bottom">
      <div class="dropdown-header d-flex align-items-center py-3">
        <h6 class="mb-0 me-auto">All Notifications</h6>
        <div class="d-flex align-items-center h6 mb-0">
          <span class="badge bg-label-primary me-2">
            {{ auth()->user()->unreadNotifications->count() }} New
          </span>
          <form id="mark-all-as-read" action="{{ route('notifications.markAllAsRead') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </div>
    </li>
    <li class="dropdown-notifications-list scrollable-container">
      <ul class="list-group list-group-flush" id="notifications-container">
          {{-- Initial Notifications --}}
          @foreach(auth()->user()->notifications->where('type', '=', 'App\Notifications\MerchantActivityNotification')->take(10) as $notification)
          <li class="list-group-item list-group-item-action dropdown-notifications-item">
            <a
              href="{{ route('notifications.read', ['id' => $notification->id, 'merchant_id' => $notification->data['merchant_id']]) }}"
              class="d-flex text-decoration-none">
        
                  <div class="flex-grow-1">
                      <h6 class="small mb-1">{{ $notification->data['message'] }}</h6>
                      @if(isset($notification->data['activity_type']) && $notification->data['activity_type'] == 'store')
                          <small class="text-muted">Added by: {{ $notification->data['added_by'] }}</small><br>
                      @endif
                      @if(isset($notification->data['activity_type']) && $notification->data['activity_type'] == 'approve')
                          <small class="text-muted">Approved by: {{ $notification->data['added_by'] }}</small><br>
                      @endif
                      @if( isset($notification->data['activity_type']) && $notification->data['activity_type'] == 'decline')
                          <small class="text-muted">Rejected by: {{ $notification->data['added_by'] }}</small><br>
                      @endif
                      <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                  </div>
                  <div class="flex-shrink-0 dropdown-notifications-actions">
                      @if(is_null($notification->read_at))
                          <span class="badge badge-dot bg-primary"></span>
                          <small>Unread</small>
                      @endif
                  </div>
              </a>
          </li>
          @endforeach
      </ul>
  </li>
  </ul>
</li>

{{-- <script>
  document.addEventListener('DOMContentLoaded', function () {
      const notificationsContainer = document.getElementById('notifications-container');
      const unreadCountBadge = document.querySelector('.badge-notifications.border');
      const unreadCountText = document.querySelector('.badge.bg-label-primary');

      async function fetchNotifications() {
          try {
              const response = await fetch('{{ route('notifications.latest') }}');
              const data = await response.json();

              // Update unread count
              if (data.unreadCount > 0) {
                  unreadCountBadge.style.display = 'inline-block';
                  unreadCountText.textContent = `${data.unreadCount} New`;
              } else {
                  unreadCountBadge.style.display = 'none';
                  unreadCountText.textContent = '0 New';
              }

              // Update notifications list
              notificationsContainer.innerHTML = '';
              if (data.notifications.length > 0) { 
                  data.notifications.forEach(notification => {
                      const listItem = `
                          <li class="list-group-item list-group-item-action dropdown-notifications-item">
                              <a
                                  href="${`{{ route('notifications.read', ['id' => ':id', 'merchant_id' => ':merchant_id']) }}`
                                      .replace(':id', notification.id)
                                      .replace(':merchant_id', notification.data.merchant_id.id || notification.data.merchant_id)}"
                                  class="d-flex text-decoration-none"
                              >
                                  <div class="flex-grow-1">
                                      <h6 class="small mb-1">${notification.data.message}</h6>
                                      ${notification.data.activity_type === 'store' ? `<small class="text-muted">Added by: ${notification.data.added_by}</small><br>` : ''}
                                      ${notification.data.activity_type === 'approve' ? `<small class="text-muted">Approved by: ${notification.data.added_by}</small><br>` : ''}
                                      <small class="text-muted">${new Date(notification.created_at).toLocaleString()}</small>
                                  </div>
                                  <div class="flex-shrink-0 dropdown-notifications-actions">
                                      ${notification.read_at === null ? `
                                          <span class="badge badge-dot bg-primary"></span>
                                          <small>Unread</small>` : ''}
                                  </div>
                              </a>
                          </li>
                      `;
                      notificationsContainer.insertAdjacentHTML('beforeend', listItem);
                  });
              } else {
                  notificationsContainer.innerHTML = '<li class="text-center py-3 text-muted">No new notifications</li>';
              }
          } catch (error) {
              console.error('Error fetching notifications:', error);
          }
      }

      // Fetch notifications every 20 seconds
      setInterval(fetchNotifications, 20000);

      // Initial fetch on page load
      fetchNotifications();
  });
</script> --}}

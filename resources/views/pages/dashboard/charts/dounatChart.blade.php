       <!-- Donut Chart -->
       <div class="col-md-6 col-xxl-4">
        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between">
            <div>
              <h5 class="card-title mb-0">Expense Ratio</h5>
              <p class="card-subtitle my-0">Spending on various categories</p>
            </div>
            <div class="dropdown d-none d-sm-flex">
              <button
                type="button"
                class="btn dropdown-toggle px-0"
                data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="ti ti-calendar"></i>
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Today</a>
                </li>
                <li>
                  <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Yesterday</a>
                </li>
                <li>
                  <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"
                    >Last 7 Days</a
                  >
                </li>
                <li>
                  <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"
                    >Last 30 Days</a
                  >
                </li>
                <li>
                  <hr class="dropdown-divider" />
                </li>
                <li>
                  <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"
                    >Current Month</a
                  >
                </li>
                <li>
                  <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last Month</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <div id="donutChart"></div>
          </div>
        </div>
      </div>
      <!-- /Donut Chart -->

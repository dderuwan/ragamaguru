  <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="{{route('dashboard')}}" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
      <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
      <!-- nav bar -->
      <div class="w-100 mb-2 ml-3 d-flex justify-content-center">
        <a class="navbar-brand mt-2 d-flex flex-column align-items-center" href="{{route('dashboard')}}">
          <img src="{{ asset('images/logos/' . app(\App\Http\Controllers\CompanySettingController::class)->getCompanyLogo()) }}"
            style="width:auto; height: 35px;" class="mt-2" alt="Company Logo">
          <span class="mt-2">RAGAMA GURU ASAPUWA</span>
        </a>
      </div>

      <ul class="navbar-nav flex-fill w-100 mb-2">
        <li class="nav-item active sidebar_li">
          <i class="fe fe-home fe-16"></i>
          <a href="{{route('dashboard')}}" class="sidebar_text">
            <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
          </a>
        </li>

        <li class="nav-item active sidebar_li">
          <i class="fe fe-user fe-16"></i>
          <a href="{{route('allcustomers')}}" class="sidebar_text">
            <span class="ml-3 item-text">Customers</span><span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item active sidebar_li">
          <i class="fa-regular fa-pen-to-square"></i>
          <a href="{{route('Treatment')}}" class="sidebar_text">
            <span class="ml-3 item-text">Treatment</span><span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item active sidebar_li">
          <i class="fe fe-truck"></i>

          <a href="{{route('allsuppliers')}}" class="sidebar_text">
            <span class="ml-3 item-text">Suppliers</span><span class="sr-only">(current)</span>
          </a>
        </li>

        <!-- <li class="nav-item active sidebar_li">
            <i class="fe fe-box fe-16"></i>
          <a href="{{route('item.index')}}" class="sidebar_text" >
            <span class="ml-3 item-text">Items</span><span class="sr-only">(current)</span>
          </a>
        </li> -->

        <li class="nav-item dropdown">
          <a href="#items" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-box fe-16"></i>
            <span class="ml-3 item-text">Items</span><span class="sr-only">(current)</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="items">
            <li class="nav-item active">
              <a class="nav-link pl-3" href="{{route('item.index')}}"><span class="ml-1 item-text"> Items</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link pl-3" href="{{route('offerIndex')}}"><span class="ml-1 item-text"> Special offers</span></a>
            </li>
          </ul>
        </li>

        <li class="nav-item active sidebar_li">
          <i class="fe fe-package fe-16 mb-2"></i>
          <a href="{{route('allorderrequests')}}" class="sidebar_text">
            <span class="ml-3 item-text">OrderRequests List</span><span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item active sidebar_li">
          <i class="fe fe-file-text fe-16 mb-2"></i>
          <a href="{{route('allgins')}}" class="sidebar_text">
            <span class="ml-3 item-text">GIN List</span><span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item active sidebar_li">
          <i class="fe fe-users fe-16"></i>
          <a href="{{route('employee')}}" class="sidebar_text">
            <span class="ml-3 item-text">Employee</span><span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item active sidebar_li">
          <i class="fa-regular fa-calendar-check"></i>
          <a href="{{route('appointments.index')}}" class="sidebar_text">
            <span class="ml-3 item-text">Appointments</span><span class="sr-only">(current)</span>
          </a>
        </li>

        <li class="nav-item dropdown">
          <a href="#bookings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fa-regular fa-paste"></i>
            <span class="ml-3 item-text">Bookings</span><span class="sr-only">(current)</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="bookings">
            <li class="nav-item active">
              <a class="nav-link pl-3" href="{{route('bookings.indexLocal')}}"><span class="ml-1 item-text">Local</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link pl-3" href="{{route('bookings.indexInternational')}}"><span class="ml-1 item-text">International</span></a>
            </li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a href="#invoice" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-shopping-cart fe-16"></i>
            <span class="ml-3 item-text">Invoices</span><span class="sr-only">(current)</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="invoice">
            <li class="nav-item active">
              <a class="nav-link pl-3" href="{{route('pospage')}}"><span class="ml-1 item-text"> POS Invoice</span></a>
            </li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a href="#orders" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-shopping-bag" aria-hidden="true"></i>
            <span class="ml-3 item-text">Orders</span><span class="sr-only">(current)</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="orders">
            <li class="nav-item active">
              <a class="nav-link pl-3" href="{{route('onlineOrders')}}"><span class="ml-1 item-text"> Online Orders</span></a>
            </li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a href="#HR" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fa-regular fa-address-book"></i>
            <span class="ml-3 item-text">Human Resource</span><span class="sr-only">(current)</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="HR">
            <li class="nav-item dropdown">
              <a href="#attendance" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <span class="ml-3 item-text">Attendance</span><span class="sr-only">(current)</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="attendance">
                <li class="nav-item active">
                  <a class="nav-link pl-3" href="{{route('attendance_list')}}"><span class="ml-1 item-text">Attendance List</span></a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link pl-3" href="{{route('attendance_reports')}}"><span class="ml-1 item-text">Attendance Reports</span></a>
                </li>
              </ul>
            </li>
          </ul>
          <ul class="collapse list-unstyled pl-4 w-100" id="HR">
            <li class="nav-item dropdown">
              <a href="#leave" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <span class="ml-3 item-text">Leave</span><span class="sr-only">(current)</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="leave">
                <li class="nav-item active">
                  <a class="nav-link pl-3" href="{{route('weekly_holiday')}}"><span class="ml-1 item-text"> - Weekly Holiday</span></a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link pl-3" href="{{route('holiday')}}"><span class="ml-1 item-text">- Holiday </span></a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link pl-3" href="{{route('add_leave_type')}}"><span class="ml-1 item-text">- Add Leave Type</span></a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link pl-3" href="{{route('leave_application')}}"><span class="ml-1 item-text">- Leave Application </span></a>
                </li>
                <a class="nav-link pl-3" href="{{route('attendance_reports')}}"><span class="ml-1 item-text"> </span></a>
            </li>
          </ul>
        </li>
      </ul>

      </li>






      <li class="nav-item dropdown">
        <a href="#setting" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
          <i class="fe fe-settings fe-16"></i>
          <span class="ml-3 item-text">Settings</span><span class="sr-only">(current)</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="setting">
          <li class="nav-item active">
            <a class="nav-link pl-3" href="{{route('company.index')}}"><span class="ml-1 item-text">Manage Company</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link pl-3" href="{{route('apType.index')}}"><span class="ml-1 item-text">Appointment Type</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link pl-3" href="{{route('user.index')}}"><span class="ml-1 item-text">Add User</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link pl-3" href="{{route('user.show')}}"><span class="ml-1 item-text">User List</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link pl-3" href="{{route('addRole')}}"><span class="ml-1 item-text">Add Role</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link pl-3" href="{{route('showRole')}}"><span class="ml-1 item-text">Role List</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link pl-3" href="{{route('assign_user_role')}}"><span class="ml-1 item-text">Assign User Roles</span></a>
          </li>
        </ul>

      <li class="nav-item dropdown">
        <a href="#reports" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
          <i class="fe fe-book-open"></i>
          <span class="ml-3 item-text">Reports</span><span class="sr-only">(current)</span>
        </a>
        <ul class="collapse list-unstyled pl-1 w-100 ml-4" id="reports">
          <li class="nav-item mb-2">

            <a href="{{route('customerreport')}}" class="sidebar_text text-decoration-none">
              <span class="ml-3 item-text">Customer Report</span><span class="sr-only">(current)</span>
            </a>

          </li>

          <li class="nav-item mb-2">

            <a href="{{route('supplierreport')}}" class="sidebar_text text-decoration-none">
              <span class="ml-3 item-text">Supplier Report</span><span class="sr-only">(current)</span>
            </a>

          </li>

          <li class="nav-item mb-2">

            <a href="{{route('productreport')}}" class="sidebar_text text-decoration-none">
              <span class="ml-3 item-text">Products Report</span><span class="sr-only">(current)</span>
            </a>

          </li>

          <li class="nav-item mb-2">

            <a href="{{route('stockreport')}}" class="sidebar_text text-decoration-none">
              <span class="ml-3 item-text">Stock Report</span><span class="sr-only">(current)</span>
            </a>

          </li>

          <li class="nav-item mb-2">

            <a href="{{route('purchaseorderreport')}}" class="sidebar_text text-decoration-none">
              <span class="ml-3 item-text">Purchase Order Report</span><span class="sr-only">(current)</span>
            </a>

          </li>

          <li class="nav-item mb-2">

            <a href="{{route('ginreport')}}" class="sidebar_text text-decoration-none">
              <span class="ml-3 item-text">GIN Report</span><span class="sr-only">(current)</span>
            </a>

          </li>

          <li class="nav-item mb-2">

            <a href="{{route('orderreport')}}" class="sidebar_text text-decoration-none">
              <span class="ml-3 item-text">Sales Report</span><span class="sr-only">(current)</span>
            </a>

          </li>

        </ul>
        
      </li>

      

      </ul>

      



    </nav>
  </aside>
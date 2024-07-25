  <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
      <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
      <!-- nav bar -->
      <div class="w-100 mb-4 d-flex">
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
          <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
            <g>
              <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
              <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
              <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
            </g>
          </svg>
        </a>
      </div>
      <ul class="navbar-nav flex-fill w-100 mb-2">
         <li class="nav-item active sidebar_li">
            <i class="fe fe-home fe-16"></i>
          <a href="{{route('dashboard')}}" class="sidebar_text" >
            <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item dropdown">
            <a href="#customer" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-user fe-16"></i>
            <span class="ml-3 item-text">Customer</span><span class="sr-only">(current)</span>
            </a>
            <ul class="collapse list-unstyled pl-4 w-100" id="customer">
            <li class="nav-item active">
                <a class="nav-link pl-3" href="{{route('allcustomers')}}" ><span class="ml-1 item-text"> - Customer List</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link pl-3" href="{{route('createcustomer')}}" ><span class="ml-1 item-text"> - Add customer</span></a>
            </li>
            </ul>
        </li>
         <li class="nav-item active sidebar_li">
            <i class="fe fe-home fe-16"></i>
          <a href="{{route('Treatment')}}" class="sidebar_text" >
            <span class="ml-3 item-text">Treatment</span><span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item active sidebar_li">
            <i class="fe fe-user fe-16"></i>
          <a href="{{route('allsuppliers')}}" class="sidebar_text" >
            <span class="ml-3 item-text">Suppliers</span><span class="sr-only">(current)</span>
          </a>
        </li>

        <li class="nav-item active sidebar_li">
            <i class="fe fe-box fe-16"></i>
          <a href="{{route('item.index')}}" class="sidebar_text" >
            <span class="ml-3 item-text">Items</span><span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item active sidebar_li">
            <i class="fe fe-shopping-cart fe-16 mb-2"></i>
          <a href="{{route('allorderrequests')}}" class="sidebar_text" >
            <span class="ml-3 item-text">OrderRequests List</span><span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item active sidebar_li">
            <i class="fe fe-shopping-cart fe-16 mb-2"></i>
          <a href="{{route('allgins')}}" class="sidebar_text" >
            <span class="ml-3 item-text">GIN List</span><span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item active sidebar_li">
            <i class="fe fe-home fe-16 mb-2"></i>
          <a href="{{route('employee')}}" class="sidebar_text" >
            <span class="ml-3 item-text">Employee</span><span class="sr-only">(current)</span>
          </a>
        </li>

        <li class="nav-item dropdown">
            <a href="#invoice" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-file-text fe-16"></i>
            <span class="ml-3 item-text">Invoices</span><span class="sr-only">(current)</span>
            </a>
            <ul class="collapse list-unstyled pl-4 w-100" id="invoice">
            <li class="nav-item active">
                <a class="nav-link pl-3" href="{{route('pospage')}}" ><span class="ml-1 item-text"> -POS Invoice</span></a>
            </li>
            </ul>
        </li>

        <li class="nav-item dropdown">
            <a href="#HR" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fe fe-users fe-16"></i>
              <span class="ml-3 item-text">Human Resource</span><span class="sr-only">(current)</span>
            </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="HR">
                <li class="nav-item dropdown">
                  <a href="#attendance" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                      <span class="ml-3 item-text">Attendance</span><span class="sr-only">(current)</span>
                  </a>
                  <ul class="collapse list-unstyled pl-4 w-100" id="attendance">
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{route('attendance_list')}}" ><span class="ml-1 item-text"> - Attendance List</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{route('attendance_reports')}}" ><span class="ml-1 item-text"> - Attendance Reports</span></a>
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
                        <a class="nav-link pl-3" href="{{route('weekly_holiday')}}" ><span class="ml-1 item-text"> - Weekly Holiday</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{route('holiday')}}" ><span class="ml-1 item-text">- Holiday </span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{route('add_leave')}}" ><span class="ml-1 item-text">- Add Leave Type</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{route('leave_application')}}" ><span class="ml-1 item-text">- Leave Application </span></a>
                    </li>
                        <a class="nav-link pl-3" href="{{route('attendance_reports')}}" ><span class="ml-1 item-text"> </span></a>
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
                <a class="nav-link pl-3" href="{{route('company.index')}}" ><span class="ml-1 item-text"> - Manage Company</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link pl-3" href="{{route('user.index')}}" ><span class="ml-1 item-text"> - Add User</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link pl-3" href="{{route('user.show')}}" ><span class="ml-1 item-text"> - User List</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link pl-3" href="{{route('add_roles')}}" ><span class="ml-1 item-text"> - Add Role</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link pl-3" href="{{route('role_list')}}" ><span class="ml-1 item-text"> - Role List</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link pl-3" href="{{route('assign_user_role')}}" ><span class="ml-1 item-text"> - Assign User Roles</span></a>
            </li>

            </ul>
        </li>
        <li class="nav-item dropdown">
              <a href="#reports" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fa-solid fa-book-open"></i>
                <span class="ml-3 item-text">Reports</span><span class="sr-only">(current)</span>
              </a>
              <ul class="collapse list-unstyled pl-1 w-100 ml-4" id="reports">
              <li class="nav-item mb-2">

              <a href="{{route('customerreport')}}" class="sidebar_text text-decoration-none"  >
                <span class="ml-3 item-text">Customer Report</span><span class="sr-only">(current)</span>
              </a>

              </li>

              <li class="nav-item mb-2">

              <a href="{{route('supplierreport')}}" class="sidebar_text text-decoration-none"  >
                <span class="ml-3 item-text">Supplier Report</span><span class="sr-only">(current)</span>
              </a>

              </li>

              <li class="nav-item mb-2">

              <a href="{{route('productreport')}}" class="sidebar_text text-decoration-none"  >
                <span class="ml-3 item-text">Products Report</span><span class="sr-only">(current)</span>
              </a>

              </li>

              <li class="nav-item mb-2">

              <a href="{{route('purchaseorderreport')}}" class="sidebar_text text-decoration-none"  >
                <span class="ml-3 item-text">Purchase Order Report</span><span class="sr-only">(current)</span>
              </a>

              </li>

              <li class="nav-item mb-2">

              <a href="{{route('ginreport')}}" class="sidebar_text text-decoration-none"  >
                <span class="ml-3 item-text">GIN Report</span><span class="sr-only">(current)</span>
              </a>

              </li>

              <li class="nav-item mb-2">

              <a href="{{route('orderreport')}}" class="sidebar_text text-decoration-none"  >
                <span class="ml-3 item-text">Sales Report</span><span class="sr-only">(current)</span>
              </a>

              </li>

              </ul>
            </li>

      </ul>



    </nav>
  </aside>


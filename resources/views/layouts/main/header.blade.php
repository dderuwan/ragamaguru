 <nav class="topnav navbar navbar-light">
   <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
     <i class="fe fe-menu navbar-toggler-icon"></i>
   </button>
   <!-- <form class="form-inline mr-auto searchform text-muted">
     <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Type something..." aria-label="Search">
   </form> -->
   <ul class="nav">
     <li class="nav-item">
       <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
         <i class="fe fe-sun fe-16"></i>
       </a>
     </li>
     <li class="nav-item">
       <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-shortcut">
         <span class="fe fe-grid fe-16"></span>
       </a>
     </li>
     <!-- <li class="nav-item nav-notif">
       <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
         <span class="fe fe-bell fe-16"></span>
         <span class="dot dot-md bg-success"></span>
       </a>
     </li> -->
     <li class="nav-item">
       <a class="nav-link text-muted my-2" href="#" onclick="confirmLogout(event)">
         <span class="fe fe-log-out fe-16"></span>
       </a>
     </li>
     <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
       @csrf
     </form>

     <!-- <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <span class="avatar avatar-sm mt-2">
           <img src="./assets/avatars/face-1.jpg" alt="..." class="avatar-img rounded-circle">
         </span>
       </a>
       <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
         <a class="dropdown-item" href="#">Profile</a>
         <a class="dropdown-item" href="#">Settings</a>
         <a class="dropdown-item" href="#">Activities</a>
       </div>
     </li> -->
   </ul>
 </nav>


 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script>
   function confirmLogout(event) {
     event.preventDefault(); // Prevent the default anchor behavior

     Swal.fire({
       title: 'Are you sure?',
       text: "You are about to log out.",
       icon: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Yes, log me out!',
       cancelButtonText: 'Cancel'
     }).then((result) => {
       if (result.isConfirmed) {
         // If confirmed, submit the logout form
         document.getElementById('logout-form').submit();
       }
     });
   }
 </script>
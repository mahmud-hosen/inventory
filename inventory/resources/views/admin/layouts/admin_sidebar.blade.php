 <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Home</a>
        </li> -->
       
      </ul>

      <!-- SEARCH FORM -->
      <!-- <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form> -->

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
       
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="{{asset('admin')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">Inventory</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
       

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            
            <li class="nav-item">
              <router-link to="/" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </router-link>
            </li>

            <li class="nav-item">
              <router-link to="/pos" class="nav-link">
                <!-- <i class="nav-icon fas fa-tag"></i> -->
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                  POS
                </p>
              </router-link>
            </li>
           
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p>
                  Category Manage
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
               
                 
                 <li class="nav-item">
                  <router-link to="/categoryList" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p> Category List</p>
                  </router-link>
                 </li>

              </ul>
            </li>
            

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tag"></i>
                <p>
                 Sub Category Manage
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
         
                <li class="nav-item">
                  <router-link to="/SubCategoryList" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Sub Category List</p>
                  </router-link>
                </li>                
             
              </ul>
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                  Product Manage
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
         
                <li class="nav-item">
                  <router-link to="/productList" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Product List</p>
                  </router-link>
                </li>                
             
              </ul>
            </li>
            
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon  fas fa-dollar-sign"></i>
                <p>
                  Cash Manage
                  <i class="fas fa-angle-left right"></i>
                  
                </p>
              </a>
              <ul class="nav nav-treeview">
         
                <li class="nav-item">
                  <router-link to="/cashAdd" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Cash Add</p>
                  </router-link>
                </li>   
                 <li class="nav-item">
                  <router-link to="/cashList" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Cash List</p>
                  </router-link>
                </li>             
             
              </ul>
            </li>
             <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-money-check-alt"></i>
                <p>
                  Expense Manage
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
         
                <li class="nav-item">
                  <router-link to="/expenseAdd" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Expense Add</p>
                  </router-link>
                </li>   
                 <li class="nav-item">
                  <router-link to="/expenseList" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Expense List</p>
                  </router-link>
                </li>             
             
              </ul>
            </li>
           
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-store"></i>
                <p>
                  Stock Manage
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link to="/stockAdd" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stock Add</p>
                  </router-link>
                </li>

                <li class="nav-item">
                  <router-link to="/stockList" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stock List</p>
                  </router-link>
                </li>                
             
              </ul>
            </li>
            
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Customer Manage
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
         
                <li class="nav-item">
                  <router-link to="/customerList" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Custome List</p>
                  </router-link>
                </li>                
             
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cart-plus"></i>
                <p>
                  Order Manage
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
         
                <li class="nav-item">
                  <router-link to="/orderList" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Order List</p>
                  </router-link>
                </li>                
             
              </ul>
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-alt"></i>
                <p>
                    Employee Manage
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
         
                <li class="nav-item">
                  <router-link to="/employeeList" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Employee List</p>
                  </router-link>
                </li>                
             
              </ul>
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-credit-card"></i>
                <p>
                    Salary Manage
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
         
                <li class="nav-item">
                  <router-link to="/salaryList" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Salary List</p>
                  </router-link>
                </li>                
             
              </ul>
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-check"></i>
                <p>
                    Attendence Manage
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
         
                <li class="nav-item">
                  <router-link to="/takeAttendence" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Take Attendence</p>
                  </router-link>
                </li> 
                <li class="nav-item">
                  <router-link to="/viewAttendence" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Attendence</p>
                  </router-link>
                </li>               
             
              </ul>
            </li>
           
            <li class="nav-header">EXAMPLES</li>
            <li class="nav-item">
              <a href="pages/calendar.html" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Calendar
                  <span class="badge badge-info right">2</span>
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/gallery.html" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                  Gallery
                </p>
              </a>
            </li>
          
           
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
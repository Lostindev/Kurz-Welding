  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
      <img src="https://i.pinimg.com/564x/c6/ca/90/c6ca900eee3cd55f2c43ac29636cf2ef.jpg" alt="PGM Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">PGM Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/img/logo.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Kurz Welding</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item ">
              <a href="/admin/viewCustomOrders" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                Custom Orders
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          </li>

          <li class="nav-item ">
              <a href="/admin/viewOrders" class="nav-link">
              <i class="nav-icon fas fa-sort-amount-up-alt"></i>
                <p>
                View Orders
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Categories
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/newCategory" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/viewCategories" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Categories</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Sub Categories
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/newSubCategory" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Sub-Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/viewSubCategories" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Sub-Categories</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/newProduct" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/viewProducts" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Products</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Specs
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/newSpec" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Spec</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/viewSpecs" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View All Specs</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon far fa-images"></i>
              <p>
                Gallery
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/newGallery" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Gallery Entry</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/viewGallery" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View All Gallery Entries</p>
                </a>
              </li>
            </ul>
          </li>
  

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
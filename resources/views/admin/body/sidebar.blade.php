@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();

@endphp
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar-->
  <section class="sidebar">
    
    <div class="user-profile">
      <div class="ulogo">
        <a href="{{ url('admin/dashboard')}}">
          <!-- logo for regular state and mobile devices -->
          <div class="d-flex align-items-center justify-content-center">
            <img src="{{ asset('backend/images/logo-dark.png')}}" alt="">
            <h3><b>Easy</b> Shop</h3>
          </div>
        </a>
      </div>
    </div>
    
    <!-- sidebar menu-->
    <ul class="sidebar-menu" data-widget="tree">
      
      <li class=" {{ ($route == 'dashboard')?'active':'' }}">
        <a href="{{ url('admin/dashboard')}}">
          <i data-feather="pie-chart"></i>
          <span>Dashboard</span>
        </a>
      </li>
      
     <li class="treeview  {{ ($prefix == '/profile')?'active':'' }}">
        <a href="#">
          <i data-feather="users"></i> <span>Manage Profile</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class=" {{ ($route == 'admin.profile.view')?'active':'' }}"><a href="{{ route('admin.profile.view') }}"><i class="ti-more"></i>Your Profile</a></li>
          <li class ="{{ ($route == 'admin.password.view')?'active':'' }}"><a href="{{ route('admin.password.view') }}"><i class="ti-more"></i>Change Password</a></li>
        </ul>
      </li>

      <li class="treeview  {{ ($prefix == '/brand')?'active':'' }}">
        <a href="#">
          <i data-feather="bookmark"></i> <span>Brands</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li  class =""><a href="{{route('brand.view')}}"><i class="ti-more"></i>All Brand</a></li>
        </ul>
      </li>
      <li class="treeview {{ ($prefix == '/category')?'active':'' }}">
        <a href="#">
          <i data-feather="filter"></i> <span>Category</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class =""><a href="{{route('category.view')}}"><i class="ti-more"></i>All Category</a></li>
          <li class =""><a href="{{route('subcategory.view')}}"><i class="ti-more"></i>All SubCategory</a></li>
          <li class =""><a href="{{route('all.subsubcategory')}}"><i class="ti-more"></i>All SubSubCategory</a></li>
        </ul>
      </li>
      <li class="treeview {{ ($prefix == '/product')?'active':'' }}">
        <a href="#">
          <i data-feather="database"></i> <span>Products</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class =""><a href="{{route('product.add')}}"><i class="ti-more"></i>Add Products</a></li>
          <li class =""><a href="{{route('manage.product')}}"><i class="ti-more"></i>Manage Products</a></li>
        </ul>
      </li>
      
      <li class="treeview {{ ($prefix == '/slider')?'active':'' }}">
        <a href="">
          <i data-feather="grid"></i> <span>Slider</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class =""><a href="{{route('manage.slider')}}"><i class="ti-more"></i>Manage Slider</a></li>
        </ul>
      </li>


      <li class="treeview {{ ($prefix == '/coupon')?'active':'' }}">
        <a href="">
          <i data-feather="grid"></i> <span>Coupons</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class =""><a href="{{route('manage.coupon')}}"><i class="ti-more"></i>Manage Coupons</a></li>
        </ul>
      </li>


       <li class="treeview {{ ($prefix == '/shipping')?'active':'' }}">
        <a href="">
          <i data-feather="grid"></i> <span>Shipping Area</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class =""><a href="{{route('manage.division')}}"><i class="ti-more"></i>Shipping Division</a></li>
        </ul>
      </li>
      
      <li class="header nav-small-cap">User Interface</li>
      
      <li class="treeview">
        <a href="#">
          <i data-feather="grid"></i>
          <span>Components</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="components_alerts.html"><i class="ti-more"></i>Alerts</a></li>
          <li><a href="components_badges.html"><i class="ti-more"></i>Badge</a></li>
          <li><a href="components_buttons.html"><i class="ti-more"></i>Buttons</a></li>
          <li><a href="components_sliders.html"><i class="ti-more"></i>Sliders</a></li>
          <li><a href="components_dropdown.html"><i class="ti-more"></i>Dropdown</a></li>
          <li><a href="components_modals.html"><i class="ti-more"></i>Modal</a></li>
          <li><a href="components_nestable.html"><i class="ti-more"></i>Nestable</a></li>
          <li><a href="components_progress_bars.html"><i class="ti-more"></i>Progress Bars</a></li>
        </ul>
      </li>
      
      <li class="treeview">
        <a href="#">
          <i data-feather="credit-card"></i>
          <span>Cards</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="card_advanced.html"><i class="ti-more"></i>Advanced Cards</a></li>
          <li><a href="card_basic.html"><i class="ti-more"></i>Basic Cards</a></li>
          <li><a href="card_color.html"><i class="ti-more"></i>Cards Color</a></li>
        </ul>
      </li>
      
      
      
      
      
    </ul>
  </section>
  
  <div class="sidebar-footer">
    <!-- item-->
    <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
    <!-- item-->
    <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
    <!-- item-->
    <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
  </div>
</aside>
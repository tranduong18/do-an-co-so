<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>

  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <?php
    $getUnreadNotification = App\Models\NotificationModel::getUnreadNotification();
    ?>
    <!-- Navbar Search -->
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">{{$getUnreadNotification->count()}}</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">{{$getUnreadNotification->count()}} Notifications</span>
        <div class="dropdown-divider"></div>
        @foreach($getUnreadNotification as $noti)
        <a href="{{$noti->url}}?noti_id={{$noti->id}}" class="dropdown-item">
         <div>{{$noti->message}}</div>
          <div class=" text-muted text-sm">{{date('d-m-Y h:i A', strtotime($noti->created_at))}}</>
        </a>
        @endforeach
       
        <div class="dropdown-divider"></div>
        <a href="{{url('admin/notification')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </li>


  </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <div href="" class="brand-link" style="text-align: center;">
    <span class="brand-text font-weight-light">Welcome {{Auth::user()->name}}</span>
  </div>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ url('assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2">
      </div>
      <div class="info">
        <a class="d-block">{{Auth::user()->name}}</a>
      </div>
    </div> -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{url('admin/dashboard')}}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        @if(Auth::user()->is_manager == 1)
        <li class="nav-item">
          <a href="{{url('admin/admin/list')}}" class="nav-link @if(Request::segment(2) == 'admin') active @endif">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Admin
            </p>
          </a>
        </li>
        @endif

        <li class="nav-item">
          <a href="{{url('admin/customer/list')}}" class="nav-link @if(Request::segment(2) == 'customer') active @endif">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Customer
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{url('admin/order/list')}}" class="nav-link @if(Request::segment(2) == 'order') active @endif">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Orders
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{url('admin/category/list')}}" class="nav-link @if(Request::segment(2) == 'category') active @endif">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Category
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{url('admin/sub_category/list')}}" class="nav-link @if(Request::segment(2) == 'sub_category') active @endif">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Sub Category
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{url('admin/brand/list')}}" class="nav-link @if(Request::segment(2) == 'brand') active @endif">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Brand
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{url('admin/color/list')}}" class="nav-link @if(Request::segment(2) == 'color') active @endif">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Color
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{url('admin/product/list')}}" class="nav-link @if(Request::segment(2) == 'product') active @endif">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Product
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{url('admin/discount_code/list')}}" class="nav-link @if(Request::segment(2) == 'discount_code') active @endif">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Discount Code
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{url('admin/shipping_charge/list')}}" class="nav-link @if(Request::segment(2) == 'shipping_charge') active @endif">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Shipping Charge
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{url('admin/slider/list')}}" class="nav-link @if(Request::segment(2) == 'slider') active @endif">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Slider
            </p>
          </a>
        </li>


        <li class="nav-item">
          <a href="{{url('admin/partner/list')}}" class="nav-link @if(Request::segment(2) == 'partner') active @endif">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Partner Logo
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{url('admin/page/list')}}" class="nav-link @if(Request::segment(2) == 'page') active @endif">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Page
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{url('admin/blog_category/list')}}" class="nav-link @if(Request::segment(2) == 'blog_category') active @endif">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Blog Category
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{url('admin/blog/list')}}" class="nav-link @if(Request::segment(2) == 'blog') active @endif">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Blog
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{url('admin/contactus') }}" class="nav-link @if(Request::segment(2) == 'contactus') active @endif">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Contact Us
            </p>
          </a>
        </li>

          
          <li class="nav-item">
              <a href="{{url('admin/system-setting')}}" class="nav-link @if(Request::segment(2) == 'system-setting') active @endif">
                  <i class="nav-icon fas fa-list-alt"></i>
                  <p>
                      System Setting
                  </p>
              </a>
          </li>

          <li class="nav-item">
              <a href="{{url('admin/home-setting')}}" class="nav-link @if(Request::segment(2) == 'home-setting') active @endif">
                  <i class="nav-icon fas fa-list-alt"></i>
                  <p>
                      Home Setting
                  </p>
              </a>
          </li>

        <li class="nav-item">
          <a href="{{url('admin/logout')}}" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>
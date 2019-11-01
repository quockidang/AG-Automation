<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{Auth::User()->fullname}}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li><a href="viewtypeproduct"><i class="fa fa-dashboard"></i> <span>Loại sản phẩm</span></a></li>
      <li>
        <a href="viewproduct">
          <i class="fa fa-dashboard"></i> <span>Sản phẩm</span>
        </a>
      </li>

      <li><a href="{{URL::to('view-all-accessories-group')}}"><i class="fa fa-dashboard"></i> <span>Nhóm Phụ Kiện</span></a></li>
    <li><a href="{{URL::to('view-all-accessories')}}"><i class="fa fa-dashboard"></i> <span>Phụ kiện</span></a></li>
      <li>
      <a href="{{URL::to('view-bill')}}">
          <i class="fa fa-dashboard"></i> <span>Quản lý đơn hàng</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
      </li>
      <li><a href="viewcusaccount"><i class="fa fa-dashboard"></i> <span>Khách hàng</span></a></li>
      <li><a href="viewuser"><i class="fa fa-dashboard"></i> <span>Tài khoản quản trị</span></a></li>
      <li><a href="{{URL::to('create-bill-admin-now')}}"><i class="fa fa-dashboard"></i> <span>Tài Đơn Hàng Trực Tiếp</span></a></li>
    </ul>
  </section>
</aside>

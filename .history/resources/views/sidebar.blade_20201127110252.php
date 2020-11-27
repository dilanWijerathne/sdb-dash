
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="public/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{session('user_name')}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>


      <!-- /.search form -->


      <!-- sidebar menu: : style can be found in sidebar.less -->

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview menu-open">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/sdb-dash/dashboard"><i class="fa fa-circle-o"></i>Bak to Home</a></li>
            <li class="active"><a target="blank" href="{{env('CORE_URL')}}/sdb-dash/log-viewer"><i class="fa fa-circle-o"></i>BE Logs Review</a></li>
            <li class="active"><a target="blank" href="{{env('CORE_URL')}}/sdb-dash/log-viewer"><i class="fa fa-circle-o"></i>Dash Logs Review</a></li>
          </ul>
        </li>













        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Applications</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/sdb-dash/onboarding"><i class="fa fa-circle-o"></i>Saving Accounts</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>FD Accounts</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Kids Accounts</a></li>
          </ul>
        </li>



        <li>
          <a href="#">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">12</small>
              <small class="label pull-right bg-green">16</small>
              <small class="label pull-right bg-red">5</small>
            </span>
          </a>
        </li>


        <li class="treeview">
            <a href="#">
              <i class="fa fa-edit"></i> <span>My Team</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="myteam"><i class="fa fa-circle-o"></i> General</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Stats</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Wiki</a></li>
            </ul>
          </li>



        <li class="header">Communications</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>


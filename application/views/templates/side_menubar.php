<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li id="dashboardMainMenu">
          <a href="<?php echo base_url('dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li id="mainRecipeNav">
          <a href="<?php echo base_url('recipe/list/') ?>">
            <i class="fa fa-cutlery"></i> <span>Recipe</span>
          </a>
        </li>
        <li id="mainUserdataNav">
          <a href="<?php echo base_url('recipe/userData/') ?>">
            <i class="fa fa-database"></i> <span>Customer Data</span>
          </a>
        </li>
        
        <!-- user permission info -->
        <li><a href="<?php echo base_url('auth/logout') ?>"><i class="glyphicon glyphicon-log-out"></i> <span>Logout</span></a></li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<ul class="nav navbar-nav side-nav">
          <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Data Master <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo site_url('admin/administrator') ?>"><i class="fa fa-users"></i> Admin</a></li>
          <li><a href="<?php echo site_url('admin/user') ?>"><i class="fa fa-user-md"></i> Pengguna</a></li>
        </ul>
    </li>         
          <li><a href="<?php echo site_url('admin/project') ?>"><i class="fa fa-home"></i> Project</a></li>
          <li><a href="<?php echo site_url('admin/channel') ?>"><i class="fa fa-tag"></i> Channel</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Laporan <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#"><i class="fa fa-book"></i> Report</a></li>
        </ul>
    </li>       
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> User Menu <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo site_url('user') ?>"><i class="fa fa-lock"></i> Ubah Profil</a></li>
          <li><a href="<?php echo site_url('auth/logout') ?>" onclick="return confirm('Yakin Mau Keluar?');"><i class="fa fa-sign-out"></i> Log Out</a></li>
        </ul>
    </li>
</ul>
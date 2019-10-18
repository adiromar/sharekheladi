<?php
$user_id=$this->session->userdata('user_id');
$user_role=$this->session->userdata('user_role');
$user_name=$this->session->userdata('user_name');
$status=$this->session->userdata('status');
// // echo $user_id;die;
if($user_id = true && $user_role == 'SuperAdmin' || $user_role == 'Admin' && $status =='Active'){

}elseif ($user_id != true){
  redirect('pages/index');
}else{
  redirect('pages/index');
}
?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/admin_part.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Admin Section</title>
  </head>
  <body class="app sidebar-mini sidenav-toggled">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="">Admin Section</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"></a>
      <!-- Navbar Right Menu-->

      <ul class="app-nav">
        <li><a class="app-nav__item" href="<?php echo base_url(); ?>" target="_blank">Go to Website</a></li>
        
        
          
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <!-- <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li> -->
            <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-user fa-lg"></i><?php echo $user_name;?></a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('user/logout');?>"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
            <li></li>
          </ul>
        </li>
      </ul>
    </header>

<!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <!-- <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image"> -->
        <div>
          <!-- <p class="app-sidebar__user-name">Wump Admin</p> -->
          <!-- <p class="app-sidebar__user-designation">Frontend Developer</p> -->
        </div>
      </div>
      <ul class="app-menu">
        
        <li><a class="app-menu__item" href="<?php echo base_url(); ?>admin/dash"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        
        <li><a class="app-menu__item" href="<?php echo base_url(); ?>user/index"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">User Mgmt</span></a></li>
        
        <li><a class="app-menu__item" href="<?php echo base_url(); ?>admin/add_benefit"><i class="app-menu__icon fa fa-plus"></i><span class="app-menu__label">Add Benefit</span></a></li>

        <li><a class="app-menu__item" href="<?php echo base_url(); ?>admin/templates"><i class="app-menu__icon fa fa-file"></i><span class="app-menu__label">Templates</span></a></li>

        <!-- <li><a class="app-menu__item" href="<?php echo base_url(); ?>admin/view_a"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">View</span></a></li> -->
        <!-- <li><a class="app-menu__item" href="<?php echo base_url(); ?>admin/import_csv"><i class="app-menu__icon fa fa-upload"></i><span class="app-menu__label">Import</span></a></li> -->
        
      </ul>
    </aside>
<?php
$islogin = $this->session->userdata('islogin');
$user_name = $this->session->userdata('user_name');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Share Market Information</title>

    <!-- Favicon -->
    <link rel="icon" href="<?= base_url()?>assets_front/sharekheladi.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?= base_url()?>assets_front/style.css">
    <link rel="stylesheet" href="<?= base_url()?>assets_front/main.css">
    <style>
        .logo img{
            height: 90px !important;
        }

        .logo img:hover{
            /* transform: scale(1.5); */
            /* z-index: 1000 !important; */
        }
    </style>
</head>
<body>
    <!-- Preloader -->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">
        <!-- Top Header Area -->
        <div class="top-header-area">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12 d-flex justify-content-between">
                        <!-- Logo Area -->
                        <div class="logo">
                            <a href="index.html">
                                <img src="<?= base_url()?>assets_front/sharekheladi.png" alt="">
                            </a>
                        </div>

                        <!-- Top Contact Info -->
                        <div class="top-contact-info d-flex align-items-center">
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="25 th Street Avenue, Los Angeles, CA"><img src="<?= base_url()?>assets_front/img/core-img/placeholder.png" alt=""> <span></span></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="office@yourfirm.com"><img src="<?= base_url()?>assets_front/img/core-img/message.png" alt=""> <span>office@yourfirm.com</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navbar Area -->
        <div class="credit-main-menu" id="sticker">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="creditNav">

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                            
                                <ul>
                                    <li><a href="<?= base_url()?>">Home</a></li>
                                    <?php
                                    if ($islogin == true){ ?>
                                    <li><a href="<?= base_url()?>admin/dash">Admin Section</a></li>

                                    <?php } ?>
                                    <li><a href="#">About Us</a></li>
                                    <!-- <li><a href="#">Pages</a>
                                        <ul class="dropdown">
                                            <li><a href="index.html">Home</a></li>
                                            <li><a href="#">About Us</a></li>
                                            <li><a href="#">Services</a></li>
                                            <li><a href="#">Contact</a></li>
                                        </ul>
                                    </li> -->
                                    <!-- <li><a href="services.html">Services</a></li> -->
                                    <!-- <li><a href="#">Portfolio</a>
                                        <div class="megamenu">
                                            <ul class="single-mega cn-col-4">
                                                <li><a href="#">Portfolio 1</a></li>
                                                <li><a href="#">Portfolio 2</a></li>
                                                <li><a href="#">Portfolio 3</a></li>
                                                <li><a href="#">Portfolio 4</a></li>
                                                <li><a href="#">Portfolio 5</a></li>
                                                <li><a href="#">Portfolio 6</a></li>
                                                <li><a href="#">Portfolio 7</a></li>
                                            </ul>
                                            <ul class="single-mega cn-col-4">
                                                <li><a href="#">Portfolio 8</a></li>
                                                <li><a href="#">Portfolio 9</a></li>
                                                <li><a href="#">Portfolio 10</a></li>
                                                <li><a href="#">Portfolio 11</a></li>
                                                <li><a href="#">Portfolio 12</a></li>
                                                <li><a href="#">Portfolio 13</a></li>
                                                <li><a href="#">Portfolio 14</a></li>
                                            </ul>
                                            <ul class="single-mega cn-col-4">
                                                <li><a href="#">Portfolio 15</a></li>
                                                <li><a href="#">Portfolio 16</a></li>
                                                <li><a href="#">Portfolio 17</a></li>
                                                <li><a href="#">Portfolio 18</a></li>
                                                <li><a href="#">Portfolio 19</a></li>
                                                <li><a href="#">Portfolio 20</a></li>
                                                <li><a href="#">Portfolio 21</a></li>
                                            </ul>
                                            <ul class="single-mega cn-col-4">
                                                <li><a href="#">Portfolio 22</a></li>
                                                <li><a href="#">Portfolio 23</a></li>
                                                <li><a href="#">Portfolio 24</a></li>
                                                <li><a href="#">Portfolio 25</a></li>
                                                <li><a href="#">Portfolio 26</a></li>
                                                <li><a href="#">Portfolio 27</a></li>
                                                <li><a href="#">Portfolio 28</a></li>
                                            </ul>
                                        </div>
                                    </li> -->
                                    <?php 
                            if($islogin == 'Logged In'){ ?>
                                    <li><a href="<?= base_url()?>pages/myportfolio">My Portfolio</a></li>
                            <?php } ?>
                                    <!-- <li><a href="<?= base_url()?>user/login" data-toggle="modal" data-target="#modalLoginForm">Login</a></li> -->
                                </ul>
                            </div>
                            <!-- Nav End -->
                        </div>

                        <!-- Contact -->
                        <div class="contact">
                            <!-- <a href="#"><img src="<?= base_url()?>assets_front/img/core-img/call2.png" alt=""> +800 49 900 900</a> -->
                            <?php 
                            if($islogin == 'Logged In'){
                                echo '<a href="#"><small>'.$user_name.' , </small></a>';
                                echo '<a href="'.base_url().'user/logout"><small> Log Out</small></a>';
                            }else{ ?>
                            <a href="<?= base_url()?>user/login" data-toggle="modal" data-target="#modalLoginForm">Login</a>
                        <?php } ?>
                        

                        </div>
                    </nav>
                </div>

            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->



<!-- <div class="text-center">
  <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm">Launch
    Modal Login Form</a>
</div> -->

<?php if($this->session->flashdata('login_error')):
    echo '<p class="alert alert-danger"><b>'.$this->session->flashdata('login_error').'</b></p>';
  endif;
?>

<script type="text/javascript">
    
//     setTimeout(function() {
//     // $('#modalLoginForm').modal();
// }, 9500);


</script>
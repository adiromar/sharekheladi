<!-- login modal starts -->
<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Sign In</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form action="<?= base_url()?>user/login" method="post" id="login_form">
      <div class="modal-body mx-3">
        <div class="row md-form mb-5">
            <div class="col-md-3">
                <i class="fa fa-envelope prefix grey-text" style="font-size:36px;color: darkgrey;"></i>
            </div>
            <div class="col-md-9">
                <input type="text" id="defaultForm-email" name="username" class="form-control validate" placeholder="Username or Email">
            </div>
          <!-- <label data-error="wrong" data-success="right" for="defaultForm-email">Your Email/Username</label> -->
        </div>

        <div class="row md-form mb-4">
            <div class="col-md-3">
                <i class="fa fa-lock prefix grey-text" style="font-size:36px;color: darkgrey;"></i>
            </div>
            <div class="col-md-9">
                <input type="password" id="defaultForm-pass" name="password" class="form-control validate" placeholder="Password">
            </div>
          <!-- <label data-error="wrong" data-success="right" for="defaultForm-pass">Your Password</label> -->
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <input type="submit" name="btnlogin" value="Login" class="btn btn-info">
      </div>

    </div>
  </div>
</div> <!-- end of login modal -->

    <!-- ##### Footer Area Start ##### -->
    
    
    <footer class="footer-area section-padding-100-0">
        <div class="container">
            <div class="row">

                <!-- Single Footer Widget -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-footer-widget mb-100">
                        <h5 class="widget-title">About Us</h5>
                        <!-- Nav -->
                        <nav>
                            <ul>
                                <li><a href="<?= base_url();?>">Homepage</a></li>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Trading &amp; Commerce</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- Single Footer Widget -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-footer-widget mb-100">
                        <h5 class="widget-title">Disclaimer</h5>
                        <!-- Nav -->
                        <nav>
                            <ul>
                                <li><a href="#">Disclaimer</a></li>
                                <!-- <li><a href="#">Trading &amp; Commerce</a></li>
                                <li><a href="#">Banking &amp; Private Equity</a></li>
                                <li><a href="#">Industrial &amp; Factory</a></li>
                                <li><a href="#">Financial Solutions</a></li> -->
                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- Single Footer Widget -->
                <!-- <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-footer-widget mb-100">
                        <h5 class="widget-title">Our Loans</h5> -->
                        <!-- Nav -->
                        <!-- <nav>
                            <ul>
                                <li><a href="#">Our Loans</a></li>
                                <li><a href="#">Trading &amp; Commerce</a></li>
                                <li><a href="#">Banking &amp; Private Equity</a></li>
                                <li><a href="#">Industrial &amp; Factory</a></li>
                                <li><a href="#">Financial Solutions</a></li>
                            </ul>
                        </nav>
                    </div>
                </div> -->

                <!-- Single Footer Widget -->
                <!-- <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-footer-widget mb-100">
                        <h5 class="widget-title">Latest News</h5> -->

                        <!-- Single News Area -->
                        <!-- <div class="single-latest-news-area d-flex align-items-center">
                            <div class="news-thumbnail">
                                <img src="<?= base_url()?>assets_front/img/bg-img/7.jpg" alt="">
                            </div>
                            <div class="news-content">
                                <a href="#">How to get the best loan?</a>
                                <div class="news-meta">
                                    <a href="#" class="post-author"><img src="img/core-img/pencil.png" alt=""> Jane Smith</a>
                                    <a href="#" class="post-date"><img src="img/core-img/calendar.png" alt=""> April 26</a>
                                </div>
                            </div>
                        </div> -->

                        <!-- Single News Area -->
                        <!-- <div class="single-latest-news-area d-flex align-items-center">
                            <div class="news-thumbnail">
                                <img src="img/bg-img/8.jpg" alt="">
                            </div>
                            <div class="news-content">
                                <a href="#">A new way to get a loan</a>
                                <div class="news-meta">
                                    <a href="#" class="post-author"><img src="<?= base_url()?>assets_front/img/core-img/pencil.png" alt=""> Jane Smith</a>
                                    <a href="#" class="post-date"><img src="<?= base_url()?>assets_front/img/core-img/calendar.png" alt=""> April 26</a>
                                </div>
                            </div>
                        </div> -->

                        <!-- Single News Area -->
                        <!-- <div class="single-latest-news-area d-flex align-items-center">
                            <div class="news-thumbnail">
                                <img src="<?= base_url()?>assets_front/img/bg-img/9.jpg" alt="">
                            </div>
                            <div class="news-content">
                                <a href="#">Finance you home</a>
                                <div class="news-meta">
                                    <a href="#" class="post-author"><img src="<?= base_url()?>assets_front/img/core-img/pencil.png" alt=""> Jane Smith</a>
                                    <a href="#" class="post-date"><img src="<?= base_url()?>assets_front/img/core-img/calendar.png" alt=""> April 26</a>
                                </div>
                            </div>
                        </div> -->

                    </div>
                </div>
            </div>
        </div>

        <!-- Copywrite Area -->
        <div class="copywrite-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="copywrite-content d-flex flex-wrap justify-content-between align-items-center">
                            <!-- Footer Logo -->
                            <a href="index.html" class="footer-logo"><img src="<?= base_url()?>assets_front/img/core-img/logo.png" alt=""></a>

                            <!-- Copywrite Text -->
                            <p class="copywrite-text"><a href="#"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area Start ##### -->

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="<?= base_url()?>assets_front/js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="<?= base_url()?>assets_front/js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="<?= base_url()?>assets_front/js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="<?= base_url()?>assets_front/js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="<?= base_url()?>assets_front/js/active.js"></script>

    <script type="text/javascript">
        // check delete record
 function check_del(){
    var r=confirm("Confirm Delete this Data?")
        if (r==true)
          window.location = url+"pages/delete_sin/"+title+id;
        else
          return false;
  }
    </script>
</body>

</html>
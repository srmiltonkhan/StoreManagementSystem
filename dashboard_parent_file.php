<!-- Side Navbar Items Includes -->
<?php require 'side_nav_item_and_brand_name.php';?>
<?php $html_and_head_section = "
<!DOCTYPE html>
<html lang='en'>
<head>
	<title>KYAU STORE MANAGEMENT SYSTEM</title>
  <link rel='shortcut icon' href='img/favicon/kyausmsfavicon.ico'>
	<meta charset='utf-16'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' href='vendor/bootstrap/css/bootstrap.min.css'>
	<link rel='stylesheet' href='css/dataTables.bootstrap4.min.css'>
  <link href='vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'> 
  <link href='vendor/fontawesome/css/all.css' rel='stylesheet'>
  <link rel='stylesheet' href='css/bootstrap-select.min.css'>
  <link rel='stylesheet' href='css/style.default.css' id='theme-stylesheet'>
	<link rel='stylesheet' href='css/custom.css'>
  <script src='vendor/jquery/jquery.min.js'></script>
</head>
";
?>
<?php $body_and_header_section = "
<body>
      <div class='page'>
      <header class='header fixed-top'>
        <nav class='navbar'>      
          <div class='container-fluid'> 
            <div class='row navbar-holder d-flex align-items-center justify-content-between'> 
                <div class='navbar-header col-3'>
                    <a href='dashboard.php' class='navbar-brand d-none d-sm-inline-block'>
                      <div class='brand-text d-none d-lg-inline-block'><span>$brand_name</span></div>
                    </a>
                    <a id='toggle-btn' href='#'' class='menu-btn active'><span></span><span></span><span></span></a>
                </div>
                <div class='col-7'>
                    <marquee>$header_mqrquee_title</marquee>
                </div>
                <div class='col-2 clearfix'>
                    <ul class='nav-menu list-unstyled d-flex flex-md-row align-items-md-center float-right'>     
                      <li class='nav-item dropdown'>
                          <a id='languages' rel='nofollow' data-target='#' href='#' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' class='nav-link language  dropdown-toggle'> 
                            <img class='rounded-circle' src='img/user_image/milton.jpg' alt='Milton Hossain' width='30' height='30'>
                              <span class='d-none d-sm-inline-block'>$profile_name</span>
                          </a>
                          <ul aria-labelledby='languages' class='dropdown-menu'>
                            <li><a rel='nofollow' href='#' class='dropdown-item'><i class='fa fa-user'></i>$my_profile</a></li>
                            <li><a rel='nofollow' href='#' class='dropdown-item'><i class='fa fa-edit'></i>$change_password</a></li>
                            <li>
                              <a rel='nofollow' href='#' class='dropdown-item'><i class='fas fa-sign-out-alt'></i>$logout</a>
                            </li>                                               
                          </ul>
                      </li>                   
                    </ul>
                </div>          
            </div>
          </div>
        </nav>
      </header>
      ";
      ?>
      <!-- Side Navbar Section -->
      <?php 
      $side_nabar_and_content_inner_section = "
      <div class='page-content d-flex align-items-stretch page-margin'>
        <nav class='side-navbar fixed-nav'>
          <ul class='list-unstyled'>
            <li><a href='dashboard.php'><i class='fas fa-tachometer-alt fa-lg'></i></i>$dashboard</a></li>
            <li><a href='#misDropdownItem' aria-expanded='false' data-toggle='collapse'><i class='fas fa-laptop fa-lg'></i>$mis</a>
              <ul id='misDropdownItem' class='collapse list-unstyled'>
                <li><a href='stock_report.php'><i class='fas fa-warehouse fa-lg'></i>$stock_report</a></li>
                <li><a href='issued_report.php'><i class='fas fa-shopping-cart'></i>$issued_report</a></li>
                <li><a href='return_scrap_report.php'><i class='fas fa-reply fa-xs'></i>$return_scrap_report</a></li>
              </ul>
            </li>
            <li><a href='#inventoryDropDownItem' aria-expanded='false' data-toggle='collapse'><i class='fas fa-dolly-flatbed fa-lg'></i>$inventory</a>
              <ul id='inventoryDropDownItem' class='collapse list-unstyled'>
                <li><a href='category.php'><i class='fas fa-clipboard-list'></i>$category</a></li>
                <li><a href='brand.php'><i class='fas fa-copyright'></i>$brand</a></li>
                <li><a href='product.php'><i class='fas fa-marker'></i>$product</a></li>
              </ul>
            </li>
            <li><a href='#warehouseDropdownItem' aria-expanded='false' data-toggle='collapse'><i class='fas fa-warehouse fa-lg'></i>$warehouse</a>
              <ul id='warehouseDropdownItem' class='collapse list-unstyled'>
                <li><a href='stock_info.php'><i class='fas fa-info fa-lg'></i>$stock_info</a></li>
                <li><a href='warehouse_cost_information.php'><i class='fas fa-dollar-sign'></i></i>$warehouse_cost_information</a></li>
              </ul>
            </li>
            <li><a href='inventory_requisition.php'> <i class='fas fa-file-export fa-lg'></i>$inventory_requisition</a></li>
            <li><a href='#requisitionApprover'aria-expanded='false' data-toggle='collapse'> <i class='fas fa-file-import fa-lg'></i>$requisition_inventory</a>
              <ul id='requisitionApprover' class='collapse list-unstyled'>
                <li><a href='department_office.php'><i class='fas fa-chalkboard-teacher'></i>$department_office</a></li>
                <li><a href='registrar.php'><i class='fas fa-user-shield'></i>$registrar</a></li>
                <li><a href='vice_chancellor.php'><i class='fas fa-user-md'></i>$vice_chancellor</a></li>
                <li><a href='store_manager.php'><i class='fas fa-user-tie'></i>$store_manager</a></li>
              </ul>
            </li>
            <li><a href='issued_inventory.php'> <i class='fas fa-shopping-cart fa-lg'></i>$issued_inventory</a></li>
            <li><a href='return_scrap_inventory.php'> <i class='fas fa-reply fa-lg'></i></i>$return_scrap_inventory</a></li>
            <li><a href='member.php'> <i class='fas fa-users fa-lg'></i>$member</a></li>
            <li><a href='user_control.php'> <i class='fa fa-user-lock fa-lg'></i></i>$user_control</a></li>
            <li><a href='user_login_activity.php'> <i class='fas fa-history fa-lg'></i>$user_login_activity</a></li>
            <li><a href='access_control.php'> <i class='fa fa-cogs fa-lg'></i>$access_control</a></li>
          </ul>
        </nav>
        <div class='content-inner'>
              ";?>


          <!-- Start Page Footer Section-->
  <?php $end_page_sidenav_content_footer_section = "
          <footer class='main-footer'>
            <div class='container-fluid'>
              <div class='row'>
                <div class='col-sm-6'>
                  <p>$footer_policy_name</p>
                </div>
                <div class='col-sm-6 text-right'>
                  <p>DESIGN AND DEVELOPED BY <a href='#' class='external'>$developer_and_designer_name</a></p>
                </div>
              </div>
            </div>
          </footer>
        </div>
      </div>
    </div>
  ";?>
 <!-- JavaScript files-->
 <!-- jQuery library -->
 <?php $end_body_html_and_java_script_section = "
  <script src='js/jquery.dataTables.min.js'></script> 
  <script src='js/dataTables.bootstrap4.min.js'></script> 
	<script src='vendor/popper.js/popper.min.js'></script>
	<script src='vendor/bootstrap/js/bootstrap.min.js'></script>
  <script src='js/custom.js'></script>
  <script src='js/bootstrap-select.min.js'></script>
</body>
</html>
  ";
  ?>

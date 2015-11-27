    <header class="main-header">
        <a href="#" class="logo"><b>Cien</b> | Tracking</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
            <!--
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">แสดงตามสี <?php echo date('F Y'); ?><span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="<?php echo site_url("report/allparcel_color/Blue"); ?>">Blue</a></li>
                  <li><a href="<?php echo site_url("report/allparcel_color/Light_Blue"); ?>">Light Blue</a></li>
                  <li><a href="<?php echo site_url("report/allparcel_color/Yellow"); ?>">Yellow</a></li>
                  <li><a href="<?php echo site_url("report/allparcel_color/Bangacha"); ?>">Bangacha</a></li>
                  <li><a href="<?php echo site_url("report/allparcel_color/Orange"); ?>">Orange</a></li>
                  <li><a href="<?php echo site_url("report/allparcel_color/Purple"); ?>">Purple</a></li>
                  <li><a href="<?php echo site_url("report/allparcel_color/Ruby"); ?>">Ruby</a></li>
                  <li><a href="<?php echo site_url("report/allparcel_color/Pink"); ?>">Pink</a></li>
                  <li><a href="<?php echo site_url("report/allparcel_color/Green"); ?>">Green</a></li>
                  <li><a href="<?php echo site_url("report/allparcel_color/มรกต"); ?>">มรกต</a></li>
                  <li><a href="<?php echo site_url("report/allparcel_color/Tsavori"); ?>">Tsavori</a></li>
                  <li><a href="<?php echo site_url("report/allparcel_color/Brown_Garnet"); ?>">Brown Garnet</a></li>
                  <li><a href="<?php echo site_url("report/allparcel_color/Amethast"); ?>">Amethast</a></li>
                  <li><a href="<?php echo site_url("report/allparcel_color/Red_Spinel"); ?>">Red Spinel</a></li>
                  <li><a href="<?php echo site_url("report/allparcel_color/Swiss_Blue"); ?>">Swiss Blue</a></li>
                  <li><a href="<?php echo site_url("report/allparcel_color/London_Blue"); ?>">London Blue</a></li>
                  <li><a href="<?php echo site_url("report/allparcel_color/Aqumarine"); ?>">Aqumarine</a></li>
                </ul>
              </li>
            -->
            </ul>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
            <?php if ($this->session->userdata('sessstatus') == 1) { ?>
              <li class="tasks-menu">
                <a href="<?php echo site_url("main/config"); ?>"><i class="fa fa-gears"></i> ตั้งค่า</a>
              </li>
            <?php } ?>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs">ผู้ใช้งาน :  <strong><?php echo $this->session->userdata('sessfirstname')." ".$this->session->userdata('sesslastname'); ?></strong><i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i></span>
                </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo site_url("main/changepass"); ?>"><i class="fa fa-gear fa-fw"></i> เปลี่ยนรหัสผ่าน</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url("main/logout"); ?>"><i class="fa fa-sign-out fa-fw"></i> ออกจากระบบ</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
              </li>
            </ul>
          </div>
        </div>
        </nav>
      </header>

<!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li>
              <a href="<?php echo site_url("main"); ?>">
                <i class="fa fa-home"></i> <span>Dashboard</span>
              </a>
            </li>
            <?php if (($this->session->userdata('sessstatus') == 4) || ($this->session->userdata('sessstatus') == 1)) { ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-diamond"></i>
                <span>Inventory</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url("stock/liststock"); ?>"><i class="fa fa-circle-o"></i> Inventory List</a></li>
                <li><a href="<?php echo site_url("stock/addstock"); ?>"><i class="fa fa-circle-o"></i> Add New Stone</a></li>
                
              </ul>
            </li>
            <li>
              <a href="<?php echo site_url("purchase/addstock"); ?>">
                <i class="fa fa-file-text-o"></i> <span>Add New Delivery Form</span>
              </a>
            </li>
            <li>
              <a href="<?php echo site_url("purchase/allgems"); ?>">
                <i class="fa fa-th"></i> <span>View Delivery</span>
              </a>
            </li>
            <li>
            <?php }
            
            if ($this->session->userdata('sessstatus') == 3) {
            ?>
            <li><a href="<?php echo site_url("stock/liststock"); ?>"><i class="fa fa-diamond"></i> Inventory List</a></li>
            <?php 
            }
            if ($this->session->userdata('sessstatus') <= 2) { ?>
            <li>
              <a href="<?php echo site_url("purchase/createbarcode");  //echo site_url("gemstone/addgems"); ?>">
                <i class="fa fa-file-text-o"></i> <span>พิมพ์บาร์โค้ด</span>
              </a>
            </li>
            <li>
              <a href="<?php echo site_url("gemstone/sendbackgems"); ?>">
                <i class="fa fa-refresh"></i> <span>เบิก/คืนของ</span>
              </a>
            </li>
            <li>
              <a href="<?php echo site_url("report/taken_back"); ?>">
                <i class="fa fa-exclamation-triangle"></i> <span>รายการเบิก-คืนประจำวัน</span>
              </a>
            </li>
            <li>
              <a href="<?php echo site_url("gemstone/qcgems"); ?>">
                <i class="fa fa-check-square-o"></i> <span>QC ออกจากโรงงาน</span>
              </a>
            </li>
            <?php } ?>
            <li>
              <a href="<?php echo site_url("report/allparcel"); ?>">
                <i class="fa fa-th"></i> <span>ชุดวัตถุดิบทั้งหมดในโรงงาน</span>
              </a>
            </li>
            <?php if ($this->session->userdata('sessstatus') != 4) { ?>
            <li>
              <a href="<?php echo site_url("report/searchbarcode"); ?>">
                <i class="fa fa-barcode"></i> <span>บาร์โค้ดทั้งหมด</span>
              </a>
            </li>
            <li>
              <a href="<?php echo site_url("report/showgems_edit"); ?>">
                <i class="fa fa-exclamation-triangle"></i> <span>บาร์โค้ดที่ต้องซ่อม</span>
              </a>
            </li>
            <?php    
            }
            if (($this->session->userdata('sessstatus') == 3)||($this->session->userdata('sessstatus') ==1 ) ) {
            ?>
            <li><a href="<?php echo site_url("kpi/viewmain"); ?>"><i class="fa fa-street-view"></i> KPI</a></li>
            <?php } ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

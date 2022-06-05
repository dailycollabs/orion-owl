 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
      <img src="<?=base_url()?>assets/dist/img/logo/logo2.png" alt="AdminLTE Logo" class="brand-image" width="85px">
        <span class="brand-text font-weight-light">ORION OWL</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"> <span>Admin</span></a>
          </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->


                        <li class="nav-item">
                        <a href="<?= base_url('superadmin/dashboard'); ?>" class="nav-link">
                            <i class="fas fa-home"></i>
                            <p>
                            Dashboard
                            </p>
                        </a>
                        </li>
                        
                        <li class="nav-item">
                        <a href="<?= base_url('superadmin/dataorder') ?>" class="nav-link">
                            <i class="fas fa-industry"></i>
                            <p>
                                Data Order
                            <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item pl-4">
                            <a href="<?= base_url('superadmin/dataorder/minerbaOrderList') ?>" class="nav-link">
                                <i class="fas fa-industry"></i>
                                <p>Data Order Minerba</p>
                            </a>
                            </li>
                            <li class="nav-item pl-4">
                            <a href="<?= base_url('superadmin/dataorder/marineOrderList'); ?>" class="nav-link">
                                <i class="fas fa-layer-group"></i>
                                <p>Data Order Marine</p>
                            </a>
                            </li>

                        </ul>
                        </li>
                        <li class="nav-item">
                        <a href="<?= base_url('superadmin/prosesorder') ?>" class="nav-link">
                            <i class="fas fa-dolly"></i>
                            <p>
                            Proses Order
                            <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item pl-4">
                            <a href="<?= base_url('superadmin/prosesorder/prosesorder_minerba') ?>" class="nav-link">
                                <i class="fas fa-industry"></i>
                                <p> Proses Order Minerba</p>
                            </a>
                            </li>
                            <li class="nav-item pl-4">
                            <a href="<?= base_url('superadmin/prosesorder/prosesorder_marine'); ?>" class="nav-link">
                                <i class="fas fa-layer-group"></i>
                                <p> Proses Order Marine</p>
                            </a>
                            </li>

                        </ul>
                        </li>

                        <li class="nav-item">
                        <a href="<?= base_url('superadmin/bidang') ?>" class="nav-link">
                            <i class="fas fa-industry"></i>
                            <p>
                            Bidang
                            <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item pl-4">
                            <a href="<?= base_url('superadmin/bidang') ?>" class="nav-link">
                                <i class="fas fa-industry"></i>
                                <p>Bidang</p>
                            </a>
                            </li>
                            <li class="nav-item pl-4">
                            <a href="<?= base_url('superadmin/subbidang'); ?>" class="nav-link">
                                <i class="fas fa-layer-group"></i>
                                <p>Sub Bidang</p>
                            </a>
                            </li>

                        </ul>
                        </li>

                        <li class="nav-item">
                        <a href="<?= base_url('superadmin/client'); ?>" class="nav-link">
                            <i class="fas fa-users"></i>
                            <p>
                            Client
                            <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item pl-4">
                            <a href="<?= base_url('superadmin/client/konfirmasi_client'); ?>" class="nav-link">
                                <i class="fas fa-user-check"></i>
                                <p>Konfirmasi Client</p>
                            </a>
                            </li>
                            <li class="nav-item pl-4">
                            <a href="<?= base_url('superadmin/client/data_client'); ?>" class="nav-link">
                                <i class="fas fa-id-card-alt"></i>
                                <p>Data Client</p>
                            </a>
                            </li>

                        </ul>
                        </li>

                        <li class="nav-item">
                        <a href="<?= base_url('superadmin/pengguna'); ?>" class="nav-link">
                            <i class="fas fa-user-circle"></i>
                            <p>
                            Pengguna
                            <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item pl-4">
                            <a href="<?= base_url('superadmin/pengelola'); ?>" class="nav-link">
                                <i class="fas fa-user-circle"></i>
                                <p>Pengelola</p>
                            </a>
                            </li>
                            <li class="nav-item pl-4">
                            <a href="<?= base_url('superadmin/petugas'); ?>" class="nav-link">
                                <i class="fas fa-user-circle"></i>
                                <p>Karyawan</p>
                            </a>
                            </li>
                        </ul>
                        </li>
                        
                        <li class="nav-item">
                            <a href="<?= base_url('superadmin/pengaturan'); ?>" class="nav-link">
                            <i class="fas fa-home"></i>
                            <p>Pengaturan</p>
                            </a>
                        </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
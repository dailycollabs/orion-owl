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
            <img src="<?= base_url() ?>uploads/clientFile/clientFoto/<?=$this->fungsi->client_login()->clientFotoProfil?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
            <a href="<?= site_url('Client/profilClient')?>" class="d-block"> <span><?=$this->fungsi->client_login()->clientUsername?></span></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="<?= base_url('Client/clientDashboard'); ?>" class="nav-link"> 
                        <i class="fas fa-home"></i> 
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('Client/viewClientProjectNew'); ?>" class="nav-link">
                        <i class="fas fa-home"></i> 
                        <p>Approval Project</p>
                    </a>
                </li>

                <li class="nav-item">
                <a href="<?= base_url('Client/clientProject'); ?>" class="nav-link <?=$this->uri->segment(2) == 'clientProject' ? 'active' : ''?>">
                        <i class="fas fa-home"></i> 
                        <p>Data Project</p>
                    </a>
                </li>

                <!-- <li class="nav-item <?=$this->uri->segment(1) == 'WorkflowQuotation' ? 'menu-open' : ''?>">
                    <a href="<?= base_url('WorkflowQuotation') ?>" class="nav-link <?=$this->uri->segment(1) == 'WorkflowQuotation' ? 'active' : ''?>">
                        <i class="fas fa-industry"></i>
                        <p>Project<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="<?= base_url('Client/viewClientProjectNew'); ?>" class="nav-link">
                                <i class="fas fa-industry"></i>
                                <p>Approval Project</p>
                            </a>
                        </li>
            

                        <li class="nav-item">
                            <a href="<?= base_url('Client/clientProject'); ?>" class="nav-link <?=$this->uri->segment(2) == 'clientProject' ? 'active' : ''?>">
                                <i class="fas fa-industry"></i>
                                <p>Data Project</p>
                            </a>
                        </li>
                    </ul>
                </li> -->


            </ul>
        </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
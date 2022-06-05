
<?php 

    
    $clientNewProjectMarine        = $this->fungsi_notifikasi->notif_clientFinalProjectNewMarine();
    $clientNewProjectMinerba        = $this->fungsi_notifikasi->notif_clientFinalProjectNewMinerba();

    $jumlahAll = $clientNewProjectMarine+$clientNewProjectMinerba;

?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

      </ul>

      <!-- SEARCH FORM -->


      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">


        <!-- Messages Dropdown Menu -->
        
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-danger navbar-badge"><?=$jumlahAll?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header"><?=$jumlahAll?> Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="<?=site_url('client/clientProject/viewClientProjectNew')?>" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> <?=$clientNewProjectMarine?> new Project Marine Success
              
            </a>

            <div class="dropdown-divider"></div>
            <a href="<?=site_url('client/clientProject/viewClientProjectNew')?>" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> <?=$clientNewProjectMinerba?> new Project Minerba Success
                
            </a>
            
            
        </div>
        </li>



            <li class="nav-item dropdown user user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= base_url() ?>uploads/clientFile/clientFoto/<?=$this->fungsi->client_login()->clientFotoProfil?>" class="user-image img-circle elevation-2 alt=" User Image">
                        <span class="hidden-xs"><?=$this->fungsi->client_login()->clientUsername?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                                    <li class="user-header bg-primary">
                                    <img src="<?= base_url() ?>uploads/clientFile/clientFoto/<?=$this->fungsi->client_login()->clientFotoProfil?>" class="img-circle elevation-2" alt="User Image">

                                    <p>
                                    <?=$this->fungsi->client_login()->clientUsername?>
                                    <small><?=$this->fungsi->client_login()->clientPerusahaan_nama?></small>

                                    </p>
                                    </li>
                                    <!-- Menu Body -->
                                   
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="float-left">
                                            <a href="<?= site_url('Client/profilClient') ?>" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="float-right">
                                            <a href="<?= site_url('ClientAuth/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                    </ul>
            </li>
      </ul>
    </nav>
    <!-- /.navbar -->
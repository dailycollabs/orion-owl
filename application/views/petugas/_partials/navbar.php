
<?php 
    $bidangID = $this->fungsi->petugas_login()->bidangID;
    $sbID = $this->fungsi->petugas_login()->subbidangID;
    if($sbID == 'AM1' || $sbID == 'AM2'){
        $projectClient    = $this->fungsi_notifikasi->notif_projectclient();
    }else{
        $projectClient = 0;
    }
   
    $quotation        = $this->fungsi_notifikasi->notif_quotationnew();
    $quotationFailed  = $this->fungsi_notifikasi->notif_quotationnewFailed();

    $jobdesc  = $this->fungsi_notifikasi->notif_jobdesc();
    
    if($sbID == 'SM1' || $sbID == 'SM2'){
        $spk  = $this->fungsi_notifikasi->notif_spk();
    }else{
        $spk = 0;
    }

    if($bidangID == 1){
      $frNew  = $this->fungsi_notifikasi->notif_frMarNew();
      $frFailed  = $this->fungsi_notifikasi->notif_frMarFailed();
    }else if($bidangID == 2 || $sbID == 'FM'){
      $frNew     = $this->fungsi_notifikasi->notif_frMinNew();
      $frFailed  = $this->fungsi_notifikasi->notif_frMinFailed();
    }else{
      $frNew     = 0;
      $frFailed  = 0;
    }
   

    // $frMinNew  = $this->fungsi_notifikasi->notif_frMarNew();
    // $frMinFailed  = $this->fungsi_notifikasi->notif_frMarFailed();

    // if($sbID == 'FM' || $sbID == 'AM1'){
    //   $invNew  = $this->fungsi_notifikasi->notif_InvMarNew();
    //   $invFailed  = $this->fungsi_notifikasi->notif_InvMarFailed();
    // }else{
    //   $invNew = 0;
    //   $invFailed = 0;
    // }
   
    // if($sbID == 'MDM2' || $sbID == 'AM2' ){
    //   $invNew  = $this->fungsi_notifikasi->notif_InvMinNew();
    //   $frFailed  = $this->fungsi_notifikasi->notif_frMinFailed();
    // }else{
    //   $invNew = 0;
    //   $invFailed = 0;
    // }

    // 

    if($bidangID == 1 || $sbID == 'FM'){
      $invNew  = $this->fungsi_notifikasi->notif_InvMarNew();
      $invFailed  = $this->fungsi_notifikasi->notif_InvMarFailed();
    }else if($bidangID == 2){
      $invNew  = $this->fungsi_notifikasi->notif_InvMinNew();
      $invFailed  = $this->fungsi_notifikasi->notif_InvMinFailed();
    }else{
      $invNew = 0;
      $invFailed = 0;
    }
    

    $jumlahAll = $projectClient+$quotation+$quotationFailed+$jobdesc+$spk+$frNew+$frFailed+$invNew+$invFailed;

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


        
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell fa-lg"></i>
            <span class="badge badge-danger navbar-badge"><?=$jumlahAll?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        
            <span class="dropdown-item dropdown-header"><?=$jumlahAll?> Notifications</span>
        <?php if($projectClient != 0){?>
            <?php if($sbID == 'AM1' || $sbID == 'AM2'){?>
            <div class="dropdown-divider"></div>
            <a href="<?=site_url('ClientProject/viewNewProject')?>" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> <?=$projectClient ?> new Project Client 
                
            </a>
            <?php } ?>
        <?php } ?>
        <?php if($quotation != 0){?>
            <div class="dropdown-divider"></div>
            <a href="<?=site_url('WorkflowQuotation/viewNewQuo')?>" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> <?=$quotation ?> new Quotation
                
            </a>
        <?php } ?>
        <?php if($quotationFailed != 0){?>
            <div class="dropdown-divider"></div>
            <a href="<?=site_url('WorkflowQuotation/viewfailedquo')?>" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> <?=$quotationFailed ?> new Failed Quotation 
                
            </a>
        <?php } ?>

        <?php if($jobdesc != 0){?>
            <div class="dropdown-divider"></div>
            <a href="<?=site_url('WorkflowJobdesc/viewNewApproval')?>" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> <?=$jobdesc?> new Approval Jobdesc
              
            </a>
        <?php } ?>
        
        <?php if($sbID == 'SM1' || $sbID == 'SM2'){ ?>
            <?php if($spk != 0){?>
            <div class="dropdown-divider"></div>
            <a href="<?=site_url('WorkflowSpk/viewNewspk')?>" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> <?=$spk?> new SPK
               
            </a>
            <?php } ?>
        <?php } ?>

        <?php if($frNew != null){?>
            <div class="dropdown-divider"></div>
            <a href="<?=site_url('InvoicingFinalReport/viewNewFR')?>" class="dropdown-item">
                <i class="fas fa-file mr-2"></i><?=$frNew?> new Final Report  
            </a>
        <?php } ?>
        <?php if($frFailed != null){?>
            <div class="dropdown-divider"></div>
            <a href="<?=site_url('InvoicingFinalReport/viewDraftFRNewFailed')?>" class="dropdown-item">
                <i class="fas fa-file mr-2"></i><?=$frFailed?> new Failed Final Report
            </a>
        <?php } ?>

        <?php if($sbID == 'FM'){ ?>
        <?php if($invNew != 0){?>
            <div class="dropdown-divider"></div>
            <a href="<?=site_url('InvoicingDraft/viewNewDraftInv')?>" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> <?=$invNew?> new Approval Invoice
            </a>
        <?php } ?>
        <?php } ?>

        <?php if($sbID == 'MDM1'){ ?>
        <?php if($invFailed != null){?>
            <div class="dropdown-divider"></div>
            <a href="<?=site_url('InvoicingDraft/viewfailedDraftInv')?>" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> <?=$invFailed?> new Failed Approval Invoice  
            </a>
        <?php } ?>
        <?php } ?>
        <?php if($sbID == 'AM1' || $sbID == 'AM2' || $sbID == 'MDM2'){ ?>
        <?php if($invNew != null){?>
        <div class="dropdown-divider"></div>
            <a href="<?=site_url('InvoicingDraft/viewNewApprov')?>" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> <?=$invNew?> new Approval Invoice  
            </a>
            <?php } ?>
            <?php } ?>
        </div>
        </li>

        <li class="nav-item dropdown user user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2 alt=" User Image">
            <span class="hidden-xs"><?=$this->fungsi->petugas_login()->petugasNama?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- User image -->
            <li class="user-header bg-primary">
              <img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">

              <p>
              <?=$this->fungsi->petugas_login()->petugasNama?>
                <small>Member since Nov. 2012</small>
              </p>
            </li>
            <!-- Menu Body -->
            
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="float-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="float-right">
                <a href="<?= site_url('PetugasAuth/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->
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
                <a href="#" class="d-block"> <span> <?=$this->fungsi->petugas_login()->petugasNama?></span></a>
            </div>
        </div>
        <!-- Sidebar Menu -->

        <?php $sbRules = $this->fungsi->petugas_login()->subidangrules;
              $sbID = $this->fungsi->petugas_login()->subbidangID;
        
        ?>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <?php if($sbRules == 1 ||$sbRules == 2 || $sbID == 'FM'){?>
                <li class="nav-item ml-2 ">
                    <a href="<?= site_url('petugas/petugasDashboard'); ?>" class="nav-link <?=$this->uri->segment(2) == 'petugasDashboard' ? 'active' : ''?>">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item ml-2 ">
                    <a href="<?= site_url('InvoivingFinalClient/viewTransaksiData'); ?>"  class="nav-link ">
                        <i class="fas fa-home"></i>
                        <p>Data Transaksi</p>
                    </a>
                </li> 
                <?php } ?>
                <!-- Dashboard -->     

                <!-- Order Client -->
                <?php if($sbID == 'AM1' || $sbID == 'AM2'){?>
                    <li class="nav-item ml-2 ">
                        <a href="<?= base_url('ClientProject/viewNewProject'); ?>" class="nav-link  <?=$this->uri->segment(2) == 'viewnewproject' ? 'active' : ''?>">
                            <i class="fas fa-industry"></i>
                            <p>Project Client</p>
                        </a>
                    </li>
                <?php } ?>
                <!-- Order Client -->

                <!-- Workflow -->
                <?php if($sbID == 'AM1' || $sbID == 'AM2' || $sbID == 'OMM1' || $sbID == 'MDM1' || $sbID == 'MDM2' || $sbID == 'FM'){?>
                <li class="nav-header">WORKFLOW</li>
                <li class="nav-item ml-2  <?=$this->uri->segment(1) == 'WorkflowQuotation' ? 'menu-open' : ''?>">
                    <a href="<?= base_url('WorkflowQuotation') ?>" class="nav-link <?=$this->uri->segment(1) == 'WorkflowQuotation' ? 'active' : ''?>">
                        <i class="fas fa-industry"></i>
                        <p>Quotation<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                    <?php if($sbID == 'OMM1' || $sbID == 'MDM1' || $sbID == 'MDM2' || $sbID == 'FM'){?>
                        <li class="nav-item">
                            <a href="<?= base_url('WorkflowQuotation/viewNewQuo'); ?>" class="nav-link">
                                <i class="fas fa-industry"></i>
                                <p>New Quotation</p>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if($sbID == 'AM1' || $sbID == 'AM2' || $sbID == 'OMM1' || $sbID == 'MDM1' || $sbID == 'MDM2'){?> 
                        <li class="nav-item">
                            <a href="<?= base_url('WorkflowQuotation/viewfailedquo'); ?>" class="nav-link <?=$this->uri->segment(2) == 'viewfailedquo' ? 'active' : ''?>">
                                <i class="fas fa-industry"></i>
                                <p>Quotation Failed</p>
                            </a>
                        </li>
                    <?php } ?>
                       
                    </ul>
                </li>
   
                <?php if($sbID == 'AM1' || $sbID == 'AM2' || $sbID == 'OMM1' || $sbID == 'MDM1' || $sbID == 'MDM2'){?> 
                    <li class="nav-item ml-2">
                        <a href="<?= base_url('WorkflowJobdesc/viewNewApproval') ?>" class="nav-link">
                            <i class="fas fa-industry"></i>
                            <p>New Approval</p>
                        </a>
                    </li>
                <?php } ?>
               
              
                <li class="nav-item ml-2">
                    <a href="<?= base_url('Workflow/viewDataWorkflow') ?>" class="nav-link">
                        <i class="fas fa-industry"></i>
                        <p>Data Workflow</p>
                    </a>
                </li>
                <?php } ?>
         
                <!-- Workflow -->

                <!-- Invoice -->
                <?php if($sbID == 'AM1' || $sbID == 'AM2' || $sbID == 'OMM1' || $sbID == 'MDM1' || $sbID == 'MDM2' || $sbID == 'SM1' || $sbID == 'SM2'){?>
                <li class="nav-header">INVOICE</li>

                    <?php if($sbID == 'SM1' || $sbID == 'SM2'){?> 
                    <li class="nav-item ml-2">
                        <a href="<?= base_url('WorkflowSpk/viewNewspk') ?>" class="nav-link">
                            <i class="fas fa-industry"></i>
                            <p>New SPK</p>
                        </a>
                    </li>
                    <?php } ?>
                    
               
                    <li class="nav-item ml-2">
                    <?php if($sbID == 'FM'){?> 
                       <a href="<?= base_url('InvoicingFinalReport') ?>" class="nav-link">
                           <i class="fas fa-industry"></i>
                           <p>Final Report Minerba<i class="fas fa-angle-left right"></i></p>
                        </a>
                    <?php }else{ ?>
                        <a href="<?= base_url('InvoicingFinalReport') ?>" class="nav-link">
                           <i class="fas fa-industry"></i>
                           <p>Draft Final Report<i class="fas fa-angle-left right"></i></p>
                        </a>
                    <?php } ?>
                        <ul class="nav nav-treeview">
                            <?php if($sbID != 'SM1' && $sbID != 'SM2'){?> 
                            <li class="nav-item">
                                <a href="<?= base_url('InvoicingFinalReport/viewNewFR'); ?>" class="nav-link">
                                    <i class="fas fa-industry"></i>
                                    <p>New Final Report</p>
                                </a>
                            </li>
                            <?php } ?>
                            <?php if($sbID != 'FM'){?> 
                            <li class="nav-item">
                               <a href="<?= base_url('InvoicingFinalReport/viewDraftFRNewFailed'); ?>" class="nav-link">
                                    <i class="fas fa-industry"></i>
                                    <p>Final Report Failed</p>
                               </a>
                            </li>
                            <?php } ?>
                            
                        </ul>
                    </li>
           
                   
                

                <?php if($sbID == 'MDM1'){?>
                        <li class="nav-item ml-2">
                        <a href="<?= base_url('InvoicingDraft') ?>" class="nav-link">
                            <i class="fas fa-industry"></i>
                            <p>Draft Invoice<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            
                            <li class="nav-item">
                                <a href="<?= base_url('InvoicingDraft/viewfailedDraftInv'); ?>" class="nav-link">
                                    <i class="fas fa-industry"></i>
                                    <p>Draft Invoice Failed</p>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                    <?php } ?>

                    <?php if($sbID != 'SM1' && $sbID != 'SM2'){?>
                 
                            <li class="nav-item ml-2">
                                <a href="<?= base_url('InvoicingDraft/viewNewApprov') ?>" class="nav-link">
                                    <i class="fas fa-industry"></i>
                                    <p>New Approval</p>
                                </a>
                            </li>
                    
                    <?php } ?>
                    <li class="nav-item ml-2">
                        <a href="<?= base_url('Invoicing/viewDataInvoicing') ?>" class="nav-link">
                            <i class="fas fa-industry"></i>
                            <p>Data Invoice</p>
                        </a>
                    </li>
                   
                    <?php } ?>


                    <?php if($sbID == 'FM'){?>
                        <li class="nav-header">INVOICE MARINE</li>
                        <li class="nav-item ml-2">
                            <a href="<?= base_url('InvoicingDraft') ?>" class="nav-link">
                                <i class="fas fa-industry"></i>
                                <p>Draft Invoice<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('InvoicingDraft/viewNewDraftInv'); ?>" class="nav-link">
                                        <i class="fas fa-industry"></i>
                                        <p>New Draft Invoice</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('Invoicing/viewDataInvoicingMarineFM') ?>" class="nav-link">
                                        <i class="fas fa-industry"></i>
                                        <p>Data Invoice</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        

                        <li class="nav-header">INVOICE MINERBA</li>

                        <li class="nav-item ml-2">
                            <a href="<?= base_url('InvoicingFinalReport') ?>" class="nav-link">
                                <i class="fas fa-industry"></i>
                                <p>Final Report<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('InvoicingFinalReport/viewNewFR'); ?>" class="nav-link">
                                        <i class="fas fa-industry"></i>
                                        <p>New Final Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('Invoicing/viewDataInvoicing') ?>" class="nav-link">
                                        <i class="fas fa-industry"></i>
                                        <p>Data Invoice</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    
                  
                    <?php } ?>

                     <!-- Link Akses Surveyor -->
                 <!-- Link Akses Surveyor -->
                <!-- Invoice -->

                 <!-- Honorarium -->
                 <?php if($sbID == 'FM' || $sbID == 'HR'){?>
                    <li class="nav-header">HONORARIUM</li>

                        <li class="nav-item ml-2">
                            <a href="<?= base_url('IntHonorarium') ?>" class="nav-link">
                                <i class="fas fa-industry"></i>
                                <p>Budget Honor<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                            <?php if($sbID == 'HR'){?>
                                
                                <li class="nav-item">
                                    <a href="<?= base_url('IntHonorarium/viewFailedBudgetHonor'); ?>" class="nav-link">
                                        <i class="fas fa-industry"></i>
                                        <p>Failed Budget Honor</p>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if($sbID == 'FM'){?>
                                <li class="nav-item">
                                    <a href="<?= base_url('IntHonorarium/viewNewBudgetHonor'); ?>" class="nav-link">
                                        <i class="fas fa-industry"></i>
                                        <p>New Budget Honor</p>
                                    </a>
                                </li>
                            <?php } ?>
                                <li class="nav-item">
                                    <a href="<?= base_url('IntHonorarium/viewDataBudgetHonor') ?>" class="nav-link">
                                        <i class="fas fa-industry"></i>
                                        <p>Data Budget Honor</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?= base_url('IntHonorarium/viewNewApproval'); ?>" class="nav-link">
                                        <i class="fas fa-industry"></i>
                                        <p>Approval Pengeluaran</p>
                                    </a>
                                </li>
                            </ul>

                        </li>

                        <!-- Inventaris -->
                        <li class="nav-item ml-2">
                            <a href="<?= base_url('IntHonorarium') ?>" class="nav-link">
                                <i class="fas fa-industry"></i>
                                <p>Inventaris<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                            <?php if($sbID == 'HR'){?>
                                
                                <li class="nav-item">
                                    <a href="<?= base_url('IntHonorarium/viewFailedInventaris'); ?>" class="nav-link">
                                        <i class="fas fa-industry"></i>
                                        <p>Failed Inventaris</p>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if($sbID == 'FM'){?>
                                <li class="nav-item">
                                    <a href="<?= base_url('IntHonorarium/viewNewInventaris'); ?>" class="nav-link">
                                        <i class="fas fa-industry"></i>
                                        <p>New Inventaris</p>
                                    </a>
                                </li>
                            <?php } ?>
                                <li class="nav-item">
                                    <a href="<?= base_url('IntHonorarium/viewDataBudgetHonor') ?>" class="nav-link">
                                        <i class="fas fa-industry"></i>
                                        <p>Data Inventaris</p>
                                    </a>
                                </li>

                                
                            </ul>

                        </li>


                 <?php } ?>
                 <!-- Honorarium -->


                 <?php if($sbID == 'AM1' || $sbID == 'AM2' || $sbID == 'FM'|| $sbID == 'HR' || $sbID == 'GA'){?>
                    <li class="nav-header">PENGADAAN</li>

                    <?php if($sbID == 'AM1' || $sbID == 'AM2' || $sbID == 'HR'){?>
                        <li class="nav-item ml-2">
                            <a href="<?= base_url('IntPengadaanBarang') ?>" class="nav-link">
                                <i class="fas fa-industry"></i>
                                <p>Draft Pengadaan<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                           
                            <?php if($sbID == 'AM1' || $sbID == 'AM2' ){?>
                                <li class="nav-item">
                                    <a href="<?= base_url('IntPengadaanBarang/viewFailedPettyCash'); ?>" class="nav-link">
                                        <i class="fas fa-industry"></i>
                                        <p>Failed Budget Honor</p>
                                    </a>
                                </li>
                            <?php } ?>

                            <?php if($sbID == 'HR'){?>
                                <li class="nav-item">
                                    <a href="<?= base_url('IntPengadaanBarang/viewNewPettyCash'); ?>" class="nav-link">
                                        <i class="fas fa-industry"></i>
                                        <p>New Patty Cash</p>
                                    </a>
                                </li>
                            <?php } ?>

                            <li class="nav-item">
                                <a href="<?= base_url('IntPengadaanBarang/viewDataPettyCash'); ?>" class="nav-link">
                                    <i class="fas fa-industry"></i>
                                    <p>Data Patty Cash</p>
                                </a>
                            </li>
                            
                               
                            </ul>

                        </li>
                        <?php } ?>

                        <?php if($sbID == 'GA' || $sbID == 'HR'){?>
                        <li class="nav-item ml-2">
                            <a href="<?= base_url('IntPengadaanBarang') ?>" class="nav-link">
                                <i class="fas fa-industry"></i>
                                <p>List Belanja<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                            <?php if($sbID == 'GA'){?>
                            <li class="nav-item">
                                <a href="<?= base_url('IntPengadaanBarang/viewNewListBelanja'); ?>" class="nav-link">
                                    <i class="fas fa-industry"></i>
                                    <p>New List Belanja</p>
                                </a>
                            </li>
                            <?php } ?>
                            
                            <li class="nav-item">
                                <a href="<?= base_url('IntPengadaanBarang/viewDataListBelanja'); ?>" class="nav-link">
                                    <i class="fas fa-industry"></i>
                                    <p>Data List Belanja</p>
                                </a>
                            </li>
                               
                            </ul>

                        </li>
                        <?php } ?>

                        <?php if($sbID == 'GA' || $sbID == 'HR' || $sbID == 'FM'){?>
                        <li class="nav-item ml-2">
                            <a href="<?= base_url('IntPengadaanBarang') ?>" class="nav-link">
                                <i class="fas fa-industry"></i>
                                <p>Breakdown List Belanja<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                            <?php if($sbID == 'HR' || $sbID == 'FM'){?>
                            <li class="nav-item">
                                <a href="<?= base_url('IntPengadaanBarang/viewNewBreakdown'); ?>" class="nav-link">
                                    <i class="fas fa-industry"></i>
                                    <p>New Breakdown</p>
                                </a>
                            </li>
                            <?php } ?>

                            <?php if($sbID == 'GA' || $sbID == 'HR'){?>
                            <li class="nav-item">
                                <a href="<?= base_url('IntPengadaanBarang/viewFailedBreakdown'); ?>" class="nav-link">
                                    <i class="fas fa-industry"></i>
                                    <p>Failed Breakdown</p>
                                </a>
                            </li>
                            <?php } ?>
                            
                            <li class="nav-item">
                                <a href="<?= base_url('IntPengadaanBarang/viewDataBreakdown'); ?>" class="nav-link">
                                    <i class="fas fa-industry"></i>
                                    <p>Data List Belanja</p>
                                </a>
                            </li>
                               
                            </ul>

                        </li>
                        <?php } ?>

                        <?php if($sbID == 'HR' || $sbID == 'FM'){?>
                        <li class="nav-item ml-2">
                            <a href="<?= base_url('IntPengadaanBarang') ?>" class="nav-link">
                                <i class="fas fa-industry"></i>
                                <p>Pencairan Budget<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                            <?php if($sbID == 'HR'){?>
                            <li class="nav-item">
                                <a href="<?= base_url('IntPengadaanBarang/viewNewPencairanBudget'); ?>" class="nav-link">
                                    <i class="fas fa-industry"></i>
                                    <p>New Pencairan Budget</p>
                                </a>
                            </li>
                            <?php } ?>

                            <li class="nav-item">
                                <a href="<?= base_url('IntPengadaanBarang/viewDataPencairanBudget'); ?>" class="nav-link">
                                    <i class="fas fa-industry"></i>
                                    <p>Data Pencairan Budget</p>
                                </a>
                            </li>
                               
                            </ul>

                        </li>
                        <?php } ?>

                        <!-- Nota Dinas -->
                        <?php if($sbID == 'HR' || $sbID == 'GA'){?>
                        <li class="nav-item ml-2">
                            <a href="<?= base_url('IntPengadaanBarang') ?>" class="nav-link">
                                <i class="fas fa-industry"></i>
                                <p>Nota Dinas<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                            <?php if($sbID == 'GA'){?>
                            <li class="nav-item">
                                <a href="<?= base_url('IntPengadaanBarang/viewNewNotaDinas'); ?>" class="nav-link">
                                    <i class="fas fa-industry"></i>
                                    <p>New Nota Dinas</p>
                                </a>
                            </li>
                            <?php } ?>

                            <li class="nav-item">
                                <a href="<?= base_url('IntPengadaanBarang/viewDataNotaDinas'); ?>" class="nav-link">
                                    <i class="fas fa-industry"></i>
                                    <p>Data Nota Dinas</p>
                                </a>
                            </li>
                               
                            </ul>

                        </li>
                        <?php } ?>
                        <!-- Nota Dinas -->


                        <!-- Laporan Belanja -->
                        <?php if($sbID == 'GA' || $sbID == 'HR' || $sbID == 'FM'){?>
                        <li class="nav-item ml-2">
                            <a href="<?= base_url('IntPengadaanBarang') ?>" class="nav-link">
                                <i class="fas fa-industry"></i>
                                <p>Laporan Belanja<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                            <?php if($sbID == 'HR' || $sbID == 'FM'){?>
                            <li class="nav-item">
                                <a href="<?= base_url('IntPengadaanBarang/viewNewLaporanBelanja'); ?>" class="nav-link">
                                    <i class="fas fa-industry"></i>
                                    <p>New Laporan Belanja</p>
                                </a>
                            </li>
                            <?php } ?>

                            <?php if($sbID == 'GA' || $sbID == 'HR'){?>
                            <li class="nav-item">
                                <a href="<?= base_url('IntPengadaanBarang/viewFailedLaporanBelanja'); ?>" class="nav-link">
                                    <i class="fas fa-industry"></i>
                                    <p>Failed Laporan Belanja</p>
                                </a>
                            </li>
                            <?php } ?>
                            
                            <li class="nav-item">
                                <a href="<?= base_url('IntPengadaanBarang/viewDataLaporanBelanja'); ?>" class="nav-link">
                                    <i class="fas fa-industry"></i>
                                    <p>Data Laporan Belanja</p>
                                </a>
                            </li>
                               
                            </ul>

                        </li>
                        <?php } ?>

                        <!-- Approval -->
                        
                        <li class="nav-item ml-2">
                            <a href="<?= base_url('IntPengadaanBarang/viewDataPengadaanApprov') ?>" class="nav-link">
                                <i class="fas fa-industry"></i>
                                <p>Approval Pengadaan</p>
                            </a>
                        </li>
                 <?php } ?>




                 <!-- Administrasi Umum -->
                 <?php if($sbID == 'FM' || $sbID == 'HR'){?>
                    <li class="nav-header">ADMINISTRASI UMUM</li>

                        <li class="nav-item ml-2">
                            <a href="<?= base_url('IntAdministrasi') ?>" class="nav-link">
                                <i class="fas fa-industry"></i>
                                <p>Penomoran Surat<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                            <?php if($sbID == 'HR'){?>
                                
                                <li class="nav-item">
                                    <a href="<?= base_url('IntAdministrasi/viewDataSuratMasuk'); ?>" class="nav-link">
                                        <i class="fas fa-industry"></i>
                                        <p>DataSuratMasuk</p>
                                    </a>
                                </li>
                            <?php } ?>
                            
                                

                                
                            </ul>

                        </li>

                      

                 <?php } ?>
                 <!-- Administrasi Umum  -->

                 
             
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
      <!-- /.sidebar -->
</aside>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("petugas/_partials/head.php") ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php $this->load->view("petugas/_partials/navbar.php")?>
        <!-- Content Wrapper. Contains page content -->
        <?php $this->load->view("petugas/_partials/sidebar.php")?>

        <div class="content-wrapper">
        <?php $this->load->view("petugas/_partials/breadcrumb.php")?>


            <section class="content">
                <div class="container-fluid" style="max-width: 100%;">
                    <!-- Small boxes (Stat box) -->
                    <div class="card">
                        <!-- <div class="card-header bg-dark">
                            <div class="card-title ">
                            <span>Data Client New Order</span>
                            </div>
                        </div> -->
                       
                        <div class="card-body">
                        <div>
                            <a href="<?=base_url('rka/viewfailedRka')?>"><button class="btn btn-success mb-4"> <i class="fas fa-home"></i> Back</button></a>
                        </div>

                        
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="card">
                                            <div class="card-header bg-dark">
                                                <div class="card-title">
                                                    <span>Project</span>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th width="30%">ID PROJECT</th>
                                                                <td><?=$rowClientProject->projectID?></td>
                                                            </tr>
                                                            <tr>
                                                                <th width="30%">File PROJECT</th>
                                                                <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/clientFile/'.$rowBidang.'/'.$rowClientProject->projectFile;?>"> Download</a> <?=$rowClientProject->projectFile?>  </td>
                                                            </tr>
                                                        </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <div class="card">
                                            <div class="card-header bg-dark">
                                                <div class="card-title">
                                                    <span>Project Approval</span>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th width="30%">ID Project Approval</th>
                                                            <?php if($rowClientProject->projectbidangID == 1){?>
                                                                <td><?=$rowFinalClientProject->invMarFinalID?></td>
                                                            <?php }else if($rowClientProject->projectbidangID == 2){ ?>
                                                                <td><?=$rowFinalClientProject->invMinFinalID?></td>
                                                            <?php } ?>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%">File Project Approval</th>
                                                            <?php if($rowClientProject->projectbidangID == 1){?>
                                                                <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/invoicing/'.$rowBidang.'/'.$rowFinalClientProject->invMarFile;?>"> Download</a> <?=$rowFinalClientProject->invMarFile?>  </td>
                                                            <?php }else if($rowClientProject->projectbidangID == 2){ ?>
                                                                <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/invoicing/'.$rowBidang.'/'.$rowFinalClientProject->invMinFile;?>"> Download</a> <?=$rowFinalClientProject->invMinFile?>  </td>
                                                            <?php } ?>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <div class="card">
                                            <div class="card-header bg-dark">
                                                <div class="card-title">
                                                    <span>Client</span>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th width="30%">ID Client</th>
                                                            <td><?=$rowClientProject->clientID?></td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%">Nama Client</th>
                                                            <td><?=$rowClientProject->clientNama?></td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%">Perusahaan Client</th>
                                                            <td><?=$rowClientProject->clientPerusahaan_nama?></td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%">Telepon Client</th>
                                                            <td><?=$rowClientProject->clientTelepon?></td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%">Email Client</th>
                                                            <td><?=$rowClientProject->clientEmail?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <div class="card">
                                            <div class="card-header bg-dark">
                                                <div class="card-title">
                                                    <span>Workflow</span>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th width="30%">ID Workflow</th>
                                                            <td><?=$rowFinalClientProject->quoD_quoID?></td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%">File Workflow</th>
                                                            <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/quotation/'.$rowBidang.'/'.$rowFinalClientProject->quoDFile;?>"> Download</a><?=$rowFinalClientProject->quoDFile?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <div class="card">
                                            <div class="card-header bg-dark">
                                                <div class="card-title">
                                                    <span>JOBDESC</span>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th width="30%">ID JOBDESC</th>
                                                            <td><?=$rowFinalClientProject->jobdaD_jobdApprovID?></td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%">File JOBDESC</th>
                                                            <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/approval_jobd/'.$rowBidang.'/'.$rowFinalClientProject->jobdaDFile;?>">Download</a>  <?=$rowFinalClientProject->jobdaDFile?>  </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <div class="card">
                                            <div class="card-header bg-dark">
                                                <div class="card-title">
                                                    <span>SPK</span>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th width="30%">ID SPK</th>
                                                            <td><?=$rowFinalClientProject->spkNo?></td>
                                                        </tr>
                                                        <tr>
                                                            <th width="30%">File SPK</th>
                                                            <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/spk/'.$rowBidang.'/fileSpk/'.$rowFinalClientProject->fileSpk;?>">Download</a> <?=$rowFinalClientProject->fileSpk?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>File Biaya Survey</th>
                                                            <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/spk/'.$rowBidang.'/filebiayasurvey/'.$rowFinalClientProject->fileBiayaSurvey;?>">Download</a> <?=$rowFinalClientProject->fileBiayaSurvey?></td> 
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <div class="card">
                                            <div class="card-header bg-dark">
                                                <div class="card-title">
                                                    <span>FINAL REPORT</span>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th width="30%">ID FINAL REPORT</th>
                                                            <?php if($rowClientProject->projectbidangID == 1){?>
                                                                <td><?=$rowFinalClientProject->frMarD_frID?></td>
                                                            <?php }else if($rowClientProject->projectbidangID == 2){ ?>
                                                                <td><?=$rowFinalClientProject->frMinD_frID?></td>
                                                            <?php } ?> 
                                                        </tr>
                                                        <?php if($rowClientProject->projectbidangID == 1){?>
                                                            <tr>
                                                                <th width="30%">File Draft Final Report Survey</th>
                                                                <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/finalreport/Marine/fr_Survey/'.$rowFinalClientProject->frSurveyFile;?>"> Download</a> <?=$rowFinalClientProject->frSurveyFile?></td>
                                                            </tr>
                                                            <tr>
                                                                <th width="30%">File Draft Final Report Internal</th>
                                                                <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/finalreport/Marine/fr_Internal/'.$rowFinalClientProject->frInternalFile;?>"> Download</a>  <?=$rowFinalClientProject->frInternalFile?></td>
                                                            </tr>
                                                        <?php }else if($rowClientProject->projectbidangID == 2){ ?>
                                                            <tr>
                                                                <th>File Final Report INTERNAL</th>
                                                                <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/finalreport/Minerba/fr_internal/'.$rowFinalClientProject->frInternalFile;?>"> Download</a> <?=$rowFinalClientProject->frInternalFile?> </td>
                                                            </tr>
                                                            <tr>
                                                                <th>File Final Report LHV</th>
                                                                <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/finalreport/Minerba/fr_lhv/'.$rowFinalClientProject->lhvFile;?>"> Download</a>  <?=$rowFinalClientProject->lhvFile?> </td>
                                                            </tr>

                                                            <tr>
                                                                <th>File Final Report DSR</th>
                                                                <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/finalreport/Minerba/fr_dsr/'.$rowFinalClientProject->dsrFile;?>"> Download</a>  <?=$rowFinalClientProject->dsrFile?> </td>
                                                            </tr>
                                                            <tr>
                                                                <th>File Final Report COA</th>
                                                                <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/finalreport/Minerba/fr_coa/'.$rowFinalClientProject->coaFile;?>"> Download</a>  <?=$rowFinalClientProject->coaFile?> </td>
                                                            </tr>

                                                            <tr>
                                                                <th>File Final Report COW</th>
                                                                <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/finalreport/Minerba/fr_cow/'.$rowFinalClientProject->cowFile;?>"> Download</a>  <?=$rowFinalClientProject->cowFile?> </td>
                                                            </tr>
                                                            <tr>
                                                                <th>File Final Report CDS</th>
                                                                <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/finalreport/Minerba/fr_cds/'.$rowFinalClientProject->cdsFile;?>"> Download</a>  <?=$rowFinalClientProject->cdsFile?> </td>
                                                            </tr>
                                                        <?php } ?> 
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <div class="card">
                                            <div class="card-header bg-dark">
                                                <div class="card-title">
                                                    <span>Approval Invoicing</span>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th width="30%">ID Approval Invoicing</th>
                                                            <?php if($rowClientProject->projectbidangID == 1){?>
                                                                <td><?=$rowFinalClientProject->invMarD_invID?></td>
                                                            <?php }else if($rowClientProject->projectbidangID == 2){ ?>
                                                                <td><?=$rowFinalClientProject->invMinD_invID?></td>
                                                            <?php } ?> 
                                                        </tr>
                                                        <tr>
                                                            <th width="30%">File Approval Invoicing</th>
                                                            <?php if($rowClientProject->projectbidangID == 1){?>
                                                                <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/invoicing/'.$rowBidang.'/'.$rowFinalClientProject->invMarFile;?>"> Download</a> <?=$rowFinalClientProject->invMarFile?>  </td>
                                                            <?php }else if($rowClientProject->projectbidangID == 2){ ?>
                                                                <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/invoicing/'.$rowBidang.'/'.$rowFinalClientProject->invMinFile;?>"> Download</a> <?=$rowFinalClientProject->invMinFile?>  </td>
                                                            <?php } ?> 
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    



                                </div>
                            
                        </div>                          
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>

        </div>


        

     

        <!-- /.content-wrapper -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        <!-- Main Footer -->
        <?php $this->load->view("petugas/_partials/footer.php") ?>
    
    </div>
<!-- ./wrapper -->

<!-- Javascript -->
<?php $this->load->view("petugas/_partials/js.php") ?>

<script>



</script>





</body>

</html>
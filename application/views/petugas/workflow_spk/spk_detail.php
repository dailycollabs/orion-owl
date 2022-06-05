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
                        <div class="card-header">
                            <div class="card-title">
                               <span>Data SPK</span>
                            </div>
                        </div>
                        <div class="card-body">
                        <a href="<?=base_url('order/neworder')?>"><button class="btn btn-success mb-4"> <i class="fas fa-home"></i> Back</button></a>
                            <div class="row"> 
                                <div class="col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-dark">
                                            <div class="card-title">
                                                <span>Data SPK</span>
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <th>No SPK</th>
                                                        <td><?=$row->spkNo?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>ID Job Desc</th>
                                                        <td><?=$row->jobdaD_jobdApprovID?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>ID Order</th>
                                                        <td> <?=$rowJobd->jobdA_orderID?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>File SPK</th>
                                                        <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/spk/'.$rowBidang.'/fileSpk/'.$row->fileSpk;?>">Download</a> <?=$row->fileSpk?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>File Biaya Survey</th>
                                                        <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/spk/'.$rowBidang.'/filebiayasurvey/'.$row->fileBiayaSurvey;?>">Download</a> <?=$row->fileBiayaSurvey?></td> 
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







</body>

</html>
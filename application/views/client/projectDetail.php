<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("client/_partials/head.php") ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php $this->load->view("client/_partials/navbar.php")?>
        <!-- Content Wrapper. Contains page content -->
        <?php $this->load->view("client/_partials/sidebar.php")?>

        <div class="content-wrapper">
        <?php $this->load->view("client/_partials/breadcrumb.php")?>


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
                                                    <span>Data Project</span>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th width="30%">ID Project</th>
                                                                <td><?=$row->projectID?></td>
                                                            </tr>
                                                            <tr>
                                                                <th width="30%">Bidang Project</th>
                                                                <td><?=$rowBidang?></td>
                                                            </tr>
                                                            <tr>
                                                                <th width="30%">Status Project</th>
                                                                <td><?=$rowStatus?></td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <th width="30%">File Project</th>
                                                                <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/clientFile/'.$rowBidang.'/'.$row->projectFile;?>"> Download</a> <?=$row->projectFile?>  </td>
                                                            </tr>
                                                            <tr>
                                                                <th width="30%">Komentar</th>
                                                                <td><?=$row->komentar?></td>
                                                            </tr>
                                                        </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if($rowFinalClientProject != null){?>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="card">
                                            <div class="card-header bg-dark">
                                                <div class="card-title">
                                                    <span>Project Success</span>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th width="30%">ID Project Approval</th>
                                                            
                                                            <?php if($row->projectbidangID == 1){?>
                                                                <td><?=$rowFinalClientProject->invMarFinalID?></td>
                                                            <?php }else if($row->projectbidangID == 2){ ?>
                                                                <td><?=$rowFinalClientProject->invMinFinalID?></td>
                                                            <?php } ?>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <th width="30%">File Project Approval</th>
                                                            <?php if($row->projectbidangID  == 1){?>
                                                                <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/invoicing/'.$rowBidang.'/'.$rowFinalClientProject->invMarFile;?>"> Download</a> <?=$rowFinalClientProject->invMarFile?>  </td>
                                                            <?php }else if($row->projectbidangID  == 2){ ?>
                                                                <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/invoicing/'.$rowBidang.'/'.$rowFinalClientProject->invMinFile;?>"> Download</a> <?=$rowFinalClientProject->invMinFile?>  </td>
                                                            <?php } ?>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <?php } ?>
                                    

                                </div>
                            
                        </div>                          
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>

        </div>


        

     



        <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        <!-- Main Footer -->
        <?php $this->load->view("client/_partials/footer.php") ?>
    
    </div>
<!-- ./wrapper -->

<!-- Javascript -->
<?php $this->load->view("client/_partials/js.php") ?>

<script>



</script>





</body>

</html>
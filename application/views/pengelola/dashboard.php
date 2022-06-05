<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("pengelola/_partials/head.php") ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php $this->load->view("pengelola/_partials/navbar.php")?>
        <!-- Content Wrapper. Contains page content -->
        <?php $this->load->view("pengelola/_partials/sidebar.php")?>

        <div class="content-wrapper">
        <?php $this->load->view("pengelola/_partials/breadcrumb.php")?>

            <!-- content -->
            <section class="content">  
                <div class="card"> <!-- card -->
                    <div class="card-header">Data Order</div>
                    <div class="card-body"> <!-- /.card-body -->    
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-6">
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3>MINERBA</h3>
                                            <div class="row">
                                                <div class="col-4">
                                                    <p><h5><b>ORDER</b></h5></p>
                                                    <p><h5><b>PROSES ORDER</b></h5></p>
                                                </div>
                                                <div class="col-4">
                                                    <p><h5><b>200</b></h5></p>
                                                    <p><h5><b>2</b></h5></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-6">
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3>MARINE</h3>
                                            <div class="row">
                                                <div class="col-4">
                                                    <p><h5><b>ORDER</b></h5></p>
                                                    <p><h5><b>PROSES ORDER</b></h5></p>
                                                </div>
                                                <div class="col-4">
                                                    <p><h5><b>200</b></h5></p>
                                                    <p><h5><b>2</b></h5></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.card-body -->                            
                </div> <!-- /.card -->
            </section> 
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        <!-- Main Footer -->
        <?php $this->load->view("pengelola/_partials/footer.php") ?>
    
    </div>
<!-- ./wrapper -->

<!-- Javascript -->
<?php $this->load->view("pengelola/_partials/js.php") ?>
 
</body>

</html>
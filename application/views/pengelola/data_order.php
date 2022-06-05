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


            <section class="content">

                <div class="container-fluid pt-5 pb-5 bg-white">
                    <!-- Small boxes (Stat box) -->
                    <div class="container mt-4" style="max-width: 700px">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 mb-1 col-md-6 d-flex justify-content-center">
                                <a href="<?= base_url('superadmin/dataorder/minerbaOrderList') ?>">
                                    <button type="button" class="btn btn-primary btn-lg pt-3 pb-3 pl-4 pr-4">
                                        <h2 class="font-weight-bold">MINERBA</h2>
                                    </button>
                                </a>
                            </div>
                            <div class="col-xs-6 col-sm-6 mb-1 col-md-6 d-flex justify-content-center">
                                <a href="<?= base_url('superadmin/dataorder/marineOrderList'); ?>">
                                    <button type="button" class="btn btn-primary btn-lg pt-3 pb-3 pl-4 pr-4">
                                        <h2 class="font-weight-bold">MARINE</h2>
                                    </button>
                                </a>
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
        <?php $this->load->view("pengelola/_partials/footer.php") ?>
    
    </div>
<!-- ./wrapper -->

<!-- Javascript -->
<?php $this->load->view("pengelola/_partials/js.php") ?>
 
</body>

</html>
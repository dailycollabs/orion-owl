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
        <!-- Content -->
            <section class="content">
                <div class="container-fluid pt-5 pb-5 bg-white">
                    <!-- Small boxes (Stat box) -->
                    <div class="container mt-4" style="max-width: 700px">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 mb-1 col-md-6 d-flex justify-content-center">
                                <a href="<?= base_url('superadmin/prosesorder/prosesorder_minerba') ?>">
                                    <button type="button" class="btn btn-primary btn-lg pt-3 pb-3 pl-4 pr-4" style="max-width: 200px;">
                                        <h2 class="font-weight-bold">ORDER MINERBA</h2>
                                    </button>
                                </a>
                            </div>
                            <div class="col-xs-6 col-sm-6 mb-1 col-md-6 d-flex justify-content-center">
                                <a href="<?= base_url('superadmin/prosesorder/prosesorder_marine'); ?>">
                                    <button type="button" class="btn btn-primary btn-lg pt-3 pb-3 pl-4 pr-4" style="max-width: 200px;">
                                        <h2 class="font-weight-bold">ORDER MARINE</h2>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <!-- /.row (main row) -->
                    </div><!-- /.container-fluid -->
            </section>
             <!-- /.Content -->
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
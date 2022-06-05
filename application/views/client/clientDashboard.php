  
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

            <div class="card">
                <div class="card-body">
                    <h1>Applikasi Jasa Pengiriman</h1>
                </div>
            </div>


        

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


</body>
</html>
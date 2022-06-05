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
                <div class="container-fluid" style="max-width: 100%;">
                    <!-- Small boxes (Stat box) -->
                    <div class="card">
                       
                        <div class="card-body">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="marinelistTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5px">#</th>
                                                <th>ID Order</th>
                                                <th>Nama Bidang Order</th>
                                                <th>Nama Perusahaan</th>
                                                <th width="15%">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="bidangData"></tbody>

                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>   
                        </div>                          
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>

        </div>


        
        <!--END MODAL HAPUS-->

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



<script>

$(document).ready(function(){

    $('#marinelistTable').DataTable({
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]]
    });
     

});
</script>
</body>

</html>
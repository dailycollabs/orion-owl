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
                    <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info ">
                            <div class="card-header">
                            <h3 class="card-title">Files</h3>

                            </div>
                            <div class="card-body p-3 " style="display: block;">

                            <table class="table table-bordered">
                                <thead>
    
                                </thead>
                                <tbody>
                            
                                <tr>
                                    <td>Nama</td>
                                    <td>ID</td>
                                    <td>Status</td>
                                    <td>Keterangan</td>
                                </tr>
                                <tr>
                                    <td>Order</td>
                                    <td id="orderID"><?=$rowOrder->orderID?></td>
                                    <td><?=$rowOrder->status?></td>
                                    <td width="40%"><?=$rowOrder->Keterangan?></td>
                                </tr>
                                <tr>
                                    <td>Quotation</td>
                                    <td>QUO-003</td>
                                    <td>Success</td>
                                    <td>Berhasil DI Proses</td>
                                </tr>
                                <tr>
                                    <td>JOBDESC</td>
                                    <td>JOB-003</td>
                                    <td>SUCCESS</td>
                                    <td>Masih dalam Proses</td>
                                </tr>
                                <tr>
                                    <td>FINAL REPORT</td>
                                    <td>FR-003</td>
                                    <td>Prossess</td>
                                    <td>Masih dalam Proses</td>
                                </tr>
                                <tr>
                                    <td>Invoicing</td>
                                    <td>FR-003</td>
                                    <td>Prossess</td>
                                    <td>Masih dalam Proses</td>
                                </tr>
                                <tr>
                                    <td>Issuing Client</td>
                                    <td>FR-003</td>
                                    <td>Prossess</td>
                                    <td>Masih dalam Proses</td>
                                </tr>
                                
                               
                               
                                
                            </tbody>
                            </table>
                            
                            </div>
                            
                            </div>
                           
                            <!-- /.card-body -->
                        </div>

                       
                    <!-- Small boxes (Stat box) -->
                    
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
$(document).ready(function(){

  

    


});

</script>





</body>

</html>
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
                                                <span>Data Client Order</span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                            <thead>
                                        
                                            </thead>
                                                <tbody>
                                               
                                                    <tr>
                                                    <th>RKA ID</th>
                                                        <td><?=$row->rkaID?></td>
                                                    </tr>
                                                    <tr>
                                                    <th width="13%">Nama Client</th>
                                                        <td><?=$row->clientNama?></td>
                                                    </tr>
                                                    <tr>
                                                    <th>Nama Perusahaan</th>
                                                    <td><?=$row->clientPerusahaan?></td>
                                                    
                                                    </tr>
                                                    <tr>
                                                    <th>Email</th>
                                                    <td><?=$row->clientEmail?></td>
                                                    
                                                    </tr>
                                                    <tr>
                                                    <th>No Telepon</th>
                                                    <td><?=$row->clientTelepon?></td>
                                                    
                                                    </tr>
                                                    <tr>
                                                    <th>File PDF</th>
                                                        <td><?=$row->orderFile?> <button class="ml-3 btn btn-primary btn-sm">Download File</button></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                    <th>Comment</th>
                                                    <td><?=$row->orderComentar?></td>
                                                        
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
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
                        <div class="card-header bg-dark">
                            <div class="card-title ">
                            <span>KONFIRMASI PENCAIRAN BUDGET</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                        
                                            <tr>
                                                <th>Bidang</th>
                                                <td><?=$rowBidang?></td>
                                            </tr>
                                            <tr>
                                                <th>ID Pencairan Budget</th>
                                                <td><?=$row->pencairanbudgetID?></td>
                                            </tr>
                                            <tr>
                                                <th>NO Pengeluaran</th>
                                                <td><?=$row->pbPengeluaranNo?></td>
                                            </tr>
                                            <tr>
                                                <th>ID Breakdown</th>
                                                <td><?=$row->bdlD_breakdownlistID?></td>
                                            </tr>
                                            <tr>
                                                <th>File Pencairan Budget</th>
                                                <td><a class="btn btn-primary" href="<?php echo base_url().'./uploads/pengadaan/'.$rowBidang.'/pencairanBudget/'.$row->pbFile;?>"> Download</a> <?=$row->pbFile?></td>
                                            </tr>
                                            <tr>
                                                <th>Pengirim</th>
                                                <td><?=$row->pb_pengirimID?></td>
                                            </tr>
                                            <tr>
                                                <th>Comment</th>
                                                <td><?=$row->pbComment?></td>
                                            </tr>
                                            <?php if($petugasLogin == $row->pb_penerimaID){?>
                                            <?php if($row->status != 'reject' || $row->status != 'success'){?>
                                            <tr>
                                                <th>Action</th>
                                                <td> 
                                                    <div class="justify-content-center"> 
                                                        <a href="<?=site_url('IntPengadaanBarang/viewAddNotaDinas/').$row->pencairanbudgetID?>"><button class="btn btn-success" id="quo-success">Create Nota Dinas</button></a>
                                                    </div>
                                                </td>
                                            </tr>  
                                            <?php } ?>
                                            <?php } ?> 
                                        </tbody>
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
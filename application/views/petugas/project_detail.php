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
                            <span>Project Detail</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                                
                       
                                <!-- /.box-header -->
                               

                                    <table class="table table-bordered">
                                        <tbody>
                                        <input type="hidden" name="quoDetailID" class="form-control" id="quoDetailID"  value=""><!-- Membuat Waktu Pengerjaan -->   

                                            <tr>
                                                <th>ID Project</th>
                                                <td><?=$row->projectID?></td>
                                            </tr>
                                            <tr>
                                                <th>Project Nama</th>
                                                <td><?=$row->bidangNama?></td>
                                            </tr>
                                            <tr>
                                                <th>Nama Client</th>
                                                <td><?=$row->clientNama?></td>
                                            </tr>
                                            <tr>
                                                <th>Nama Perusahaan</th>
                                                <td><?=$row->clientPerusahaan_nama?></td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td><?=$row->clientEmail?></td>
                                            </tr>
                                            <tr>
                                                <th>Komentar</th>
                                                <td width="70%"><?=$row->komentar?></td>
                                            </tr>
                                            <tr>
                                                <th>Waktu</th>
                                                <td id="waktuTimeout"><?=$row->waktu?></td>
                                            </tr>
                                            <?php if($rowOrder == null || $rowOrder->status == 'reject'){?>
                                            <tr>
                                                <th>Action</th>
                                                <td> 
                                                    <div class="justify-content-center" id="action"> 
                                                        <input type="hidden" name="projectID" id="projectID" value="<?=$row->projectID?>">
                                                        <button class="btn btn-primary mr-3" id="add-order">Create Order</button> 
                                                    </div>
                                                </td>
                                            </tr>  
                                            <?php } ?>
                                        </tbody>
                                    </table>

                               
                                <!-- /.box-body -->
                           
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
$(document).ready(function(){
    
    $('#add-order').on('click', function(){
        var projectID = $('#projectID').val();
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('WorkflowOrder/addOrder')?>",
            dataType : "JSON",
            data : {projectID:projectID},
            success: function(data){
                console.log(data);
                if(data.status == 'success'){
                    Swal.fire({
                        icon: 'success',
                        title: 'Proses Order!',
                        text: 'You clicked the button!',
                    }).then(function() {
                        window.location.assign("<?php echo base_url();?>WorkflowQuotation/viewAddQuoID/"+data.orderID);
                    }); 
                }     
            }
        });
        return false;
    });

    

});

</script>





</body>

</html>
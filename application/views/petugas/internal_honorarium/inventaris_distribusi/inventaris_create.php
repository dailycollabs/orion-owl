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

        <?php $this->view('messages')?>
            <section class="content">
                <div class="container-fluid" style="max-width: 100%;">
                    <!-- Small boxes (Stat box) -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                               <span>CREATE INVENTARIS DISTRIBUSI</span>
                            </div>
                        </div>
                        <div class="card-body">
                        <a href="<?=base_url('order/neworder')?>"><button class="btn btn-success mb-4"> <i class="fas fa-home"></i> Back</button></a>
                            <div class="row">
                                
                                <div class="col-md-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-dark">
                                            <div class="card-title">
                                                <span>Data Approval</span>
                                              
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <table class="table table-bordered">
                                            <thead>
                                        
                                            </thead>
                                                <tbody>  
                                                    <tr>
                                                        <th>ID Pengeluaran</th>
                                                        <td><?=$row->pengeluaranID?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>ID Budget Honor</th>
                                                        <td><?=$row->budgethonorNo?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-dark">
                                            <div class="card-title">
                                                <span>Create Inventaris Distribus Honor</span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form action="" id="formAdd">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">ID Pengeluaran</label>
                                                    <input type="hidden" name="approvalID" class="form-control orderID" id="approvalID" value="<?=$row->approvDetailID?>" readonly>
                                                    <input type="text" name="pengeluaranID" class="form-control pengeluaranID" id="pengeluaranID" value="<?=$row->pengeluaranID?>" readonly>
                                                    <span class="orderID_error text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">NO budgethonor</label>
                                                    <input type="hidden" name="budgethonorID" class="form-control budgethonorID" id="budgethonorID" value="<?=$row->approv_budgethonorID?>" >
                                                    <input type="text" name="budgethonorNo" class="form-control budgethonorNo" id="budgethonorNo" value="<?=$row->budgethonorNo?>" readonly>
                                                    <span class="quoID_error text-danger"></span>
                                                </div>
                                                
                                                <button type="submit" id="add" name="add" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-secondary">Reset</button>
                                            </form>
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
$(document).ready(function(){

    $('#add').on('click', function(){
        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('IntHonorarium/addInventarisID')?>",
            dataType : "JSON",
            data : $('#formAdd').serialize(),
            success: function(response){
                console.log(response);
                if(response.status == 'success'){
                    console.log("sukses");
                    $('.quoID').html("");
                    $('.orderID').html("");
                    Swal.fire({
                        icon: 'success',
                        title: 'ID Quotation Berhasil Di Buat!',
                        text: 'You clicked the button!',
                    
                    }).then(function() {
                        window.location.assign("<?php echo base_url();?>IntHonorarium/viewUploadInventaris/"+response.id);
                    });
                   
                }else{
                    $('.quoID_error').html(response.quoID);
                    $('.orderID_error').html(response.orderID);
                }   
            }
        });
        return false;
    });
});



</script>





</body>

</html>
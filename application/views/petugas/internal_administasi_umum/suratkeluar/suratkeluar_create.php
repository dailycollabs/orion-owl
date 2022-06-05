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
                               <span>Create Rencana Kerja dan Anggaran (quotation) </span>
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
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                            <thead>
                                        
                                            </thead>
                                                <tbody>
                                                    
                                                    <tr>
                                                    <th>ID Pengeluaran</th>
                                                    <td></td>
                                                    
                                                    </tr>
                                                    <tr>
                                                    <th>File PDF</th>
                                                        <td> <button class="ml-3 btn btn-primary btn-sm">Download File</button></td>
                                                        
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
                                                    <label for="exampleInputEmail1">Surat Masuk ID</label>
                                                    <input type="text" name="smID" class="form-control orderID" id="smID" value="<?=$row->smID?>" readonly>
                                                    <span class="orderID_error text-danger"></span>
                                                </div>
                                               
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Surat Keluar ID</label>
                                                    <input type="text" name="suratkeluarNo" class="form-control suratkeluarNo" id="suratkeluarNo" value="" >
                                                    <span class="quoID_error text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">File Surat Keluar</label>
                                                    <input type="file" name="skFile" class="form-control suratkeluarNo" id="skFile" value="" >
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

      
        var myformData = new FormData(); 
        myformData.append('smID', $("#smID").val());
        myformData.append('suratkeluarNo', $("#suratkeluarNo").val());
        myformData.append('skFile', $('#skFile')[0].files[0]);
      

      
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('IntAdministrasi/addSuratKeluar')?>",
            dataType : "JSON",
            data : myformData,
            contentType: false,
            processData: false,
            cache: false,
            enctype: 'multipart/form-data',
            success: function(response){
                console.log(response);
                if(response.status == 'success'){
                    console.log("sukses");
                    $('.quoID').html("");
                    $('.orderID').html("");
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Di Tambahkan!',
                        text: 'You clicked the button!',
                    
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
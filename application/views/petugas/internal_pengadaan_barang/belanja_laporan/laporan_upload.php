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
                        
                        <div class="card-body">
                        <a href="<?=base_url('order/neworder')?>"><button class="btn btn-success mb-4"> <i class="fas fa-home"></i> Back</button></a>
                            <div class="row">
                                
                               
                                <div class="col-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-dark">
                                            <div class="card-title">
                                                <span>Upload Laporan Belanja</span>
                                            </div>
                                        </div>
                                        
                                        <div class="card-body">
                                       
                                        <form action="" id="formAdd">
                                                <input type="hidden" name="send_up" id="send_up" value="send_up">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Bidang</label>
                                                    <input type="hidden" name="bidangID" id="bidangID" class="form-control"  value="<?=$row->laporanb_bidangID?>">
                                                    <input type="text" name="bidangNama" id="bidangNama" class="form-control"  value="<?=$bidangNama?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">ID Laporan Belanja</label>
                                                    <input type="text" name="laporanbelanjaID" id="laporanbelanjaID" class="form-control"  value="<?=$row->laporanbelanjaID?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">File Breakdown</label>
                                                    <input type="file" name="lbFile" class="form-control lbFile" id="lbFile" required>
                                                    <span class="quoFile_error text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Comment</label>
                                                    <textarea name="lbComment" id="lbComment" class="form-control" cols="10" rows="5"></textarea>
                                               
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

    $('#add').on('click', function(e){
        $('.quoID_error').empty();  
        $('.quoFile_error').empty();
        e.preventDefault();

        var myformData = new FormData(); 
        myformData.append('send_up', $("#send_up").val());
        myformData.append('laporanbelanjaID', $("#laporanbelanjaID").val());
        myformData.append('bidangID', $("#bidangID").val());
        myformData.append('lbFile', $('#lbFile')[0].files[0]);
        myformData.append('lbComment', $("#lbComment").val());


        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('IntPengadaanBarang/uploadLaporanBelanja')?>",
            dataType : "JSON",
            data : myformData,
            contentType: false,
            processData: false,
            cache: false,
            enctype: 'multipart/form-data',
            
            success: function(response){
                console.log(response);
                if(response.status == 'success'){
                    Swal.fire({
                        icon: 'success',
                        title: 'File Berhasil Di Upload!',
                        text: 'You clicked the button!',
                    })
                    .then(function() {
                        window.location.assign("<?php echo base_url();?>IntPengadaanBarang/viewNewNotaDinas");
                    });
                   
                   
                } else if(response.status == 'error-upload'){
                    $('.quoFile_error').html(response.quoFile);
                }
                else{
                    console.log(response);
                    $('.quoID_error').html(response.quoID);
                    $('.quoFile_error').html(response.quoFile);
                    
                    
                }   
            }
        });

       
        return false;
    });


    
});



</script>


</body>

</html>
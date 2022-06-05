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
                                                <span>UPLOAD DRAFT PENGADAAN (PATTYCASH)</span>
                                            </div>
                                        </div>
                                        
                                        <div class="card-body">
                                        
                                            <form action="" id="formAdd"> 
                                                <input type="hidden" name="send_up" id="send_up" class="form-control" value="send_up">
                                                <input type="hidden" name="add_new" id="add_new" class="form-control" value="add_new">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Bidang</label>
                                                    <input type="hidden" name="bidangID" id="bidangID" class="form-control" value="<?=$this->fungsi->petugas_login()->bidangID?>">
                                                    <input type="text" name="bidangNama" id="bidangNama" class="form-control" value="<?=$rowBidang?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">File Draft Pattycash</label>
                                                    <input type="file" name="pattycashFile" class="form-control draftInvFile" id="pattycashFile">
                                                    <span class="pattycashFile_error text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Comment</label>
                                                    <textarea name="commentPatty" id="commentPatty" class="form-control" cols="10" rows="5"></textarea>
                                                </div>
                                                <button type="submit" id="btn-add" name="add" class="btn btn-primary">Submit</button>
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

    $('#btn-add').on('click', function(e){
        // $('.invID_error').empty();  
        // $('.draftInvFile_error').empty();
        e.preventDefault();

        var myformData = new FormData(); 
        
        myformData.append('send_up', $("#send_up").val());
        myformData.append('add_new', $("#add_new").val());
        myformData.append('bidangID', $("#bidangID").val());
        myformData.append('pattycashFile', $('#pattycashFile')[0].files[0]);
        myformData.append('commentPatty', $("#commentPatty").val());
      

      
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('IntPengadaanBarang/addPettyCash')?>",
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
                        title: 'FileBerhasil Di Upload!',
                        text: 'You clicked the button!',
                    }).then(function() {
                        window.location.assign("<?php echo base_url();?>IntPengadaanBarang/viewDataPettyCash");
                    }); 
                   
                } else if(response.status == 'error-upload'){
                    $('.draftInvFile_error').html(response.quoFile);
                }
                else{
                    console.log(response);
                   
                    
                }   
            }
        });

       
        return false;
    });
    
});


</script>
</body>
</html>
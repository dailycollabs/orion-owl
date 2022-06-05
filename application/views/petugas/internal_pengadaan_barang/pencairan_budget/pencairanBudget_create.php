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
                                                <span>Create Pencairan Budget</span>
                                            </div>
                                        </div>
                                        
                                        <div class="card-body">
                                            <form action="" id="formAdd">
                                                <input type="hidden" name="send_down" id="send_down" value="send_down">
                                                <input type="hidden" name="breakdowndetailID" id="breakdowndetailID" class="form-control"  value="<?=$row->bdlDetailID?>">
                                                <input type="hidden" name="listbelanjaID" id="listbelanjaID" class="form-control"  value="<?=$row->bdl_listbelanjaID?>">
                                                <input type="hidden" name="pattycashID" id="pattycashID" class="form-control"  value="<?=$row->bdl_pattycashID?>">
                                                
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Bidang</label>
                                                    <input type="hidden" name="bidangID" id="bidangID" class="form-control"  value="<?=$row->bdl_bidangID?>">
                                                    <input type="text" name="bidangNama" id="bidangNama" class="form-control"  value="<?=$rowBidang?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">ID Breakdown</label>
                                                    <input type="text" name="breakdowndetailNo" id="breakdowndetailNo" class="form-control"  value="<?=$row->bdlD_breakdownlistID?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">NO Pengeluaran</label>
                                                    <input type="text" name="pbPengeluaranNo" id="pbPengeluaranNo" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">File Pencairan Budget</label>
                                                    <input type="file" name="pbFile" class="form-control filePeriodic" id="pbFile" required>
                                                    <span class="draftInvFile_error text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Comment</label>
                                                    <textarea name="pbComment" id="pbComment" class="form-control" cols="10" rows="5"></textarea>
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
        $('.invID_error').empty();  
        $('.draftInvFile_error').empty();
        e.preventDefault();

        var myformData = new FormData(); 
        myformData.append('send_up', $("#send_up").val());
        myformData.append('breakdowndetailID', $("#breakdowndetailID").val());
        myformData.append('listbelanjaID', $("#listbelanjaID").val());
        myformData.append('pattycashID', $("#pattycashID").val());
        myformData.append('pbPengeluaranNo', $("#pbPengeluaranNo").val());
        myformData.append('bidangID', $("#bidangID").val());
        myformData.append('pbFile', $('#pbFile')[0].files[0]);
        myformData.append('pbComment', $("#pbComment").val());
        
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('IntPengadaanBarang/addPencairanBudget')?>",
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
                    })
                    .then(function() {
                        window.location.assign("<?php echo base_url();?>IntPengadaanBarang/viewNewBreakdown");
                    });
   
                } else if(response.status == 'error-upload'){
                    $('.draftInvFile_error').html(response.quoFile);
                }
                else{
                    console.log(response);
                    $('.invID_error').html(response.invID);
                    $('.draftInvFile_error').html(response.draftInvFile);
                    // .then(function() {
                    //     window.location.assign("<?php echo base_url();?>order/viewneworder");
                    // });
                    
                }   
            }
        });
   
        return false;
    });


    });

</script>

</body>
</html>
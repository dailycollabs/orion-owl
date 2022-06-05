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
                            <span>KONFIRMASI BREAKDOWN</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                <input type="hidden" name="bdlDetailID" class="form-control" id="bdlDetailID"  value="<?=$rowBreakdown->bdlDetailID?>" >
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Bidang</th>
                                                <td><?=$rowBidang?></td>
                                            </tr>
                                            <tr>
                                                <th>ID Breakdown</th>
                                                <td><?=$rowBreakdown->breakdownlistID?></td>
                                            </tr>
                                            <tr>
                                                <th>ID List Belanja</th>
                                                <td><?=$rowListBelanja->listbelanjaNo?></td>
                                            </tr>
                                            <tr>
                                                <th>ID Pattycash</th>
                                                <td><?=$rowPatty->pattycashNo?></td>
                                            </tr>
                                            <tr>
                                                <th>Pengirim</th>
                                                <td><?=$rowBreakdown->bdlD_pengirimID?></td>
                                            </tr>
                                            <tr>
                                                <th>Commetn</th>
                                                <td><?=$rowBreakdown->bdlComment?></td>
                                            </tr>
                                            <tr>
                                                <th>File List Breakdown</th>
                                                <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/pengadaan/'.$rowBidang.'/breakdownList/'.$rowBreakdown->bdlDFile;?>"> Download</a> <?=$rowBreakdown->bdlDFile?></td>
                                            </tr>

                                            <?php if($petugasLogin == $rowBreakdown->bdlD_penerimaID){?>
                                            <?php if($rowBreakdown->status != 'reject' || $rowBreakdown->status != 'success'){?>
                                            <tr>
                                                <th>Action</th>
                                                <td> 
                                                    <div class="justify-content-center"> 
                                                    <?php if($this->fungsi->petugas_login()->subbidangID == 'FM'){?>
                                                        <a href="<?=site_url('IntPengadaanBarang/viewAddPencairanBudget/').$rowBreakdown->bdlDetailID?>"><button class="btn btn-success mr-3" id="quo-success">Pencairan Budget</button></a>
                                                    <?php }else{ ?>
                                                        <button class="btn btn-success mr-3" id="quo-success">Breakdown Success</button>
                                                    <?php } ?>
                                                        <button class="btn btn-danger" id="quo-failed">Breakdown Revisi</button>
                                                    </div>
                                                </td>
                                            </tr> 
                                            <?php } ?>
                                            <?php } ?>  
                                        </tbody>
                                    </table>


                                        <!-- Quotation Success -->
                                    <div class="row justify-content-center mt-4">
                                        <div class="col-12">        
                                            <div class="card"style="display:none;" id="quoSukses">
                                                <div class="card-header bg-success">
                                                    <div class="card-title">
                                                        <span>Send Breakdown Success</span>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <form action="" id="formAdd">
                                                        <input type="hidden" name="send_up" id="send_up" value="send_up">
                                                        
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Bidang</label>
                                                            <input type="text" name="bidangID" class="form-control" value="<?=$rowBidang?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">ID Breakdown</label>
                                                            <input type="text" name="breakdownID" class="form-control" id="breakdownID" value="<?=$rowBreakdown->bdlD_breakdownlistID?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">File Breakdown</label>
                                                            <input type="text" name="breakdownFile_send" class="form-control" id="breakdownFile_send" value="<?=$rowBreakdown->bdlDFile?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Comment</label>
                                                            <textarea name="breakdownComment"  class="form-control" cols="30" rows="10"></textarea>
                                                        </div>
                                                        <button type="submit" name="success" id="success" class="btn btn-success">Kirim</button>
                                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                                
                                                    </form>
                                                </div>
                                            </div>
                                        </div>        
                                    </div>
                                    <!-- Quotation Success -->


                                    <!-- Quotation Revisi -->
                                    <div class="row justify-content-center">
                                        <div class="col-12">  
                                            <div class="card" style="display:none;" id="quoFailed">
                                                <div class="card-header bg-danger">
                                                    <div class="card-title">
                                                        <span>Send Breakdown Failed</span>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <form action="">
                                                        <input type="hidden" name="send_down" id="send_down" value="send_down">
                                                        <input type="hidden" name="failed" id="failed" value="failed">
                                                        
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">ID Breakdown</label>
                                                            <input type="text" name="breakdownID" class="form-control" id="breakdownID" value="<?=$rowBreakdown->bdlD_breakdownlistID?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">File List Breakdown</label>
                                                            <input type="file" name="breakdownFile" class="form-control" id="breakdownFile" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Comment</label>
                                                            <textarea name="breakdownComment" id="breakdownComment" class="form-control" cols="30" rows="10"></textarea>
                                                        </div> 
                                                            <button type="submit" name="kirim-failed" id="kirim-failed" class="btn btn-primary">Kirim</button>
                                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                                        </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Quotation Revisi -->

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

$(document).ready(function(){

    $('#quo-success').on('click', function(){
        $('#quoFailed').hide("slow");
        $('#quoSukses').show("slow");
    });

    $('#quo-failed').on('click', function(){
        $('#quoSukses').hide("slow");
        $('#quoFailed').show("slow");
        
    });


    $('#success').on('click', function(){
            // e.preventDefault();
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('IntPengadaanBarang/uploadBreakdown')?>",
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
                        title: 'File Berhasil Di Kirim!',
                        text: 'You clicked the button!',
                    
                    }).then(function() {
                        window.location.assign("<?php echo base_url();?>IntPengadaanBarang/viewNewBreakdown/");
                    });
                   
                }else{
                    $('.quoID_error').html(response.quoID);
                    $('.orderID_error').html(response.orderID);
                }        
            }
        });
        return false;
    });


    //Revisi
    $('#kirim-failed').on('click', function(e){
        e.preventDefault();
        var myformData = new FormData();        
        myformData.append('send_down',  $('#send_down').val());
        myformData.append('failed',  $('#failed').val());
        myformData.append('breakdownID',  $('#breakdownID').val());
        myformData.append('breakdownFile', $('#breakdownFile')[0].files[0]);
        myformData.append('breakdownComment',  $('#breakdownComment').val());

        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('IntPengadaanBarang/uploadBreakdown')?>",
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
                            title: 'File Berhasil Di Kirim!',
                            text: 'You clicked the button!',
                    }).then(function() {
                        window.location.assign("<?php echo base_url();?>IntPengadaanBarang/viewNewBreakdown/");
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
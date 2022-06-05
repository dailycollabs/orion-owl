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
                        <div class="card-header">
                            <div class="card-title">
                               <span>Data SPK</span>
                            </div>
                        </div>
                        <div class="card-body">
                        <a href="<?=base_url('order/neworder')?>"><button class="btn btn-success mb-4"> <i class="fas fa-home"></i> Back</button></a>
                            <div class="row">
                                
                                <div class="col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-dark">
                                            <div class="card-title">
                                                <span>Data SPK</span>
                                              
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                            <thead>
                                        
                                            </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>ID SPK</th>
                                                        <td id="spkID"><?=$row->spkID?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>ID Job Desc</th>
                                                        <td><?=$row->jobdaD_jobdApprovID?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>ID Order</th>
                                                        <td> <?=$rowJobd->jobdA_orderID?></td>
                                                    </tr>
                                                   
                                                    <tr>
                                                        <th>File SPK</th>
                                                        <td><?=$row->fileSpk?> <button class="ml-3 btn btn-primary btn-sm">Download File</button></td>
                                                    </tr>
                                                    <tr>
                                                        <th>File Biaya Survey</th>
                                                        <td><?=$row->fileBiayaSurvey?>  <button class="ml-3 btn btn-primary btn-sm">Download File</button></td> 
                                                    </tr>
                                                    <tr>
                                                    <th>Detail</th>
                                                        <td><a href="<?=base_url('order/orderclient/getDetailOrder/')?>"> <button class="btn btn-info">Detail</button></a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                             
                                
                            </div>

                            <div class="row">
                            
                            <?php if($rowFR == null){?>

                                <div class="col-md-12 col-sm-12" id="createFR">
                                                    <div class="card">
                                                                <div class="card-header bg-dark">
                                                                    <div class="card-title">
                                                                        <span>Create Draft Final Report Marine</span>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                        <form action="" id="formAdd">
                                                                                <div class="form-group">
                                                                                    <input type="hidden" name="spkID" value="<?=$row->spkID?>">
                                                                                    
                                                                                    <span class="spkID_error text-danger"></span>
                                                                                </div>
                                                                            <?php
                                                                            
                                                                            if($this->fungsi->petugas_login()->bidangID == 2){?>
                                                                            
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputEmail1">No LHV</label>
                                                                                    <input type="text" name="lhvID" class="form-control lhvID" id="lhvID" value="" >
                                                                                    <span class="lhvID_error text-danger"></span>
                                                                                </div>

                                                                                <button type="reset" class="btn btn-secondary">Reset</button>
                                                                            <?php } ?>
                                                                                
                                                                                <button type="submit" id="add" name="add" class="btn btn-primary">Create Final Report</button>
                                                                        </form>
                                                                </div>
                                                    </div>
                                </div>
                                <?php }else{ ?>

                               
                                <div class="col-md-12 col-sm-12" id="createFR">
                                                    <div class="card">
                                                                <div class="card-header bg-dark">
                                                                    <div class="card-title">
                                                                        <span>Upload File Final Report</span>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                        <form action="" id="formAdd">
                                                                                <div class="form-group">
                                                                                    <input type="hidden" name="frMarID" id="frMarID" value="<?=$rowFR->frMarID?>">
                                                                                    
                                                                                    <span class="spkID_error text-danger"></span>
                                                                                </div>
                                                                    
                                                                                <button type="submit" id="upload" name="upload" class="btn btn-primary">Upload File</button>
                                                                        </form>
                                                                </div>
                                                    </div>
                                </div>


                           








                                <?php } ?>
                            
                            
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

    // getApproval();

    $('#add').on('click', function(){

        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('InvoicingFinalReport/addFRID')?>",
            dataType : "JSON",
            data : $('#formAdd').serialize(),
            success: function(response){
                console.log(response);
                if(response.status == 'success'){
                    console.log("sukses");
                    // $('.quoID').html("");
                    // $('.orderID').html("");
                    Swal.fire({
                        icon: 'success',
                        title: 'Create Draft Final Report!',
                        text: 'You clicked the button!',
                    
                    })
                    .then(function() {
                        window.location.assign("<?php echo base_url();?>InvoicingFinalReport/viewUploadFRFile/"+ response.id);
                    });
                   
                }else{
                      
                       $('.lhvID_error').html(response.lhvID);
                       $('.spkID_error').html(response.spkID);
                }   
            }
        });
        return false;
    });

    $('#upload').on('click', function(){
        var id = $('#frMarID').val();
            Swal.fire({
                icon: 'success',
                title: 'Upload Final Report!',
                text: 'You clicked the button!',
            
            }).then(function() {
                window.location.assign("<?php echo base_url();?>InvoicingFinalReport/viewUploadFRFile/"+ id);
            });
        
     
        return false;
        });


});



</script>





</body>

</html>
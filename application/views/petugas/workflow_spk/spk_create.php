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
                               <span>CREATE SPK </span>
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
                                                <tbody>
                                                    <tr>
                                                        <th>Bidang</th>
                                                        <td><?=$rowBidang?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>No JobDesc</th>
                                                        <td><?=$row->jobdApprovNo?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>No Quotation</th>
                                                        <td><?=$rowQuo->quoNo?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>No Order</th>
                                                        <td><?=$row->jobdA_orderID?></td>
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
                                                <span>Create SPK</span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form action="" id="formAdd">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No Approval</label>
                                                    <input type="hidden" name="jobdaDetailID" class="form-control jobdaDetailID" id="jobdaDetailID" value="<?=$row->jobdaDetailID?>">
                                                    <input type="text" name="jobdaDetailID" class="form-control jobdaDetailID" id="jobdaDetailID" value="<?=$row->jobdApprovNo?>">
                                                    <span class="quoID_error text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No SPK</label>
                                                    <input type="text" name="spkNo" class="form-control spkNo" id="spkNo" value="">
                                                    <span class="spkNo_error text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">File Spk</label>
                                                    <input type="file" name="fileSpk" class="form-control-file fileSpk" id="fileSpk" value="" >
                                                    <span class="fileSpk_error text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Biaya Survey</label>
                                                    <input type="file" name="filebiayasurvey" class="form-control-file filebiayasurvey" id="filebiayasurvey" value="" >
                                                    <span class="filebiayasurvey_error text-danger"></span>
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
        e.preventDefault();
        var myformData = new FormData();        
        myformData.append('jobdaDetailID',  $('#jobdaDetailID').val());
        myformData.append('spkNo',  $('#spkNo').val());
        myformData.append('fileSpk', $('#fileSpk')[0].files[0]);
        myformData.append('filebiayasurvey', $('#filebiayasurvey')[0].files[0]);

        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('WorkflowSpk/saveSpk')?>",
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
                        title: 'Berhasil',
                        text: 'Data Berhasil Di Kirim!',
                    }).then(function() {
                        window.location.assign("<?php echo base_url();?>WorkflowJobdesc/viewNewApproval/");
                    });
                }else{
                    $('.spkNo_error').html(response.spkNo);
                    $('.fileSpk_error').html(response.fileSpk);
                    $('.filebiayasurvey_error').html(response.filebiayasurvey);
                }   
            }
        });
        return false;
    });


});



</script>





</body>

</html>
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
                            <span>Konfirmasi Quotaion</span>
                            </div>
                        </div>
                        <div class="card-body p-0">   
                         
                                <!-- /.box-header -->
                                <input type="hidden" name="quoDetailID" class="form-control" id="quoDetailID"  value="<?=$rowQuo->quoDetailID?>"><!-- Membuat Waktu Pengerjaan -->
                               
                                    <table class="table table-bordered">
                                        <tbody>  
                                            <tr>
                                                <th>No Quotation</th>
                                                <td><?=$rowQuo->quoNo?></td>
                                            </tr>
                                            <tr>
                                                <th>ID Order</th>
                                                <td><?=$rowQuo->quo_orderID?></td> 
                                            </tr>
                                            <tr>
                                                <th>Nama Bidang</th>
                                                <td><?=$rowBidang?></td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td><?=$rowQuo->status?></td>
                                            </tr>
                                            <tr>
                                                <th>File Quotation PDF</th>
                                                <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/quotation/'.$rowBidang.'/'.$rowQuo->quoDFile;?>"> Download</a> <?=$rowQuo->quoDFile?>  </td>
                                            </tr>
                                            <tr>
                                                <th>Comment</th>
                                                <td width="70%"><?=$rowQuo->comment?></td>
                                            </tr>
                                            <?php if($petugasLogin == $rowQuo->quoD_penerimaID){?>
                                            <tr>
                                                <th>Waktu</th>
                                                <td id="waktuTimeout"></td>
                                            </tr>
                                            <?php } ?>
                                            
                                            <?php if($petugasLogin == $rowQuo->quoD_penerimaID ){?>
                                            <?php if($waktusekarang < $rowQuo->waktu_end){?>
                                            <?php if($rowQuo->status != 'reject' || $rowQuo->status != 'success'){?>
                                            <tr id="action">
                                                <th>Action</th>
                                                <td> 
                                                    <div class="justify-content-center" >    
                                                    <?php if($this->fungsi->petugas_login()->subbidangID == 'FM'){?>
                                                        <a href="<?=site_url('WorkflowJobdesc/viewAddJobdescID/').$rowQuo->quoDetailID?>"><button class="btn btn-success mr-3">Approval</button></a>
                                                    <?php } else{?>
                                                        <button class="btn btn-success mr-3" id="quo-success">Quotation Success</button> 
                                                    <?php } ?>
                                                        <button class="btn btn-danger" id="quo-failed">Quotation Revisi</button> 
                                                    </div>
                                                </td>      
                                            </tr>  
                                            <?php } ?>
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
                                                        <span>Send Quotation Success</span>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <form action="" id="formAdd">
                                                        <input type="hidden" name="send_up" id="send_up" value="send_up">
                                                        <input type="hidden" name="quoDetailID" class="form-control"   value="<?=$rowQuo->quoDetailID?>"><!-- Membuat Waktu Pengerjaan -->
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">No Quotation</label>
                                                            <input type="text" name="quoID" class="form-control quoID" value="<?=$rowQuo->quoD_quoID?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Nama Bidang</label>
                                                            <input type="hidden" name="bidangID" class="form-control bidangID" value="<?=$rowQuo->quo_bidangID?>">
                                                            <input type="text" name="bidangNama" class="form-control bidangID" value="<?=$rowBidang?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">File Quotation Success</label>
                                                            <input type="text" name="quoFileSeuccess" class="form-control quoFileSeuccess" value="<?=$rowQuo->quoDFile?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Comment</label>
                                                            <textarea name="quoComment" id="" class="form-control" cols="30" rows="10"></textarea>
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
                                                        <span>Send Quotation Failed</span>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <form action="">
                                                        <input type="hidden" name="send_down" id="send_up" value="send_down">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">No Quotation</label>
                                                            <input type="text" name="quoID" class="form-control" id="quoID" value="<?=$rowQuo->quoD_quoID?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Nama Bidang</label>
                                                            <input type="hidden" name="bidangID" class="form-control" id="bidangID" value="<?=$rowQuo->quo_bidangID?>" >
                                                            <input type="text" name="bidangNama" class="form-control bidangID" value="<?=$rowBidang?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">File Quotation Revisi</label>
                                                            <input type="file" name="quoFile" class="form-control-file" id="quoFile" ">
                                                            <span class="quoFile_error text-danger"></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Comment</label>
                                                            <textarea name="quoComment" id="quoComment" class="form-control" cols="30" rows="10"></textarea>
                                                        </div> 
                                                            <button type="submit" name="kirim-failed" id="kirim-failed" class="btn btn-danger">Kirim</button>
                                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Quotation Revisi -->
                           
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

    //Kirim Failed
    $('#success').on('click', function(){
 
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('WorkflowQuotation/saveQuoFile')?>",
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
                        title: 'Berhasil',
                        text: 'Data Berhasil Di Kirim!',
                    }).then(function() {
                        window.location.assign("<?php echo base_url();?>WorkflowQuotation/viewNewQuo/");
                    }); 
                }else if(response.status == 'reject'){
                    Swal.fire({
                        icon: 'error',
                        title: 'File Reject!',
                        text: 'You clicked the button!',
                    }).then(function() {
                        window.location.assign("<?php echo base_url();?>WorkflowQuotation/viewNewQuo/");
                    });
                }
                else{
                    $('.quoID_error').html(response.quoID);
                    $('.orderID_error').html(response.orderID);
                }     
            }
        });
        return false;
    });


    //Kirim Failed
    $('#kirim-failed').on('click', function(e){
        e.preventDefault();
        var myformData = new FormData();        
        myformData.append('send_down',  $('#send_down').val());
        myformData.append('quoDetailID',  $('#quoDetailID').val());
        myformData.append('quoID',  $('#quoID').val());
        myformData.append('bidangID',  $('#bidangID').val());
        myformData.append('quoFile', $('#quoFile')[0].files[0]);
        myformData.append('quoComment',  $('#quoComment').val());
        

        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('WorkflowQuotation/saveQuoFile')?>",
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
                        window.location.assign("<?php echo base_url();?>WorkflowQuotation/viewNewQuo/");
                    });
                }else if(response.status == 'reject'){
                    Swal.fire({
                        icon: 'error',
                        title: 'File Sudah Di Reject',
                        text: 'You clicked the button!',
                    });
                }
                else{
                    $('.quoID_error').html(response.quoID);
                    $('.quoFile_error').html(response.quoFile);
                }   
            }
        });
        return false;
    });


    //Waktu Pengerjaan
    var set = setInterval(getTimeOut, 1000);
    function getTimeOut(){
        var id = $('#quoDetailID').val();
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('WorkflowQuotation/timeViewMarine')?>",
            dataType : "JSON",
            data : {id:id},
            success: function(data){
                // console.log(data);
                $('#status').text(data.status);
                if(data.status == 'success'){
                    clearInterval(set);
                    $('#waktuTimeout').html('<span class="text-danger">Waktu Selesai</span>');
                    $('#action').hide();
                }else if(data.status == 'proses'){
                    if(data.statusAll == 'reject' || data.statusAll == 'success'){
                        clearInterval(set);
                        $('#waktuTimeout').html('<span class="text-danger">Waktu Selesai</span>');
                        $('#action').hide();
                    }else{
                        var now         = new Date().getTime();
                        var waktuEnd    = new Date(data.waktuEnd).getTime();
                        var time        = now-waktuEnd;
                        var diff_time   = Math.abs(time);
                        var minutes = Math.floor((diff_time % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((diff_time % (1000 * 60)) / 1000);
                        document.getElementById("waktuTimeout").innerHTML = minutes + " Menit " + seconds + " Detik ";

                        if(now > waktuEnd){
                            $('#status').text(data.status);
                            Swal.fire({
                                icon: 'error',
                                title: 'Data Reject!',
                                text: 'Data ini telah di Reject',
                            }).then(function(){
                                location.reload();
                            }); 
                        }
                    }
                }   
            }
        });
    }


});

</script>

</body>
</html>
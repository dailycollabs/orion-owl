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
                            <span>Quotaion Revisi</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <input type="hidden" name="quoDetailID" class="form-control" id="quoDetailID"  value="<?=$rowQuo->quoDetailID?>"><!-- Membuat Waktu Pengerjaan -->
                                <input type="hidden" name="orderID" class="form-control" id="orderID"  value="<?=$rowQuo->quo_orderID?>"><!-- Membuat Waktu Pengerjaan -->
                                <div class="box-body">

                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Status</th>
                                                <td><?=$rowQuo->status?></td>
                                            </tr>
                                            <tr>
                                                <th>No Quotation</th>
                                                <td><?=$rowQuo->quoD_quoID?></td>
                                            </tr>
                                            <tr>
                                                <th>No Order</th>
                                                <td><?=$rowQuo->quo_orderID?></td>
                                            </tr>
                                            <tr>
                                                <th>Nama Bidang</th>
                                                <td><?=$rowBidang?></td> 
                                            </tr>
                                            <tr>
                                                <th>File Quotation PDF</th>
                                                <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/quotation/Marine/'.$rowQuo->quoDFile;?>"> Download</a> <?=$rowQuo->quoDFile?>  </td>
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
                                                <tr>
                                                    <th>Action</th>
                                                    <td> 
                                                        <div class="justify-content-center"> 
                                                        <?php if($this->fungsi->petugas_login()->subbidangID != 'AM1' || $this->fungsi->petugas_login()->subbidangID == 'AM2'){?>
                                                            <button class="btn btn-primary mr-3" id="quo-success">Quotation  send </button> 
                                                        <?php } ?>
                                                            <button class="btn btn-primary" id="quo-failed">Quotation Create</button> 
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>    
                                            <?php } ?> 
                                            <?php } ?>  
                                        </tbody>
                                    </table>

                                    <!-- Quotation Revisi -->
                                    <div class="row justify-content-center mt-4">
                                        <div class="col-12">  
                                            <div class="card" style="display:none;" id="quoFailed">
                                                <div class="card-header bg-primary">
                                                    <div class="card-title">
                                                        <span>Send Quotation Refisi ke </span>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <form action="">
                                                        <input type="hidden" name="send_up" id="send_up" value="send_up">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">No Quotation</label>
                                                            <input type="text" name="quoID" class="form-control" id="quoID" value="<?=$rowQuo->quoD_quoID?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Nama Bidang</label>
                                                            <input type="hidden" name="bidangID" class="form-control" id="bidangID" value="<?=$rowQuo->quo_bidangID?>" >
                                                            <input type="text" name="bidangNama" class="form-control bidangNama" value="<?=$rowBidang?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">File Revisi</label>
                                                            <input type="file" name="quoFile" class="form-control" id="quoFile" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Comment</label>
                                                            <textarea name="quoComment" id="quoComment" class="form-control" cols="30" rows="10"></textarea>
                                                        </div>
                                                        <div>
                                                            <p> <span class="text-danger">*</span><span> Membuat Revisi Untuk mengirimkan ke </span></p>
                                                        </div> 
                                                        <button type="submit" name="kirim-revisi" id="kirim-revisi" class="btn btn-primary">Kirim</button>
                                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Quotation Revisi -->

                                        <!-- Quotation Success -->
                                        <div class="row justify-content-center ">
                                        <div class="col-12">        
                                            <div class="card"style="display:none;" id="quoSukses">
                                                <div class="card-header bg-primary">
                                                    <div class="card-title">
                                                        <span>Send Quotation Failed ke</span>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <form action="" id="formFailed">
                                                        <input type="hidden" name="send_down" id="send_down" value="send_down">
                                                        
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">No RKA</label>
                                                            <input type="text" name="quoID" class="form-control" id="succes_quoID" value="<?=$rowQuo->quoD_quoID?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">bidang</label>
                                                            <input type="hidden" name="bidangID" class="form-control"  value="<?=$rowQuo->quo_bidangID?>" >
                                                            <input type="text" name="bidangNama" class="form-control bidangNama" value="<?=$rowBidang?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">File RKA Success</label>
                                                            <input type="text" name="quoFileSeuccess" class="form-control" id="succes_quoFile" value="<?=$rowQuo->quoDFile?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Comment</label>
                                                            <textarea name="quoComment" id="" class="form-control" cols="30" rows="10"></textarea>
                                                        </div>
                                                        <div>
                                                            <p> <span class="text-danger">*</span><span> Melanjutkan Untuk mengirimkan Quotation ke </span></p>
                                                        </div>
                                                        <button type="submit" name="kirim-failed" id="kirim-failed" class="btn btn-primary">Kirim</button>
                                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>        
                                    </div>
                                    <!-- Quotation Success -->

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

    //Membuat dan mengirimkan file Refisi pengirimannya ke atas
    $('#kirim-revisi').on('click', function(e){
        e.preventDefault();
        var myformData = new FormData();        
        myformData.append('send_up',  $('#send_up').val());
        myformData.append('quoID',  $('#quoID').val());
        myformData.append('bidangID',  $('#bidangID').val());
        myformData.append('quoFile', $('#quoFile')[0].files[0]);
        myformData.append('quoComment',  $('#quoComment').val());
        console.log('click');

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
                        window.location.assign("<?php echo base_url();?>WorkflowQuotation/viewfailedquo/");
                    });
                
                }else{
                    $('.quoID_error').html(response.quoID);
                    $('.orderID_error').html(response.orderID);
                }   
            }
        });
        return false;
    });


    //Melanjutkan File Failed Ke Orang Di bawah
    $('#kirim-failed').on('click', function(){
    
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('WorkflowQuotation/saveQuoFile')?>",
            dataType : "JSON",
            data : $('#formFailed').serialize(),
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
                        window.location.assign("<?php echo base_url();?>WorkflowQuotation/viewfailedquo/");
                    });
                
                }else{
                    $('.quoID_error').html(response.quoID);
                    $('.orderID_error').html(response.orderID);
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
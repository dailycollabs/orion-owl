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
                            <span>Konfirmasi Approval</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <input type="hidden" name="invMinDetailID" id="invMinDetailID" value="<?=$rowINV->invMinDetailID?>">
                                            <tr>
                                                <th>No Invoice</th>
                                                <td><?=$rowINV->invMinD_invID?></td>
                                            </tr>
                                            <tr>
                                                <th>ID FR</th>
                                                <td><?=$rowFR->frMinD_frID?></td>
                                            </tr>
                                            <tr>
                                                <th>No SPK</th>
                                                <td><?=$rowSPK->spkNo?></td>
                                            </tr>
                                            <tr>
                                                <th>No JOBDESC</th>
                                                <td><?=$rowJobdesc->jobdApprovNo?></td>
                                            </tr>
                                            <tr>
                                                <th>ID ORDER</th>
                                                <td><?=$rowINV->invMin_orderID?></td>
                                            </tr>
                                            <tr>
                                                <th>File Draft Invoice</th>
                                                <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/invoicing/Minerba/'.$rowINV->invMinFile;?>"> Download</a> <?=$rowINV->invMinFile?></td>
                                            </tr>
                                            <?php if($petugasLogin == $rowINV->invMinD_penerimaID){?>
                                            <tr>
                                                <th>Waktu</th>
                                                <td id="waktuTimeout"></td>
                                            </tr>
                                            <?php } ?>

                                            <?php if($petugasLogin == $rowINV->invMinD_penerimaID){?>
                                            <?php if($waktusekarang < $rowINV->waktu_end){?>
                                            <?php if($rowINV->status != 'reject' || $rowINV->status != 'success'){?>
                                            <tr>
                                                <th>Action</th>
                                                <td> 
                                                    <div class="justify-content-center"> 
                                                        <?php if($this->fungsi->petugas_login()->subbidangID == 'AM2'){?>
                                                            <button class="btn btn-success mr-3" id="send-client">Send Client</button> 
                                                        <?php } else{?>
                                                            <button class="btn btn-success mr-3" id="quo-success">Send Approval</button> 
                                                        <?php } ?>  
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
                                                        <span>Send Approval Invoice</span>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <form action="" id="sendApproval">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Bidang</label>
                                                            <input type="hidden" name="bidangID"  class="form-control bidangID"  value="<?=$rowINV->invMin_bidangID?>">
                                                            <input type="text" name="bidangNama"  class="form-control bidangNama"  value="<?=$rowBidang?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">No Invoice</label>
                                                            <input type="hidden" name="invID"  class="form-control invID"  value="<?=$rowINV->invMinD_invID?>">
                                                            <input type="text" name="invNo"  class="form-control invNo"  value="<?=$rowINV->invMinNo?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">ID Order</label>
                                                            <input type="text" name="orderID"  class="form-control orderID"  value="<?=$rowINV->invMin_orderID?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">File Invoice</label>
                                                            <input type="text" name="draftInvFile_send" class="form-control draftInvFile" id="draftInvFile_send" value="<?=$rowINV->invMinFile?>">
                                                            <span class="jobdFile_error text-danger"></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Comment</label>
                                                            <textarea name="commentINVMIN" id="" class="form-control" cols="10" rows="5"></textarea>
                                                        </div>
                                                        <button type="submit" id="add-approval" name="add" class="btn btn-primary">Submit</button>
                                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>        
                                    </div>
                                    <!-- Quotation Success -->

                                    <!-- Quotation Success -->
                                    <div class="row justify-content-center mt-4">
                                        <div class="col-12">        
                                            <div class="card"style="display:none;" id="sendClient">
                                                <div class="card-header bg-success">
                                                    <div class="card-title">
                                                        <span>Send Invoice Client</span>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <form action="" id="sendApprovClient">
                                                    <input type="hidden" name="clientF_invDetailID" id="clientF_invDetailID" class="form-control clientF_invDetailID"  value="<?=$rowINV->invMinDetailID?>">
                                                        <input type="hidden" name="clientF_frDetailID" id="clientF_frDetailID" class="form-control clientF_frDetailID"  value="<?=$rowINV->invMin_frDetailID?>">
                                                        <input type="hidden" name="clientF_spkID" id="clientF_spkID" class="form-control clientF_spkID"  value="<?=$rowINV->invMin_spkID?>">
                                                        <input type="hidden" name="clientF_jobdaDetailID" id="clientF_jobdaDetailID" class="form-control clientF_jobdaDetailID"  value="<?=$rowINV->invMin_jobdaDetailID?>">
                                                        <input type="hidden" name="clientF_quoDetailID" id="clientF_quoDetailID" class="form-control clientF_quoDetailID"  value="<?=$rowINV->invMin_quoDetailID?>">


                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Bidang</label>
                                                            <input type="hidden" name="clientF_bidangID" id="clientF_bidangID" class="form-control clientF_bidangID"  value="<?=$rowINV->invMin_bidangID?>">
                                                            <!-- <input type="text" name="bidangNama" class="form-control" value="<?=$rowBidang?>" readonly> -->
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">No Invoice</label>
                                                            <input type="text" name="clientF_invID" id="clientF_invID" class="form-control jobdID"  value="<?=$rowINV->invMinD_invID?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">ID Order</label>
                                                            <input type="text" name="clientF_orderID" id="clientF_orderID" class="form-control clientF_orderID"  value="<?=$rowINV->invMin_orderID?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">ID PROJECT</label>
                                                            <input type="text" name="clientF_projectClientID" id="clientF_projectClientID" class="form-control clientF_projectClientID"  value="<?=$rowClient->order_projectID?>" readonly>
                                                        </div>
                                                            <div class="form-group">
                                                            <label for="exampleInputEmail1">Client ID</label>
                                                            <input type="text" name="clientF_clientID" id="clientF_clientID" class="form-control clientF_clientID"  value="<?=$rowClient->order_clientID?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Comment</label>
                                                            <textarea name="clientF_comment" id="clientF_comment" class="form-control" cols="10" rows="5"></textarea>
                                                        </div>
                                                        <button type="submit" id="add-approvclient" name="add" class="btn btn-primary">Submit</button>
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
        $('#sendClient').hide("slow");
        $('#quoSukses').show("slow");
    });

    $('#send-client').on('click', function(){
        $('#quoSukses').hide("slow");
        $('#sendClient').show("slow");
        
    });

    $('#add-approval').on('click', function(){
     
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('InvoicingDraft/saveInvMinFile')?>",
            dataType : "JSON",
            data : $('#sendApproval').serialize(),
            success: function(response){
                console.log('success');    
                console.log(response);  
                if(response.status == 'success'){
                   Swal.fire({
                       icon: 'success',
                       title: 'Berhasil!',
                       text: 'Data Berhasil Di Kirim',
                   }).then(function(){
                        window.location.assign("<?php echo base_url();?>InvoicingDraft/viewNewApprov");
                    });

               }else{
                   Swal.fire({
                       icon: 'error',
                       title: 'Error Send!',
                       text: 'Tidak Ada Data Yang Di Kirim',
                   });
               }  
            }
        }); 
        return false;
    });

    $('#add-approvclient').on('click', function(){
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('InvoivingFinalClient/saveFinalClient')?>",
            dataType : "JSON",
            data : $('#sendApprovClient').serialize(),
            success: function(response){
                console.log(response); 
                if(response.status == 'success'){
                   Swal.fire({
                       icon: 'success',
                       title: 'Berhasil!',
                       text: 'Data Berhasil Di Kirim',
                   }).then(function(){
                        window.location.assign("<?php echo base_url();?>InvoicingDraft/viewNewApprov");
                    });

               }
            //    else{
            //        Swal.fire({
            //            icon: 'error',
            //            title: 'Error Send!',
            //            text: 'Tidak Ada Data Yang Di Kirim',
            //        });
            //    }   
            }
        }); 
        return false;
    });


     //Waktu Pengerjaan
     var set = setInterval(getTimeOut, 1000);
    function getTimeOut(){
        var id = $('#invMinDetailID').val();
        console.log(id);
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('InvoicingDraft/timeViewMinerba')?>",
            dataType : "JSON",
            data : {id:id},
            success: function(data){
                console.log(data);
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
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
                            <span>KONFIRMASI INVOICE DRAFT</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <input type="hidden" name="invMarDetailID" id="invMarDetailID" value="<?=$rowINV->invMarDetailID?>">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>No Invoice</th>
                                                    <td><?=$rowINV->invMarD_invID?></td>
                                                </tr>
                                                <tr>
                                                    <th>ID FR</th>
                                                    <td><?=$rowFR->frMarD_frID?></td>
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
                                                    <td><?=$rowINV->invMar_orderID?></td>
                                                </tr>
                                                <tr>
                                                    <th>File Draft Invoice</th>
                                                    <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/invoicing/Marine/'.$rowINV->invMarFile;?>"> Download</a> <?=$rowINV->invMarFile?></td>
                                                </tr>
                                                <?php if($petugasLogin == $rowINV->invMarD_penerimaID){?>
                                                <tr>
                                                    <th>Waktu</th>
                                                    <td id="waktuTimeout"></td>
                                                </tr>
                                                <?php }?> 

                                                <?php if($petugasLogin == $rowINV->invMarD_penerimaID){?>
                                                <?php if($waktusekarang < $rowINV->waktu_end){?>
                                                <?php if($rowINV->status != 'reject' || $rowINV->status != 'success'){?>
                                                <tr>
                                                    <th>Action</th>
                                                    <td> 
                                                        <div class="justify-content-center"> 
                                                            <?php if($this->fungsi->petugas_login()->subbidangID == 'FM'){?>
                                                                <button class="btn btn-success mr-3" id="inv-approval">Approval</button>
                                                                <button class="btn btn-danger" id="inv-failed">Draft Invoice Revisi</button> 
                                                            <?php } ?>
                                                            <?php if($this->fungsi->petugas_login()->subbidangID == 'AM1'){?>
                                                                <button class="btn btn-success mr-3" id="send-client">Send Client</button> 
                                                            <?php }?>  
                                                        </div>
                                                    </td>
                                                </tr>  
                                                <?php }?>
                                                <?php }?>
                                                <?php }?>
                                            </tbody>
                                        </table>

                                        <!-- Quotation Success -->
                                        <div class="row justify-content-center mt-4">
                                            <div class="col-12">        
                                                <div class="card"style="display:none;" id="invApproval">
                                                    <div class="card-header bg-success">
                                                        <div class="card-title">
                                                            <span>Send Approval</span>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                  
                                                        <form action="" id="formAdd">
                                                            <input type="hidden" name="invDetailID" class="form-control" id="invDetailID" value="<?=$rowINV->invMarDetailID?>" readonly> 
                                                            <input type="hidden" name="send_approval" class="form-control" id="send_approval" value="send_approval" readonly>
                                                            <input type="hidden" name="orderID" class="form-control" id="orderID" value="<?=$rowINV->invMar_orderID?>" readonly>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Bidang</label>
                                                                <input type="hidden" name="bidangID" class="form-control" id="bidangID" value="<?=$rowINV->invMar_bidangID?>" readonly>
                                                                <input type="text" name="bidangNama" class="form-control" id="bidangNama" value="<?=$rowBidang?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">No Invoice</label>
                                                                <input type="text" name="invID" class="form-control" id="invID" value="<?=$rowINV->invMarD_invID?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">No Referencing</label>
                                                                <input type="text" name="referencingID" class="form-control" id="referencingID" value="<?=$rowINV->invMarRefNo?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">draftInvFile</label>
                                                                <input type="text" name="send_draftInvFile" class="form-control" id="send_draftInvFile" value="<?=$rowINV->invMarFile?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Comment</label>
                                                                <textarea name="comentINV"  class="form-control" cols="30" rows="10"></textarea>
                                                            </div>
                                                            <button type="submit" name="success" id="approval" class="btn btn-success">Kirim</button>
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
                                                <div class="card" style="display:none;" id="invFailed">
                                                    <div class="card-header bg-danger">
                                                        <div class="card-title">
                                                            <span>Send Draft Invoice Failed</span>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <form action="" >
                                                            <input type="hidden" name="send_down" id="send_down" value="send_down">
                                                            <input type="hidden" name="failed" value="failed">
                                                            <!-- <input type="hidden" name="send_down" id="send_down" value="send_down"> -->
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Bidang</label>
                                                                <input type="hidden" name="bidangID" class="form-control" id="bidangID" value="<?=$rowINV->invMar_bidangID?>" readonly>
                                                                <input type="text" name="bidangNama" class="form-control" value="<?=$rowBidang?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">No Invoice</label>
                                                                <input type="text" name="invID" class="form-control" value="<?=$rowINV->invMarD_invID?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">No Referencing</label>
                                                                <input type="text" name="referencingID" class="form-control"  value="<?=$rowINV->invMarRefNo?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">File Draft Invoice Revisi</label>
                                                                <input type="file" name="draftInvFile" class="form-control" id="draftInvFile" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Comment</label>
                                                                <textarea name="comentINV" id="comentINV" class="form-control" cols="30" rows="10"></textarea>
                                                            </div> 
                                                                <button type="submit" name="kirim-failed" id="kirim-failed" class="btn btn-primary">Kirim</button>
                                                                <button type="reset" class="btn btn-secondary">Reset</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Quotation Revisi -->

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
                                                        
                                                        <input type="hidden" name="clientF_invDetailID" id="clientF_invDetailID" class="form-control clientF_invDetailID"  value="<?=$rowINV->invMarDetailID?>">
                                                        <input type="hidden" name="clientF_frDetailID" id="clientF_frDetailID" class="form-control clientF_frDetailID"  value="<?=$rowINV->invMar_frDetailID?>">
                                                        <input type="hidden" name="clientF_spkID" id="clientF_spkID" class="form-control clientF_spkID"  value="<?=$rowINV->invMar_spkID?>">
                                                        <input type="hidden" name="clientF_jobdaDetailID" id="clientF_jobdaDetailID" class="form-control clientF_jobdaDetailID"  value="<?=$rowINV->invMar_jobdaDetailID?>">
                                                        <input type="hidden" name="clientF_quoDetailID" id="clientF_quoDetailID" class="form-control clientF_quoDetailID"  value="<?=$rowINV->invMar_quoDetailID?>">


                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Bidang</label>
                                                            <input type="hidden" name="clientF_bidangID" id="clientF_bidangID" class="form-control clientF_bidangID"  value="<?=$rowINV->invMar_bidangID?>">
                                                            <!-- <input type="text" name="bidangNama" class="form-control" value="<?=$rowBidang?>" readonly> -->
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">No Invoice</label>
                                                            <input type="text" name="clientF_invID" id="clientF_invID" class="form-control jobdID"  value="<?=$rowINV->invMarD_invID?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">ID Order</label>
                                                            <input type="text" name="clientF_orderID" id="clientF_orderID" class="form-control clientF_orderID"  value="<?=$rowINV->invMar_orderID?>" readonly>
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

    $('#inv-approval').on('click', function(){
        $('#invFailed').hide("slow");
        $('#invApproval').show("slow");
    });

    $('#inv-failed').on('click', function(){
        $('#invApproval').hide("slow");
        $('#invFailed').show("slow");
    });

    $('#send-client').on('click', function(){
        $('#sendClient').toggle();
    });


    $('#approval').on('click', function(){
        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('InvoicingDraft/saveMarInvFile')?>",
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
                        title: 'Berhasil!',
                        text: 'Data Berhasil Di Kirim!',
                    }).then(function() {
                        window.location.assign("<?php echo base_url();?>InvoicingDraft/viewNewDraftInv/");
                    });
                }else{
                    $('.quoID_error').html(response.quoID);
                    $('.orderID_error').html(response.orderID);
                }   
            }
        });
        return false;
    });

   


    $('#kirim-failed').on('click', function(){
        var myformData = new FormData();        
        myformData.append('send_down',  $('#send_down').val());
        myformData.append('invID',  $('#invID').val());
        myformData.append('bidangID',  $('#bidangID').val());
        myformData.append('comentINV',  $('#comentINV').val());
        myformData.append('draftInvFile', $('#draftInvFile')[0].files[0]);
        console.log(myformData);
        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('InvoicingDraft/saveMarInvFile')?>",
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
                        title: 'Berhasil!',
                        text: 'Data Berhasil Di Kirim!',
                    }).then(function() {
                        window.location.assign("<?php echo base_url();?>InvoicingDraft/viewNewDraftInv/");
                    });
                }else{
                    $('.quoID_error').html(response.quoID);
                    $('.orderID_error').html(response.orderID);
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
                        window.location.assign("<?php echo base_url();?>InvoicingDraft/viewNewDraftInv/");
                    });

               }else{
                //    Swal.fire({
                //        icon: 'error',
                //        title: 'Error Send!',
                //        text: 'Tidak Ada Data Yang Di Kirim',
                //    }).then(function(){
                //         window.location.assign("<?php echo base_url();?>InvoicingDraft/viewNewDraftInv/");
                //     });
               }   
            }
        }); 
        return false;
    });





    //Waktu Pengerjaan
    var set = setInterval(getTimeOut, 1000);
    function getTimeOut(){
        var id = $('#invMarDetailID').val();
        console.log(id);
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('InvoicingDraft/timeViewMarine')?>",
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
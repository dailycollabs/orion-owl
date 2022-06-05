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
                            <span>Draft Final Report Revisi</span>
                            </div>
                        </div>
                        <div class="card-body">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">

                                        <table class="table table-bordered">
                                            <tbody>
                                            <input type="hidden" name="frMinDetailID" class="form-control" id="frMinDetailID"  value="<?=$rowMinFR->frMinDetailID?>"><!-- Membuat Waktu Pengerjaan -->
                                            <tr>
                                                <th>ID Final Report</th>
                                                <td><?=$rowMinFR->frMinD_frID?></td>
                                            </tr>
                                            <tr>
                                                <th>No SPK</th>
                                                <td><?=$rowSpk->spkNo?></td>                 
                                            </tr>
                                            <tr>
                                                <th>No JOBDESC</th>
                                                <td><?=$rowJobdesc->jobdApprovNo?></td>                 
                                            </tr>
                                            <tr>
                                                <th>No Quotation</th>
                                                <td><?=$rowQuo->quoNo?></td>                 
                                            </tr>
                                            <tr>
                                                <th>Order ID</th>
                                                <td><?=$rowMinFR->frMin_orderID?></td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td><?=$rowMinFR->status?></td>
                                            </tr>

                                                <?php if(preg_match("/FD1/i", $rowMinFR->frInternalFile)){?>
                                                    <tr>
                                                        <th>File Final Report INTERNAL</th>
                                                        <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/finalreport/Minerba/fr_internal/'.$rowMinFR->frInternalFile;?>"> Download</a> <?=$rowMinFR->frInternalFile?> </td>
                                                      
                                                    </tr>
                                                <?php }?>
                                                
                                                <?php if(preg_match("/FD1/i", $rowMinFR->lhvFile)){?>
                                                    <tr>
                                                        <th>File Final Report LHV</th>
                                                        <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/finalreport/Minerba/fr_lhv/'.$rowMinFR->lhvFile;?>"> Download</a>  <?=$rowMinFR->lhvFile?> </td>
                                                       
                                                    </tr>
                                                <?php } ?>

                                                <?php if(preg_match("/FD1/i", $rowMinFR->dsrFile)){?>
                                                    <tr>
                                                        <th>File Final Report DSR</th>
                                                        <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/finalreport/Minerba/fr_dsr/'.$rowMinFR->dsrFile;?>"> Download</a>  <?=$rowMinFR->dsrFile?> </td>
                                                        
                                                    </tr>
                                                <?php }?>
                                                
                                                <?php if(preg_match("/FD1/i", $rowMinFR->coaFile)){?>
                                                    <tr>
                                                        <th>File Final Report COA</th>
                                                        <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/finalreport/Minerba/fr_coa/'.$rowMinFR->coaFile;?>"> Download</a>  <?=$rowMinFR->coaFile?> </td>
                                                       
                                                    </tr>
                                                <?php } ?>

                                                <?php if(preg_match("/FD1/i", $rowMinFR->cowFile)){?>
                                                    <tr>
                                                        <th>File Final Report COW</th>
                                                        <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/finalreport/Minerba/fr_cow/'.$rowMinFR->cowFile;?>"> Download</a>  <?=$rowMinFR->cowFile?> </td>
                                                       
                                                    </tr>
                                                <?php }?>
                                                
                                                <?php if(preg_match("/FD1/i", $rowMinFR->cdsFile)){?>
                                                    <tr>
                                                        <th>File Final Report CDS</th>
                                                        <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/finalreport/Minerba/fr_cds/'.$rowMinFR->cdsFile;?>"> Download</a>  <?=$rowMinFR->cdsFile?> </td>
                                                    
                                                    </tr>
                                                <?php } ?>

                                                <?php if($petugasLogin == $rowMinFR->frMinD_penerimaID){?>
                                                <tr>
                                                    <th>Waktu</th>
                                                    <td id="waktuTimeout"></td>
                                                </tr>

                                                <?php } ?>
                                               
                                                <?php if($petugasLogin == $rowMinFR->frMinD_penerimaID ){?>
                                                <?php if($waktusekarang < $rowMinFR->waktu_end){?>
                                                <?php if($rowMinFR->status != 'reject' || $rowMinFR->status != 'success'){?>
                                                <tr id="action">
                                                    <th>Action</th>
                                                    <td> 
                                                        <div class="justify-content-center" > 
                                                            <?php if($this->fungsi->petugas_login()->subbidangID == 'FM'){?>
                                                                <a href="<?=site_url('approval/approval/')?>"><button class="btn btn-success mr-3">Approval</button></a>
                                                            <?php } ?>
                                                            <?php if($this->fungsi->petugas_login()->subbidangID != 'SM2'){?>
                                                                <button class="btn btn-primary mr-3" id="quo-success">FR send_Down</button> 
                                                            <?php } ?>
                                                                <button class="btn btn-primary" id="quo-failed">FR Create Revisi</button> 
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
                                                            <span>Create Revisi Draft Final Report </span>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <form action="" >
                                                            <input type="hidden" name="revisi" value="revisi" id="revisi">
                                                            <input type="hidden" name="send_up" id="send_up" value="send_up">

                                                            
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Bidang</label>
                                                                <input type="hidden" name="bidangID" class="form-control" id="bidangID" value="<?=$rowMinFR->frMin_bidangID?>" readonly>
                                                                <input type="text" name="bidangNama" class="form-control" id="bidangNama" value="<?=$rowBidang?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">ID Final Report</label>
                                                                <input type="text" name="frID" class="form-control" id="frID" value="<?=$rowMinFR->frMinD_frID?>">
                                                            </div>
                                                            
                                                            
                                                                
                                                                <?php if(preg_match("/FD1/i", $rowMinFR->frInternalFile)) { ?>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">File Revisi Internal</label>
                                                                        <input type="file" name="fr_internal" class="form-control active" id="fr_internal" value="">
                                                                    </div>
                                                                <?php }else{?>
                                                                    <input type="hidden" name="fr_internal_revisi" class="form-control active" id="fr_internal_revisi" value="<?=$rowMinFR->frInternalFile?>">
                                                                <?php } ?>
                                                                
                                                                <?php if(preg_match("/FD1/i", $rowMinFR->lhvFile)) { ?>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">File Revisi LHV</label>
                                                                        <input type="file" name="fr_lhv" class="form-control active" id="fr_lhv" value="">
                                                                    </div>
                                                                <?php }else{ ?>
                                                                    <input type="hidden" name="fr_lhv_revisi" class="form-control active" id="fr_lhv_revisi" value="<?=$rowMinFR->lhvFile?>">
                                                                <?php } ?>
                                                                <?php if(preg_match("/FD1/i", $rowMinFR->dsrFile)) { ?>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">File Revisi dsrFile</label>
                                                                        <input type="file" name="fr_dsr" class="form-control active" id="fr_dsr" value="">
                                                                    </div>
                                                                <?php }else{?>
                                                                    <input type="hidden" name="fr_dsr_revisi" class="form-control active" id="fr_dsr_revisi" value="<?=$rowMinFR->dsrFile?>">
                                                                <?php } ?>
                                                                
                                                                <?php if(preg_match("/FD1/i", $rowMinFR->coaFile)) { ?>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">File Revisi coaFile</label>
                                                                        <input type="file" name="fr_coa" class="form-control active" id="fr_coa" value="">
                                                                    </div>
                                                                <?php }else{ ?>
                                                                    <input type="hidden" name="fr_coa_revisi" class="form-control active" id="fr_coa_revisi" value="<?=$rowMinFR->coaFile?>">
                                                                <?php } ?>
                                                                <?php if(preg_match("/FD1/i", $rowMinFR->cowFile)) { ?>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">File Revisi cowFile</label>
                                                                        <input type="file" name="fr_cow" class="form-control active" id="fr_cow" value="">
                                                                    </div>
                                                                <?php }else{?>
                                                                    <input type="hidden" name="fr_cow_revisi" class="form-control active" id="fr_cow_revisi" value="<?=$rowMinFR->cowFile?>">
                                                                <?php } ?>
                                                                
                                                                <?php if(preg_match("/FD1/i", $rowMinFR->cdsFile)) { ?>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">File Revisi cdsFile</label>
                                                                        <input type="file" name="fr_cds" class="form-control active" id="fr_cds" value="">
                                                                    </div>
                                                                <?php }else{ ?>
                                                                    <input type="hidden" name="fr_cds_revisi" class="form-control active" id="fr_cds_revisi" value="<?=$rowMinFR->cdsFile?>">
                                                                <?php } ?>

                                                                
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Comment</label>
                                                                    <textarea name="frMinComment" id="frMinComment" class="form-control" cols="30" rows="10"></textarea>
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
                                                <div class="card" style="display:none;" id="quoSukses">
                                                    <div class="card-header bg-primary">
                                                        <div class="card-title">
                                                            <span>Send Quotation Failed</span>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <form action="" id="formAdd">
                                                            <input type="hidden" name="send_down" id="send_down" value="send_down">
                                                           
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Bidang</label>
                                                                <input type="hidden" name="bidangID" class="form-control" value="<?=$rowMinFR->frMin_bidangID?>" readonly>
                                                                <input type="text" name="bidangNama" class="form-control"  value="<?=$rowBidang?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">ID Final Report</label>
                                                                <input type="text" name="frID" class="form-control"  value="<?=$rowMinFR->frMinD_frID?>">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">File frInternalFile</label>
                                                                <input type="text" name="fr_internal_send" class="form-control" id="fr_internal_send" value="<?=$rowMinFR->frInternalFile?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">File lhvFile</label>
                                                                <input type="text" name="fr_lhv_send" class="form-control" id="fr_lhv_send" value="<?=$rowMinFR->lhvFile?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">File dsrFile</label>
                                                                <input type="text" name="fr_dsr_send" class="form-control" id="fr_dsr_send" value="<?=$rowMinFR->dsrFile?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">File coaFile</label>
                                                                <input type="text" name="fr_coa_send" class="form-control" id="fr_coa_send" value="<?=$rowMinFR->coaFile?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">File cowFile</label>
                                                                <input type="text" name="fr_cow_send" class="form-control" id="fr_cow_send" value="<?=$rowMinFR->cowFile?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">File cdsFile</label>
                                                                <input type="text" name="fr_cds_send" class="form-control" id="fr_cds_send" value="<?=$rowMinFR->cdsFile?>">
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Comment</label>
                                                                <textarea name="" id="" class="form-control" cols="30" rows="10"></textarea>
                                                            </div>
                                                            <div>
                                                                <p> <span class="text-danger">*</span><span> Melanjutkan Untuk mengirimkan Quotation ke</span></p>
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





    $('#kirim-failed').on('click', function(){
        // e.preventDefault();
      
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('InvoicingFinalReport/uploadFRFile')?>",
            dataType : "JSON",
            data : $('#formAdd').serialize(),
            success: function(response){
                console.log(response);
                   
            }
        }); 

        return false;
    });


    $('#kirim-revisi').on('click', function(e){
        e.preventDefault();
       
        var myformData = new FormData(); 
        myformData.append('revisi', $("#revisi").val());
        myformData.append('send_up', $("#send_up").val());
        myformData.append('frID', $("#frID").val());
        myformData.append('bidangID', $("#bidangID").val());
        myformData.append('frMinComment', $("#frMinComment").val());
        
        
        if ($('#fr_internal').hasClass('active')){
            myformData.append('fr_internal', $("#fr_internal")[0].files[0]);
        }

        if ($('#fr_lhv').hasClass('active')){
            myformData.append('fr_lhv', $("#fr_lhv")[0].files[0]);
        }

        if ($('#fr_dsr').hasClass('active')){
            myformData.append('fr_dsr', $("#fr_dsr")[0].files[0]);
        }

        if ($('#fr_coa').hasClass('active')){
            myformData.append('fr_coa', $("#fr_coa")[0].files[0]);
        }

        if ($('#fr_cow').hasClass('active')){
            myformData.append('fr_cow', $("#fr_cow")[0].files[0]);
        }

        if ($('#fr_cds').hasClass('active')){
            myformData.append('fr_cds', $("#fr_cds")[0].files[0]);
        }



        if ($('#fr_internal_revisi').hasClass('active')){
            myformData.append('fr_internal_send', $('#fr_internal_revisi').val());
        }
        if ($('#fr_lhv_revisi').hasClass('active')){
            myformData.append('fr_lhv_send', $('#fr_lhv_revisi').val());
        }
        if ($('#fr_dsr_revisi').hasClass('active')){
            myformData.append('fr_dsr_send', $('#fr_dsr_revisi').val());
        }
        if ($('#fr_coa_revisi').hasClass('active')){
            myformData.append('fr_coa_send', $('#fr_coa_revisi').val());
        }
        if ($('#fr_cow_revisi').hasClass('active')){
            myformData.append('fr_cow_send', $('#fr_cow_revisi').val());
        }
        if ($('#fr_cds_revisi').hasClass('active')){
            myformData.append('fr_cds_send', $('#fr_cds_revisi').val());
        }

        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('InvoicingFinalReport/saveFRMinerbaFile')?>",
            dataType : "JSON",
            data :myformData,
            contentType: false,
            processData: false,
            cache: false,
            enctype: 'multipart/form-data',
            
            success: function(response){
                console.log(response);
                if(response.status == 'success'){
                   
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data Berhasil Di Kirim',
                    
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

   


     //Waktu Pengerjaan
     var set = setInterval(getTimeOut, 1000);
    function getTimeOut(){
        var id = $('#frMinDetailID').val();
        console.log(id);
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('InvoicingFinalReport/timeViewMinerba')?>",
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
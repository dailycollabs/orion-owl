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
                        <div class="card-body p-0">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <input type="hidden" name="frMarDetailID" class="form-control" id="frMarDetailID"  value="<?=$rowMarFR->frMarDetailID?>"><!-- Membuat Waktu Pengerjaan -->
                                            
                                            <tr>
                                                <th>ID Final Report</th>
                                                <td><?=$rowMarFR->frMarD_frID?></td>
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
                                                <td><?=$rowMarFR->frMar_orderID?></td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td><?=$rowMarFR->status?></td>
                                            </tr>
                                            

                                            <?php if(preg_match("/FD1/i", $rowMarFR->frInternalFile)) {?>
                                            <tr>
                                                <th>File Intrnal PDF</th>
                                                <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/finalreport/Marine/fr_Internal/'.$rowMarFR->frInternalFile;?>"> Download</a> <?=$rowMarFR->frInternalFile?> </td>
                                            </tr>
                                            <?php }?>
                                            <?php if(preg_match("/FD1/i", $rowMarFR->frSurveyFile)) {?>
                                            <tr>
                                                <th>File Survey PDF</th>
                                                <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/finalreport/Marine/fr_Survey/'.$rowMarFR->frSurveyFile;?>"> Download</a> <?=$rowMarFR->frSurveyFile?> </td>
                                            </tr>
                                            <?php } ?>

                                            <?php if($petugasLogin != $rowMarFR->frMarD_pengirimID){?>
                                            <tr>
                                                <th>Waktu</th>
                                                <td id="waktuTimeout"></td>
                                            </tr>

                                            <?php } ?>
                                            <tr>
                                                <th>Comment</th>
                                                <td><?=$rowMarFR->frMarDComment?></td>
                                            </tr>

                                            <?php if($petugasLogin == $rowMarFR->frMarD_penerimaID ){?>
                                            <?php if($waktusekarang < $rowMarFR->waktu_end){?>
                                            <?php if($rowMarFR->status != 'reject' || $rowMarFR->status != 'success'){?>
                                            <tr>
                                                <th>Action</th>
                                                <td> 
                                                    <div class="justify-content-center"> 
                                                        <?php if($this->fungsi->petugas_login()->subbidangID == 'FM'){?>
                                                            <a href="<?=site_url('approval/approval/')?>"><button class="btn btn-success mr-3">Approval</button></a>
                                                        <?php }?>
                                                        <?php if($this->fungsi->petugas_login()->subbidangID != 'SM1'){?>
                                                            <button class="btn btn-primary mr-3" id="quo-success">FR Send Down</button> 
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

                                    


                                    <!-- Final Report Revisi -->
                                    <div class="row justify-content-center mt-4">
                                        <div class="col-12">  
                                            <div class="card" style="display:none;" id="quoFailed">
                                                <div class="card-header bg-primary">
                                                    <div class="card-title">
                                                        <span>Create Revisi Draft Final Report</span>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <form action="" >
                                                        <input type="hidden" name="revisi" value="revisi" id="revisi">
                                                        <input type="hidden" name="send_up" id="send_up" value="send_up">
                                                        
                                                        <div class="form-group">
                                                        <label for="exampleInputEmail1">ID Final Report</label>
                                                            <input type="text" name="frID" class="form-control" id="exampleInputEmail1" value="<?=$rowMarFR->frMarD_frID?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Bidang ID</label>
                                                            <input type="hidden" name="bidangID" class="form-control" id="bidangID" value="<?=$rowMarFR->frMar_bidangID?>" readonly>
                                                            <input type="text" name="bidangNama" class="form-control" id="bidangNama" value="<?=$rowBidang?>" readonly>
                                                        </div>
                                                        <?php 
                                                        if(preg_match("/FD1/i", $rowMarFR->frInternalFile)) {
                                                        ?>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">File Revisi Internal</label>
                                                                <input type="file" name="fr_internal" class="form-control active" id="fr_internal" value="">
                                                            </div>
                                                        <?php }else{?>
                                                            <input type="hidden" name="fr_internal_revisi" class="form-control active" id="fr_internal_revisi" value="<?=$rowMarFR->frInternalFile?>">
                                                        <?php } ?>
                                                        
                                                        <?php 
                                                        if(preg_match("/FD1/i", $rowMarFR->frSurveyFile)) {
                                                        
                                                        ?>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">File Revisi Survey</label>
                                                                <input type="file" name="fr_survey" class="form-control active" id="fr_survey" value="">
                                                            </div>
                                                        <?php }else{ ?>

                                                            <input type="hidden" name="fr_survey_revisi" class="form-control active" id="fr_survey_revisi" value="<?=$rowMarFR->frSurveyFile?>">
                                                        <?php } ?>
                                                        
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Comment</label>
                                                            <textarea name="frMarComment" id="frMarComment" class="form-control" cols="30" rows="10"></textarea>
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
                                                        <span>Send Final Report Failed</span>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <form action="" id="formAdd">
                                                        <input type="hidden" name="send_down" id="send_down" value="send_down">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">ID Final Report</label>
                                                            <input type="text" class="form-control" name="frID" id="frID" value="<?=$rowMarFR->frMarD_frID?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Bidang</label>
                                                            <input type="hidden" name="bidangID" class="form-control" id="bidangID" value="<?=$rowMarFR->frMar_bidangID?>" readonly>
                                                            <input type="text" name="bidangNama" class="form-control" id="bidangNama" value="<?=$rowBidang?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">File FR Internal</label>
                                                            <input type="text" name="fr_internal_send" class="form-control" id="fr_internal_send" value="<?=$rowMarFR->frInternalFile?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">File FR Survey</label>
                                                            <input type="text" name="fr_survey_send" class="form-control" id="fr_survey_send" value="<?=$rowMarFR->frSurveyFile?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Comment</label>
                                                            <textarea name="frMarComment"  class="form-control" cols="30" rows="10"></textarea>
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
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('InvoicingFinalReport/uploadFRFile')?>",
            dataType : "JSON",
            data : $('#formAdd').serialize(),
            success: function(response){
                console.log(response);
                if(response.status == 'success'){
                   Swal.fire({
                       icon: 'success',
                       title: 'Berhasil!',
                       text: 'Data Berhasil Di Kirim',
                   }).then(function(){
                        window.location.assign("<?php echo base_url();?>petugas/petugasDashboard/");   
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


    $('#kirim-revisi').on('click', function(e){
        e.preventDefault();
       
        var myformData = new FormData(); 
        myformData.append('revisi', $("#revisi").val());
        myformData.append('send_up', $("#send_up").val());
        myformData.append('frID', $("#frID").val());
        myformData.append('bidangID', $("#bidangID").val());
       
        
        if ($('#fr_internal').hasClass('active')){
            myformData.append('fr_internal', $("#fr_internal")[0].files[0]);
            // myformData.append('fr_lhv', $('#fr_lhv')[0].files[0]);
        }

        if ($('#fr_survey').hasClass('active')){
            myformData.append('fr_survey', $("#fr_survey")[0].files[0]);
        }

        if ($('#fr_survey_revisi').hasClass('active')){
            myformData.append('fr_survey_send', $('#fr_survey_revisi').val());
        }

        if ($('#fr_internal_revisi').hasClass('active')){
            myformData.append('fr_internal_send', $('#fr_internal_revisi').val());
        }

        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('InvoicingFinalReport/uploadFRFile')?>",
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
                   }).then(function(){
                        window.location.assign("<?php echo base_url();?>petugas/petugasDashboard/");   
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
        var id = $('#frMarDetailID').val();
        console.log(id);
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('InvoicingFinalReport/timeViewMarine')?>",
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
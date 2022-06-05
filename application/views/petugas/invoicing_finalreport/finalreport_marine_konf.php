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
                               <span>KONFIRMASI FINAL REPORT</span>
                            </div>
                        </div>
                        <div class="card-body">
                        <a href="<?=base_url('rka/viewNewRka')?>"><button class="btn btn-success mb-4"> <i class="fas fa-home"></i> Back</button></a>
                            <div class="row">
                                
                                <div class="col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-dark">
                                            <div class="card-title">
                                                <span>KONFIRMASI FINAL REPORT</span>
                                            
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                        <input type="hidden" name="frMarDetailID" class="form-control" id="frMarDetailID"  value="<?=$rowMarFR->frMarDetailID?>"><!-- Membuat Waktu Pengerjaan -->
                                            <table class="table table-bordered">
                                            <thead>
                                        
                                            </thead>
                                                <tbody>
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
                                                    <tr>
                                                        <th>File Draft Final Report Survey</th>
                                                        <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/finalreport/Marine/fr_survey/'.$rowMarFR->frSurveyFile;?>"> Download</a> <?=$rowMarFR->frSurveyFile?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>File Draft Final Report Internal</th>
                                                        <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/finalreport/Marine/fr_internal/'.$rowMarFR->frInternalFile;?>"> Download</a>  <?=$rowMarFR->frInternalFile?></td>
                                                    </tr>
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
                                                            <?php if($this->fungsi->petugas_login()->subbidangID == 'MDM1'){?>
                                                                <a href="<?=site_url('InvoicingDraft/viewAddInvID/').$rowMarFR->frMarDetailID?>"><button class="btn btn-success mr-3">Approval</button></a>
                                                            <?php } else{ ?>
                                                                <button class="btn btn-success mr-3" id="rka-success">Final Report Success</button> 
                                                            <?php } ?>
                                                                <button class="btn btn-danger" id="rka-failed">Final Report Revisi</button> 
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                    <?php } ?>
                                                    <?php } ?>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div> 
                            </div>

                           
                            
                            <div id="rka"></div>
                            
                            <div class="row justify-content-center mt-4" style="display:none;" id="rkaSukses">
                                <div class="col-md-12 col-sm-12">
                                        <div class="card">
                                                <div class="card-header bg-success">
                                                    <div class="card-title">
                                                        <span>Send Final Report Success</span>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                
                                                <form action="" id="formAdd">
                                                    <input type="hidden" name="send_up" id="send_up" value="send_up">
                                                    <input type="hidden" name="frID" id="frID" value="<?=$rowMarFR->frMarD_frID?>">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">ID Final Report</label>
                                                        <input type="text" name="frID" class="form-control" id="exampleInputEmail1" value="<?=$rowMarFR->frMarD_frID?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Nama Bidang</label>
                                                        <input type="hidden" name="bidangID" class="form-control" id="bidangID" value="<?=$rowMarFR->frMar_bidangID?>">
                                                        <input type="text" name="bidangNama" class="form-control" id="bidangNama" value="<?=$rowBidang?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">File Final Report Internal</label>
                                                        <input type="text" name="fr_internal_send" class="form-control" id="fr_internal_send" value="<?=$rowMarFR->frInternalFile?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">File Final Report Survey</label>
                                                        <input type="text" name="fr_survey_send" class="form-control" id="fr_survey_send" value="<?=$rowMarFR->frSurveyFile?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Comment</label>
                                                        <textarea name="frMarComment"  class="form-control" cols="30" rows="10"></textarea>
                                                    </div>
                                                    <button type="submit" name="kirim" id="add" class="btn btn-primary">Kirim</button>
                                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                               
                                                </form>
                                                </div>
                                        </div>
                                    </div>        
                            </div>

                            <div class="row justify-content-center mt-4" style="display:none;" id="rkaFailed">
                                <div class="col-md-12 col-sm-12">
                                        <div class="card">
                                                <div class="card-header bg-danger">
                                                    <div class="card-title">
                                                        <span>Send Final Report Failed</span>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                
                                                    <form action="">
                                                        <input type="hidden" name="detailFRID" value="">
                                                        <input type="hidden" name="failed" id="failed" value="failed">
                                                        <input type="hidden" name="send_down" id="send_down" value="send_down">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">ID Final Report</label>
                                                            <input type="text" name="frID" class="form-control" id="frFailedID" value="<?=$rowMarFR->frMarD_frID?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Bidang ID</label>
                                                            <input type="hidden" name="bidangID" class="form-control" id="bidangID" value="<?=$rowMarFR->frMar_bidangID?>" readonly>
                                                            <input type="text" name="bidangNama" class="form-control" id="bidangNama" value="<?=$rowBidang?>" readonly>
                                                        </div>
                                                        
                                                        <div class="form-group ">
                                                        <label for="exampleInputEmail1">Upload File </label>
                                                        <input type="hidden" name="fileInternal" class="form-control" id="fileInternal" value="<?=$rowMarFR->frInternalFile?>" readonly>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="check1" id="checkFRInternal">
                                                                <label class="form-check-label" for="gridCheck1">
                                                                Final Report Internal
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="internal"></div>
                                                        <div class="form-group ">
                                                        <input type="hidden" name="fileSurvey" class="form-control" id="fileSurvey" value="<?=$rowMarFR->frSurveyFile?>" readonly>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="check2" id="checkFRSurvey">
                                                                <label class="form-check-label" for="gridCheck1">
                                                                Final Report Survey
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="survey"></div>

                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Comment</label>
                                                            <textarea name="frMarComment" id="frMarComment" class="form-control" cols="30" rows="10"></textarea>
                                                        </div>
                                            
                                                        <button type="submit" id="addFailed" name="kirim-failed" class="btn btn-primary">Kirim</button>
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

    
    $('#draft-invoiceMDMarine').on('click', function(){
        $('#rkaFailed').hide("slow");
        $('#draftInvoice-marine').show("slow");
    });

    $('#rka-success').on('click', function(){
        $('#rkaFailed').hide("slow");
        $('#rkaSukses').show("slow");
    });

    $('#rka-failed').on('click', function(){
        $('#rkaSukses').hide("slow");
        $('#rkaFailed').show("slow");
        $('#draftInvoice-marine').hide("slow");
        
    });

    var checkFRInternal = $('#checkFRInternal');
    var checkFRSurvey   = $('#checkFRSurvey');


    //Bidang Marine

    $('input').on('click',function () {
        if (checkFRInternal.is(':checked')) {
            $('#fileInternal').addClass("d-none").hide();
            $('#internal').html('<div id="failed_fRInternal" class=""><div class="form-group"><label for="exampleInputEmail1">File Revisi Internal</label><input type="file" name="fr_internal" class="form-control" id="fr_internal" value="" required></div></div>');
        } else {
            $('#failed_fRInternal').addClass("d-none").hide();
            $('#fileInternal').removeClass("d-none").hide();
        }
    });   

    $('input').on('click',function () {
        if (checkFRSurvey.is(':checked')) {
            $('#fileSurvey').addClass("d-none").hide();
            $('#survey').html('<div id="failed_fRSurvey" class=""> <div class="form-group"> <label for="exampleInputEmail1">File Revisi Survey</label><input type="file" name="fr_survey" class="form-control" id="fr_survey" value="" required></div></div>');
        } else {
            $('#failed_fRSurvey').addClass("d-none").hide();
        }
    });  


    

    $('#draftInv-upload').on('click', function(e){
        var frDetailID = $('#frDetailID').val();
          
            Swal.fire({
                icon: 'success',
                title: 'Upload Draft!',
                text: 'Create Draft Invoice!',
            }).then(function(){
                window.location.assign("<?php echo base_url();?>InvoicingDraft/viewAddInvID/"+frDetailID);
            });
                    
               
        return false;
    });

     
    $('#add').on('click', function(e){
        $('.quoID_error').empty();  
        $('.quoFile_error').empty();
        e.preventDefault();
      
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('InvoicingFinalReport/uploadFRFile')?>",
            dataType : "JSON",
            data : $('#formAdd').serialize(),
            
            success: function(response){
                console.log(response);
                if(response.status == 'success'){
                    $('.quoID').html("");
                    $('.quoFile').html("");
                    
                    if(response.id == null){
                        Swal.fire({
                        icon: 'success',
                            title: 'Berhasil',
                            text: 'Data Berhasil Di Kirim!',
                        }).then(function(){
                            window.location.assign("<?php echo base_url();?>petugas/PetugasDashboard");
                        });
                    } else{
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Create Draft Invoice!',
                        }).then(function(){
                            window.location.assign("<?php echo base_url();?>InvoicingDraft/viewAddInvID/"+response.id);
                        });
                    }  
                } 
                else{
                    console.log(response);
                    $('.quoID_error').html(response.quoID);
                    $('.quoFile_error').html(response.quoFile);
                    // .then(function() {
                    //     window.location.assign("<?php echo base_url();?>order/viewneworder");
                    // });
                    
                }   
            }
        });

       
        return false;
    });


    $('#addFailed').on('click', function(e){
        e.preventDefault();
       
        var myformData = new FormData(); 
        myformData.append('failed', $("#failed").val());
        myformData.append('send_down', $("#send_down").val());
        myformData.append('frID', $("#frFailedID").val());
        myformData.append('bidangID', $("#bidangID").val());
        myformData.append('check1', $('#checkFRInternal').prop('checked'));
        myformData.append('check2', $('#checkFRSurvey').prop('checked'));
        myformData.append('fr_internal_send', $('#fileInternal').val());
        myformData.append('fr_survey_send', $('#fileSurvey').val());
        myformData.append('frMarComment', $("#frMarComment").val());
        
      
        if (checkFRInternal.is(':checked')) {
            myformData.append('fr_internal', $('#fr_internal')[0].files[0]);
        }
        if (checkFRSurvey.is(':checked')) {
            myformData.append('fr_survey', $('#fr_survey')[0].files[0]);
        }

        console.log('click');
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
                            window.location.assign("<?php echo base_url();?>petugas/PetugasDashboard");
                    });

                }else{
                    if(response.check1 != '' || response.check2 != ''){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error Send!',
                            text: 'Tidak Ada Data Yang Di Kirim',
                        });
                    } 
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
                }else if(data.status == 'proses'){
                    if(data.statusAll == 'reject' || data.statusAll == 'success'){
                            clearInterval(set);
                            $('#waktuTimeout').html('<span class="text-danger">Waktu Selesai</span>');
                        
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
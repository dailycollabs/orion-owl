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
                            <span>Invoice Revisi</span>
                            </div>
                        </div>
                        <div class="card-body">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <input type="hidden" name="invMarDetailID" id="invMarDetailID" value="<?=$rowINV->invMarDetailID?>">
                                <div class="box-body">

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
 
                                                                <button class="btn btn-primary" id="fr-failed">FR Failed</button> 
                                                                <button class="btn btn-primary" id="inv-revisi">Invoice Revisi </button> 

                                                        </div>
                                                    </td>
                                                </tr> 
                                                <?php }?>
                                                <?php }?>
                                                <?php }?> 
                                            </tbody>
                                        </table>

                                       


                                        <!-- Quotation Revisi -->
                                        <div class="row justify-content-center mt-4">
                                            <div class="col-12">  
                                                <div class="card" style="display:none;" id="invRevisi">
                                                    <div class="card-header bg-primary">
                                                        <div class="card-title">
                                                            <span>Send Invoice Revisi ke </span>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <form action="">
                                                            <input type="hidden" name="send_up" id="send_up" value="send_up">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Bidang ID</label>
                                                                <input type="hidden" name="bidangID" class="form-control" id="bidangID" value="<?=$rowINV->invMar_bidangID?>" >
                                                                <input type="text" name="bidangNama" class="form-control" id="bidangNama" value="<?=$rowBidang?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">No Invoice</label>
                                                                <input type="text" name="invID" class="form-control" id="invID" value="<?=$rowINV->invMarD_invID?>" readonly>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">File Revisi</label>
                                                                <input type="file" name="draftInvFile" class="form-control" id="draftInvFile" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Comment</label>
                                                                <textarea name="comentINV" id="comentINV" class="form-control" cols="30" rows="10"></textarea>
                                                            </div>
                                                            <div>
                                                                <p> <span class="text-danger">*</span><span> Membuat Revisi Untuk mengirimkan ke</span></p>
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
                                                <div class="card"style="display:none;" id="frFailed">
                                                    <div class="card-header bg-primary">
                                                        <div class="card-title">
                                                            <span>Final Report Failed</span>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                    <form action="">
                                                            <input type="hidden" name="detailFRID" value="">
                                                            <input type="hidden" name="failed" id="failed" value="failed">
                                                            <input type="hidden" name="failed_invFrom" id="failed_invFrom" value="failed_invFrom">
                                                            <input type="hidden" name="frDetailID_invFrom" id="frDetailID_invFrom" value="<?=$rowFR->frMarDetailID?>">
                                                            <input type="hidden" name="send_down" id="send_down" value="send_down">
                                                            <input type="hidden" name="orderID" class="form-control" id="exampleInputEmail1" value="<?=$rowFR->frMar_orderID?>" readonly>
                                                            
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Bidang</label>
                                                                <input type="hidden" name="bidangID" class="form-control" id="bidangID" value="<?=$rowFR->frMar_bidangID?>" readonly>
                                                                <input type="text" name="bidangNama" class="form-control" id="bidangNama" value="<?=$rowBidang?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">ID Final Report</label>
                                                                <input type="text" name="frID" class="form-control" id="frFailedID" value="<?=$rowFR->frMarD_frID?>" readonly>
                                                            </div>
                                                            <div class="form-group ">
                                                            <input type="text" name="fileInternal" class="form-control" id="fileInternal" value="<?=$rowFR->frInternalFile?>" readonly>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="check1" id="checkFRInternal">
                                                                    <label class="form-check-label" for="gridCheck1">
                                                                    Final Report Internal
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div id="internal"></div>

                                                            <div class="form-group ">
                                                            <input type="text" name="fileSurvey" class="form-control" id="fileSurvey" value="<?=$rowFR->frSurveyFile?>" readonly>
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

$('#fr-failed').on('click', function(){
    $('#invRevisi').hide("slow");
    $('#frFailed').show("slow");
});

$('#inv-revisi').on('click', function(){
    $('#frFailed').hide("slow");
    $('#invRevisi').show("slow");
    
});




$('#kirim-revisi').on('click', function(e){

    $('.invID_error').empty();  
        $('.draftInvFile_error').empty();
        e.preventDefault();

        var myformData = new FormData(); 
        myformData.append('send_up', $("#send_up").val());
        myformData.append('invID', $("#invID").val());
        myformData.append('bidangID', $("#bidangID").val());
        myformData.append('draftInvFile', $('#draftInvFile')[0].files[0]);
        myformData.append('comentINV', $("#comentINV").val());
        
      

      
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('InvoicingDraft/saveMarInvFile')?>",
            dataType : "JSON",
            data : myformData,
            contentType: false,
            processData: false,
            cache: false,
            enctype: 'multipart/form-data',
            
            success: function(response){
                console.log(response);
                if(response.status == 'success'){
                    $('.invID').html("");
                    $('.draftInvFile').html("");
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data Berhasil Di Kirim!',
                    }).then(function() {
                        window.location.assign("<?php echo base_url();?>InvoicingDraft/viewfailedDraftInv/");
                    });
                   
                   
                } else if(response.status == 'error-upload'){
                    $('.draftInvFile_error').html(response.quoFile);
                }
                else{
                    console.log(response);
                    $('.invID_error').html(response.invID);
                    $('.draftInvFile_error').html(response.draftInvFile);
                    // .then(function() {
                    //     window.location.assign("<?php echo base_url();?>order/viewneworder");
                    // });
                    
                }   
            }
        });

       
        return false;
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


$('#addFailed').on('click', function(e){
        e.preventDefault();
       
        var myformData = new FormData(); 
        myformData.append('failed', $("#failed").val());
        myformData.append('failed_invFrom', $("#failed_invFrom").val());
        myformData.append('send_down', $("#send_down").val());
        myformData.append('frDetailID_invFrom', $("#frDetailID_invFrom").val());
        myformData.append('frID', $("#frFailedID").val());
        myformData.append('bidangID', $("#bidangID").val());
        myformData.append('check1', $('#checkFRInternal').prop('checked'));
        myformData.append('check2', $('#checkFRSurvey').prop('checked'));
        myformData.append('fr_internal_send', $('#fileInternal').val());
        myformData.append('fr_survey_send', $('#fileSurvey').val());
      
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
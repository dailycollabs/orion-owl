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
                               <span>Data Final Report Minerba</span>
                            </div>
                        </div>
                        <div class="card-body">
                        <a href="<?=base_url('rka/viewNewRka')?>"><button class="btn btn-success mb-4"> <i class="fas fa-home"></i> Back</button></a>
                            <div class="row">
                                
                                <div class="col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-dark">
                                            <div class="card-title">
                                                <span>Data Final Report</span>
                                            
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                        <input type="hidden" name="frMinDetailID" class="form-control" id="frMinDetailID"  value="<?=$rowMinFR->frMinDetailID?>"><!-- Membuat Waktu Pengerjaan -->
                                            <table class="table table-bordered">
                                            <thead>
                                        
                                            </thead>
                                                <tbody>
                                               
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
                                                    <tr>
                                                        <th>File Final Report INTERNAL</th>
                                                        <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/finalreport/Minerba/fr_internal/'.$rowMinFR->frInternalFile;?>"> Download</a> <?=$rowMinFR->frInternalFile?> </td>
                                                    </tr>
                                                    <tr>
                                                        <th>File Final Report LHV</th>
                                                        <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/finalreport/Minerba/fr_lhv/'.$rowMinFR->lhvFile;?>"> Download</a>  <?=$rowMinFR->lhvFile?> </td>
                                                    </tr>

                                                    <tr>
                                                        <th>File Final Report DSR</th>
                                                        <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/finalreport/Minerba/fr_dsr/'.$rowMinFR->dsrFile;?>"> Download</a>  <?=$rowMinFR->dsrFile?> </td>
                                                    </tr>
                                                    <tr>
                                                        <th>File Final Report COA</th>
                                                        <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/finalreport/Minerba/fr_coa/'.$rowMinFR->coaFile;?>"> Download</a>  <?=$rowMinFR->coaFile?> </td>
                                                    </tr>

                                                    <tr>
                                                        <th>File Final Report COW</th>
                                                        <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/finalreport/Minerba/fr_cow/'.$rowMinFR->cowFile;?>"> Download</a>  <?=$rowMinFR->cowFile?> </td>
                                                    </tr>
                                                    <tr>
                                                        <th>File Final Report CDS</th>
                                                        <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/finalreport/Minerba/fr_cds/'.$rowMinFR->cdsFile;?>"> Download</a>  <?=$rowMinFR->cdsFile?> </td>
                                                    </tr>
                                                    <?php if($petugasLogin != $rowMinFR->frMinD_pengirimID){?>
                                                    <tr>
                                                    <th>Waktu</th>
                                                        <td id="waktuTimeout"></td>
                                                    </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <th>Comment</th>
                                                        <td><?=$rowMinFR->frMinDComment?></td>
                                                    </tr>

                                                    <?php if($petugasLogin == $rowMinFR->frMinD_penerimaID ){?>
                                                    <?php if($waktusekarang < $rowMinFR->waktu_end){?>
                                                    <?php if($rowMinFR->status != 'reject' || $rowMinFR->status != 'success'){?>
                                                    <tr id="action">
                                                    <th>Action</th>
                                                        <td> 
                                                            <div class="justify-content-center" > 
                                                            <?php if($this->fungsi->petugas_login()->subbidangID == 'FM'){?>
                                                                <a href="<?=site_url('InvoicingDraft/viewAddInvID/').$rowMinFR->frMinDetailID?>"><button class="btn btn-success mr-3">Approval</button></a>
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
                                                <!-- <input type="text" name="add" id="add" value="add"> -->
                                                <input type="hidden" name="orderID" class="form-control" id="exampleInputEmail1" value="<?=$rowMinFR->frMin_orderID?>" readonly>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Bidang</label>
                                                    <input type="hidden" name="bidangID" class="form-control"  value="<?=$rowMinFR->frMin_bidangID?>" >
                                                    <input type="text" name="bidangNama" class="form-control"  value="<?=$rowBidang?>" readonly>                 
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">ID Final Report</label>
                                                    <input type="text" name="frID" class="form-control" value="<?=$rowMinFR->frMinD_frID?>" readonly>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">File Final Report Internal</label>
                                                    
                                                    <input type="text" name="fr_internal_send" class="form-control" id="fr_internal_send" value="<?=$rowMinFR->frInternalFile?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">File Final Report LHV</label>
                                                    <input type="text" name="fr_lhv_send" class="form-control" id="fr_lhv_send" value="<?=$rowMinFR->lhvFile?>" readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">File Final Report DSR</label>
                                                    
                                                    <input type="text" name="fr_dsr_send" class="form-control" id="fr_dsr_send" value="<?=$rowMinFR->dsrFile?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">File Final Report COA</label>
                                                    <input type="text" name="fr_coa_send" class="form-control" id="fr_coa_send" value="<?=$rowMinFR->coaFile?>" readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">File Final Report COW</label>
                                                    
                                                    <input type="text" name="fr_cow_send" class="form-control" id="fr_cow_send" value="<?=$rowMinFR->cowFile?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">File Final Report CDS</label>
                                                    <input type="text" name="fr_cds_send" class="form-control" id="fr_cds_send" value="<?=$rowMinFR->cdsFile?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Comment</label>
                                                    <textarea name="frMinComment" id="" class="form-control" cols="30" rows="10"></textarea>
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
                                                            <input type="hidden" name="failed" value="failed">
                                                            <input type="hidden" name="send_down" id="send_down" value="send_down">
                                               
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Bidang</label>
                                                            <input type="hidden" name="bidangID" class="form-control" id="bidangID" value="<?=$rowMinFR->frMin_bidangID?>" readonly>
                                                            <input type="text" name="bidangNama" class="form-control"  value="<?=$rowBidang?>" readonly>                 
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">ID Final Report</label>
                                                            <input type="text" name="frID" class="form-control" id="frID" value="<?=$rowMinFR->frMinD_frID?>" readonly>
                                                        </div>
                                                        <div class="form-group ">
                                                        <input type="hidden" name="fileInternal" class="form-control" id="fileInternal" value="<?=$rowMinFR->frInternalFile?>" readonly>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="check1" id="checkFRInternal">
                                                                <label class="form-check-label" for="gridCheck1">
                                                                Final Report Internal
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="internal"></div>

                                                        <div class="form-group"> 
                                                        <input type="hidden" name="fr_lhv_send" class="form-control" id="fileLhv" value="<?=$rowMinFR->lhvFile?>" readonly>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="check2" id="checkFRLhv">
                                                                <label class="form-check-label" for="gridCheck1">
                                                                Final Report LHV
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="lhv"></div>

                                                        <div class="form-group ">
                                                        <input type="hidden" name="fr_dsr_send" class="form-control" id="fileDsr" value="<?=$rowMinFR->dsrFile?>" readonly>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="check3" id="checkFRDsr">
                                                                <label class="form-check-label" for="gridCheck1">
                                                                Final Report DSR
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="dsr"></div>
                                                        
                                                        <div class="form-group"> 
                                                        <input type="hidden" name="fr_coa_send" class="form-control" id="fileCoa" value="<?=$rowMinFR->coaFile?>" readonly>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="check4" id="checkFRCoa">
                                                                <label class="form-check-label" for="gridCheck1">
                                                                Final Report COA
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="coa"></div>

                                                        <div class="form-group ">
                                                        <input type="hidden" name="fr_cow_send" class="form-control" id="fileCow" value="<?=$rowMinFR->cowFile?>" readonly>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="check5" id="checkFRCow">
                                                                <label class="form-check-label" for="gridCheck1">
                                                                Final Report COW
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="cow"></div>
                                                        
                                                        <div class="form-group"> 
                                                        <input type="hidden" name="fr_cds_send" class="form-control" id="fileCds" value="<?=$rowMinFR->cdsFile?>" readonly>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="check6" id="checkFRCds">
                                                                <label class="form-check-label" for="gridCheck1">
                                                                Final Report CDS
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="cds"></div>
                                                        
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Comment</label>
                                                            <textarea name="frMinComment" id="frMinComment" class="form-control" cols="30" rows="10"></textarea>
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

    var checkFRSurvey   = $('#CheckFRSurvey');
    var checkFRInternal = $('#checkFRInternal');
    var checkFRLhv      = $('#checkFRLhv');
    var checkFRDsr      = $('#checkFRDsr');
    var checkFRCoa      = $('#checkFRCoa');
    var checkFRCow      = $('#checkCow');
    var checkFRCds      = $('#checkFRCds');

  

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
 

    $('input').on('click',function () {
        if (checkFRLhv.is(':checked')) {
            $('#fileLhv').addClass("d-none").hide();
            $('#lhv').html('<div id="failed_fRLhv" class=""> <div class="form-group"> <label for="exampleInputEmail1">File Revisi Lhv</label><input type="file" name="fr_lhv" class="form-control" id="fr_lhv" value="" required></div></div>');
        } else {
            $('#failed_fRLhv').addClass("d-none").hide();
        }
    });

     $('input').on('click',function () {
        if (checkFRDsr.is(':checked')) {
            $('#fileDsr').addClass("d-none").hide();
            $('#dsr').html('<div id="failed_fRDsr" class=""><div class="form-group"><label for="exampleInputEmail1">File Revisi Internal</label><input type="file" name="fr_dsr" class="form-control" id="fr_dsr" value="" required></div></div>');
        } else {
            $('#failed_fRDsr').addClass("d-none").hide();
        }
    });  

    $('input').on('click',function () {
        if (checkFRCoa.is(':checked')) {
            $('#fileCoa').addClass("d-none").hide();
            $('#coa').html('<div id="failed_fRCoa" class=""> <div class="form-group"> <label for="exampleInputEmail1">File Revisi Lhv</label><input type="file" name="fr_coa" class="form-control" id="fr_coa" value="" required></div></div>');
        } else {
            $('#failed_fRCoa').addClass("d-none").hide();
        }
    });

     $('input').on('click',function () {
        if (checkFRCow.is(':checked')) {
            $('#fileCow').addClass("d-none").hide();
            $('#cow').html('<div id="failed_fRCow" class=""><div class="form-group"><label for="exampleInputEmail1">File Revisi Internal</label><input type="file" name="fr_cow" class="form-control" id="fr_cow" value="" required></div></div>');
        } else {
            $('#failed_fRCow').addClass("d-none").hide();
        }
    });  

    $('input').on('click',function () {
        if (checkFRCds.is(':checked')) {
            $('#fileCds').addClass("d-none").hide();
            $('#cds').html('<div id="failed_fRCds" class=""> <div class="form-group"> <label for="exampleInputEmail1">File Revisi Lhv</label><input type="file" name="fr_cds" class="form-control" id="fr_cds" value="" required></div></div>');
        } else {
            $('#failed_fRCds').addClass("d-none").hide();
        }
    }); 


     
    $('#add').on('click', function(e){
        $('.quoID_error').empty();  
        $('.quoFile_error').empty();
        e.preventDefault();

      
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('InvoicingFinalReport/saveFRMinerbaFile')?>",
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
                        title: 'Berhasil!',
                        text: 'You clicked the button!',
                        })
                        .then(function(){
                            window.location.assign("<?php echo base_url();?>petugas/PetugasDashboard");
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




 


    //Bidang Marine

   


    $('#addFailed').on('click', function(e){
        // $('.quoID_error').empty();  
        // $('.quoFile_error').empty();
        e.preventDefault();
       
        var myformData = new FormData(); 
        myformData.append('failed', $("#failed").val());
        myformData.append('send_down', $("#send_down").val());
        myformData.append('bidangID', $("#bidangID").val());
        myformData.append('frID', $("#frID").val());
        
        myformData.append('check1', $('#checkFRInternal').prop('checked'));
        myformData.append('check2', $('#checkFRLhv').prop('checked'));
        myformData.append('check3', $('#checkFRDsr').prop('checked'));
        myformData.append('check4', $('#checkFRCoa').prop('checked'));
        myformData.append('check5', $('#checkFRCow').prop('checked'));
        myformData.append('check6', $('#checkFRCds').prop('checked'));

        myformData.append('fr_internal_send', $('#fileInternal').val());
        myformData.append('fr_lhv_send', $('#fileLhv').val());
        myformData.append('fr_dsr_send', $('#fileDsr').val());
        myformData.append('fr_coa_send', $('#fileCoa').val());
        myformData.append('fr_cow_send', $('#fileCow').val());
        myformData.append('fr_cds_send', $('#fileCds').val());

        if (checkFRInternal.is(':checked')) {
            myformData.append('fr_internal', $('#fr_internal')[0].files[0]);
        }

        if (checkFRLhv.is(':checked')) {
            myformData.append('fr_lhv', $('#fr_lhv')[0].files[0]);
        }

        if (checkFRDsr.is(':checked')) {
            myformData.append('fr_dsr', $('#fr_dsr')[0].files[0]);
        }

        if (checkFRCoa.is(':checked')) {
            myformData.append('fr_coa', $('#fr_coa')[0].files[0]);
        }

        if (checkFRCow.is(':checked')) {
            myformData.append('fr_cow', $('#fr_cow')[0].files[0]);
        }

        if (checkFRCds.is(':checked')) {
            myformData.append('fr_cds', $('#fr_cds')[0].files[0]);
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
                    if(response.check1 != '' || response.check2 != '' || response.check3 != '' || 
                    response.check4 != '' || response.check5 != '' || response.check6 != ''){
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
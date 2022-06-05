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
                        
                           
                
                           
                      
                        <div class="card-body">
                        <a href="<?=base_url('spk/viewgetNewSpk')?>"><button class="btn btn-success mb-4"> <i class="fas fa-home"></i> Back</button></a>
                            <div class="row">
                                
                               
                                <div class="col-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-dark">
                                            <div class="card-title">
                                                <span>Upload Draft Final Report</span>
                                            </div>
                                        </div>
                                        
                                        <div class="card-body">
                                       
                                        <form action="">
                                       
                                                <input type="hidden" name="add" class="form-control" id="add" value="add">
                                                <input type="hidden" name="send_up" class="form-control" id="send_up" value="send_up">
                                                <?php if($this->fungsi->petugas_login()->bidangID == 1){ ?>
                                                
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">ID Final Report</label>
                                                    <input type="text" name="frID" class="form-control" id="frID" value="<?=$row->frMarID?>" readonly>
                                                    <span class="frID_error text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Bidang</label>
                                                    <input type="hidden" name="bidangID" class="form-control" id="bidangID" value="<?=$row->frMar_bidangID?>">
                                                    <input type="text" name="bidang" class="form-control" id="" value="Marine" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Final Report Internal</label>
                                                    <input type="file" name="fr_internal" class="form-control" id="fr_internal">
                                                    <span class="fr_internal_error text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Final Report Survey</label>
                                                    <input type="file" name="fr_survey" class="form-control" id="fr_survey">
                                                    <span class="fr_survey_error text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Comment</label>
                                                    <textarea name="frMarComment" id="frMarComment" class="form-control" cols="10" rows="5"></textarea>
                                                </div>
                                                <button type="submit" name="kirim" id="add-marine" class="btn btn-primary">Submit</button>
                                      
                                                <?php }else if($this->fungsi->petugas_login()->bidangID == 2){?>
                                                   
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Bidang</label>
                                                        <input type="hidden" name="bidangID" class="form-control" id="bidangID" value="<?=$row->frMin_bidangID?>">
                                                        <input type="text" name="bidang" class="form-control" id="bidang" value="Minerba" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">ID Final Report</label>
                                                        <input type="text" name="frID" class="form-control" id="frID" value="<?=$row->frMinID?>" readonly>
                                                        <span class="frID_error text-danger"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">No LHV</label>
                                                        <input type="text" name="lhvID" class="form-control" id="lhvID" value="<?=$row->frMinlhvNo?>" readonly>
                                                        <span class="lhvID_error text-danger"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">File FR Internal</label>
                                                        <input type="file" name="fr_internal" class="form-control" id="fr_internal">
                                                        <span class="fr_internal_error text-danger"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">File LHV</label>
                                                        <input type="file" name="fr_lhv" class="form-control" id="fr_lhv">
                                                        <span class="fr_lhv_error text-danger"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">File DSR</label>
                                                        <input type="file" name="fr_dsr" class="form-control" id="fr_dsr">
                                                        <span class="fr_dsr_error text-danger"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">File CoA</label>
                                                        <input type="file" name="fr_coa" class="form-control" id="fr_coa">
                                                        <span class="fr_coa_error text-danger"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">File CoW</label>
                                                        <input type="file" name="fr_cow" class="form-control" id="fr_cow">
                                                        <span class="fr_cow_error text-danger"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">File CDS</label>
                                                        <input type="file" name="fr_cds" class="form-control" id="fr_cds">
                                                        <span class="fr_cds_error text-danger"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Comment</label>
                                                        <textarea name="frMinComment" id="frMinComment" class="form-control" cols="10" rows="5"></textarea>
                                                    </div>
                                                    <button type="submit" name="kirim" id="add-minerba" class="btn btn-primary">Submit</button>
                                                <?php } ?>
                                             
                                                
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

    $('#add-marine').on('click', function(e){
        $('.fr_internal_error').empty();  
        $('.fr_survey_error').empty();
        e.preventDefault();

        var myformData = new FormData(); 
        
        myformData.append('add', $("#add").val());
        myformData.append('send_up', $("#send_up").val());
        myformData.append('frID', $("#frID").val());
        myformData.append('bidangID', $("#bidangID").val());
        myformData.append('fr_survey', $('#fr_survey')[0].files[0]);
        myformData.append('fr_internal', $('#fr_internal')[0].files[0]);
        myformData.append('frMarComment', $("#frMarComment").val());
        
      
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('InvoicingFinalReport/uploadFRFile')?>",
            dataType : "JSON",
            data : myformData,
            contentType: false,
            processData: false,
            cache: false,
            enctype: 'multipart/form-data',
            
            success: function(response){
                console.log(response);
                if(response.status == 'success'){
                    $('.quoID').html("");
                    $('.quoFile').html("");
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data Berhasil Di Kirim!',
                    })
                    .then(function() {
                        window.location.assign("<?php echo base_url();?>WorkflowSpk/viewNewspk");
                    });
                   
                } else if(response.status == 'error-upload'){
                    $('.fr_internal_error').html(response.fr_internal);
                    $('.fr_survey_error').html(response.fr_survey);
                }
                else{
                    $('.fr_internal_error').html(response.fr_internal);
                    $('.fr_survey_error').html(response.fr_survey);
                }   
            }
        });

       
        return false;
    });



    $('#add-minerba').on('click', function(e){
        $('.fr_internal_error').empty();
        $('.fr_lhv_error').empty();
        $('.fr_dsr_error').empty();
        $('.fr_coa_error').empty();
        $('.fr_cow_error').empty();
        $('.fr_cds_error').empty();
        e.preventDefault();

        var myformData = new FormData(); 
        myformData.append('send_up', $("#send_up").val());
        myformData.append('add', $("#add").val());
        myformData.append('frID', $("#frID").val());
        myformData.append('bidangID', $("#bidangID").val());
        myformData.append('lhvID', $("#lhvID").val());
        myformData.append('fr_internal', $('#fr_internal')[0].files[0]);
        myformData.append('fr_lhv', $('#fr_lhv')[0].files[0]);
        myformData.append('fr_dsr', $('#fr_dsr')[0].files[0]);
        myformData.append('fr_coa', $('#fr_coa')[0].files[0]);
        myformData.append('fr_cow', $('#fr_cow')[0].files[0]);
        myformData.append('fr_cds', $('#fr_cds')[0].files[0]);
        myformData.append('frMinComment', $("#frMinComment").val());
        

        console.log("Click");
      
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('InvoicingFinalReport/saveFRMinerbaFile')?>",
            dataType : "JSON",
            data : myformData,
            contentType: false,
            processData: false,
            cache: false,
            enctype: 'multipart/form-data',
            
            success: function(response){
                console.log(response);
                console.log(response);
                if(response.status == 'success'){
                    $('.quoID').html("");
                    $('.quoFile').html("");
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data Berhasil Di Kirim!',
                    })
                    .then(function() {
                        window.location.assign("<?php echo base_url();?>WorkflowSpk/viewNewspk");
                    });
                   
                   
                } else if(response.status == 'error-upload'){
                    $('.fr_internal_error').html(response.fr_internal);
                    $('.fr_lhv_error').html(response.fr_lhv);
                    $('.fr_dsr_error').html(response.fr_dsr);
                    $('.fr_coa_error').html(response.fr_coa);
                    $('.fr_cow_error').html(response.fr_cow);
                    $('.fr_cds_error').html(response.fr_cds);
                }
                else{
                    console.log(response);
                    $('.fr_internal_error').html(response.fr_internal);
                    $('.fr_lhv_error').html(response.fr_lhv);
                    $('.fr_dsr_error').html(response.fr_dsr);
                    $('.fr_coa_error').html(response.fr_coa);
                    $('.fr_cow_error').html(response.fr_cow);
                    $('.fr_cds_error').html(response.fr_cds);
                    
                    // .then(function() {
                    //     window.location.assign("<?php echo base_url();?>order/viewneworder");
                    // });
                    
                } 
            }
        });

       
        return false;
    });


    });

</script>

</body>
</html>
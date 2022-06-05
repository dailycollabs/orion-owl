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
                            <div class="d-flex justify-content-between">
                                <div class="card-title">CREATE INVOICING DRAFT</div>
                                <div id="waktuTimeout" class="card-title"></div>
                            </div>
                        </div>
                        <div class="card-body">
                        <a href="<?=base_url('order/neworder')?>"><button class="btn btn-success mb-4"> <i class="fas fa-home"></i> Back</button></a>
                            <div class="row">
                                
                                <div class="col-md-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-dark">
                                            <div class="card-title">
                                                <span>Data Project</span>
                                              
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                        <input type="hidden" id="frMarDetailID" value="<?=$row->frMarDetailID?>">
                                            <table class="table table-bordered">
                                            <thead>
                                        
                                            </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>ID Final Report</th>
                                                        <td><?=$row->frMarD_frID?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>NO SPK</th>
                                                        <td><?=$rowSPK->spkNo?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>NO JOBDESC</th>
                                                        <td><?=$rowJobDesc->jobdApprovNo?></td>
                                                    </tr>
                                                    

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                <?php if($rowINV == null){?>
                                    <div class="card">
                                        <div class="card-header bg-dark">
                                            <div class="card-title">
                                                <span>Create Draft Final Report Marine</span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form action="" id="formAdd">
                                             
                                                <input type="hidden" name="frDetailID" class="form-control" id="exampleInputEmail1" value="<?=$row->frMarDetailID?>">
                                                <input type="hidden" name="spkID" class="form-control" id="exampleInputEmail1" value="<?=$row->frMar_spkID?>">
                                                <input type="hidden" name="jobdescID" class="form-control" id="exampleInputEmail1" value="<?=$row->frMar_jobdaDetailID?>">
                                                <input type="hidden" name="quoDetailID" class="form-control" id="exampleInputEmail1" value="<?=$row->frMar_quoDetailID?>">
                                                <input type="hidden" name="orderID" class="form-control" id="exampleInputEmail1" value="<?=$row->frMar_orderID?>">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Bidang</label>
                                                    <input type="hidden" name="bidangID" class="form-control bidangID" id="bidangID" value="<?=$row->frMar_bidangID?>" >
                                                    <input type="text" name="bidangNama" class="form-control bidangNama" id="bidangNama" value="<?=$rowBidang?>" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">ID Final Report</label>
                                                    <input type="text" name="frID" class="form-control" id="frID" value="<?=$row->frMarD_frID?>" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">NO INVOICE</label>
                                                    <input type="text" name="invNo" class="form-control invNoMar" id="invNo" value="" >
                                                    <span class="invID_error text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">NO REFERENCES</label>
                                                    <input type="text" name="referencingNo" class="form-control referencingNo" id="referencingID" value="" >
                                                    <span class="referencingID_error text-danger"></span>
                                                </div>

                                                <button type="reset" class="btn btn-secondary">Reset</button>
                                                <button type="submit" id="add" name="add" class="btn btn-primary">Create Draft</button>

                                            </form>
                                        </div>
                                    </div>
                                <?php }else{ ?>
                                    <?php if($rowInvDetail == null){?>
                                        <div class="card">
                                        <div class="card-header bg-dark">
                                            <div class="card-title">
                                                <span>Upload Draft Invoicing</span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">invoice ID</label>
                                                    <input type="text" name="invID" class="form-control lhvID" id="invID" value="<?=$rowINV->invMarID?>" >
                                                </div>
                                                <button type="submit" id="upload-draft" name="upload-draft" class="btn btn-primary">Upload Draft</button>
                                        </div>
                                    </div>
                                    <?php } ?>
                                <?php } ?>

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

    $('#add').on('click', function(){

      
        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('InvoicingDraft/addInvID')?>",
            dataType : "JSON",
            data : $('#formAdd').serialize(),
            success: function(response){
                console.log(response);
                if(response.status == 'success'){
                    console.log("sukses");
                    $('.invID').html("");
                    $('.referencingID').html("");
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'ID Berhasil Di Buat!',
                    
                    }).then(function() {
                        window.location.assign("<?php echo base_url();?>InvoicingDraft/viewUploadInv/"+ response.id);
                    });
                   
                }else{
                    // Swal.fire({
                    //     icon: 'error',
                    //     title: 'Gagal Upload!',
                    //     text: 'You clicked the button!',
                    
                    // }).then(function() {
                    //     window.location.assign("<?php echo base_url();?>InvoicingFinalReport/viewNewFR/");
                    // });
                    $('.invID_error').html(response.invID);
                    $('.referencingID_error').html(response.referencingID);
                }   
            }
        });
        return false;
    });

    $('#upload-draft').on('click', function(){
        var invID = $('#invID').val();
      
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Upload File!',
            
            }).then(function() {
                window.location.assign("<?php echo base_url();?>InvoicingDraft/viewUploadInv/"+ invID);
            });
           
           
   

        return false;
    });

    // oldfrMarDetailID

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
                if(data.statusAll == 'reject'){
                    clearInterval(set);
                    $('#waktuTimeout').html('<span class="text-danger">Waktu Selesai</span>');
                    $('#action').hide();

                    Swal.fire({
                        icon: 'error',
                        title: 'Data Reject!',
                        text: 'Data ini telah di Reject',
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    }).then(function(){
                        window.location.assign("<?php echo base_url();?>petugas/petugasDashboard/");   
                    });
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
                            $('#waktuTimeout').html('<span class="text-danger">Waktu Selesai</span>');
                        }
                    
                }
            }
        });
    }



});



</script>





</body>

</html>
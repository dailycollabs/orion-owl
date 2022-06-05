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
                            <span>JOBDESC KONFIRMASI</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <input type="hidden" name="jobDetailID" id="jobDetailID" value="<?=$rowJobd->jobdaDetailID?>">
                                <div class="box-body">

                                        <table class="table table-bordered">
                                            <tbody>
                                            
                                                <tr>
                                                    <th>No Jobdesc</th>
                                                    <td><?=$rowJobd->jobdApprovNo?></td>
                                                </tr>
                                                <tr>
                                                    <th>No Quotation</th>
                                                    <td><?=$rowQuo->quoNo?></td>
                                                </tr>
                                                <tr>
                                                    <th>No Order</th>
                                                    <td><?=$rowOrder->orderID?></td>
                                                </tr>
                                                <tr>
                                                    <th>File Approval Job Desc</th>
                                                    <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/approval_jobd/'.$rowBidang.'/'.$rowJobd->jobdaDFile;?>">Download</a>  <?=$rowJobd->jobdaDFile?>  </td>
                                                </tr>
                                                <tr>
                                                    <th>Waktu</th>
                                                    <td id="waktuTimeout"></td>
                                                </tr>
                                                <?php if($petugasLogin == $rowJobd->jobdaD_penerimaID ){?>
                                                <?php if($waktusekarang < $rowJobd->waktu_end){?>
                                                <?php if($rowJobd->status != 'reject' || $rowJobd->status != 'success'){?>
                                                <tr>
                                                    <th>Action</th>
                                                    <td> 
                                                        <div class="justify-content-center"> 
                                                            <?php if($this->fungsi->petugas_login()->subbidangID == 'AM1' || $this->fungsi->petugas_login()->subbidangID == 'AM2'){?>
                                                                <a href="<?=site_url('WorkflowSpk/viewCreatespk/').$rowJobd->jobdaDetailID?>"><button class="btn btn-success mr-3">Create SPK</button></a>
                                                            <?php } else{?>
                                                                <button class="btn btn-success mr-3" id="quo-success">Approval Workflow</button> 
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
                                                            <span>Send Approval Workflow | JOB DESCRIPSI</span>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                    <form action="" id="formAdd">

                                                            <div class="form-group">
                                                            <label for="exampleInputEmail1">No JOBDESC</label>
                                                            <input type="hidden" name="jobdID" id="jobdID" class="form-control jobdID"  value="<?=$rowJobd->jobdaD_jobdApprovID?>">
                                                            <input type="text" name="jobdNo" id="jobdID" class="form-control jobdNo"  value="<?=$rowJobd->jobdApprovNo?>">
                                                            </div>

                                                            <div class="form-group">
                                                            <label for="exampleInputEmail1">Nama Bidang</label>
                                                            <input type="hidden" name="bidangID" id="bidangID" class="form-control bidangID"  value="<?=$rowJobd->jobdA_bidangID?>">
                                                            <input type="text" name="bidangNama" id="bidangID" class="form-control bidangNama"  value="<?=$rowBidang?>">
                                                            
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">File Quotation</label>
                                                                <input type="text" name="jobdFile-kirim" class="form-control jobdFile-kirim" id="jobdFile-kirim" value="<?=$rowJobd->jobdaDFile?>">
                                                                <span class="jobdFile_error text-danger"></span>
                                                        
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Comment</label>
                                                                <textarea name="jobdComment" id="" class="form-control" cols="10" rows="5"></textarea>
                                                        
                                                            </div>
                                                        
                                                            <button type="submit" id="add" name="add" class="btn btn-primary">Submit</button>
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

$('#add').on('click', function(){

      
$.ajax({
    type : "POST",
    url  : "<?php echo base_url('WorkflowJobdesc/saveJobDescFile')?>",
    dataType : "JSON",
    data : $('#formAdd').serialize(),
    success: function(response){
        console.log(response);
        if(response.status == 'success'){
            console.log("sukses");
            $('.quoID').html("");
            $('.jobdID').html("");
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data Berhasil Di kirim!',
            
            })
            .then(function() {
                window.location.assign("<?php echo base_url();?>WorkflowJobdesc/viewNewApproval/");
            });
           
        }else{
            $('.quoID_error').html(response.quoID);
            $('.jobdID_error').html(response.jobdID);
        }   
    }
});
return false;
});

//Waktu Pengerjaan
var set = setInterval(getTimeOut, 1000);
    function getTimeOut(){
        var id = $('#jobDetailID').val();
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('WorkflowJobdesc/timeViewMarine')?>",
            dataType : "JSON",
            data : {id:id},
            success: function(data){
                // console.log(data);
                $('#status').text(data.status);
              
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
        });
    }



});


</script>





</body>

</html>
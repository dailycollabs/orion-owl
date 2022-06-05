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
                        <a href="<?=base_url('order/neworder')?>"><button class="btn btn-success mb-4"> <i class="fas fa-home"></i> Back</button></a>
                            <div class="row">
                                
                               
                                <div class="col-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-dark">
                                        <div class="d-flex justify-content-between">
                                                <div class="card-title">CREATE APPROVAL PENCAIRAN BUDGET</div>
                                                <div id="waktuTimeout" class="card-title"></div>
                                            </div>
                                           
                                        </div>
                                        
                                        <div class="card-body">
                                        <input type="hidden" name="budgethonorID" class="form-control" id="budgethonorID"  value="<?=$row->budgethonorID?>"><!-- Membuat Waktu Pengerjaan -->
                                        <form action="" id="formAdd">
                                                <input type="hidden" name="send_up" id="send_up" value="send_up">
                                                <input type="hidden" name="add_new" id="add_new" value="add_new">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">NO Budget Honor</label>
                                                    <input type="hidden" name="budgethonorID" id="budgethonorID" class="form-control"  value="<?=$row->budgethonorID?>">
                                                    <input type="text" name="budgethonorNo" id="budgethonorNo" class="form-control"  value="<?=$row->budgethonorNo?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">ID Referensi Pengeluaran</label>
                                                    <input type="text" name="refID" id="refID" class="form-control"  value="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">File Approval</label>
                                                    <input type="file" name="approvalFile" class="form-control approvalFile" id="approvalFile" required>
                                                    <span class="draftInvFile_error text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Comment</label>
                                                    <textarea name="approvalComment" id="approvalComment" class="form-control" cols="10" rows="5"></textarea>
                                                </div>
                                             
                                                <button type="submit" id="add" name="add" class="btn btn-primary">Submit</button>
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

    $('#add').on('click', function(e){
        $('.invID_error').empty();  
        $('.draftInvFile_error').empty();
        e.preventDefault();

        var myformData = new FormData(); 
        myformData.append('send_up', $("#send_up").val());
        myformData.append('add_new', $("#add_new").val());
        myformData.append('refID', $("#refID").val());
        myformData.append('budgethonorID', $("#budgethonorID").val());
        myformData.append('approvalFile', $('#approvalFile')[0].files[0]);
        myformData.append('approvalComment', $("#approvalComment").val());

        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('IntHonorarium/addApproval')?>",
            dataType : "JSON",
            data : myformData,
            contentType: false,
            processData: false,
            cache: false,
            enctype: 'multipart/form-data',
            
            success: function(response){
                console.log(response);
                if(response.status == 'success'){

                    
                    Swal.fire({
                        icon: 'success',
                        title: 'FileBerhasil Di Upload!',
                        text: 'You clicked the button!',
                    }).then(function() {
                        window.location.assign("<?php echo base_url();?>IntHonorarium/viewNewBudgetHonor");
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


    //Waktu Pengerjaan
    var set = setInterval(getTimeOut, 1000);
    function getTimeOut(){
        var id = $('#budgethonorID').val();
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('IntHonorarium/timeViewBudgetHonor')?>",
            dataType : "JSON",
            data : {id:id},
            success: function(data){
                // console.log(data);
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
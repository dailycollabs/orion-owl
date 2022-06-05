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
                        <a href="<?=base_url('WorkflowOrder/viewneworder')?>"><button class="btn btn-success mb-4"> <i class="fas fa-home"></i> Back</button></a>
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-dark">
                                        <div class="d-flex justify-content-between">
                                            <div class="card-title">UPLOAD FILE QUOTATION</div>
                                            <div id="waktuTimeout" class="card-title"></div>
                                        </div>
                                        </div>
                                        <div class="card-body">
                                            <form action="" id="formAdd">
                                                <input type="hidden" name="send_up" id="send_up" value="send_up">
                                                <input type="hidden" name="new_upload" id="new_upload" value="new_upload">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Bidang</label>
                                                    <input type="text" name="bidangNama" id="bidangNama" class="form-control"  value="<?=$row->bidangNama?>">
                                                    <input type="hidden" name="bidangID" id="bidangID" class="form-control"  value="<?=$row->quo_bidangID?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No Quotation</label>
                                                    <input type="text" name="quoID" id="quoID" class="form-control"  value="<?=$row->quoID?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">ID Order</label>
                                                    <input type="text" name="orderID" id="orderID" class="form-control"  value="<?=$row->quo_orderID?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">File Quotation</label>
                                                    <input type="file" name="quoFile" class="form-control-file quoFile" id="quoFile" required>
                                                    <span class="quoFile_error text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Comment</label>
                                                    <textarea name="quoComment" id="quoComment" class="form-control" cols="10" rows="5"></textarea>
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
        $('.quoID_error').empty();  
        $('.quoFile_error').empty();
        e.preventDefault();

        var myformData = new FormData(); 
        myformData.append('send_up', $("#send_up").val());
        myformData.append('quoID', $("#quoID").val());
        myformData.append('new_upload', $("#new_upload").val());
        myformData.append('orderID', $("#orderID").val());
        myformData.append('bidangID', $("#bidangID").val());
        myformData.append('quoFile', $('#quoFile')[0].files[0]);
        myformData.append('quoComment', $("#quoComment").val());
        
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('WorkflowQuotation/saveQuoFile')?>",
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
                        window.location.assign("<?php echo base_url();?>ClientProject/viewNewProject");
                    });

                } else if(response.status == 'error-upload'){
                    $('.quoFile_error').html(response.quoFile);

                } else if(response.status == 'reject'){
                    Swal.fire({
                        icon: 'error',
                        title: 'Data Telah Di Reject!',
                        text: 'You clicked the button!',
                    })
                    .then(function() {
                        window.location.assign("<?php echo base_url();?>WorkflowOrder/viewneworder");
                    });
                }else{
                    console.log(response);
                    $('.quoID_error').html(response.quoID);
                    $('.quoFile_error').html(response.quoFile); 
                }   
            }
        });
        return false;
    });


     //Waktu Pengerjaan
     var set = setInterval(getTimeOut, 1000);
    function getTimeOut(){
        var id = $('#orderID').val();
        console.log(id);
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('WorkflowOrder/timeViewOrder')?>",
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
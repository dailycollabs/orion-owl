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
                                                <div class="card-title">Create List Belanja (periodic dan Insidentil)</div>
                                                <div id="waktuTimeout" class="card-title"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="card-body">
                                            <form action="" id="formAdd">
                                                <input type="hidden" name="send_down" id="send_down" value="send_down">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Bidang</label>
                                                    <input type="hidden" name="bidangID" id="bidangID" class="form-control"  value="<?=$row->pc_bidangID?>">
                                                    <input type="text" name="bidangNama" id="bidangNama" class="form-control"  value="<?=$rowBidang?>" readonly> 
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">NO PattyCash</label>
                                                    <input type="hidden" name="pattycashID" id="pattycashID" class="form-control"  value="<?=$row->pattycashID?>">
                                                    <input type="text" name="pattycashNo" id="pattycashNo" class="form-control"  value="<?=$row->pattycashNo?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">File List Belanja Periodic</label>
                                                    <input type="file" name="filePeriodic" class="form-control filePeriodic" id="filePeriodic" required>
                                                    <span class="draftInvFile_error text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">File List Belanja Insidentil</label>
                                                    <input type="file" name="fileInsidentil" class="form-control fileInsidentil" id="fileInsidentil" required>
                                                    <span class="draftInvFile_error text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Comment</label>
                                                    <textarea name="commentBelanjaList" id="commentBelanjaList" class="form-control" cols="10" rows="5"></textarea>
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
        myformData.append('send_down', $("#send_down").val());
        myformData.append('pattycashID', $("#pattycashID").val());
        myformData.append('bidangID', $("#bidangID").val());
        myformData.append('filePeriodic', $('#filePeriodic')[0].files[0]);
        myformData.append('fileInsidentil', $('#fileInsidentil')[0].files[0]);
        myformData.append('commentBelanjaList', $("#commentBelanjaList").val());
        
      

      
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('IntPengadaanBarang/addListBelanja')?>",
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
                    })
                    .then(function() {
                        window.location.assign("<?php echo base_url();?>IntPengadaanBarang/viewNewPettyCash");
                    });
                    // console.log("sukses");
                   
                   
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
        var id = $('#pattycashID').val();
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('IntPengadaanBarang/timeViewPattyCash')?>",
            dataType : "JSON",
            data : {id:id},
            success: function(data){
                // console.log(data);
                $('#status').text(data.status);
                
                    if(data.statusAll == 'reject'){
                        clearInterval(set);
                        $('#waktuTimeout').html('<span class="text-danger">Waktu Selesai</span>');
                        $('#action').hide();
                        Swal.fire({
                                icon: 'error',
                                title: 'Data Reject!',
                                text:  'Data ini telah di Reject',
                            }).then(function() {
                                window.location.assign("<?php echo base_url();?>IntPengadaanBarang/viewNewPettyCash");
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
                            Swal.fire({
                                icon: 'error',
                                title: 'Data Reject!',
                                text: 'Data ini telah di Reject',
                            }).then(function() {
                                window.location.assign("<?php echo base_url();?>IntPengadaanBarang/viewNewPettyCash");
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
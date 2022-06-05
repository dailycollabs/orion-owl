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
                            <span>Budget Honor Revisi</span>
                            </div>
                        </div>
                        <div class="card-body">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                <input type="hidden" name="budgethonorID" class="form-control" id="budgethonorID"  value="<?=$row->budgethonorID?>"><!-- Membuat Waktu Pengerjaan -->
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>ID Budget Honor</th>
                                                    <td><?=$row->budgethonorNo?></td>
                                                </tr>
                                                <tr>
                                                    <th>Pengirim</th>
                                                    <td><?=$row->budgetH_pengirimID?></td>
                                                </tr>
                                                <tr>
                                                    <th>File Budget Honor</th>
                                                    <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/honorarium/budgetHonor/'.$row->budgetHFile;?>"> Download</a> <?=$row->budgetHFile?>  </td>
                                                </tr>
                                                <?php if($petugasLogin != $row->budgetH_pengirimID){?>
                                                <tr>
                                                    <th>Waktu</th>
                                                    <td id="waktuTimeout"></td>
                                                </tr>
                                                <?php } ?>
                                                
                                                <?php if($petugasLogin == $row->budgetH_penerimaID){?>
                                                <?php if($waktusekarang < $row->budgetHWaktu_end){?>
                                                <?php if($row->status != 'reject' || $row->status != 'success'){?>
                                                <tr>
                                                    <th>Action</th>
                                                    <td> 
                                                        <div class="justify-content-center"> 
                                                            <button class="btn btn-primary" id="bhd-revisi">Revisi</button> 
                                                        </div>
                                                    </td>
                                                </tr>  
                                                <?php } ?>
                                                <?php } ?> 
                                                <?php } ?> 
                                            </tbody>
                                        </table>

                                        <!-- Quotation Revisi -->
                                        <div class="row justify-content-center mt-4">
                                            <div class="col-12">  
                                                <div class="card" style="display:none;" id="revisiDraft">
                                                    <div class="card-header bg-primary">
                                                        <div class="card-title">
                                                            <span>Send Budget Honor</span>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <form action="">
                                                            <input type="hidden" name="send_up" id="send_up" value="send_up">
                                                            <input type="hidden" name="add" id="add" value="add">
                                                            <input type="hidden" name="revisi" class="form-control" id="revisi" value="revisi" >
                                                            <div class="form-group">
                                                            <label for="exampleInputEmail1">ID Budget Honor</label>
                                                                <input type="text" name="budgethonorNo" class="form-control" id="budgethonorNo" value="<?=$row->budgethonorNo?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                            <label for="exampleInputEmail1">FIle Budget Honor</label>
                                                                <input type="file" name="budgetHFile" class="form-control" id="budgetHFile" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Comment</label>
                                                                <textarea name="budgetComment" id="budgetComment" class="form-control" cols="30" rows="10"></textarea>
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

    $('#bhd-revisi').on('click', function(){
        $('#revisiDraft').show("slow");
    });


    //Membuat dan mengirimkan file Refisi pengirimannya ke atas

    //Melanjutkan File Failed Ke Orang Di bawah
    $('#kirim-revisi').on('click', function(e){

        e.preventDefault();

        var myformData = new FormData();        
        myformData.append('send_up',  $('#send_up').val());
        myformData.append('add',  $('#add').val());
        myformData.append('revisi',  $('#revisi').val());
        myformData.append('budgethonorNo',  $('#budgethonorNo').val());
        myformData.append('budgetHFile', $('#budgetHFile')[0].files[0]);
        myformData.append('budgetComment',  $('#budgetComment').val());

        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('IntHonorarium/addBudgetHonor')?>",
            dataType : "JSON",
            data : myformData,
            contentType: false,
            processData: false,
            cache: false,
            enctype: 'multipart/form-data',
            success: function(response){
                console.log(response);
                if(response.status == 'success'){
                    console.log("sukses");
                    $('.quoID').html("");
                    $('.orderID').html("");
                    Swal.fire({
                        icon: 'success',
                            title: 'File Berhasil Di Kirim!',
                            text: 'You clicked the button!',
                    
                    }).then(function() {
                        window.location.assign("<?php echo base_url();?>IntHonorarium/viewFailedBudgetHonor");
                    });
                
                }else{
                    $('.quoID_error').html(response.quoID);
                    $('.orderID_error').html(response.orderID);
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
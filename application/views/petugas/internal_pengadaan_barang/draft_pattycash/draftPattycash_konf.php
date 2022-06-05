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
                            <span>KONFIRMASI DRAFT PENGADAAN (PATTYCASH)</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body ">
                                    <input type="hidden" name="pattycashID" class="form-control" id="pattycashID"  value="<?=$rowPattycash->pattycashID?>"><!-- Membuat Waktu Pengerjaan -->
                                        <table class="table table-bordered">
                                            <tbody>
                                            
                                                <tr>
                                                    <th>Bidang</th>
                                                    <td><?=$rowBidang?></td>
                                                </tr>
                                                <tr>
                                                    <th>ID Patty Cash</th>
                                                    <td><?=$rowPattycash->pattycashNo?></td>
                                                </tr>
                                                <tr>
                                                    <th>File Patty Cash</th>
                                                    <td><a class="btn btn-primary" href="<?php echo base_url().'./uploads/pengadaan/'.$rowBidang.'/pattycash/'.$rowPattycash->pcFile;?>"> Download</a> <?=$rowPattycash->pcFile?></td>
                                                </tr>
                                                <tr>
                                                    <th>Pengirim</th>
                                                    <td><?=$rowPattycash->pc_pengirimID?></td>
                                                </tr>
                                                
                                                <?php if($petugasLogin == $rowPattycash->pc_penerimaID){?>
                                                <tr>
                                                    <th>Waktu</th>
                                                    <td id="waktuTimeout"></td>
                                                </tr>
                                                <?php } ?>

                                                <tr>
                                                    <th>Comment</th>
                                                    <td><?=$rowPattycash->pcComment?></td>
                                                </tr>

                                                <?php if($petugasLogin == $rowPattycash->pc_penerimaID){?>
                                                <?php if($waktusekarang < $rowPattycash->pcWaktu_end){?>
                                                <?php if($rowPattycash->status != 'reject' || $rowPattycash->status != 'success'){?>
                                                <tr>
                                                    <th>Action</th>
                                                    <td> 
                                                        <div class="justify-content-center"> 
                                                            <?php if($this->fungsi->petugas_login()->subbidangID == 'HR'){?>
                                                            <a href="<?=site_url('IntPengadaanBarang/viewAddListBelanja/').$rowPattycash->pattycashID?>"><button class="btn btn-success mr-3" id="quo-success">Pattycash Success</button></a>
                                                            <button class="btn btn-danger" id="quo-failed">Pattycash Revisi</button> 
                                                            <?php } ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                <?php } ?>  
                                                <?php } ?>  
                                            </tbody>
                                        </table>

                                       
                                        <!-- Quotation Revisi -->
                                        <div class="row justify-content-center">
                                            <div class="col-12">  
                                                <div class="card" style="display:none;" id="quoFailed">
                                                    <div class="card-header bg-danger">
                                                        <div class="card-title">
                                                            <span>Send Pattycash Failed</span>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <form action="">
                                                            <input type="hidden" name="send_down" id="send_down" value="send_down">
                                                            <input type="hidden" name="failed" id="failed" value="failed">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Bidang</label>
                                                                <input type="hidden" name="bidangID" class="form-control" id="bidangID" value="<?=$rowPattycash->pc_bidangID?>" >
                                                                <input type="text" name="bidangNama" class="form-control" id="bidangNama" value="<?=$rowBidang?>" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">NO Pattycash</label>
                                                                <input type="text" name="pattycashNo" class="form-control" id="pattycashNo" value="<?=$rowPattycash->pattycashNo?>" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">File Pattycash </label>
                                                                <input type="file" name="pattycashFile" class="form-control" id="pattycashFile" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Comment</label>
                                                                <textarea name="commentPatty" id="commentPatty" class="form-control" cols="30" rows="10"></textarea>
                                                            </div> 
                                                                <button type="submit" name="kirim-failed" id="kirim-failed" class="btn btn-primary">Kirim</button>
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

                    <?php if($rowlistBelanja != null){?>
                    <div class="card">
                        <div class="card-header bg-dark">
                            <div class="card-title ">
                            <span>List Belanja</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="box">
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <th>#</th>
                                                        <th>List Belanja No</th>
                                                        <th>pattycashNo</th>
                                                        <th>Bidang</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td><?=$rowlistBelanja->listbelanjaNo?></td>
                                                            <td><?=$rowlistBelanja->pattycashNo?></td>
                                                            <td><?=$rowlistBelanja->lb_bidangID?></td>
                                                            <td>
                                                                <a href="<?=base_url('IntPengadaanBarang/konfListBelanja/').$rowlistBelanja->listbelanjaID?>" class="btn btn-primary btn-sm">Detail</a>
                                                            </td>
                                                        </tr>
                                                    
                                                    </tbody>
                                                </table>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>



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


    $('#kirim-failed').on('click', function(e){
    e.preventDefault();
    var myformData = new FormData();        
    myformData.append('send_down',  $('#send_down').val());
    myformData.append('failed',  $('#failed').val());
    myformData.append('bidangID',  $('#bidangID').val());
    myformData.append('pattycashNo',  $('#pattycashNo').val());
    myformData.append('pattycashFile', $('#pattycashFile')[0].files[0]);
    myformData.append('commentPatty',  $('#commentPatty').val());
    
    $.ajax({
        type : "POST",
        url  : "<?php echo base_url('IntPengadaanBarang/addPettyCash')?>",
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
                    window.location.assign("<?php echo base_url();?>IntPengadaanBarang/viewNewPettyCash/");
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
        var id = $('#pattycashID').val();
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('IntPengadaanBarang/timeViewPattyCash')?>",
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
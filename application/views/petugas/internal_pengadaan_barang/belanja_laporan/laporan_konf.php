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
                            <span>KONFIRMASI LAPORAN BELANJA</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <input type="hidden" name="lbDetailID" class="form-control" id="lbDetailID"  value="<?=$rowLaporanBelanja->lbDetailID?>"><!-- Membuat Waktu Pengerjaan -->
                                <div class="box-body">

                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>Bidang</th>
                                                    <td><?=$rowBidang?></td>
                                                </tr>
                                                <tr>
                                                    <th>ID Laporan Belanja</th>
                                                    <td><?=$rowLaporanBelanja->lbd_laporanbelanjaID?></td>
                                                </tr>
                                                <tr>
                                                    <th>ID Nota Dinas</th>
                                                    <td><?=$rowNotaDinas->notadinasID?></td>
                                                </tr>
                                                <tr>
                                                    <th>ID Pencairan Budget</th>
                                                    <td><?=$rowPencairanBudget->pencairanbudgetID?></td>
                                                </tr>
                                                <tr>
                                                    <th>NO Pengeluaran</th>
                                                    <td><?=$rowPencairanBudget->pbPengeluaranNo?></td>
                                                </tr>
                                                <tr>
                                                    <th>Pengirim</th>
                                                    <td><?=$rowLaporanBelanja->lbd_pengirimID?></td>
                                                </tr>
                                                <tr>
                                                    <th>File Quotation PDF</th>
                                                    <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/pengadaan/'.$rowBidang.'/laporanBelanja/'.$rowLaporanBelanja->lbdFile;?>"> Download</a> <?=$rowLaporanBelanja->lbdFile?>  </td>
                                                </tr>
                                                <?php if($petugasLogin == $rowLaporanBelanja->lbd_penerimaID){?>
                                                <tr>
                                                    <th>Waktu</th>
                                                    <td id="waktuTimeout"></td>
                                                </tr>
                                                <?php } ?>

                                                <tr>
                                                    <th>Comment</th>
                                                    <td><?=$rowLaporanBelanja->lbdComment?></td>
                                                </tr>
                                                
                                                <?php if($petugasLogin == $rowLaporanBelanja->lbd_penerimaID ){?>
                                                <?php if($waktusekarang < $rowLaporanBelanja->lbdWaktu_end){?>
                                                <?php if($rowLaporanBelanja->status != 'reject' || $rowLaporanBelanja->status != 'success'){?>
                                                <tr>
                                                    <th>Action</th>
                                                    <td> 
                                                        <div class="justify-content-center"> 
                                                        <?php if($this->fungsi->petugas_login()->subbidangID == 'FM'){?>
                                                            <a href="<?=site_url('IntPengadaanBarang/viewAddApproval/').$rowLaporanBelanja->lbDetailID?>"><button class="btn btn-success mr-3" id="quo-success">Approval</button></a>
                                                        <?php }else{ ?>
                                                            <button class="btn btn-success mr-3" id="quo-success">Laporan Belanja Success</button>
                                                        <?php } ?>
                                                            <button class="btn btn-danger" id="quo-failed">Laporan Belanja Revisi</button> 
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
                                                            <span>Send Laporan Belanja Success</span>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                    
                                                       
                                                        <form action="" id="formAdd">
                                                            <input type="hidden" name="send_up" id="send_up" value="send_up">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Bidang</label>
                                                                <input type="hidden" name="bidangID" class="form-control" value="<?=$rowLaporanBelanja->laporanb_bidangID?>">
                                                                <input type="text" name="bidangNama" class="form-control" value="<?=$rowBidang?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">ID Laporan Belanja</label>
                                                                <input type="text" name="laporanbelanjaID" class="form-control" value="<?=$rowLaporanBelanja->lbd_laporanbelanjaID?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">File Laporan Belanja</label>
                                                                <input type="text" name="lbFile_send" class="form-control" id="lbFile_send" value="<?=$rowLaporanBelanja->lbdFile?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Comment</label>
                                                                <textarea name="lbComment"  class="form-control" cols="30" rows="10"></textarea>
                                                            </div>
                                                            <button type="submit" name="success" id="success" class="btn btn-success">Kirim</button>
                                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                                   
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>        
                                        </div>
                                        <!-- Quotation Success -->

                                       


                                        <!-- Quotation Revisi -->
                                        <div class="row justify-content-center">
                                            <div class="col-12">  
                                                <div class="card" style="display:none;" id="quoFailed">
                                                    <div class="card-header bg-danger">
                                                        <div class="card-title">
                                                            <span>Send Laporan Belanja Failed</span>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <form action="">
                                                            <input type="hidden" name="send_down" id="send_down" value="send_down">
                                                            <input type="hidden" name="failed" id="failed" value="failed">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Bidang</label>
                                                                <input type="hidden" name="bidangID" id="bidangID" class="form-control" value="<?=$rowLaporanBelanja->laporanb_bidangID?>">
                                                                <input type="text" name="bidangNama" id="bidangNama" class="form-control" value="<?=$rowBidang?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">ID Laporan Belanja</label>
                                                                <input type="text" name="laporanbelanjaID" id="laporanbelanjaID" class="form-control" value="<?=$rowLaporanBelanja->lbd_laporanbelanjaID?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">FIle Laporan Belanja</label>
                                                                <input type="file" name="lbFile" class="form-control" id="lbFile" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Comment</label>
                                                                <textarea name="lbComment" id="lbComment" class="form-control" cols="30" rows="10"></textarea>
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



$('#success').on('click', function(){
        // e.preventDefault();

        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('IntPengadaanBarang/uploadLaporanBelanja')?>",
            dataType : "JSON",
            data : $('#formAdd').serialize(),
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
                        window.location.assign("<?php echo base_url();?>IntPengadaanBarang/viewNewLaporanBelanja/");
                    });
                   
                }else{
                    $('.quoID_error').html(response.quoID);
                    $('.orderID_error').html(response.orderID);
                }
                   
            }
        });

       
        return false;
    });



    //Revisi

    $('#kirim-failed').on('click', function(e){

        e.preventDefault();
        var myformData = new FormData();        
        myformData.append('send_down',  $('#send_down').val());    
        myformData.append('failed',  $('#failed').val());
        myformData.append('bidangID',  $('#bidangID').val());
        myformData.append('laporanbelanjaID',  $('#laporanbelanjaID').val());
        myformData.append('lbFile', $('#lbFile')[0].files[0]);
        

        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('IntPengadaanBarang/uploadLaporanBelanja')?>",
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
                        window.location.assign("<?php echo base_url();?>IntPengadaanBarang/viewNewLaporanBelanja/");
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
        var id = $('#lbDetailID').val();
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('IntPengadaanBarang/timeViewLaporanBelanja')?>",
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
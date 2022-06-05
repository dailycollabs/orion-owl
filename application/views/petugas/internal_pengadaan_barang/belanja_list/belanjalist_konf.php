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
                            <div class="card-title">
                            <span>KONFIRMASI LIST BELANJA</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                <input type="hidden" name="listbelanjaID" class="form-control" id="listbelanjaID"  value="<?=$rowBelanjaList->listbelanjaID?>"><!-- Membuat Waktu Pengerjaan -->
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Bidang</th>
                                                <td><?=$rowBidang?></td>
                                            </tr>
                                            <tr>
                                                <th>NO List Belanja</th>
                                                <td><?=$rowBelanjaList->listbelanjaNo?></td>
                                            </tr>
                                            <tr>
                                                <th>File List Belanja Periodic</th>
                                                <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/pengadaan/'.$rowBidang.'/listBelanja/periodic/'.$rowBelanjaList->lbPeriodicFile;?>"> Download</a>  <?=$rowBelanjaList->lbPeriodicFile?></td>
                                            </tr>
                                            <tr>
                                                <th>File List Belanja Insidentil</th>
                                                <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/pengadaan/'.$rowBidang.'/listBelanja/insidentil/'.$rowBelanjaList->lbInsidentilFile;?>"> Download</a>  <?=$rowBelanjaList->lbInsidentilFile?></td>
                                            </tr>

                                            <?php if($petugasLogin == $rowBelanjaList->lb_penerimaID){?>
                                            <tr>
                                                <th>Waktu</th>
                                                <td id="waktuTimeout"></td>
                                            </tr>
                                            <?php } ?>

                                            <?php if($petugasLogin == $rowBelanjaList->lb_penerimaID){?>
                                            <?php if($waktusekarang < $rowBelanjaList->lbWaktu_end){?>
                                            <?php if($rowBelanjaList->status != 'reject' || $rowBelanjaList->status != 'success'){?>
                                            <tr>
                                                <th>Action</th>
                                                <td> 
                                                    <div class="justify-content-center"> 
                                                        <a href="<?=site_url('IntPengadaanBarang/viewAddBreakdown/').$rowBelanjaList->listbelanjaID?>"><button class="btn btn-success mr-3" id="quo-success">Create Breakdown</button></a>
                                                    </div>
                                                </td>
                                            </tr>  
                                            <?php } ?>
                                            <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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
        
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('WorkflowQuotation/saveQuoFile')?>",
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
                        window.location.assign("<?php echo base_url();?>WorkflowQuotation/viewNewQuo/");
                    });
                
                }else{
                    $('.quoID_error').html(response.quoID);
                    $('.orderID_error').html(response.orderID);
                } 
            }
        });

        return false;
    });


    $('#kirim-failed').on('click', function(e){
        e.preventDefault();
        var myformData = new FormData();        
        myformData.append('send_down',  $('#send_down').val());
        myformData.append('quoID',  $('#quoID').val());
        myformData.append('quoFile', $('#quoFile')[0].files[0]);

        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('WorkflowQuotation/saveQuoFile')?>",
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
                        window.location.assign("<?php echo base_url();?>WorkflowQuotation/viewNewQuo/");
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
        var id = $('#listbelanjaID').val();
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('IntPengadaanBarang/timeViewListBelanja')?>",
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
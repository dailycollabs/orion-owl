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

        <?php $this->view('messages')?>
            <section class="content">
                <div class="container-fluid" style="max-width: 100%;">
                    <!-- Small boxes (Stat box) -->
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div class="card-title">Create List BreakDown</div>
                                <div id="waktuTimeout" class="card-title"></div>
                            </div>
                        </div>
                        <div class="card-body">
                        <a href="<?=base_url('order/neworder')?>"><button class="btn btn-success mb-4"> <i class="fas fa-home"></i> Back</button></a>
                            <div class="row">
                                
                                <div class="col-md-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-dark">
                                            <div class="card-title">DATA LIST BELANJA</div>
                                      
                                        </div>
                                        <div class="card-body p-0">
                                        <input type="hidden" name="listbelanjaID" class="form-control" id="listbelanjaID"  value="<?=$row->listbelanjaID?>"><!-- Membuat Waktu Pengerjaan -->
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <th>Bidang</th>
                                                        <td><?=$rowBidang?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>NO List Belanja</th>
                                                        <td><?=$row->listbelanjaNo?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>NO PattyCash</th>
                                                        <td><?=$row->pattycashNo?></td>
                                                    </tr>  
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-dark">
                                            <div class="card-title">
                                                <span>Create List Breakdown</span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form action="" id="formAdd">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Bidang</label>
                                                    <input type="hidden" name="bidangID" class="form-control orderID" id="bidangID" value="<?=$row->lb_bidangID?>">
                                                    <input type="text" name="bidangNama" class="form-control bidangNama" id="bidangNama" value="<?=$rowBidang?>" readonly>
                                                    <span class="orderID_error text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">NO List Belanja</label>
                                                    <input type="hidden" name="listbelanjaID" class="form-control listbelanjaID" id="listbelanjaID" value="<?=$row->listbelanjaID?>">
                                                    <input type="text" name="listbelanjaNo" class="form-control listbelanjaNo" id="listbelanjaNo" value="<?=$row->pattycashNo?>" readonly>
                                                    <span class="listbelanjaNo_error text-danger"></span>
                                                </div>
                                                <button type="submit" id="add" name="add" class="btn btn-primary">Create Breakdown</button>
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

    $('#add').on('click', function(){

        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('IntPengadaanBarang/addBreakdownID')?>",
            dataType : "JSON",
            data : $('#formAdd').serialize(),
            success: function(response){
                console.log(response);
                if(response.status == 'success'){
                    console.log("sukses");
                    Swal.fire({
                        icon: 'success',
                        title: 'ID Berhasil Di Buat!',
                        text: 'You clicked the button!',
                    })
                    .then(function() {
                        window.location.assign("<?php echo base_url();?>IntPengadaanBarang/viewUploadBreakdown/"+response.id);
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
                
                    if(data.statusAll == 'reject'){
                        clearInterval(set);
                        $('#waktuTimeout').html('<span class="text-danger">Waktu Selesai</span>');
                        $('#action').hide();
                        Swal.fire({
                                icon: 'error',
                                title: 'Data Reject!',
                                text:  'Data ini telah di Reject',
                        }).then(function() {
                            window.location.assign("<?php echo base_url();?>IntPengadaanBarang/viewNewListBelanja");
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
                            window.location.assign("<?php echo base_url();?>IntPengadaanBarang/viewNewListBelanja");
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
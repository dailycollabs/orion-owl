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
                                            <div class="card-title">
                                                <span>Tambahkan Laporan Finish ke Database</span>
                                            </div>
                                        </div>
                                        
                                        <div class="card-body">
                                            <form action="" id="formAdd">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Bidang</label>
                                                    <input type="text" name="bidangID" id="bidangID" class="form-control"  value="<?=$row->laporanb_bidangID?>" readonly>
                                                    <!-- <input type="text" name="bidangNama" id="bidangNama" class="form-control"  value="" readonly> -->
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">ID Laporan Belanja</label>
                                                    <input type="text" name="laporanbelanjaID" id="laporanbelanjaID" class="form-control"  value="<?=$row->lbDetailID?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">ID Nota Dinas</label>
                                                    <input type="text" name="notadinasID" id="notadinasID" class="form-control"  value="<?=$row->laporanb_notadinasID?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">ID Pencairan Budget</label>
                                                    <input type="text" name="pencairanbudgetID" id="pencairanbudgetID" class="form-control"  value="<?=$row->laporanb_pencairanbudgetID?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">ID Breakdown List</label>
                                                    <input type="text" name="bddetailID" id="bddetailID" class="form-control"  value="<?=$row->laporanb_bddetailID?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">ID List Belanja</label>
                                                    <input type="text" name="listbelanjaID" id="listbelanjaID" class="form-control"  value="<?=$row->laporanb_listbelanjaID?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">ID Pattycash</label>
                                                    <input type="text" name="pattycashID" id="pattycashID" class="form-control"  value="<?=$row->laporanb_pattycashID?>" readonly>
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
        <?php $this->load->view("petugas/_partials/footer.php")?>
    
    </div>
<!-- ./wrapper -->

<!-- Javascript -->
<?php $this->load->view("petugas/_partials/js.php")?>


<script>
$(document).ready(function(){

    $('#add').on('click', function(){
        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('IntPengadaanBarang/addApprovalPengadaan')?>",
            dataType : "JSON",
            data : $('#formAdd').serialize(),
            success: function(response){
                console.log(response);
                if(response.status == 'success'){
                    console.log("sukses");
                    Swal.fire({
                        icon: 'success',
                        title: 'Data Berhasil!',
                        text: 'You clicked the button!',
                    })
                    .then(function() {
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

});


</script>

</body>
</html>
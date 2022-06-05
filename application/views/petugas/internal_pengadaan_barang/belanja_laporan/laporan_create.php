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
                            <div class="card-title">
                               <span>Create Laporan Belanja</span>
                            </div>
                        </div>
                        <div class="card-body">
                        <a href="<?=base_url('order/neworder')?>"><button class="btn btn-success mb-4"> <i class="fas fa-home"></i> Back</button></a>
                            <div class="row">
                                
                                <div class="col-md-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-dark">
                                            <div class="card-title">
                                                <span>Data</span>
                                              
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <table class="table table-bordered">
                                            <thead>
                                        
                                            </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>Bidang</th>
                                                        <td><?=$rowBidang?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>ID Nota Dinas</th>
                                                        <td><?=$rowNotaDinas->notadinasID?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>ID Pencairan Budget</th>
                                                        <td><?=$rowNotaDinas->pencairanbudgetID?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>NO Pengeluaran</th>
                                                        <td><?=$rowNotaDinas->pbPengeluaranNo?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>ID Breakdown</th>
                                                        <td><?=$rowNotaDinas->bdlD_breakdownlistID?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>ID List Belanjan</th>
                                                        <td><?=$rowNotaDinas->listbelanjaNo?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>ID Pattycash</th>
                                                        <td><?=$rowNotaDinas->pattycashNo?></td>
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
                                                <span>Create Laporan Belanja</span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                        <form action="" id="formAdd">
                                                <div class="form-group">
                                                <input type="hidden" name="bddetailID" class="form-control bddetailID" id="bddetailID" value="<?=$rowNotaDinas->pb_bddetailID?>">
                                                <input type="hidden" name="pattycashID" class="form-control pattycashID" id="pattycashID" value="<?=$rowNotaDinas->pb_pattycashID?>">
                                                <input type="hidden" name="listbelanjaID" class="form-control listbelanjaID" id="listbelanjaID" value="<?=$rowNotaDinas->nd_listbelanjaID?>">
                                                    <label for="exampleInputEmail1">Bidang</label>
                                                    <input type="hidden" name="bidangID" class="form-control bidangID" id="bidangID" value="<?=$rowNotaDinas->nd_bidangID?>">
                                                    <input type="text" name="bidangNama" class="form-control bidangNama" id="bidangNama" value="<?=$rowBidang?>" readonly>
                                                    
                                                    <span class="orderID_error text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nota Dinas ID</label>
                                                    <input type="text" name="notadinasID" class="form-control notadinasID" id="notadinasID" value="<?=$rowNotaDinas->notadinasID?>" readonly>
                                                    <span class="quoID_error text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Pencairan Budget ID</label>
                                                    <input type="text" name="pencairanbudgetID" class="form-control pencairanbudgetID" id="pencairanbudgetID" value="<?=$rowNotaDinas->nd_pencairanbudgetID?>" readonly>
                                                    <span class="quoID_error text-danger"></span>
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
            url  : "<?php echo base_url('IntPengadaanBarang/addLaporanBelanja')?>",
            dataType : "JSON",
            data : $('#formAdd').serialize(),
            success: function(response){
                console.log(response);
                if(response.status == 'success'){
                    console.log("sukses");
                    Swal.fire({
                        icon: 'success',
                        title: 'ID Laporan Belanja Berhasil Di Buat!',
                        text: 'You clicked the button!',
                    })
                    .then(function() {
                        window.location.assign("<?php echo base_url();?>IntPengadaanBarang/viewUploadLaporanBelanja/"+response.id);
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
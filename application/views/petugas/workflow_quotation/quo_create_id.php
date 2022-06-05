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
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div class="card-title">CREATE QUOTATION</div>
                                <div id="waktuTimeout" class="card-title"></div>
                            </div>
                        </div>
                        <div class="card-body">
                        <a href="<?=base_url('WorkflowOrder/viewneworder')?>"><button class="btn btn-success mb-4"> <i class="fas fa-home"></i> Back</button></a>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-dark">
                                            <div class="card-title">
                                                <span>Data Client Order</span>
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                        <input type="hidden" name="orderID" id="orderID" value="<?=$row->orderID?>">
                                            <table class="table">
                                                <tbody> 
                                                    <tr>
                                                        <th>ID Project</th>
                                                        <td id="projectID"><?=$row->order_projectID?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Nama Client</th>
                                                        <td><?=$row->clientNama?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Nama Perusahaan</th>
                                                        <td><?=$row->clientPerusahaan_nama?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Email</th>
                                                        <td><?=$row->clientEmail?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>No Telepon</th>
                                                        <td><?=$row->clientTelepon?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>File PDF</th>
                                                        <td><a class="btn btn-primary" href="<?php echo base_url().'uploads/clientFile/'.$row->bidangNama.'/'.$row->projectFile;?>"> Download</a> <?=$row->projectFile?>  </td> 
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
                                                <span>Create Quotation</span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form action="" id="formAdd">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">ID Order</label>
                                                    <input type="text" name="orderID" class="form-control orderID" id="orderID" value="<?=$row->orderID?>" readonly>
                                                    <span class="orderID_error text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No Quotation</label>
                                                    <input type="text" name="quoNo" class="form-control quoNo">
                                                    <span class="quoID_error text-danger"></span>
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

    $('#add').on('click', function(){
        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('WorkflowQuotation/addQuoID')?>",
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
                        title: 'Berhasil',
                        text: 'ID Berhasil Di Buat!',
                        // closeOnClickOutside: false
                    }).then(function() {
                        window.location.assign("<?php echo base_url();?>WorkflowQuotation/viewUploadQuo/"+response.id);
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
        var id = $('#orderID').val();
        console.log(id);
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('WorkflowOrder/timeViewOrder')?>",
            dataType : "JSON",
            data : {id:id},
            success: function(data){
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
                                window.location.assign("<?php echo site_url();?>petugas/petugasDashboard/");
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
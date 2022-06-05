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
                            <span>KONFIRMASI NOTA DINAS</span>
                            </div>
                        </div>
                        <div class="card-body p-0">   
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Bidang</th>
                                                <td><?=$rowBidang?></td>
                                            </tr>
                                            <tr>
                                                <th>ID Nota Dinas</th>
                                                <td><?=$row->notadinasID?></td>
                                            </tr>
                                            <tr>
                                                <th>ID Pencairan Budget</th>
                                                <td><?=$row->nd_pencairanbudgetID?></td>
                                            </tr>
                                            <tr>
                                                <th>NO Pengeluaran</th>
                                                <td><?=$row->pbPengeluaranNo?></td>
                                            </tr>
                                            <tr>
                                                <th>Pengirim</th>
                                                <td><?=$row->nd_pengirimID?></td>
                                            </tr>
                                        
                                            <tr>
                                                <th>File Nota Dinas</th>
                                                <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'./uploads/pengadaan/'.$rowBidang.'/notaDinas/'.$row->ndFile;?>"> Download</a>  <?=$row->ndFile?><</td>
                                            </tr>
                                            <?php if($petugasLogin == $row->nd_penerimaID){?>
                                            <?php if($row->status != 'reject' || $row->status != 'success'){?>
                                            <tr>
                                                <th>Action</th>
                                                <td> 
                                                    <div class="justify-content-center"> 
                                                        <a href="<?=site_url('IntPengadaanBarang/viewAddLaporanBelanja/').$row->notadinasID?>"><button class="btn btn-success" id="quo-success">Create Laporan Belanja</button></a>
                                                    </div>
                                                </td>
                                            </tr>
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








    var set = setInterval(getTimeOut, 1000);
    

    function getTimeOut(){
        var id = $('#quoDetailID').val();
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('WorkflowQuotation/timeView')?>",
            dataType : "JSON",
            data : {id:id},
            success: function(data){
            console.log(data);
            var now   = new Date();

            var waktuEnd   = new Date(data.waktuEnd);
            var time   = now-waktuEnd;
            var diff_time = Math.abs(time);
            console.log(diff_time);
            // 
            var detik       = Math.round(diff_time/1000);
            console.log(detik);
            var detikx      = detik % 60;
            console.log(detikx);
            var menit       = Math.round(detik/60);
            var menitx      = menit % 60;
            var jam         = Math.round(menit/60);
            var hari        = Math.round(jam/24);
            var minggu      = Math.round(hari/7);
            var waktu;
            var waktux;
            
            if(detik < 60 && detik >=0){
                waktu = detikx + ' Detik';  
            } 
            else if(menit < 60){    
                waktu = menit+' Menit '+detikx+' Detik';
            } 
            else if(jam < 24){
                waktu = jam+'Jam '+menitx+' Menit '+detikx+' Detik ';
            } 
            else if(hari < 7){
                waktu = hari+'d';
            } 
            else{
                waktu = minggu + 'w';
            }

            // console.log(waktu);
            $('#waktuTimeout').html(waktu);

            
            if(now > waktuEnd){
                clearInterval(set);
                
                Swal.fire({
                    icon: 'error',
                        title: 'Data Telah Di Reject!',
                        text: 'You clicked the button!',
                
                }).then(function() {
                    window.location.assign("<?php echo base_url();?>WorkflowQuotation/viewNewQuo/");
                });

            }
               
        }

        });
    }


});


</script>





</body>

</html>
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
                            <span>Data Invoicing</span>
                            </div>
                        </div>
                        <div class="card-body">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="d-none" id="petugas"><?=$this->fungsi->petugas_login()->subbidangID?></div>
                                <div class="box-body">
                                <input type="hidden" name="frMin_spkID" id="frMin_spkID" value="<?=$row->frMin_spkID?>">
                                    <table id="invoicingTable" class="table table-bordered table-hover">

                                        <thead>
                                            <tr>
                                                <th width="5px">#</th>
                                                <th>FR ID</th>
                                                <th>SPK NO</th>
                                                <th>JOBDESC NO</th>
                                                <th>Status</th>
                                                <th>Proses/Reject</th>
                                                <th>Pengirim/Penerima</th>
                                                <th>Waktu</th>
                                                <th width="15%">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="invoicingData">
                                       
                                            
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

    var petugas = $('#petugas').text();
    console.log(petugas);

    getNewOrder();

    function getNewOrder(){
        var id = $('#frMin_spkID').val();
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('Invoicing/getDataInvoicingIDMinerba')?>",
            dataType : "JSON",
            data  : {id:id},
            success : function(data){

                console.log(data);
                var html;
                var i;
                var n = 1;
                for(i=0; i<data.length; i++){
                    html += "<tr>"+
                            "<td>"+ n++ +"</td>"+
                            "<td>"+data[i].frID+"</td>"+
                            "<td>"+data[i].spkNo+"</td>"+
                            "<td>"+data[i].jobdNo+"</td>"+
                            "<td>"+data[i].status+"</td>"+
                            "<td>"+data[i].statusProses+"</td>";
                            
                            if(petugas == data[i].penerima){
                                html += "<td>Penerima</td>";
                            }else if(petugas == data[i].pengirim){
                                html += "<td>Pengirim</td>";
                            }
                            
                    html += "<td>"+data[i].waktu+"</td>"+
                            "<td style='text-align:center'><a href='<?=base_url('order/getorderdetail/')?>"+data[i].orderID+"'><button id='btn-detail' class='btn btn-info btn-sm'>Detail</button> </a><a href='<?=base_url('Invoicing/detailDataInvoicingIDMinerba/')?>"+data[i].frID+"'><button class='btn btn-primary btn-sm'>konfirmasi</button></a></td>"+
                            "</tr>";
                }
                $('#invoicingData').html(html);
                $('#invoicingTable').DataTable({
                    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]]
                });
            }
        });
 
    }
    
    


});


</script>





</body>

</html>
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
    
        <div class="p-4">
            <span class="text-danger">Perhatian!!!</span><br>
            <span class="text-danger">Data Reject: Data dengan ID Tersebut Akan Di Cek Keseluruhan  tanpa perlu melihat <br>siapa yang pengirim atau penerima,
             jika data dengan ID Tersebut sudah di Reject maka statusnya akan di reject</span>
        </div>

            <section class="content">
                <div class="container-fluid" style="max-width: 100%;">
                    <div class="row">
                    <div class="col-md-6">
                        <div class="card card-info ">
                            <div class="card-header">
                            <h3 class="card-title">Files</h3>

                            </div>
                            <div class="card-body p-0 " style="display: block;">
                            <table class="table">
                                <thead>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Petugas</td>
                                        <td id="petugas"><?=$this->fungsi->petugas_login()->subbidangID?></td>
                                    </tr>
                                    <tr>
                                        <td>ID Final Report</td>
                                        <td id="frID"><?=$row->frD_frID?></td>
                                    </tr>
                                    <tr>
                                        <td>ID SPK</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>ID ORDER</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>STATUS</td>
                                        <td id="statusAll"></td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td id="statusKet"></td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            </div>
                            
                            </div>
                           
                            <!-- /.card-body -->
                        </div>

                        <div class="col-md-6">
                        <div class="card card-info ">
                            <div class="card-header">
                                <h3 class="card-title">Approval Invoicing</h3>
                            </div>
                            <div class="card-body p-0 " style="display: block;">
                                <table class="table" id="approvalTable">
                                    <thead>
                                    <tr>
                                        <th>ID Approval</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
        
                                    </thead>
                                    <tbody id="approvalData">
                                    </tbody>
                                </table>
                            </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        </div>
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
                                <div class="box-body">
                                    <table id="invoicingTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5px">#</th>
                                                <th>ID Final Report</th>
                                                <th>ORDER ID</th>
                                                <th>Status</th>
                                                <th>Penerima/Pengirim</th>
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
    getInvoicingDetail();


    function getInvoicingDetail(){
        var frID = $('#frID').text();
        console.log(frID);
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('Invoicing/getDetailDataInvoicing')?>",
            dataType : "JSON",
            data:{frID:frID},
            success : function(data){

                console.log(data);
                var html;
                var i;
                var n = 1;
                for(i=0; i<data.length; i++){
                    html += "<tr>"+
                            "<td>"+ n++ +"</td>"+
                            "<td>"+data[i].frD_frID+"</td>"+
                            "<td>"+data[i].orderID+"</td>"+
                            "<td>"+data[i].status+"</td>";
                          

                            
                            if(petugas == data[i].penerima){
                                html += "<td>Penerima</td>";
                            }else if(petugas == data[i].pengirim){
                                html += "<td>Pengirim</td>";
                            }
                            
                    html += "<td>"+data[i].waktu+"</td>"+
                            "<td style='text-align:center'><a href='<?=base_url('order/getorderdetail/')?>"+data[i].orderID+"'><button id='btn-detail' class='btn btn-info btn-sm'>Detail</button> </a>";
                            if(data[i].status == 'failed'){
                                html +=  "<a href='<?=base_url('InvoicingFinalReport/revisiDraftFR/')?>"+data[i].frDetailID+"'><button class='btn btn-primary btn-sm'>Revisi</button></a></td>";
                            }else if(data[i].status == 'new' || data[i].status == 'revisi' || data[i].status == 'reject'){
                                html +=  "<a href='<?=base_url('InvoicingFinalReport/konfirmasiFR/')?>"+data[i].frDetailID+"'><button class='btn btn-primary btn-sm'>Konfirmasi</button></a></td>";
                            }
                           
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
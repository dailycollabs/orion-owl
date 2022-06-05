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
                    <div class="row">
                    <div class="col-md-12">
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
                                        <td>ID Invoicing</td>
                                        <td id="invID"><?=$rowInv->invMarD_invID?></td>
                                    </tr>
                                    <tr>
                                        <td>No Invoicing</td>
                                        <td><?=$rowInv->invMarNo?></td>
                                    </tr>
                                    <tr>
                                        <td>ID Final Report</td>
                                        <td><?=$rowInv->invMarD_invID?></td>
                                    </tr>
                                    <tr>
                                        <td>No SPK</td>
                                        <td><?=$rowSPK->spkNo?></td>
                                    </tr>
                                    <tr>
                                        <td>No Jobdesc</td>
                                        <td><?=$rowJOBDesc->jobdApprovNo?></td>
                                    </tr>
                                   
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
                                                <th>ID Invoicing</th>
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
        var id = $('#invID').text();
        console.log(id);
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('Invoicing/getDetailDataInvoicingMarineFM')?>",
            dataType : "JSON",
            data:{id:id},
            success : function(data){

                console.log(data);
                var html;
                var i;
                var n = 1;
                for(i=0; i<data.length; i++){
                    html += "<tr>"+
                            "<td>"+ n++ +"</td>"+
                            "<td>"+data[i].invID+"</td>"+
                            "<td>"+data[i].orderID+"</td>"+
                            "<td>"+data[i].status+"</td>";
                          
                            if(petugas == data[i].penerima){
                                html += "<td>Penerima</td>";
                            }else if(petugas == data[i].pengirim){
                                html += "<td>Pengirim</td>";
                            }
                            
                    html += "<td>"+data[i].waktu+"</td>";
                            if(data[i].status == 'failed'){
                                html +=  "<td style='text-align:center'><a href='<?=base_url('InvoicingDraft/revisiInv/')?>"+data[i].invDetailID+"'><button class='btn btn-primary btn-sm'>Konfirmasi</button></a></td>";
                            }else if(data[i].status == 'new' || data[i].status == 'revisi' || data[i].status == 'reject' || data[i].status == 'success'){
                                html +=  "<td style='text-align:center'><a href='<?=base_url('InvoicingDraft/konfirmasiInvMar/')?>"+data[i].invDetailID+"'><button class='btn btn-primary btn-sm'>Konfirmasi</button></a></td>";
                            }
                           
                            html += "</tr>";
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
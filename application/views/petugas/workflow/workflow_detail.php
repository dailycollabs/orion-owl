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
                    <div class="col-md-6">
                        <div class="card card-info ">
                            <div class="card-header">
                                <h3 class="card-title">Data Workflow</h3>
                            </div>
                            <div class="card-body p-0 " style="display: block;">
                            <input type="hidden" name="quoID" id="quoID" value="<?=$row->quoD_quoID?>">
                                <table class="table">
                                    <thead>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Petugas</td>
                                            <td id="petugas"><?=$this->fungsi->petugas_login()->subbidangID?></td>
                                        </tr>
                                        <tr>
                                            <td>Client ID</td>
                                            <td><?=$rowOrder->projectclientID?></td>
                                        </tr>
                                        <tr>
                                            <td>No Quotation</td>
                                            <td><?=$row->quoNo?></td>
                                        </tr>
                                        <tr>
                                            <td>ID Order</td>
                                            <td><?=$row->quo_orderID?></td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td id="statusAll"></td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan</td>
                                            <td id="statusKet"></td>
                                        </tr>

                                        <?php if($this->fungsi->petugas_login()->subbidangID == 'AM1' || $this->fungsi->petugas_login()->subbidangID == 'AM2'){?>
                                            <?php if($rowSpk != null){?>
                                            <tr>
                                                <td>Data File SPK</td>
                                                <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/spk/'.$rowSpkBidang.'/fileSpk/'.$rowSpk->fileSpk;?>"> Download</a> <?=$rowSpk->fileSpk?></td>
                                            </tr>
                                            <tr>
                                                <td>Data File SPK (Biaya Survey)</td>
                                                <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/spk/'.$rowSpkBidang.'/filebiayasurvey/'.$rowSpk->fileBiayaSurvey;?>"> Download</a> <?=$rowSpk->fileBiayaSurvey?></td>
                                            </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            
                            </div>
                            
                            </div>
                           
                            <!-- /.card-body -->
                        </div>

                        <div class="col-md-6">
                            <div class="card card-info ">
                                <div class="card-header">
                                    <h3 class="card-title">Approval</h3>
                                    </div>
                                    <div class="card-body p-0 " style="display: block;">
                                        <table class="table" id="approvalTable">
                                            <thead>
                                                <tr>
                                                    <th>ID Approval</th>
                                                    <th>No Quotation</th>
                                                    <th>status</th>
                                                    <th>Penerima/Pengirim</th>
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
                            <span>Data Workflow</span>
                            </div>
                        </div>
                        <div class="card-body">
                       
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="workflowTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5px">#</th>
                                                <th>Quotation ID</th>
                                                <th>Quotation No</th>
                                                <th>ORDER ID</th>
                                                <th>Status</th>
                                                <th>Penerima/Pengirim</th>
                                                <th>Waktu</th>
                                                <th width="15%">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="workflowData"></tbody>
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
    // console.log(petugas);

    getNewOrder();
    getCheck();
    getApproval();
    getSpk();

    function getNewOrder(){
        var quoID = $('#quoID').val();
        console.log(quoID);
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('Workflow/getDetailDataWorkflow')?>",
            dataType : "JSON",
            data:{quoID:quoID},
            success : function(data){

                console.log(data);
                var html;
                var i;
                var n = 1;
                for(i=0; i<data.length; i++){
                    html += "<tr>"+
                            "<td>"+ n++ +"</td>"+
                            "<td>"+data[i].quoID+"</td>"+
                            "<td>"+data[i].quoNo+"</td>"+
                            "<td>"+data[i].orderID+"</td>"+
                            "<td>"+data[i].status+"</td>";
                            
                            if(petugas == data[i].penerima){
                                html += "<td>Penerima</td>";
                            }else if(petugas == data[i].pengirim){
                                html += "<td>Pengirim</td>";
                            }
                            
                    html += "<td>"+data[i].waktu+"</td>";
                            // "<td style='text-align:center'><a href='<?=base_url('order/getorderdetail/')?>"+data[i].orderID+"'><button id='btn-detail' class='btn btn-info btn-sm'>Detail</button> </a>";
                            if(data[i].status == 'failed'){
                                html +=  "<td style='text-align:center'><a href='<?=base_url('WorkflowQuotation/revisiQuo/')?>"+data[i].quoDetailID+"'><button class='btn btn-primary btn-sm'>Revisi</button></a></td>";
                            }else if(data[i].status == 'new' || data[i].status == 'revisi' || data[i].status == 'reject'|| data[i].status == 'success'){
                                html +=  "<td style='text-align:center'><a href='<?=base_url('WorkflowQuotation/konfQuo/')?>"+data[i].quoDetailID+"'><button class='btn btn-primary btn-sm'>Konfirmasi</button></a></td>";
                            }
                           
                            "</tr>";
                }
                $('#workflowData').html(html);
                $('#workflowTable').DataTable({
                    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]]
                });
            }
        });

    }

    function getCheck(){
        var quoID = $('#quoID').val();
        console.log(quoID);
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('Workflow/getCheckAll')?>",
            dataType : "JSON",
            data:{quoID:quoID},
            success : function(data){
                console.log(data);
                $('#statusAll').text(data.status);
                $('#statusKet').text(data.message);
            }
        });

    }

    function getApproval(){
        var quoID = $('#quoID').val();
        console.log(quoID);
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('Workflow/getWorkflowApproval')?>",
            dataType : "JSON",
            data:{quoID:quoID},
            success : function(data){
                console.log(data);
                var html;
                var i;
                var n = 1;
                for(i=0; i<data.length; i++){
                    html += "<tr>"+
                            "<td>"+data[i].jobdescID+"</td>"+
                            "<td>"+data[i].quoNo+"</td>"+
                            "<td>"+data[i].status+"</td>";
                            if(petugas == data[i].penerima){
                                html += "<td>Penerima</td>";
                            }else if(petugas == data[i].pengirim){
                                html += "<td>Pengirim</td>";
                            }
                            html += "<td><a href='<?=base_url('WorkflowJobdesc/konfApproval/')?>"+data[i].jobdaDetailID+"'><button class='btn btn-primary btn-sm'>konfirmasi</button></a></td>"+
                            "<tr>";
                            
                }
                $('#approvalData').html(html);
                // $('#approvalTable').DataTable({
                //     "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]]
                // });
            }
        });

    }

    function getSpk(){
        var quoID = $('#quoID').val();
        console.log(quoID);
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('Workflow/getCheckAll')?>",
            dataType : "JSON",
            data:{quoID:quoID},
            success : function(data){
                console.log(data);
                $('#statusAll').text(data.status);
                $('#statusKet').text(data.message);
              
            }
        });

    }



});

</script>





</body>

</html>
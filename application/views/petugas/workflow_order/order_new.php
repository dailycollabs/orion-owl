<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("petugas/_partials/head.php") ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view("petugas/_partials/navbar.php")?>
        <?php $this->load->view("petugas/_partials/sidebar.php")?>
        <div class="content-wrapper">
            <?php $this->load->view("petugas/_partials/breadcrumb.php")?>

            <section class="content">
                <div class="container-fluid" style="max-width: 100%;">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <div class="card-title ">
                            <span>Data New Order</span>
                            </div>
                        </div>
                        <div class="card-body">     
                            <div class="box">
                                <div class="box-body">
                                    <table id="ordernewTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5px">#</th>
                                                <th>Order ID</th>
                                                <th>Client</th>
                                                <th>Nama Perusahaan</th>
                                                <th>Dokument</th>
                                                <th>Bidang</th>
                                                <th width="15%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ordernewData"></tbody>
                                    </table>
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
    getNewOrder();
    function getNewOrder(){
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('WorkflowOrder/getneworderAll')?>",
            dataType : "JSON",
            success : function(data){
                var html;
                var i;
                var n = 1;
                for(i=0; i<data.length; i++){
                    html += "<tr>"+
                            "<td>"+ n++ +"</td>"+
                            "<td>"+data[i].orderID+"</td>"+
                            "<td>"+data[i].clientNama+"</td>"+
                            "<td>"+data[i].clientPerusahaan+"</td>"+
                            "<td>"+data[i].orderFile+"</td>"+
                            "<td>"+data[i].bidangNama+"</td>"+
                            "<td style='text-align:center'><a href='<?=base_url('order/getorderdetail/')?>"+data[i].orderID+"'><button id='btn-detail' class='btn btn-info btn-sm'>Detail</button> </a><a href='<?=base_url('WorkflowQuotation/viewAddQuoID/')?>"+data[i].orderID+"'><button class='btn btn-primary btn-sm'>konfirmasi</button></a></td>"+
                            "</tr>";
                }
                $('#ordernewData').html(html);
                $('#ordernewTable').DataTable({
                    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]]
                });
            }
        });

      
    }

    // $('#ordernewTable tbody').on('click', '#btn-detail', function(){
    //     var id=$(this).attr('value');
    //     $.ajax({
    //         type : 'GET',
    //         url  : "<?php echo base_url('order/getDetailOrder')?>",
    //         dataType : "JSON",
    //         data : {id:id},
    //         success : function(data){
    //             window.location = "<?php echo site_url()?>order/orderClient/detailOrderView";
    //         }
    //     });
    // });

});

</script>

</body>
</html>
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
                            <span>Data Order</span>
                            </div>
                        </div>
                        <div class="card-body">     
                            <div class="box">
                                <div class="box-body">
                                    <table id="projectTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5px">#</th>
                                                <th>Project ID</th>
                                                <th>Client</th>
                                                <th>Bidang</th>
                                                <th>Waktu</th>
                                                <th width="15%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="projectData"></tbody>
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
            url  : "<?php echo base_url('InvoivingFinalClient/getTransaksiData')?>",
            dataType : "JSON",
            success : function(data){
                var html;
                var i;
                var n = 1;
                for(i=0; i<data.length; i++){
                    html += "<tr>"+
                            "<td>"+ n++ +"</td>"+
                            "<td>"+data[i].projectID+"</td>"+
                            "<td>"+data[i].projectclientID+"</td>"+
                            "<td>"+data[i].projectbidangID+"</td>"+
                            "<td>"+data[i].waktu+"</td>"+
                            "<td style='text-align:center'><a href='<?=base_url('InvoivingFinalClient/viewDetailDataTransaksi/')?>"+data[i].projectID+"'><button id='btn-detail' class='btn btn-primary btn-sm'>Detail</button> </a></td>"+
                            "</tr>";
                }
                $('#projectData').html(html);
                $('#projectTable').DataTable({
                    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]]
                });
            }
        });

      
    }



});

</script>

</body>
</html>
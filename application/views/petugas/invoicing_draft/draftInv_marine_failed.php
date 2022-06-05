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
                            <span>Invoice Failed New</span>
                            </div>
                        </div>
                        <div class="card-body">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="ordernewTable" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                                <th width="5px">#</th>
                                                <th>NO Invoicing</th>
                                                <th>ID Final Report</th>
                                                <th>NO SPK</th> 
                                                <th>NO JOBDESC</th>
                                                <th>Status</th>
                                                <th>Pengirim</th>
                                                <th>Waktu</th>
                                                <th width="15%">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="ordernewData"></tbody>

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
    getNewOrder();

    function getNewOrder(){

        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('InvoicingDraft/getNewFailedInv')?>",
            dataType : "JSON",
            success : function(data){
                console.log(data);
                var html;
                var i;
                var n = 1;
                for(i=0; i<data.length; i++){
                    html += "<tr>"+
                            "<td>"+ n++ +"</td>"+
                            "<td>"+data[i].invNo+"</td>"+
                            "<td>"+data[i].frID+"</td>"+
                            "<td>"+data[i].jobdApprovNo+"</td>"+
                            "<td>"+data[i].spkNo+"</td>"+
                            "<td>"+data[i].petugas+"</td>"+
                            "<td>"+data[i].status+"</td>"+
                            "<td>"+data[i].waktu+"</td>"+
                            
                            "<td style='text-align:center'><a href='<?=base_url('InvoicingDraft/revisiInv/')?>"+data[i].invDetailID+"'><button class='btn btn-primary btn-sm'>create Revisi</button></a></td>"+
                            "</tr>";
                            
                }
                $('#ordernewData').html(html);
                $('#ordernewTable').DataTable({
                    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]]
                });
            }
        });

      
    }

 



});


</script>





</body>

</html>
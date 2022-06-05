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
                            <span>Draft Final Report Failed</span>
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
                                                <th>JOBDESC ID</th>
                                                <th>SPK ID</th>
                                                <th>ORDER ID</th>
                                                <th>Pengirim</th>
                                                <th>Status</th>
                                                <th>Waktu</th>
                                                <th width="15%">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="ordernewData"></tbody>
                                        <!-- <tr>
                                            <td>1</td>
                                            <td>12345</td>
                                            <td>1243545</td>
                                            <td>Marine</td>
                                            
                                            <td>MD</td>
                                            <td>13/06/2020</td>
                                            
                                            <td>
                                            <a href="<?=base_url('rka/detailRka')?>"> <button class="btn btn-info btn-sm">Detail</button></a>
                                                <a href="<?=base_url('rka/rkaRevisi')?>"> <button class="btn btn-primary btn-sm">create Revisi</button></a>
                                            </td>

                                        </tr> -->

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
            url  : "<?php echo base_url('InvoicingFinalReport/getDraftFRNewFailed')?>",
            dataType : "JSON",
            success : function(data){
                console.log(data);
                var html;
                var i;
                var n = 1;
                for(i=0; i<data.length; i++){
                    html += "<tr>"+
                            "<td>"+ n++ +"</td>"+
                            "<td>"+data[i].jobdescID+"</td>"+
                            "<td>"+data[i].spkID+"</td>"+
                            "<td>"+data[i].orderID+"</td>"+
                            "<td>"+data[i].petugasNama+"</td>"+
                            "<td>"+data[i].statusKonfirmasi+"</td>"+
                            "<td>"+data[i].waktu+"</td>"+
                            
                            "<td style='text-align:center'><a href='<?=base_url('quotation/rkadetailFailed/')?>"+data[i].detailRkaID+"'><button id='btn-detail' class='btn btn-info btn-sm'>Detail</button> </a><a href='<?=base_url('DraftFR/revisidraftfr/')?>"+data[i].frDetailID+"'><button class='btn btn-primary btn-sm'>create Revisi</button></a></td>"+
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
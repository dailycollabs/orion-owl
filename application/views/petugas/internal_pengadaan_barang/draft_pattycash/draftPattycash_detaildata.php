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
                            <span>DATA Patty Cash</span>
                            </div>
                        </div>
                        <div class="card-body">
                        <div class="d-none" id="petugasID"><?=$this->fungsi->petugas_login()->subbidangID?></div>
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                <input type="hidden" name="pattycashNo" id="pattycashNo" value="<?=$row->pattycashNo?>">
                                    <table id="rkanewTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5px">#</th>
                                                <th>pattycash No</th>
                                                <th>Status</th>
                                                <th>Proses/Reject</th>
                                                <th>Pengirim/Penerima</th>
                                                <th>Waktu</th>
                                                <th width="15%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="rkaNewData"></tbody>
                        

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
        var petugas = $('#petugasID').text();
        var id = $('#pattycashNo').val();

        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('IntPengadaanBarang/getDetailDataPettyCash')?>",
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
                            
                            "<td>"+data[i].pattycashNo+"</td>"+
                            "<td>"+data[i].status+"</td>"+
                            "<td>"+data[i].statusProses+"</td>";
                            
                            if(petugas == data[i].penerima){
                                html += "<td>Penerima</td>";
                            }else if(petugas == data[i].pengirim){
                                html += "<td>Pengirim</td>";
                            }
                            html += "<td>"+data[i].waktu+"</td>";
                            if(data[i].status == 'failed' && petugas == data[i].penerima){
                                html += "<td style='text-align:center'><a href='<?=base_url('IntPengadaanBarang/revisiPettyCash/')?>"+data[i].pattycashID+"'><button id='btn-detail' class='btn btn-info btn-sm'>Detail</button> </td>";
                            }else{
                                html += "<td style='text-align:center'><a href='<?=base_url('IntPengadaanBarang/konfPettyCash/')?>"+data[i].pattycashID+"'><button id='btn-detail' class='btn btn-info btn-sm'>Detail</button> </td>";
                            }
                          
                            html +="</tr>";
                }
                $('#rkaNewData').html(html);
                $('#rkanewTable').DataTable({
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
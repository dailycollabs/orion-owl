<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("client/_partials/head.php") ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php $this->load->view("client/_partials/navbar.php")?>
        <!-- Content Wrapper. Contains page content -->
        <?php $this->load->view("client/_partials/sidebar.php")?>

        <div class="content-wrapper">
        <?php $this->load->view("client/_partials/breadcrumb.php")?>

            <div class="container">
                <div class="row d-flex justify-content-center">

                    <?php foreach($data->result() as $row){?>  
                        <?php if($row->bidangID != 3){?> 
                            <div class="col-lg-4 col-6">
                                <!-- small card -->
                                <div class="small-box bg-info ">
                                    <div class="inner d-flex justify-content-center">
                                        <h3><?=$row->bidangNama?></h3>
                                    </div>
                                    
                                    <a href="<?=site_url('Client/clientProjectBidang/'.$row->bidangID)?>"  class="small-box-footer">
                                        <h4>Create Project</h4>
                                    </a>
                                    
                                </div>
                            </div>
                            <?php } ?>
                    <?php } ?>

                </div>
            </div>

            <section class="content">
                <div class="container-fluid" style="max-width: 100%;">
                    <!-- Small boxes (Stat box) -->
                    <div class="card">
                        <div class="card-header bg-dark">
                            <div class="card-title ">
                            <span>Data Project</span>
                            </div>
                        </div>
                        <div class="card-body">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="rkanewTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5px">#</th>
                                                <th>ID Project</th>
                                                <th>Bidang</th>
                                                <th>Status</th>
                                                <th>Waktu</th>
                                                <th width="15%">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="rkaNewData">


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

        <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        <!-- Main Footer -->
        <?php $this->load->view("client/_partials/footer.php") ?>
    
    </div>
<!-- ./wrapper -->

<!-- Javascript -->
<?php $this->load->view("client/_partials/js.php") ?>

<script>

$(document).ready(function(){
    getNewOrder();

    function getNewOrder(){
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('Client/getProjectClient')?>",
            dataType : "JSON",
            success : function(data){
                console.log(data);
                var html;
                var i;
                var n = 1;
                for(i=0; i<data.length; i++){
                    html += "<tr>"+
                            "<td>"+ n++ +"</td>"+
                            "<td>"+data[i].projectID+"</td>"+
                            "<td>"+data[i].bidangNama+"</td>"+
                            "<td>"+data[i].statusAll+"</td>"+
                            "<td>"+data[i].waktu+"</td>"+
                            "<td style='text-align:center'><a href='<?=base_url('Client/viewDetailProject/')?>"+data[i].projectID+"'><button class='btn btn-primary btn-sm'>konfirmasi</button></a></td>"+
                            "</tr>";
                }
                $('#rkaNewData').html(html);
                $('#rkanewTable').DataTable({
                    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]]
                });
            }
        });
 
    }
    
    


});


</script>

</body>

</html>


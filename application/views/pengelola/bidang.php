<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("pengelola/_partials/head.php") ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php $this->load->view("pengelola/_partials/navbar.php")?>
        <!-- Content Wrapper. Contains page content -->
        <?php $this->load->view("pengelola/_partials/sidebar.php")?>

        <div class="content-wrapper">
        <?php $this->load->view("pengelola/_partials/breadcrumb.php")?>


            <section class="content">
                <div class="container-fluid" style="max-width: 100%;">
                    <!-- Small boxes (Stat box) -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <button id="add-pengelola" class="btn bg-primary">TAMBAH BIDANG</button>
                            </div>
                        </div>
                        <div class="card-body">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="bidangTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5px">#</th>
                                                <th>Nama Bidang</th>
                                                <th width="15%">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="bidangData"></tbody>

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


        

        <!-- ADD -->
        <div class="card-body btn-page">
            <div class="modal fade" id="ModalADD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Bidang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body m-4">
                            
                            <form id="formAdd">
                                
                                <input type="hidden" name="pengelolaID"  class="form-control" id="pengelolaID">
                                

                                <div class="form-group">
                                    <label for="">Nama Bidang *</label>
                                    <input type="text" name="bidangNama"  class="form-control" id="bidangNama">
                                    <span class="bidangNama_error text-danger"></span>
                                </div>
                                <div>
                                    <button id="simpan" class="btn btn-primary">Simpan</button>
                                </div>

                            

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ADD -->


        <!-- EDIT -->
        <div class="card-body btn-page">
            <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Bidang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body m-4">
                            
                            <form id="formEdit">
                                
                                <input type="hidden" name="bidangEditID"  class="form-control" id="bidangEditID">
                                

                                <div class="form-group">
                                    <label for="">Nama Bidang *</label>
                                    <input type="text" name="bidangEditNama"  class="form-control" id="bidangEditNama">
                                    <span class="bidangNama_error text-danger"></span>
                                </div>
                                <div>
                                    <button id="update" class="btn btn-primary">Update</button>
                                </div>

                            

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END EDIT -->


        <!--MODAL HAPUS-->
        <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Hapus pengelola</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>    
                    </div>

                    <form class="form-horizontal">
                    
                        <div class="modal-body">                      
                            <input type="hidden" name="bidangID" id="bidangID" value="">
                            <div class=""><p>Apakah Anda yakin Inggin Menghapus BIdang ini ?</p></div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button class="btn_hapus btn btn-danger" id="delete">Hapus</button>
                        </div>
                    
                    </form>

                </div>
            </div>
        </div>
        <!--END MODAL HAPUS-->

        <!-- /.content-wrapper -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        <!-- Main Footer -->
        <?php $this->load->view("pengelola/_partials/footer.php") ?>
    
    </div>
<!-- ./wrapper -->

<!-- Javascript -->
<?php $this->load->view("pengelola/_partials/js.php") ?>



<script>
$(document).on('hidden.bs.modal', '.modal', function () {
    $('.modal:visible').length && $(document.body).addClass('modal-open');
});
$(document).ready(function(){

    getBidangData();
    function getBidangData(){

        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('superadmin/bidang/getBidang')?>",
            dataType : "JSON",
            success : function(data){
                var html;
                var i;
                var n = 1;
                for(i=0; i<data.length; i++){
                    html += "<tr>"+
                            "<td>"+ n++ +"</td>"+
                            "<td>"+data[i].bidangNama+"</td>"+
                            "<td><button class='btn btn-primary' id='btn-edit' value='"+data[i].bidangID+"'>Edit</button> <button class='btn btn-danger' id='btn-delete' value='"+data[i].bidangID+"'>Delete</button></td>"+
                            "</tr>";
                }
                $('#bidangData').html(html);
                $('#bidangTable').DataTable({
                    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]]
                });
            }
        });
    }

    $('#add-pengelola').on('click', function(){
        $('#ModalADD').modal("show");
    });

    $('#simpan').on('click', function(){
        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('superadmin/bidang/saveBidang')?>",
            dataType : "JSON",
            data : $('#formAdd').serialize(),
            success : function(data){
                console.log("sukses");
                $('#ModalADD').modal('hide');
                location.reload();
            }
        });
        return false;
    });

    $('#bidangTable').on('click','#btn-edit',function(){
        var id=$(this).attr('value');
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('superadmin/bidang/getBidangEdit')?>",
            dataType : "JSON",
            data : {id:id},
            success: function(data){
                $.each(data,function(bidangID, bidangNama){
                    $('#modalEdit').modal('show');
                    $('[name="bidangEditID"]').val(data.bidangID);
                    $('[name="bidangEditNama"]').val(data.bidangNama);
                });
            }
        });
        return false;
    });

    $('#update').on('click', function(){
        console.log('Update');

        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('superadmin/bidang/updateBidang')?>",
            dataType : "JSON",
            data : $('#formEdit').serialize(),
            success : function(data){
                $('#modalEdit').modal('hide');
                location.reload();

            }
        });
        return false;
    });

    $('#bidangTable').on('click','#btn-delete', function(){
        var id=$(this).attr('value');
        $('#modalHapus').modal("show");
        $('[name="bidangID"]').val(id);
    });

    $('#delete').on('click', function(){
        var id = $('#bidangID').val();

        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('superadmin/bidang/deleteBidang')?>",
            dataType : "JSON",
            data : {id:id},
            success : function(data){
                $('#modalHapus').modal('hide');
                location.reload();
            }
        })
        .fail(function(data){
            console.log("Data Masih Di Gunakan");
            $('#modalHapus').modal('hide');
            alert("Data yang Mau Di Hapus Masih Di Gunakan");
        });



       return false;
        
    });

});
</script>
</body>

</html>
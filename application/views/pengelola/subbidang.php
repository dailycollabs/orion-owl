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
                                <button id="add-subbidang" class="btn bg-primary">TAMBAH SUB BIDANG</button>
                            </div>
                        </div>
                        <div class="card-body">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="subbidangTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5px">#</th>
                                                <th>ID Sub Bidang</th>
                                                <th>Nama Sub Bidang</th>
                                                <th>Nama Bidang</th>
                                                <th>Rules</th>
                                                <th width="15%">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="subbidangData"></tbody>

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

        <!-- ADD -->
        <div class="card-body btn-page">
            <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Sub Bidang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body m-4">
                            
                            <form id="formAdd">

                               
                                <div class="form-group">
                                    <label for="">ID Sub Bidang*</label>
                                    <input type="text" name="subbidangID"  class="form-control" id="subbidangID">
                                    <span class="pengelolaNama_error text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Nama Bidang *</label>
                                <select class="form-control" name="bidang">
                                <?php foreach($data->result() as $row){?>
                                    <option value="<?=$row->bidangID?>"><?=$row->bidangNama?></option>
                                <?php } ?>
                                </select>
                                    <span class="pengelolaNama_error text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Nama Sub Bidang *</label>
                                    <input type="text" name="subbidang"  class="form-control" id="subbidang">
                                    <span class="pengelolaNama_error text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Rules Sub Bidang *</label>
                                   <select class="form-control" name="subbidangRule" id="">
                                        <option  value="1">Admin/Petugas</option>
                                        <option  value="2">Karyawan</option>
                                        <option  value="3">Karyawan Surveyor</option>
                                   </select>
                                    <span class="pengelolaNama_error text-danger"></span>
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
                            <h5 class="modal-title" id="exampleModalLabel">Edit Sub Bidang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body m-4">
                            
                        <form id="formEdit">
                                
                                <input type="hidden" name="editsubbidangID"  class="form-control" id="editsubbidangID">

                                <div class="form-group">
                                    <label for="">Nama Bidang *</label>
                                <select class="form-control" name="editbidang">
                                <?php foreach($data->result() as $row){?>
                                    <option value="<?=$row->bidangID?>"><?=$row->bidangNama?></option>
                                <?php } ?>
                                </select>
                                    <span class="pengelolaNama_error text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Nama Sub Bidang *</label>
                                    <input type="text" name="editsubbidangNama"  class="form-control" id="editsubbidangNama">
                                    <span class="pengelolaNama_error text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Rules Sub Bidang *</label>
                                   <select class="form-control" name="editsubbidangRule" id="">
                                        <option  value="1">Admin/Petugas</option>
                                        <option  value="2">Karyawan</option>
                                        <option  value="3">Karyawan Surveyor</option>
                                   </select>
                                    <span class="pengelolaNama_error text-danger"></span>
                                </div>
                                <div>
                                    <button id="update" class="btn btn-primary">Simpan</button>
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
                            <input type="hidden" name="subbidangID" id="subbidangID" value="">
                            <div class=""><p>Apakah Anda yakin Inggin Menghapus Sub Bidang ini ?</p></div>
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

// $('#example1').DataTable({
//         "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]]
//     });


    getBidangData();
    function getBidangData(){

        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('superadmin/subbidang/getsubbidang')?>",
            dataType : "JSON",
            success : function(data){
                var html;
                var i;
                var n = 1;
                for(i=0; i<data.length; i++){
                    html += "<tr>"+
                            "<td>"+ n++ +"</td>"+
                            "<td>"+data[i].subbidangID+"</td>"+
                            "<td>"+data[i].subbidangNama+"</td>"+
                            "<td>"+data[i].bidangNama+"</td>";
                    if(data[i].subidangrules == 1){
                        html += "<td>Admin/Petugas</td>";
                    } else if(data[i].subidangrules == 2){
                        html += "<td>Karyawan</td>";
                    } else if(data[i].subidangrules == 3){
                        html += "<td>Karyawan Surveyor</td>";
                    }
                           
                    html +=  "<td><button class='btn btn-primary' id='btn-edit' value='"+data[i].subbidangID+"'>Edit</button> <button class='btn btn-danger' id='btn-delete' value='"+data[i].subbidangID+"'>Delete</button></td>"+
                            "</tr>";
                }
                $('#subbidangData').html(html);
                $('#subbidangTable').DataTable({
                    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]]
                });
            }
        });
    }

    $('#add-subbidang').on('click', function(){
        $('#ModalAdd').modal("show");
    });

    $('#simpan').on('click', function(){
        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('superadmin/subbidang/savesubbidang')?>",
            dataType : "JSON",
            data : $('#formAdd').serialize(),
            success : function(data){
                console.log("sukses");
                $('#ModalADD').modal('hide');
                location.reload();
            }
        })
        .fail(function(data){
            console.log("Data Masih Di Gunakan");
            $('#ModalAdd').modal('hide');
            alert("ID Sudah Di Gunakan");
        });
        return false;
    });
    

    //Form Edit
    $('#subbidangTable').on('click','#btn-edit',function(){
        var id=$(this).attr('value');
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('superadmin/subbidang/getsubbidangEdit')?>",
            dataType : "JSON",
            data : {id:id},
            success: function(data){
                $.each(data,function(subbidangID, bidangID, subbidangNama, subidangrules){
                    $('#modalEdit').modal('show');
                    $('[name="editbidang"]').val(data.bidangID);
                    $('[name="editsubbidangID"]').val(data.subbidangID);
                    $('[name="editsubbidangNama"]').val(data.subbidangNama);
                    $('[name="editsubbidangRule"]').val(data.subidangrules);
                });
            }
        });
        return false;
    });

    $('#update').on('click', function(){
        console.log('Update');

        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('superadmin/subbidang/updatesubbidang')?>",
            dataType : "JSON",
            data : $('#formEdit').serialize(),
            success : function(data){
                $('#modalEdit').modal('hide');
                location.reload();

            }
        });
        return false;
    });

    $('#subbidangTable').on('click','#btn-delete', function(){
        var id=$(this).attr('value');
        $('#modalHapus').modal("show");
        $('[name="subbidangID"]').val(id);
    });

    $('#delete').on('click', function(){
        var id = $('#subbidangID').val();

        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('superadmin/subbidang/deletesubbidang')?>",
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
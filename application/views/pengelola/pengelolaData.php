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
                                <button id="add-pengelola" class="btn bg-primary">TAMBAH pengelola</button>
                            </div>
                        </div>
                        <div class="card-body">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="pengelolaTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5px">#</th>
                                   
                                                <th>Nama</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>No Telepon</th>
                                                <th>Jenis Kelamin</th>
                                               
                                             
                             
                                                <th style="text-align:center">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="pengelolaData"></tbody>

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
            <div class="modal fade" id="ModalADD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah pengelola/Superadmin</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body m-4">
                            
                            <form id="formAdd">
                                
                                <input type="hidden" name="pengelolaID"  class="form-control" id="pengelolaID">
                            
                               

                                <div class="form-group">
                                    <label for="">Nama Lengkap *</label>
                                    <input type="text" name="pengelolaNama"  class="form-control" id="pengelolaNama">
                                    <span class="pengelolaNama_error text-danger"></span>
                                </div>

                                

                                <div class="form-group">
                                    <label for="">Username *</label>
                                    <input type="text" name="pengelolaUsername"  class="form-control" id="pengelolaUsername">
                                    <span class="pengelolaUsername_error text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Password *</label>
                                    <input type="password" name="pengelolaPassword"  class="form-control" id="pengelolaPassword">  
                                    <span class="pengelolaPassword_error text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Email *</label>
                                    <input type="text" name="pengelolaEmail"  class="form-control" id="pengelolaEmail">  
                                </div>
                                <div class="form-group">
                                    <label for="">Telepon *</label>
                                    <input type="text" name="pengelolaTelepon"  class="form-control" id="pengelolaTelepon">
                                    <span class="pengelolaTelepon_error text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Kelamin *</label>
                                    <select class="custom-select" name="pengelolaGender" id="pengelolaGender">
                                        <option value="1">Laki-Laki</option>
                                        <option value="2">Perempuan</option>
                                    </select>  
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat *</label>
                                    <input type="text" name="pengelolaAlamat"  class="form-control" id="pengelolaAlamat">
                                    <span class="pengelolaAlamat_error text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <button id="btn-simpan" type="Submit" class="btn btn-success btn-flat"><i class="fa fa-paper-plane"></i>    Submit</button>
                                    <button type="Reset" class="btn btn-flat">Reset</button>
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
            <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit pengelola</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body m-4">
                            
                            <form id="formEdit">
                                
                                <input type="hidden" name="editpengelolaID"  class="form-control" id="editpengelolaID">
                                
                                <div class="form-group">
                                    <label for="">Nama Lengkap *</label>
                                    <input type="text" name="editpengelolaNama"  class="form-control" id="editpengelolaNama">
                                    <span class="editpengelolaNama_error text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Username *</label>
                                    <input type="text" name="editpengelolaUsername"  class="form-control" id="editpengelolaUsername">
                                    <span class="editpengelolaUsername_error text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Password *</label>
                                    <input type="password" name="editpengelolaPassword"  class="form-control" id="editpengelolaPassword">  
                                    <span class="editpengelolaPassword_error text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Telepon *</label>
                                    <input type="text" name="editpengelolaTelepon"  class="form-control" id="editpengelolaTelepon">
                                    <span class="editpengelolaTelepon_error text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Email *</label>
                                    <input type="text" name="editpengelolaEmail"  class="form-control" id="editpengelolaEmail">  
                                </div>
                               
                                <div class="form-group">
                                    <label for="">Jenis Kelamin *</label>
                                    <select class="custom-select" name="editpengelolaGender" id="editpengelolaGender">
                                        <option value="1">Laki-Laki</option>
                                        <option value="2">Perempuan</option>
                                    </select>  
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat *</label>
                                    <input type="text" name="editpengelolaAlamat"  class="form-control" id="editpengelolaAlamat">
                                    <span class="editpengelolaAlamat_error text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <button id="btn-update" type="Submit" class="btn btn-success btn-flat"><i class="fa fa-paper-plane"></i>    Update</button>
                                    <button type="Reset" class="btn btn-flat">Reset</button>
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
                            <input type="hidden" name="deletepengelolaID"  class="form-control" id="deletepengelolaID">
                            <div class=""><p>Apakah Anda yakin Inggin Menghapus Akun pengelola ini ?</p></div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button class="btn-hapus btn btn-danger" id="delete">Hapus</button>
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

    getpengelolaData();
    function getpengelolaData(){

        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('superadmin/pengelola/getpengelola')?>",
            dataType : "JSON",
            success : function(data){
                var html;
                var i;
                var n = 1;
                for(i=0; i<data.length; i++){
                    html += "<tr>"+
                            "<td>"+ n++ +"</td>"+
                            "<td>"+data[i].pengelolaNama+"</td>"+
                            "<td>"+data[i].pengelolaUsername+"</td>"+
                            "<td>"+data[i].pengelolaEmail+"</td>"+
                            "<td>"+data[i].pengelolaTelepon+"</td>";
                           
                            
                    if(data[i].pengelolaGender == 1){
                        html +=  "<td>Laki-laki</td>";     
                    } else if(data[i].pengelolaGender == 2){
                        html +=  "<td>Perempuan</td>";
                    }
                    html += "<td style='text-align:center'><button class='btn btn-primary' id='btn-edit' value='"+data[i].pengelolaID+"'>Edit</button> <button class='btn btn-danger' id='btn-delete' value='"+data[i].pengelolaID+"'>Delete</button></td>"+
                            "</tr>";
                }
                $('#pengelolaData').html(html);
                $('#pengelolaTable').DataTable({
                    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]]
                });
            }
        });
    }

   
    $('#add-pengelola').on('click', function(){
        $('#ModalADD').modal("show");
    });

      

    $('#btn-simpan').on('click', function(){

        $("#ModalADD").on('hide.bs.modal', function(){
            $('.pengelolaNama_error').empty();
            $('.pengelolaTelepon_error').empty();  
            $('.pengelolaUsername_error').empty();
            $('.pengelolaPassword_error').empty();  
            $('.pengelolaAlamat_error').empty();

        });
        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('superadmin/pengelola/add')?>",
            dataType : "JSON",
            data : $('#formAdd').serialize(),
            success: function(response, data){
                console.log(response);
                if(response.status == 'success'){
                    console.log("sukses");

                    $('.pengelolaNama_error').html("");
                    $('.pengelolaTelepon_error').html("");
                    $('.pengelolaUsername_error').html("");
                    $('.pengelolaPassword_error').html("");
                    $('.pengelolaAlamat_error').html(""); 
                    $('#ModalADD').modal('hide');
                    location.reload();
                }else{
  
                    $('.pengelolaNama_error').html(response.pengelolaNama);
                    $('.pengelolaTelepon_error').html(response.pengelolaTelepon);    
                    $('.pengelolaUsername_error').html(response.pengelolaUsername);
                    $('.pengelolaPassword_error').html(response.pengelolaPassword); 
                    $('.pengelolaAlamat_error').html(response.pengelolaAlamat);
                }   
            }
        });
        return false;
    });


    $('#pengelolaTable').on('click','#btn-edit',function(){
        var id=$(this).attr('value');
        // console.log(id);
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('superadmin/pengelola/getpengelolaID')?>",
            dataType : "JSON",
            data : {id:id},
            success: function(data){
                $.each(data,function(pengelolaID, pengelolaNama, pengelolaTelepon, pengelolaEmail, pengelolaUsername, pengelolaPassword,  pengelolaGender, pengelolaAlamat){
                    $('#ModalEdit').modal('show');
                    $('[name="editpengelolaID"]').val(data.pengelolaID);
                    $('[name="editpengelolaNama"]').val(data.pengelolaNama);
                    $('[name="editpengelolaTelepon"]').val(data.pengelolaTelepon);
                    $('[name="editpengelolaEmail"]').val(data.pengelolaEmail);
                    $('[name="editpengelolaUsername"]').val(data.pengelolaUsername);
                    $('[name="editpengelolaPassword"]').val(data.pengelolaPassword);
                    $('[name="editpengelolaGender"]').val(data.pengelolaGender);
                    $('[name="editpengelolaAlamat"]').val(data.pengelolaAlamat);
                });
            }
        });
        return false;
    });

  

    $('#btn-update').on('click', function(){
      

        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('superadmin/pengelola/edit')?>",
            dataType : "JSON",
            data : $('#formEdit').serialize(),
            success : function(data){
                console.log('sukses');
                $('#modalEdit').modal('hide');
                location.reload();
            }
        });
        return false;
    });

    //  // ------------- GET HAPUS ----------------------
     $('#pengelolaTable').on('click','#btn-delete',function(){
        var id=$(this).attr('value');

        $('#modalHapus').modal('show');
        $('[name="deletepengelolaID"]').val(id);
    });
    // ------------- GET HAPUS END ----------------------

     // --------------- DELETE pengelola -------------------------------
     $('#delete').on('click',function(){
        var pengelolaID = $('#deletepengelolaID').val();
        console.log(pengelolaID);
        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('superadmin/pengelola/del')?>",
            dataType : "JSON",
            data : {pengelolaID: pengelolaID},
            success: function(){
                $('#modalHapus').modal('hide');
                location.reload();                   
            }     
        });
            return false;
    });
    // --------------- DELETE pengelola END-------------------------------

   

   

    


});
</script>




 
</body>

</html>
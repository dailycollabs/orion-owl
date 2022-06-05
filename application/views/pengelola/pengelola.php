<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("pengelola/_partials/head.php") ?>
</head>


<body class="hold-transition sidebar-mini">
<div></div>
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
                                <button id="add-pengguna" class="btn bg-primary">TAMBAH PENGGUNA</button>
                            </div>
                        </div>
                        <div class="card-body">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="penggunaTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5px">#</th>
                                                <th>NPWP</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
                                                <th>No Telepon</th>
                                                <th>Username</th>
                                                <th>Level</th>
                                              
                                               
                                                <th style="text-align:center">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="penggunaData"></tbody>

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
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body m-4">
                            
                            <form id="formAdd">
                                
                                <input type="hidden" name="penggunaID"  class="form-control" id="penggunaID">
                                
                                <div class="form-group">
                                    <label for="">Nama Bidang *</label>
                                    <select class="form-control" name="bidang" id="bidang">
                                    <option value="x">-Pilih-</option>
                                    <?php foreach($data->result() as $row){?>
                                        <option id="no" value="<?=$row->bidangID?>"><?=$row->bidangNama?></option>
                                    <?php } ?>
                                    </select>
                                    <span class="bidang_error text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Sub Bidang *</label>
                                    <select class="custom-select" name="subbidang" id="subbidang">
                                        <option></option>
                                    </select>  
                                    <span class="subbidang_error text-danger"></span>
                                </div>
                                
                                <div class="form-group <?=form_error('penggunaNik') ? 'has-error' : null ?>">
                                    <label for="">NPWP *</label>
                                    <input type="text" name="penggunanpwp"  class="form-control" id="penggunanpwp">
                                    <span class="penggunanpwp_error text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Nama Lengkap *</label>
                                    <input type="text" name="penggunaNama"  class="form-control" id="penggunaNama">
                                    <span class="penggunaNama_error text-danger"></span>
                                </div>

                                

                                <div class="form-group">
                                    <label for="">Username *</label>
                                    <input type="text" name="penggunaUsername"  class="form-control" id="penggunaUsername">
                                    <span class="penggunaUsername_error text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Password *</label>
                                    <input type="password" name="penggunaPassword"  class="form-control" id="penggunaPassword">  
                                    <span class="penggunaPassword_error text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Email *</label>
                                    <input type="text" name="penggunaEmail"  class="form-control" id="penggunaEmail">  
                                </div>
                                <div class="form-group">
                                    <label for="">Telepon *</label>
                                    <input type="text" name="penggunaTelepon"  class="form-control" id="penggunaTelepon">
                                    <span class="penggunaTelepon_error text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Kelamin *</label>
                                    <select class="custom-select" name="penggunaGender" id="penggunaGender">
                                        <option value="1">Laki-Laki</option>
                                        <option value="2">Perempuan</option>
                                    </select>  
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat *</label>
                                    <input type="text" name="penggunaAlamat"  class="form-control" id="penggunaAlamat">
                                    <span class="penggunaAlamat_error text-danger"></span>
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
                            <h5 class="modal-title" id="exampleModalLabel">Edit Pengguna</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body m-4">
                            
                            <form id="formEdit">
                                
                                <input type="hidden" name="editpenggunaID"  class="form-control" id="editpenggunaID">
                                
                                <div class="form-group">
                                    <label for="">Nama Bidang *</label>
                                    <select class="form-control" name="editBidang" id="editBidang">
                                    <option value="x">-Pilih-</option>
                                    <?php foreach($data->result() as $row){?>
                                        <option id="no" value="<?=$row->bidangID?>"><?=$row->bidangNama?></option>
                                    <?php } ?>
                                    </select>
                                    <span class="bidang_error text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Sub Bidang *</label>
                                    <select class="custom-select" name="editSubbidang" id="editSubbidang">
                                        <option></option>
                                    </select>  
                                    <span class="editSubbidang_error text-danger"></span>
                                </div>                            
                                <div class="form-group <?=form_error('penggunaNik') ? 'has-error' : null ?>">
                                    <label for="">NPWP *</label>
                                    <input type="text" name="editpenggunaNPWP"  class="form-control" id="editpenggunaNPWP">
                                    <span class="editpenggunaNPWP_error text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Nama Lengkap *</label>
                                    <input type="text" name="editpenggunaNama"  class="form-control" id="editpenggunaNama">
                                    <span class="editpenggunaNama_error text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Telepon *</label>
                                    <input type="text" name="editpenggunaTelepon"  class="form-control" id="editpenggunaTelepon">
                                    <span class="editpenggunaTelepon_error text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Email *</label>
                                    <input type="text" name="editpenggunaEmail"  class="form-control" id="editpenggunaEmail">  
                                </div>
                                <div class="form-group">
                                    <label for="">Username *</label>
                                    <input type="text" name="editpenggunaUsername"  class="form-control" id="editpenggunaUsername">
                                    <span class="editpenggunaUsername_error text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Password *</label>
                                    <input type="password" name="editpenggunaPassword"  class="form-control" id="editpenggunaPassword">  
                                    <span class="editpenggunaPassword_error text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Kelamin *</label>
                                    <select class="custom-select" name="editpenggunaGender" id="editpenggunaGender">
                                        <option value="1">Laki-Laki</option>
                                        <option value="2">Perempuan</option>
                                    </select>  
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat *</label>
                                    <input type="text" name="editpenggunaAlamat"  class="form-control" id="editpenggunaAlamat">
                                    <span class="editpenggunaAlamat_error text-danger"></span>
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
                        <h4 class="modal-title" id="myModalLabel">Hapus Pengguna</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>    
                    </div>

                    <form class="form-horizontal">
                    
                        <div class="modal-body">                      
                            <input type="hidden" name="deletepenggunaID"  class="form-control" id="deletepenggunaID">
                            <div class=""><p>Apakah Anda yakin Inggin Menghapus Akun Pengguna ini ?</p></div>
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

    getPenggunaData();
    function getPenggunaData(){

        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('superadmin/pengguna/getPengguna')?>",
            dataType : "JSON",
            success : function(data){
                var html;
                var i;
                var n = 1;
                for(i=0; i<data.length; i++){
                    html += "<tr>"+
                            "<td>"+ n++ +"</td>"+
                            "<td>"+data[i].penggunaNPWP+"</td>"+
                            "<td>"+data[i].penggunaNama+"</td>";
                    if(data[i].penggunaGender == 1){
                        html +=  "<td>Laki-laki</td>";     
                    } else if(data[i].penggunaGender == 2){
                        html +=  "<td>Perempuan</td>";
                    }
                    html += "<td>"+data[i].penggunaNoTelepon+"</td>"+
                            "<td>"+data[i].penggunaUsername+"</td>"+
                            "<td>"+data[i].bidangNama+"</td>"+
                            // "<td>"+data[i].subbidangNama+"</td>"+
                            "<td style='text-align:center'><button class='btn btn-info' id='btn-detail' value='"+data[i].penggunaID+"'>Detail</button> <button class='btn btn-primary' id='btn-edit' value='"+data[i].penggunaID+"'>Edit</button> <button class='btn btn-danger' id='btn-delete' value='"+data[i].penggunaID+"'>Delete</button></td>"+
                            "</tr>";
                }
                $('#penggunaData').html(html);
                $('#penggunaTable').DataTable({
                    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]]
                });
            }
        });
    }

   
    $('#add-pengguna').on('click', function(){
        $('#ModalADD').modal("show");
    });


    $('#bidang').change(function(){ 
        var id=$(this).val();
        console.log(id);
        $.ajax({
            url : "<?php echo site_url('superadmin/pengguna/ceksubbidang');?>",
            method : "GET",
            data : {id: id},
            async : true,
            dataType : 'json',
            success: function(data){  
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].subbidangID+'>'+data[i].subbidangNama+'</option>';
                }
                $('#subbidang').html(html);
            }
        });
        return false;
    });       

    $('#btn-simpan').on('click', function(){

        $("#ModalADD").on('hide.bs.modal', function(){
            $('.subbidang_error').empty();
            $('.npwp_error').empty();
            $('.penggunaNama_error').empty();
            $('.penggunaTelepon_error').empty();  
            $('.penggunaUsername_error').empty();
            $('.penggunaPassword_error').empty();  
            $('.penggunaAlamat_error').empty();

        });
        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('superadmin/pengguna/add')?>",
            dataType : "JSON",
            data : $('#formAdd').serialize(),
            success: function(response, data){
                console.log(response);
                if(response.status == 'success'){
                    console.log("sukses");

                    $('.subbidang_error').html("");
                    $('.npwp_error').html("");
                    $('.penggunaNama_error').html("");
                    $('.penggunaTelepon_error').html("");
                    $('.penggunaUsername_error').html("");
                    $('.penggunaPassword_error').html("");
                    $('.penggunaAlamat_error').html(""); 
                    $('#ModalADD').modal('hide');
                    location.reload();
                }else{
                    $('.subbidang_error').html(response.subbidang);
                    $('.npwp_error').html(response.npwp);
                    $('.penggunaNama_error').html(response.penggunaNama);
                    $('.penggunaTelepon_error').html(response.penggunaTelepon);    
                    $('.penggunaUsername_error').html(response.penggunaUsername);
                    $('.penggunaPassword_error').html(response.penggunaPassword); 
                    $('.penggunaAlamat_error').html(response.penggunaAlamat);
                }   
            }
        });
        return false;
    });


    $('#penggunaTable').on('click','#btn-edit',function(){
        var id=$(this).attr('value');
        // console.log(id);
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('superadmin/pengguna/getPenggunaID')?>",
            dataType : "JSON",
            data : {id:id},
            success: function(data){
                $.each(data,function(penggunaID, bidangID, penggunaSubbidangID,subbidangNama, penggunaNPWP, penggunaNama, penggunaNoTelepon, penggunaEmail, penggunaUsername, penggunaPassword,  penggunaGender, penggunaAlamat){
                    $('#ModalEdit').modal('show');
                    $('[name="editpenggunaID"]').val(data.penggunaID);
                    $('[name="editBidang"]').val(data.bidangID);
                    $('#editSubbidang option:selected').val(data.penggunaSubbidangID).text(data.subbidangNama);
                    $('[name="editpenggunaNPWP"]').val(data.penggunaNPWP);
                    $('[name="editpenggunaNama"]').val(data.penggunaNama);
                    $('[name="editpenggunaTelepon"]').val(data.penggunaNoTelepon);
                    $('[name="editpenggunaEmail"]').val(data.penggunaEmail);
                    $('[name="editpenggunaUsername"]').val(data.penggunaUsername);
                    $('[name="editpenggunaPassword"]').val(data.penggunaPassword);
                    $('[name="editpenggunaGender"]').val(data.penggunaGender);
                    $('[name="editpenggunaAlamat"]').val(data.penggunaAlamat);
                });
            }
        });
        return false;
    });

    $('#editBidang').change(function(){ 
        var id=$(this).val();
        console.log(id);
        $.ajax({
            url : "<?php echo site_url('superadmin/pengguna/ceksubbidang');?>",
            method : "GET",
            data : {id: id},
            async : true,
            dataType : 'json',
            success: function(data){ 
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].subbidangID+'>'+data[i].subbidangNama+'</option>';
                }
                $('#editSubbidang').html(html);
            }
        });
        return false;
    }); 

    $('#btn-update').on('click', function(){
      
        var a = $('#editBidang').val();
        var b = $('#editSubbidang').val();

        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('superadmin/pengguna/edit')?>",
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

     // ------------- GET HAPUS ----------------------
     $('#penggunaTable').on('click','#btn-delete',function(){
        var id=$(this).attr('value');

        $('#modalHapus').modal('show');
        $('[name="deletepenggunaID"]').val(id);
    });
    // ------------- GET HAPUS END ----------------------

     // --------------- DELETE PENGGUNA -------------------------------
     $('#delete').on('click',function(){
        var penggunaID = $('#deletepenggunaID').val();
        console.log(penggunaID);
        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('superadmin/pengguna/del')?>",
            dataType : "JSON",
            data : {penggunaID: penggunaID},
            success: function(){
                $('#modalHapus').modal('hide');
                location.reload();                   
            }     
        });
            return false;
    });
    // --------------- DELETE PENGGUNA END-------------------------------

   

   

    


});
</script>




 
</body>

</html>
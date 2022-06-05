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
                                <button id="add-petugas" class="btn bg-primary">Tambah Petugas</button>
                            </div>
                        </div>
                        <div class="card-body">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="petugasTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5px">#</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
                                                <th>No Telepon</th>
                                                <th>Username</th>
                                                <th>Bidang</th>
                                                <th>SubBidang</th>
                                                <th>Level</th>
                                                <th style="text-align:center">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="petugasData"></tbody>

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
                            <h5 class="modal-title" id="exampleModalLabel">Tambah petugas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body m-4">
                            
                            <form id="formAdd">
                                
                                <input type="hidden" name="petugasID"  class="form-control" id="petugasID">
                                
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
                                
                                <div class="form-group <?=form_error('petugasNik') ? 'has-error' : null ?>">
                                    <label for="">NPWP *</label>
                                    <input type="text" name="petugasnpwp"  class="form-control" id="petugasnpwp">
                                    <span class="petugasnpwp_error text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Nama Lengkap *</label>
                                    <input type="text" name="petugasNama"  class="form-control" id="petugasNama">
                                    <span class="petugasNama_error text-danger"></span>
                                </div>

                                

                                <div class="form-group">
                                    <label for="">Username *</label>
                                    <input type="text" name="petugasUsername"  class="form-control" id="petugasUsername">
                                    <span class="petugasUsername_error text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Password *</label>
                                    <input type="password" name="petugasPassword"  class="form-control" id="petugasPassword">  
                                    <span class="petugasPassword_error text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Email *</label>
                                    <input type="text" name="petugasEmail"  class="form-control" id="petugasEmail">  
                                </div>
                                <div class="form-group">
                                    <label for="">Telepon *</label>
                                    <input type="text" name="petugasTelepon"  class="form-control" id="petugasTelepon">
                                    <span class="petugasTelepon_error text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Kelamin *</label>
                                    <select class="custom-select" name="petugasGender" id="petugasGender">
                                        <option value="1">Laki-Laki</option>
                                        <option value="2">Perempuan</option>
                                    </select>  
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat *</label>
                                    <input type="text" name="petugasAlamat"  class="form-control" id="petugasAlamat">
                                    <span class="petugasAlamat_error text-danger"></span>
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
                            <h5 class="modal-title" id="exampleModalLabel">Edit petugas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body m-4">
                            
                            <form id="formEdit">
                                
                                <input type="hidden" name="editpetugasID"  class="form-control" id="editpetugasID">
                                
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
                                <div class="form-group <?=form_error('petugasNik') ? 'has-error' : null ?>">
                                    <label for="">NPWP *</label>
                                    <input type="text" name="editpetugasNPWP"  class="form-control" id="editpetugasNPWP">
                                    <span class="editpetugasNPWP_error text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Nama Lengkap *</label>
                                    <input type="text" name="editpetugasNama"  class="form-control" id="editpetugasNama">
                                    <span class="editpetugasNama_error text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Telepon *</label>
                                    <input type="text" name="editpetugasTelepon"  class="form-control" id="editpetugasTelepon">
                                    <span class="editpetugasTelepon_error text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Email *</label>
                                    <input type="text" name="editpetugasEmail"  class="form-control" id="editpetugasEmail">  
                                </div>
                                <div class="form-group">
                                    <label for="">Username *</label>
                                    <input type="text" name="editpetugasUsername"  class="form-control" id="editpetugasUsername">
                                    <span class="editpetugasUsername_error text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Password *</label>
                                    <input type="password" name="editpetugasPassword"  class="form-control" id="editpetugasPassword">  
                                    <span class="editpetugasPassword_error text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Kelamin *</label>
                                    <select class="custom-select" name="editpetugasGender" id="editpetugasGender">
                                        <option value="1">Laki-Laki</option>
                                        <option value="2">Perempuan</option>
                                    </select>  
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat *</label>
                                    <input type="text" name="editpetugasAlamat"  class="form-control" id="editpetugasAlamat">
                                    <span class="editpetugasAlamat_error text-danger"></span>
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
                        <h4 class="modal-title" id="myModalLabel">Hapus petugas</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>    
                    </div>

                    <form class="form-horizontal">
                    
                        <div class="modal-body">                      
                            <input type="hidden" name="deletepetugasID"  class="form-control" id="deletepetugasID">
                            <div class=""><p>Apakah Anda yakin Inggin Menghapus Akun petugas ini ?</p></div>
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

    getpetugasData();
    function getpetugasData(){

        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('superadmin/petugas/getpetugas')?>",
            dataType : "JSON",
            success : function(data){
                var html;
                var i;
                var n = 1;
                for(i=0; i<data.length; i++){
                    html += "<tr>"+
                            "<td>"+ n++ +"</td>"+
                            "<td>"+data[i].petugasNama+"</td>";
                    if(data[i].petugasGender == 1){
                        html +=  "<td>Laki-laki</td>";     
                    } else if(data[i].petugasGender == 2){
                        html +=  "<td>Perempuan</td>";
                    }
                    html += "<td>"+data[i].petugasTelepon+"</td>"+
                            "<td>"+data[i].petugasUsername+"</td>"+
                            "<td>"+data[i].bidangNama+"</td>"+
                            "<td>"+data[i].subbidangNama+"</td>"+
                            "<td>"+data[i].subidangrules+"</td>"+
                            "<td style='text-align:center'><button class='btn btn-info' id='btn-detail' value='"+data[i].petugasID+"'>Detail</button> <button class='btn btn-primary' id='btn-edit' value='"+data[i].petugasID+"'>Edit</button> <button class='btn btn-danger' id='btn-delete' value='"+data[i].petugasID+"'>Delete</button></td>"+
                            "</tr>";
                }
                $('#petugasData').html(html);
                $('#petugasTable').DataTable({
                    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]]
                });
            }
        });
    }

   
    $('#add-petugas').on('click', function(){
        $('#ModalADD').modal("show");
    });


    $('#bidang').change(function(){ 
        var id=$(this).val();
        console.log(id);
        $.ajax({
            url : "<?php echo site_url('superadmin/petugas/ceksubbidang');?>",
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
            $('.petugasNama_error').empty();
            $('.petugasTelepon_error').empty();  
            $('.petugasUsername_error').empty();
            $('.petugasPassword_error').empty();  
            $('.petugasAlamat_error').empty();

        });
        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('superadmin/petugas/add')?>",
            dataType : "JSON",
            data : $('#formAdd').serialize(),
            success: function(response, data){
                console.log(response);
                if(response.status == 'success'){
                    console.log("sukses");

                    $('.subbidang_error').html("");
                    $('.npwp_error').html("");
                    $('.petugasNama_error').html("");
                    $('.petugasTelepon_error').html("");
                    $('.petugasUsername_error').html("");
                    $('.petugasPassword_error').html("");
                    $('.petugasAlamat_error').html(""); 
                    $('#ModalADD').modal('hide');
                    location.reload();
                }else{
                    $('.subbidang_error').html(response.subbidang);
                    $('.npwp_error').html(response.npwp);
                    $('.petugasNama_error').html(response.petugasNama);
                    $('.petugasTelepon_error').html(response.petugasTelepon);    
                    $('.petugasUsername_error').html(response.petugasUsername);
                    $('.petugasPassword_error').html(response.petugasPassword); 
                    $('.petugasAlamat_error').html(response.petugasAlamat);
                }   
            }
        });
        return false;
    });


    $('#petugasTable').on('click','#btn-edit',function(){
        var id=$(this).attr('value');
        // console.log(id);
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('superadmin/petugas/getpetugasID')?>",
            dataType : "JSON",
            data : {id:id},
            success: function(data){
                $.each(data,function(petugasID, bidangID, subbidangID,subbidangNama, petugasNPWP, petugasNama, petugasTelepon, petugasEmail, petugasUsername, petugasPassword,  petugasGender, petugasAlamat){
                    $('#ModalEdit').modal('show');
                    $('[name="editpetugasID"]').val(data.petugasID);
                    $('[name="editBidang"]').val(data.bidangID);
                    $('#editSubbidang option:selected').val(data.subbidangID).text(data.subbidangNama);
                    $('[name="editpetugasNPWP"]').val(data.petugasNPWP);
                    $('[name="editpetugasNama"]').val(data.petugasNama);
                    $('[name="editpetugasTelepon"]').val(data.petugasTelepon);
                    $('[name="editpetugasEmail"]').val(data.petugasEmail);
                    $('[name="editpetugasUsername"]').val(data.petugasUsername);
                    $('[name="editpetugasPassword"]').val(data.petugasPassword);
                    $('[name="editpetugasGender"]').val(data.petugasGender);
                    $('[name="editpetugasAlamat"]').val(data.petugasAlamat);
                });
            }
        });
        return false;
    });

    $('#editBidang').change(function(){ 
        var id=$(this).val();
        console.log(id);
        $.ajax({
            url : "<?php echo site_url('superadmin/petugas/ceksubbidang');?>",
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
            url  : "<?php echo base_url('superadmin/petugas/edit')?>",
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
     $('#petugasTable').on('click','#btn-delete',function(){
        var id=$(this).attr('value');

        $('#modalHapus').modal('show');
        $('[name="deletepetugasID"]').val(id);
    });
    // ------------- GET HAPUS END ----------------------

     // --------------- DELETE petugas -------------------------------
     $('#delete').on('click',function(){
        var petugasID = $('#deletepetugasID').val();
        console.log(petugasID);
        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('superadmin/petugas/del')?>",
            dataType : "JSON",
            data : {petugasID: petugasID},
            success: function(){
                $('#modalHapus').modal('hide');
                location.reload();                   
            }     
        });
            return false;
    });
    // --------------- DELETE petugas END-------------------------------

   

   

    


});
</script>




 
</body>

</html>
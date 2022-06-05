<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("petugas/_partials/head.php") ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php $this->load->view("client/_partials/navbar.php")?>
        <!-- Content Wrapper. Contains page content -->
        <?php $this->load->view("client/_partials/sidebar.php")?>

        <div class="content-wrapper">
        <?php $this->load->view("client/_partials/breadcrumb.php")?>

            <section class="content">
                <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="<?= base_url() ?>uploads/clientFile/clientFoto/<?=$this->fungsi->client_login()->clientFotoProfil?>" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?=$this->fungsi->client_login()->clientUsername?></h3>

                        <p class="text-muted text-center"><?=$this->fungsi->client_login()->clientPerusahaan_nama?></p>
                        
                        
                        <a href="#" class="btn btn-primary btn-block" id="edit"><b>Edit</b></a>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    
                    <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                DATA PRIBADI
                            </div>
                            <div class="card-body">
                            <div class="tab-content">
                                

                                <div class="tab-pane active" id="settings">
                                <form class="form-horizontal">
                                <input type="hidden" class="form-control" id="clientID" value="<?=$this->fungsi->client_login()->clientID?>">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Foto Profil</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="fprofil"  value="<?=$this->fungsi->client_login()->clientFotoProfil?>" readonly>
                                            <div class="d-none" id="fprofil_edit_form">
                                                <input type="text" class="form-control" id="fprofil_old"  value="<?=$this->fungsi->client_login()->clientFotoProfil?>" readonly>
                                                <input type="file" class="form-control" id="fprofil_edit">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">NPWP</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="npwp"  value="<?=$this->fungsi->client_login()->clientNPWP?>" readonly>
                                            <div class="d-none" id="npwp_edit_form">
                                                <input type="text" class="form-control" id="npwp_edit"  value="<?=$this->fungsi->client_login()->clientNPWP?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nama" value="<?=$this->fungsi->client_login()->clientNama?>" readonly>
                                            <div class="d-none" id="nama_edit_form">
                                                <input type="text" class="form-control" id="nama_edit" value="<?=$this->fungsi->client_login()->clientNama?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="username" value="<?=$this->fungsi->client_login()->clientUsername?>" readonly>
                                            <div class="d-none" id="username_edit_form">
                                                <input type="text" class="form-control" id="username_edit" value="<?=$this->fungsi->client_login()->clientUsername?>" >
                                            </div>   
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="password" value="<?=$this->fungsi->client_login()->clientPassword?>" readonly>
                                            <div class="d-none" id="password_edit_form">
                                                <input type="password" class="form-control" id="password_edit" value="<?=$this->fungsi->client_login()->clientPassword?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Tgl Lahir</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="tglLahir" value="<?=$this->fungsi->client_login()->clientTglLahir?>" readonly>
                                            <div class="d-none" id="tglLahir_edit_form">
                                                <input type="text" class="form-control" id="tglLahir_edit" value="<?=$this->fungsi->client_login()->clientTglLahir?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-10">
                                        <?php if($this->fungsi->client_login()->clientJenisKelamin == 1){?>
                                            <input type="text" class="form-control" id="jk" value="Laki-laki" readonly>
                                        <?php }else if($this->fungsi->client_login()->clientJenisKelamin == 2){?>
                                            <input type="text" class="form-control" id="jk" value="Perempuan" readonly>
                                        <?php } ?>
                                            
                                            <div class="d-none" id="jk_edit_form">
                                            <select name="jenisKelamin" id="jk_edit" class="form-control">
                                                <option value="1" <?=$this->fungsi->client_login()->clientJenisKelamin == 1 ? 'selected' : ''?>>Laki-laki</option>
                                                <option value="2" <?=$this->fungsi->client_login()->clientJenisKelamin == 2 ? 'selected' : ''?>>Perempuan</option>
                                            </select>
                                                <!-- <input type="text" class="form-control" id="jk_edit" value="<?=$this->fungsi->client_login()->clientJenisKelamin?>" > -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Telepon</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="telepon" value="<?=$this->fungsi->client_login()->clientTelepon?>" readonly>
                                            <div class="d-none" id="telepon_edit_form">
                                                <input type="text" class="form-control" id="telepon_edit" value="<?=$this->fungsi->client_login()->clientTelepon?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="email" value="<?=$this->fungsi->client_login()->clientNPWP?>" readonly>
                                            <div class="d-none" id="email_edit_form">
                                                <input type="text" class="form-control" id="email_edit" value="<?=$this->fungsi->client_login()->clientNPWP?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="alamat" value="<?=$this->fungsi->client_login()->clientAlamat?>" readonly>
                                            <div class="d-none" id="alamat_edit_form">
                                                <input type="text" class="form-control" id="alamat_edit" value="<?=$this->fungsi->client_login()->clientAlamat?>">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                        <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <div class="card">
                            <div class="card-header">
                                DATA PERUSAHAAN
                            </div>
                            <div class="card-body">
                            <div class="tab-content">
                                

                                <div class="tab-pane active" id="settings">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                       
                                        <label for="inputName" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="namaPerusahaan" value="<?=$this->fungsi->client_login()->clientAlamat?>" readonly>
                                            <div class="d-none" id="namaPerusahaan_edit_form">
                                                <input type="text" class="form-control " id="namaPerusahaan_edit" value="<?=$this->fungsi->client_login()->clientAlamat?>">
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Jabatan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="jabatanPerusahaan" value="<?=$this->fungsi->client_login()->clientPerusahaan_jabatan?>" readonly>
                                            <div class="d-none" id="jabatanPerusahaan_edit_form">
                                                <input type="text" class="form-control" id="jabatanPerusahaan_edit"   value="<?=$this->fungsi->client_login()->clientAlamat?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="emailPerusahaan" value="<?=$this->fungsi->client_login()->clientPerusahaan_email?>" readonly>
                                            <div class="d-none" id="emailPerusahaan_edit_form">
                                                <input type="text" class="form-control" id="emailPerusahaan_edit" value="<?=$this->fungsi->client_login()->clientAlamat?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Telepon</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="teleponPerusahaan" value="<?=$this->fungsi->client_login()->clientPerusahaan_telepon?>" readonly>
                                            <div class="d-none" id="teleponPerusahaan_edit_form">
                                                <input type="text" class="form-control" id="teleponPerusahaan_edit" value="<?=$this->fungsi->client_login()->clientAlamat?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="alamatPerusahaan" value="<?=$this->fungsi->client_login()->clientPerusahaan_alamat?>" readonly>
                                            <div class="d-none" id="alamatPerusahaan_edit_form">
                                                <input type="text" class="form-control" id="alamatPerusahaan_edit"  value="<?=$this->fungsi->client_login()->clientAlamat?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="float-right">
                                        <button class="btn btn-primary" id="btn-simpan">Simpan</button>
                                        <button class="btn btn-secondary">Reset</button>
                                    </div>
                                    
                                </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                        <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
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
        <?php $this->load->view("client/_partials/footer.php") ?>
    
    </div>
<!-- ./wrapper -->

<!-- Javascript -->
<?php $this->load->view("client/_partials/js.php") ?>

<script>
$(document).ready(function(){

    $('#edit').on('click', function(){

        
        $('#fprofil').addClass("d-none").hide();
        $('#fprofil_edit_form').removeClass("d-none");

        $('#npwp').addClass("d-none").hide();
        $('#npwp_edit_form').removeClass("d-none");

        $('#nama').addClass("d-none").hide();
        $('#nama_edit_form').removeClass("d-none");

        $('#username').addClass("d-none").hide();
        $('#username_edit_form').removeClass("d-none");  

        $('#password').addClass("d-none").hide();
        $('#password_edit_form').removeClass("d-none");

        $('#tglLahir').addClass("d-none").hide();
        $('#tglLahir_edit_form').removeClass("d-none");

        $('#jk').addClass("d-none").hide();
        $('#jk_edit_form').removeClass("d-none");

        $('#telepon').addClass("d-none").hide();
        $('#telepon_edit_form').removeClass("d-none");

        $('#email').addClass("d-none").hide();
        $('#email_edit_form').removeClass("d-none");

        $('#alamat').addClass("d-none").hide();
        $('#alamat_edit_form').removeClass("d-none");

        $('#namaPerusahaan').addClass("d-none").hide();
        $('#namaPerusahaan_edit_form').removeClass("d-none");

        $('#jabatanPerusahaan').addClass("d-none").hide();
        $('#jabatanPerusahaan_edit_form').removeClass("d-none");

        $('#emailPerusahaan').addClass("d-none").hide();
        $('#emailPerusahaan_edit_form').removeClass("d-none");

        $('#teleponPerusahaan').addClass("d-none").hide();
        $('#teleponPerusahaan_edit_form').removeClass("d-none");

        $('#alamatPerusahaan').addClass("d-none").hide();
        $('#alamatPerusahaan_edit_form').removeClass("d-none");
      

        return false;
    });


    $('#btn-simpan').on('click', function(e){
        $('.quoID_error').empty();  
        $('.quoFile_error').empty();
        e.preventDefault();

        var myformData = new FormData(); 
        
        myformData.append('clientID', $("#clientID").val());
        myformData.append('npwp', $("#npwp_edit").val());
        myformData.append('fullname', $("#nama_edit").val());
        myformData.append('username', $("#username_edit").val());
        myformData.append('password', $("#password_edit").val());
        myformData.append('tglLahir', $("#tglLahir_edit").val());
        myformData.append('jenisKelamin', $("#jk_edit").val());
        myformData.append('email', $("#email_edit").val()); 
        myformData.append('noTelepon', $("#telepon_edit").val()); 
        myformData.append('alamat', $("#alamat_edit").val());
        myformData.append('namaPerusahaan', $("#namaPerusahaan_edit").val());
        myformData.append('jabatanPerusahaan', $("#jabatanPerusahaan_edit").val());
        myformData.append('emailPerusahaan', $("#emailPerusahaan_edit").val());
        myformData.append('teleponPerusahaan', $("#teleponPerusahaan_edit").val());
        myformData.append('alamatPerusahaan', $("#alamatPerusahaan_edit").val());
        myformData.append('fprofil_old', $("#fprofil_old").val());
        myformData.append('fprofil', $('#fprofil_edit')[0].files[0]);

        

        console.log(myformData);
        
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('Client/edit')?>",
            dataType : "JSON",
            data : myformData,
            contentType: false,
            processData: false,
            cache: false,
            enctype: 'multipart/form-data',
            
            success: function(response){
                console.log(response);
                if(response.status == 'success'){
                    $('.quoID').html("");
                    $('.quoFile').html("");
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'File Berhasil Di Upload!',
                        text: 'You clicked the button!',
                    })
                    .then(function() {
                        window.location.assign("<?php echo base_url();?>Client/profilClient");
                    });

                } 
                else if(response.status == 'error-upload'){
                    $('.quoFile_error').html(response.quoFile);

                } 
                else{
                    console.log(response);
                    $('.quoID_error').html(response.quoID);
                    $('.quoFile_error').html(response.quoFile); 
                }   
            }
        });
        return false;
    });




});
</script>



</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V17</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?=base_url()?>assets/assets_client/registrasi/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/assets_client/registrasi/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/assets_client/registrasi/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/assets_client/registrasi/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/assets_client/registrasi/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/assets_client/registrasi/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/assets_client/registrasi/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/assets_client/registrasi/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/assets_client/registrasi/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/assets_client/registrasi/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/assets_client/registrasi/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" >
			<div class="wrap-login100">
				<form class="login100-form validate-form" id="formAdd">
					<span class="login100-form-title p-b-30">
						REGISTRASI AKUN
					</span>
					<div class="form-group w-100 ">
						<label for="exampleInputEmail1">NPWP</label>
						<input type="text" name="npwp" class="form-control" id="npwp" aria-describedby="emailHelp">	
						<h1 class="  m-0 text-danger npwp_error" id="npwp_error"></h1>
					</div>
					<div class="form-group w-100">
						<label for="exampleInputEmail1">Nama Lengkap</label>
						<input type="text" name="fullname" class="form-control" id="fullname" aria-describedby="emailHelp">
						<span class=" p-0 m-0 text-danger fullname_error" id="fullname_error"></span>
					</div>
					<div class="form-group w-100 ">
						<label for="exampleInputEmail1">Username</label>
						<input type="text"  name="username" class="form-control" id="username" aria-describedby="emailHelp">
						<span class=" p-0 m-0 text-danger username_error" id="username_error"></span>
					</div>
					<div class="form-group w-100">
						<label for="exampleInputEmail1">Password</label>
						<input type="password" name="password" class="form-control" id="password" aria-describedby="emailHelp">
						<span class=" p-0 m-0 text-danger password_error" id="password_error"></span>
					</div>
					<div class="form-group w-100 ">
						<label for="exampleInputEmail1">Tgl Lahir</label>
						<input type="date" name="tglLahir" class="form-control" id="tglLahir" aria-describedby="emailHelp">
						<span class=" p-0 m-0 text-danger tglLahir_error" id="tglLahir_error"></span>
					</div>
					<div class="form-group w-100">
						<label for="exampleInputEmail1">Jenis Kelamin</label>
						<select name="jenisKelamin" id="jenisKelamin" class="form-control">
							<option value="1">Laki-laki</option>
							<option value="2">Perempuan</option>
						</select>
						<!-- <input type="text" name="jenisKelamin" class="form-control" id="jenisKelamin" aria-describedby="emailHelp"> -->
						<span class=" p-0 m-0 text-danger jenisKelamin_error" id="jenisKelamin_error"></span>
					</div>
					<div class="form-group w-100">
						<label for="exampleInputEmail1">Telepon</label>
						<input type="text" name="noTelepon" class="form-control" id="noTelepon" aria-describedby="emailHelp">
						<span class=" p-0 m-0 text-danger noTelepon_error" id="noTelepon_error"></span>
					</div>
					<div class="form-group w-100">
						<label for="exampleInputEmail1">Email</label>
						<input type="text" name="email" class="form-control" id="email" aria-describedby="emailHelp">
						<span class=" p-0 m-0 text-danger email_error" id="email_error"></span>
					</div>
					<!-- <div class="form-group w-100">
						<label for="exampleInputEmail1">alamat</label>
						<input type="text" name="alamat" class="form-control" id="alamat" aria-describedby="emailHelp">
						<span class=" p-0 m-0 text-danger alamat_error" id="alamat_error"></span>
					</div>
					<div class="form-group w-100">
						<label for="exampleInputEmail1">Nama Perusahaan</label>
						<input type="text" name="namaPerusahaan" class="form-control" id="namaPerusahaan" aria-describedby="emailHelp">
						<span class=" p-0 m-0 text-danger namaPerusahaan_error" id="namaPerusahaan_error"></span>
					</div>
					<div class="form-group w-100">
						<label for="exampleInputEmail1">Jabatan Perusahaan</label>
						<input type="text" name="jabatanPerusahaan" class="form-control" id="jabatanPerusahaan" aria-describedby="emailHelp">
						<span class=" p-0 m-0 text-danger jabatanPerusahaan_error" id="jabatanPerusahaan_error"></span>
					</div>
					<div class="form-group w-100">
						<label for="exampleInputEmail1">Email Perusahaan</label>
						<input type="text" name="emailPerusahaan" class="form-control" id="emailPerusahaan" aria-describedby="emailHelp">
						<span class=" p-0 m-0 text-danger emailPerusahaan_error" id="emailPerusahaan_error"></span>
					</div>
					<div class="form-group w-100">
						<label for="exampleInputEmail1">telepon Perusahaan</label>
						<input type="text" name="teleponPerusahaan" class="form-control" id="teleponPerusahaan" aria-describedby="emailHelp">
						<span class=" p-0 m-0 text-danger teleponPerusahaan_error" id="teleponPerusahaan_error"></span>
					</div>
					<div class="form-group w-100">
						<label for="exampleInputEmail1">alamat Perusahaan</label>
						<input type="text" name="alamatPerusahaan" class="form-control" id="alamatPerusahaan" aria-describedby="emailHelp">
						<span class=" p-0 m-0 text-danger alamatPerusahaan_error" id="alamatPerusahaan_error"></span>
					</div> -->
					
					
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" id="add">Sign Up</button>
					</div>

					<div class="w-full text-center p-t-27 p-b-39">
						
					</div>

					<div class="w-full text-center">
						<a href="<?=base_url('ClientAuth/login')?>" class="txt3">Login</a>
					</div>
				</form>

				<div class="login100-more" style="background-image: url('<?=base_url()?>assets/assets_client/img/img-log.jpeg');"></div>
			</div>
		</div>
	</div>
	
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/assets_client/registrasi/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/assets_client/registrasi/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/assets_client/registrasi/vendor/bootstrap/js/popper.js"></script>
	<script src="<?=base_url()?>assets/assets_client/registrasi/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/assets_client/registrasi/vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/assets_client/registrasi/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?=base_url()?>assets/assets_client/registrasi/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/assets_client/registrasi/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/assets_client/registrasi/js/main.js"></script>
	<script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>

	<script>
$(document).ready(function(){

    $('#add').on('click', function(){
		console.log("grrg");
        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('ClientAuth/add')?>",
            dataType : "JSON",
            data : $('#formAdd').serialize(),
            success: function(response){
                console.log(response);
                if(response.status == 'success'){
                    console.log("sukses");
                    Swal.fire({
                        icon: 'success',
                        title: 'Acount Berhasil Di Buat!',
                        text: 'You clicked the button!',
                        // closeOnClickOutside: false
                    }).then(function() {
                        window.location.assign("<?php echo base_url();?>ClientAuth/login");
                    });
                }else{
                    $('.npwp_error').html(response.npwp);
                    $('.fullname_error').html(response.fullname);
					$('.username_error').html(response.username);
					$('.password_error').html(response.password);
					$('.tglLahir_error').html(response.tglLahir);
					$('.jenisKelamin_error').html(response.fullname);
					$('.noTelepon_error').html(response.noTelepon);
					$('.email_error').html(response.email);

					$('.alamat_error').html(response.alamat);
					$('.namaPerusahaan_error').html(response.namaPerusahaan);
					$('.jabatanPerusahaan_error').html(response.jabatanPerusahaan);
					$('.emailPerusahaan_error').html(response.emailPerusahaan);
					$('.teleponPerusahaan_error').html(response.teleponPerusahaan);
					$('.alamatPerusahaan_error').html(response.alamatPerusahaan);
                }   
            }
        });
        return false;
    });

    

});
</script>

</body>
</html>
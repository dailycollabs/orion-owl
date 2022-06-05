
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
	
	<div class="limiter m-0">
		<div class="container-login100 ">
			<div class="wrap-login100 ">
				<form class="login100-formlogin validate-form" action="<?=base_url('ClientAuth/process')?>" method="post">
					<span class="login100-form-title p-b-4">
						Account Login
					</span>
					
					<div class="form-group w-100 ">
						<label for="exampleInputEmail1">Username</label>
						<input type="text" name="username" class="form-control" placeholder="username">
						
					</div>
					<div class="form-group w-100">
						<label for="exampleInputEmail1">Password</label>
						<input type="password" name="password" class="form-control" placeholder="Password">
						
					</div>
					
					
					<div class="container-login100-form-btn">
						<input class="login100-form-btn" type="submit" name="login" value="Sign in">
						<!-- <button class="login100-form-btn">
							
						</button> -->
					</div>

					<div class="w-full text-center p-t-27">
						

						
					</div>

					<div class="w-full text-center">
						<a href="<?=base_url('ClientAuth/registrasi')?>" class="txt3">
							Sign Up
						</a>
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

</body>
</html>
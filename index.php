<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Peminjaman</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="assets/img/icon.ico" type="image/x-icon" />

	<!-- Fonts and icons -->
	<script src="assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: { "families": ["Open+Sans:300,400,600,700"] },
			custom: {
				"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"],
				urls: ['assets/css/fonts.css']
			},
			active: function () {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/azzara.min.css">

	<!-- SweetAlert2 -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<style>
		body.login {
			background: linear-gradient(to right, #74ebd5, #acb6e5);
		}
		h3.text-center {
			color: #2c3e50;
			margin-bottom: 20px;
		}
		.btn-login {
			width: 100%;
		}
		.login-form {
			background: #fff;
			padding: 30px;
			border-radius: 10px;
			box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
		}
	</style>
</head>
<body class="login">
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn">
			<h3 class="text-center">Silahkan Login</h3>
			<div class="login-form">
				<form method="POST" action="cek_login.php">
					<div class="form-group form-floating-label">
						<input id="login-username" maxlength="15" name="username" type="text" class="form-control input-border-bottom" required>
						<label for="login-username" class="placeholder">Username</label>
					</div>
					<div class="form-group form-floating-label">
						<input id="login-password" maxlength="15" name="password" type="password" class="form-control input-border-bottom" required>
						<label for="login-password" class="placeholder">Password</label>
					</div>
					<div class="form-action mb-3">
						<button type="submit" class="btn btn-primary btn-rounded btn-login">Login</button>
					</div>
				</form>
				<div class="login-account">
					<span class="msg">Belum Punya Akun ?</span>
					<a href="#" id="show-signup" class="link">Daftar</a>
				</div>
			</div>
		</div>

		<div class="container container-signup animated fadeIn" style="display: none;">
			<h3 class="text-center">Silahkan Daftar</h3>
			<div class="login-form">
				<form method="POST" action="">
					<div class="form-group form-floating-label">
						<input id="fullname" name="nama_lengkap" type="text" class="form-control input-border-bottom" required>
						<label for="fullname" class="placeholder">Nama Lengkap</label>
					</div>

					<div class="form-group form-floating-label">
						<input id="email" name="email" type="email" class="form-control input-border-bottom" required>
						<label for="email" class="placeholder">Email</label>
					</div>
					<div class="form-group form-floating-label">
						<input id="nohp" name="nohp" type="text" class="form-control input-border-bottom" required>
						<label for="nohp" class="placeholder">No Handphone</label>
					</div>
					<div class="form-group form-floating-label">
						<input id="reg-username" maxlength="15" name="username" type="text" class="form-control input-border-bottom" required>
						<label for="reg-username" class="placeholder">Username</label>
					</div>
					<div class="form-group form-floating-label">
						<input id="passwordsignin" maxlength="15" name="password" type="password" class="form-control input-border-bottom" required>
						<label for="passwordsignin" class="placeholder">Password</label>
					</div>
					<input type="hidden" name="level" value="user">
					<div class="form-action">
						<a href="#" id="show-signin" class="btn btn-danger btn-rounded btn-login mr-3">Cancel</a>
						<button name="simpan" type="submit" class="btn btn-primary btn-rounded btn-login">Daftar</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<center><h6><b>&copy; 2025 | UMPKU</b></h6></center>

	<!-- JS Files -->
	<script src="assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="assets/js/core/popper.min.js"></script>
	<script src="assets/js/core/bootstrap.min.js"></script>
	<script src="assets/js/ready.js"></script>

	<!-- Script untuk animasi transisi dan notifikasi -->
	<script>
		$(document).ready(function () {
			$('#show-signup').click(function (e) {
				e.preventDefault();
				$('.container-login').hide();
				$('.container-signup').fadeIn();
			});
			$('#show-signin').click(function (e) {
				e.preventDefault();
				$('.container-signup').hide();
				$('.container-login').fadeIn();
			});

			const urlParams = new URLSearchParams(window.location.search);
			if (urlParams.get('success') === 'register') {
				Swal.fire({
					icon: 'success',
					title: 'Pendaftaran Berhasil!',
					text: 'Silakan login untuk melanjutkan.',
					timer: 3000,
					showConfirmButton: false
				});
			} else if (urlParams.get('success') === 'login') {
				Swal.fire({
					icon: 'success',
					title: 'Login Berhasil!',
					text: 'Selamat datang kembali!',
					timer: 3000,
					showConfirmButton: false
				});
			}
		});
	</script>
</body>
</html>

<?php
include "koneksi.php";
if (isset($_POST['simpan'])) {
	$nama_lengkap = $_POST['nama_lengkap'];
	$email = $_POST['email'];
	$nohp = $_POST['nohp'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$level = $_POST['level'];

	mysqli_query($conn, "INSERT INTO user (nama_lengkap,email,nohp,username,password,level) 
	VALUES ('$nama_lengkap','$email','$nohp','$username','$password','$level')");

	// Redirect dengan notifikasi
	echo "<script>window.location.href='index.php?success=register';</script>";
}
?>

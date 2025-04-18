<?php
//session_start(); // Pastikan ini hanya dipanggil sekali di halaman yang memerlukan session
// Memeriksa apakah user sudah login
if (!isset($_SESSION['id'])) {
    // Jika belum login, redirect ke halaman login
    header("location:index.php");
    exit();
}

// Mengambil data dari session
$namaPeminjam = $_SESSION['nama_lengkap'] ?? ''; // Menggunakan null coalescing
$emailUser    = $_SESSION['email'] ?? ''; // Menggunakan null coalescing
?>

<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Create</h4>
				<ul class="breadcrumbs">
					<li class="nav-home">
						<a href="#">
							<i class="flaticon-home"></i>
						</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Pinjam</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Ruangan</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<div class="card-title">Create Pinjam Ruangan</div>
						</div>
						<form method="POST" action="" enctype="multipart/form-data">
							<div class="card-body">
								<div class="form-group">
									<label>Nama Ruangan</label>
									<select class="form-control" id="id_ruangan" onchange="change(this.value)" name="id_ruangan" required="">
										<option value="" hidden="">-- Pilih Ruangan --</option>
										<?php
										$query       = mysqli_query($conn, 'SELECT * from ruangan');
										$deskripsi 	 = "var deskripsi 		= new Array();\n;";
										$nama_ruangan = "var nama_ruangan= new Array();\n;";
										while ($row = mysqli_fetch_array($query)) {
											if ($row['status'] == 'free') {
												echo '<option value="' . $row['id'] . '">' . $row['nama_ruangan'] . '</option>';
											}
											$deskripsi .= "deskripsi['" . $row['id'] . "'] = {deskripsi:'" . addslashes($row['deskripsi']) . "'};\n";
											$nama_ruangan .= "nama_ruangan['" . $row['id'] . "'] = {nama_ruangan:'" . addslashes($row['nama_ruangan']) . "'};\n";
										}
										?>
									</select>
								</div>

								<input type="hidden" readonly="" id="nama_ruangan" name="nama_ruangan">

								<div class="form-group">
									<label>Deskripsi</label>
									<textarea readonly="" style="white-space: pre-line;" id="deskripsi" rows="5" class="form-control"></textarea>
								</div>

							</div>

					</div>
				</div>

				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<div class="card-title">Data Peminjam</div>
						</div>
						<form method="POST" action="" enctype="multipart/form-data">
							<div class="card-body">
								<div class="form-group">
                                    <label>Nama Peminjam</label>
                                    <input type="text" name="nama_user" value="<?php echo htmlspecialchars($namaPeminjam); ?>" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email_user" value="<?php echo htmlspecialchars($emailUser ); ?>" class="form-control" readonly>
                                </div>

								<div class="form-group">
									<label>Tgl Mulai Pinjam</label>
									<!--<input type="text" readonly="" name="tgl_mulai" class="form-control" value="<?php date_default_timezone_set("Asia/Jakarta");
																												echo date('Y-m-d H:i:s') ?>">
									-->
									<input type="datetime-local" name="tgl_mulai" class="form-control">	
							</div>

								<div class="form-group">
									<label>Tgl Selesai Pinjam</label>
									<input type="datetime-local" name="tgl_selesai" class="form-control">
								</div>

								<input type="hidden" name="id_user" value="<?php echo $_SESSION['id'] ?>">
								<input type="hidden" name="email_admin" value="emailpenerima@gmail.com">
								<input type="hidden" name="status" value="menunggu">

							</div>
							<div class="card-action">
								<button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-save"></i> Save Changes</button>
								<a href="?view=datapinjamruangan" class="btn btn-danger"><i class="fa fa-undo"></i> Cancel</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<center>
		<h6><b>&copy; Copyright@2020|UMPKU|</b></h6>
	</center>
</div>

<script type="text/javascript">
	<?php
	echo $nama_ruangan;
	echo $deskripsi;
	?>

	function change(id_ruangan) {
		document.getElementById('nama_ruangan').value = nama_ruangan[id_ruangan].nama_ruangan;
		document.getElementById('deskripsi').value = deskripsi[id_ruangan].deskripsi;
	};
</script>

<?php
if (isset($_POST['simpan'])) {

    // Ambil data dari form
    $id_ruangan = $_POST['id_ruangan'];
    $tgl_mulai = $_POST['tgl_mulai']; // format: Y-m-d H:i:s
    $tgl_selesai = $_POST['tgl_selesai']; // format: Y-m-d H:i:s
    $id_user = $_POST['id_user'];
    $status = $_POST['status'];

    $email_user = $_POST['email_user'];
    $email_admin = $_POST['email_admin'];
    $password_user = $_POST['password_user'];
    $nama_ruangan = $_POST['nama_ruangan'];
	$nama_peminjam = $_POST['nama_user']; // Ambil nama peminjam dari form
    $email_peminjam = $_POST['email_user']; // Ambil email peminjam dari form


    // Ambil hari dan jam dari tgl_mulai dan tgl_selesai
    $hari_en = date('l', strtotime($tgl_mulai)); // "Monday", "Tuesday", ...
    $hari_map = [
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu',
        'Sunday' => 'Minggu',
    ];
    $hari = $hari_map[$hari_en]; // hasil "Senin", dll
    $jam_mulai = date('H:i:s', strtotime($tgl_mulai));
    $jam_selesai = date('H:i:s', strtotime($tgl_selesai));

    // Cek bentrok dengan jadwal kuliah yang berulang mingguan (dalam periode semester)
    $cekJadwal = mysqli_query($conn, "
        SELECT * FROM jadwal
        WHERE id_ruangan = '$id_ruangan'
          AND hari = '$hari'
          AND '$tgl_mulai' BETWEEN semester_mulai AND semester_selesai
          AND (
                ('$jam_mulai' BETWEEN waktu_mulai AND waktu_selesai)
             OR ('$jam_selesai' BETWEEN waktu_mulai AND waktu_selesai)
             OR (waktu_mulai BETWEEN '$jam_mulai' AND '$jam_selesai')
             OR (waktu_selesai BETWEEN '$jam_mulai' AND '$jam_selesai')
          )
    ");

    if (mysqli_num_rows($cekJadwal) > 0) {
        // Bentrok dengan jadwal kuliah
        echo "<script>alert('Gagal meminjam: Waktu yang dipilih sudah ada jadwal kuliah.');</script>";
    } else {
        // Tidak bentrok, lanjut simpan
        $insert = mysqli_query($conn, "
            INSERT INTO pinjamruangan (id_ruangan, id_user, tgl_mulai, tgl_selesai, status,nama_peminjam, email_peminjam)
            VALUES ('$id_ruangan', '$id_user', '$tgl_mulai', '$tgl_selesai', '$status','$nama_peminjam', '$email_peminjam')
        ");

        if ($insert) {
            // Update status ruangan
            $update = mysqli_query($conn, "UPDATE ruangan SET status='dipinjam' WHERE id='$id_ruangan'");
            echo "<script>alert('Peminjaman berhasil disimpan.');</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data peminjaman.');</script>";
        }
    }
}
?>


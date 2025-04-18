<?php
// Mulai session dan koneksi
//session_start();
// $conn = mysqli_connect('localhost','root','','peminjaman');

// if (!$conn) {
//     die("Koneksi gagal: " . mysqli_connect_error());
// }
?>

<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Data</h4>
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
						<a href="#">Barang</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<h4 class="card-title">Data Pinjam Barang Saya</h4>
								<a href="?view=createpinjambarang" class="btn btn-primary btn-round ml-auto">
									<i class="fa fa-plus"></i>
									Tambah Data
								</a>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="add-row" class="display table table-striped table-hover">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Barang</th>
											<th>Tgl Mulai</th>
											<th>Tgl Selesai</th>
											<th>Jumlah Pinjam</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										$query = mysqli_query($conn, 'SELECT pinjambarang.id, pinjambarang.id_barang, pinjambarang.id_user, pinjambarang.tgl_mulai, pinjambarang.tgl_selesai, pinjambarang.qty, pinjambarang.status, barang.nama_barang FROM pinjambarang INNER JOIN barang ON barang.id=pinjambarang.id_barang');
										while ($pinjambarang = mysqli_fetch_array($query)) {
											if ($_SESSION['id'] == $pinjambarang['id_user']) {
										?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= $pinjambarang['nama_barang'] ?></td>
												<td><?= $pinjambarang['tgl_mulai'] ?></td>
												<td><?= $pinjambarang['tgl_selesai'] ?></td>
												<td><?= $pinjambarang['qty'] ?></td>
												<td>
													<?php
													$status = $pinjambarang['status'];
													if ($status == 'menunggu') {
														echo '<div class="badge badge-danger">' . $status . '</div>';
													} elseif ($status == 'approve') {
														echo '<div class="badge badge-success">' . $status . '</div>';
													} elseif ($status == 'menunggu_konfirmasi_kembali') {
														echo '<div class="badge badge-warning">Menunggu Konfirmasi Kembali</div>';
													} else {
														echo '<div class="badge badge-secondary">' . $status . '</div>';
													}
													?>
												</td>
												<td>
													<a href="?view=detailpinjambarang&id=<?= $pinjambarang['id'] ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
													<?php if ($status == 'approve') { ?>
														<a href="#modalKembalikanPinjamBarang<?= $pinjambarang['id'] ?>" data-toggle="modal" class="btn btn-xs btn-warning"><i class="fa fa-undo"></i> Kembalikan</a>
													<?php } ?>
												</td>
											</tr>
										<?php }} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<center>
		<h6><b>&copy; Copyright@2020|UMPKU|</b></h6>
	</center>
</div>

<?php
$c = mysqli_query($conn, 'SELECT * FROM pinjambarang');
while ($row = mysqli_fetch_array($c)) {
?>
<div class="modal fade" id="modalKembalikanPinjamBarang<?= $row['id'] ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header no-bd">
				<h5 class="modal-title">Kembalikan Pinjaman</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST">
				<div class="modal-body">
					<input type="hidden" name="id" value="<?= $row['id'] ?>">
					<h4>Apakah Anda yakin ingin mengembalikan barang ini? Tunggu konfirmasi admin.</h4>
				</div>
				<div class="modal-footer no-bd">
					<button type="submit" name="ubah" class="btn btn-warning">Kembalikan</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php } ?>

<?php
if (isset($_POST['ubah'])) {
	$id = $_POST['id'];
	$status = 'menunggu_konfirmasi_kembali';
	mysqli_query($conn, "UPDATE pinjambarang SET status='$status' WHERE id='$id'");
	echo "<script>alert('Permintaan pengembalian dikirim. Menunggu konfirmasi admin.')</script>";
	echo "<meta http-equiv='refresh' content='0; URL=?view=datapinjambarang'>";
}

if (isset($_POST['hapus'])) {
	$id = $_POST['id'];
	$id_barang = $_POST['id_barang'];
	$qty = $_POST['qty'];

	$selSto = mysqli_query($conn, "SELECT * FROM barang WHERE id='$id_barang'");
	$sto = mysqli_fetch_array($selSto);
	$stok = $sto['stok'];
	$sisa = $stok + $qty;

	mysqli_query($conn, "UPDATE barang SET stok='$sisa' WHERE id='$id_barang'");
	mysqli_query($conn, "DELETE FROM pinjambarang WHERE id='$id'");
	echo "<script>alert('Data berhasil dihapus')</script>";
	echo "<meta http-equiv='refresh' content='0; URL=?view=datapinjambarang'>";
}
?>

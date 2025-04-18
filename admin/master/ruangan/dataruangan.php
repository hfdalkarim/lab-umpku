<?php
// $conn = mysqli_connect('localhost','root','','peminjaman');

// if (!$conn) {
//     die("Koneksi gagal: " . mysqli_connect_error());
// }
?>
<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Data Ruangan</h4>
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
								<a href="#">Data</a>
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
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Data Ruangan</h4>
										<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modalAddRuangan">
											<i class="fa fa-plus"></i>
											Tambah Data
										</button>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>No</th>
													<th>Nama Ruangan</th>
													<th>Action</th>
												</tr>
											</thead>
											
											<tbody>
												<?php
													$no = 1;
													$query = mysqli_query($conn,'SELECT * from ruangan');
													while ($ruangan = mysqli_fetch_array($query)) {
												?>
												<tr>
													<td><?php echo $no++ ?></td>
													<td><?php echo $ruangan['nama_ruangan'] ?></td>
													<td>
														<a href="#modalDetailRuangan<?php echo $ruangan['id'] ?>"  data-toggle="modal" title="Detail" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
														<a href="#modalEditRuangan<?php echo $ruangan['id'] ?>"  data-toggle="modal" title="Edit" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
														<a href="#modalHapusRuangan<?php echo $ruangan['id'] ?>"  data-toggle="modal" title="Hapus" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
													</td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>

		<div class="modal fade" id="modalAddRuangan" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header no-bd">
													<h5 class="modal-title">
														<span class="fw-mediumbold">
														New</span> 
														<span class="fw-light">
															Ruangan
														</span>
													</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<form method="POST" enctype="multipart/form-data" action="">
												<div class="modal-body">
													<div class="form-group">
														<label>Nama Ruangan</label>
														<input type="text" name="nama_ruangan" class="form-control" placeholder="Nama Ruangan ..." required="">
													</div>
													<div class="form-group">
														<label>Deskripsi</label>
														<textarea placeholder="Deskripsi ..." class="form-control" rows="5" name="deskripsi" style="white-space: pre-line;" required=""></textarea>
													</div>
													<div class="form-group">
														<label>Foto</label>
														<input type="file" name="foto" class="form-control" placeholder required="">
													</div>
												</div>
												<div class="modal-footer no-bd">
													<button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
												</div>
												</form>
											</div>
										</div>
									</div>

									<?php 
										$p = mysqli_query($conn,'SELECT * from ruangan');
										while($d = mysqli_fetch_array($p)) {
									?>

									<div class="modal fade" id="modalEditRuangan<?php echo $d['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header no-bd">
													<h5 class="modal-title">
														<span class="fw-mediumbold">
														Edit</span> 
														<span class="fw-light">
															Ruangan
														</span>
													</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<form method="POST" enctype="multipart/form-data" action="">
												<div class="modal-body">
													<input type="hidden" name="id" value="<?php echo $d['id'] ?>">
													<div class="form-group">
														<label>Nama Ruangan</label>
														<input value="<?php echo $d['nama_ruangan'] ?>" type="text" name="nama_ruangan" class="form-control" placeholder="Nama Ruangan ..." required="">
													</div>
													
													<div class="form-group">
														<label>Deskripsi</label>
														<textarea class="form-control" placeholder="Deskripsi ..." rows="5" name="deskripsi" style="white-space: pre-line;" required=""><?php echo $d['deskripsi'] ?></textarea>
													</div>
													<div class="form-group">
        <label>Foto (Opsional)</label>
        <input type="file" name="foto" class="form-control">
        <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
    </div>
												</div>
												<div class="modal-footer no-bd">
													<button type="submit" name="ubah" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
												</div>
												</form>
											</div>
										</div>
									</div>

									<?php } ?>

									<?php 
										$c = mysqli_query($conn,'SELECT * from ruangan');
										while($row = mysqli_fetch_array($c)) {
									?>

									<div class="modal fade" id="modalHapusRuangan<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header no-bd">
													<h5 class="modal-title">
														<span class="fw-mediumbold">
														Hapus</span> 
														<span class="fw-light">
															Ruangan
														</span>
													</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<form method="POST" enctype="multipart/form-data" action="">
												<div class="modal-body">
													<input type="hidden" name="id" value="<?php echo $row['id'] ?>">
													<h4>Apakah Anda Ingin Menghapus Data Ini ?</h4>
												</div>
												<div class="modal-footer no-bd">
													<button type="submit" name="hapus" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
													<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
												</div>
												</form>
											</div>
										</div>
									</div>

									<?php } ?>

									<?php 
										$q = mysqli_query($conn,'SELECT * from ruangan');
										while($k = mysqli_fetch_array($q)) {
									?>

									<div class="modal fade" id="modalDetailRuangan<?php echo $k['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header no-bd">
													<h5 class="modal-title">
														<span class="fw-mediumbold">
														Detail</span> 
														<span class="fw-light">
															Ruangan
														</span>
													</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<form method="POST" enctype="multipart/form-data" action="">
												<div class="modal-body">
													<input type="hidden" name="id" value="<?php echo $k['id'] ?>">
													<div class="form-group">
														<label>Nama Ruangan</label>
														<input readonly value="<?php echo $k['nama_ruangan'] ?>" type="text" name="nama_barang" class="form-control" placeholder="Nama Barang ..." required="">
													</div>
													<div class="form-group">
														<label>Deskripsi</label>
														<textarea readonly class="form-control" rows="5" name="deskripsi" style="white-space: pre-line;" required=""><?php echo $k['deskripsi'] ?></textarea>
													</div>
													<div class="form-group">
														<img src="master/ruangan/Fotoruangan/<?php echo $k['foto'] ?>" width="100%" height="200">
													</div>
												</div>
												<div class="modal-footer no-bd">
													<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
												</div>
												</form>
											</div>
										</div>
									</div>

								<?php } ?>

								<?php
// Simpan Data Baru
if (isset($_POST['simpan'])) {
    $nama_ruangan = $_POST['nama_ruangan'];
    $deskripsi = $_POST['deskripsi'];
    $foto = $_FILES['foto']['name'];
    $file_tmp = $_FILES['foto']['tmp_name'];

    move_uploaded_file($file_tmp, 'master/ruangan/Fotoruangan/' . $foto);

    mysqli_query($conn, "INSERT INTO ruangan(nama_ruangan, deskripsi, foto, status) 
                         VALUES ('$nama_ruangan', '$deskripsi', '$foto', 'free')");
    
    echo "<script>alert('Data Berhasil Disimpan')</script>";
    echo "<meta http-equiv='refresh' content='0; URL=?view=dataruangan'>";
}

// Ubah Data
elseif (isset($_POST['ubah'])) {
    $id = $_POST['id'];
    $nama_ruangan = $_POST['nama_ruangan'];
    $deskripsi = $_POST['deskripsi'];
    $foto_lama = $_POST['foto_lama'];

    $foto_baru = $_FILES['foto']['name'];
    $file_tmp = $_FILES['foto']['tmp_name'];

    if (!empty($foto_baru)) {
        move_uploaded_file($file_tmp, 'master/ruangan/Fotoruangan/' . $foto_baru);
        $foto = $foto_baru;
    } else {
        $foto = $foto_lama;
    }

    mysqli_query($conn, "UPDATE ruangan SET 
        nama_ruangan='$nama_ruangan', 
        deskripsi='$deskripsi', 
        foto='$foto', 
        status='free' 
        WHERE id='$id'");

    echo "<script>alert('Data Berhasil Diubah')</script>";
    echo "<meta http-equiv='refresh' content='0; URL=?view=dataruangan'>";
}

// Hapus Data
elseif (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    mysqli_query($conn, "DELETE FROM ruangan WHERE id='$id'");
    echo "<script>alert('Data Berhasil Dihapus')</script>";
    echo "<meta http-equiv='refresh' content='0; URL=?view=dataruangan'>";
}
?>

				
<!-- Tambahkan script untuk notifikasi pop-up -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

<script>
    $(document).ready(function() {
        // Notifikasi untuk tambah
        <?php if (isset($_POST['simpan'])) { ?>
            swal("Berhasil!", "Data Berhasil Disimpan", "success");
        <?php } ?>

        // Notifikasi untuk edit
        <?php if (isset($_POST['ubah'])) { ?>
            swal("Berhasil!", "Data Berhasil Diubah", "success");
        <?php } ?>

        // Notifikasi untuk hapus
        <?php if (isset($_POST['hapus'])) { ?>
            swal("Berhasil!", "Data Berhasil Dihapus", "success");
        <?php } ?>
    });
</script>
<?php
// $conn = mysqli_connect('localhost', 'root', '', 'peminjaman');

// if (!$conn) {
//     die("Koneksi gagal: " . mysqli_connect_error());
// }
?>

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Jadwal</h4>
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
                        <a href="#">Jadwal</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Jadwal</h4>
                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modalAddJadwal">
                                    <i class="fa fa-plus"></i>
                                    Tambah Jadwal
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Matkul</th>
                                            <th>Dosen</th>
                                            <th>Hari</th>
                                            <th>Waktu Mulai</th>
                                            <th>Waktu Selesai</th>
                                            <th>ID Ruangan</th>
                                            <th>Semester Mulai</th>
                                            <th>Semester Selesai</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $query = mysqli_query($conn, 'SELECT * FROM jadwal');
                                        while ($jadwal = mysqli_fetch_array($query)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $jadwal['matkul'] ?></td>
                                                <td><?php echo $jadwal['dosen'] ?></td>
                                                <td><?php echo $jadwal['hari'] ?></td>
                                                <td><?php echo $jadwal['waktu_mulai'] ?></td>
                                                <td><?php echo $jadwal['waktu_selesai'] ?></td>
                                                <td><?php echo $jadwal['id_ruangan'] ?></td>
                                                <td><?php echo $jadwal['semester_mulai'] ?></td>
                                                <td><?php echo $jadwal['semester_selesai'] ?></td>
                                                <td>
                                                    <a href="#modalEditJadwal <?php echo $jadwal['id'] ?>" data-toggle="modal" title="Edit" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                                    <a href="#modalHapusJadwal <?php echo $jadwal['id'] ?>" data-toggle="modal" title="Hapus" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
    <center><h6><b>&copy; Copyright@2025|UMPKU|</b></h6></center>
</div>

<!-- Modal Tambah Jadwal -->
<div class="modal fade" id="modalAddJadwal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">New</span>
                    <span class="fw-light">Jadwal</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Matkul</label>
                        <input type="text" name="matkul" class="form-control" placeholder="Mata Kuliah ..." required="">
                    </div>
                    <div class="form-group">
                        <label>Dosen</label>
                        <input type="text" name="dosen" class="form-control" placeholder="Nama Dosen ..." required="">
                    </div>
                    <div class="form-group">
                        <label>Hari</label>
                        <input type="text" name="hari" class="form-control" placeholder="Hari ..." required="">
                    </div>
                    <div class="form-group">
                        <label>Waktu Mulai</label>
                        <input type="time" name="waktu_mulai" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>Waktu Selesai</label>
                        <input type="time" name="waktu_selesai" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>ID Ruangan</label>
                        <input type="text" name="id_ruangan" class="form-control" placeholder="ID Ruangan ..." required="">
                    </div>
                    <div class="form-group">
                        <label>Semester Mulai</label>
                        <input type="date" name="semester_mulai" class="form-control" placeholder="Semester Mulai ..." required="">
                    </div>
                    <div class="form-group">
                        <label>Semester Selesai</label>
                        <input type="date" name="semester_selesai" class="form-control" placeholder="Semester Selesai ..." required="">
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
// Modal Edit Jadwal
$query = mysqli_query($conn, 'SELECT * FROM jadwal');
while ($jadwal = mysqli_fetch_array($query)) {
?>

<div class="modal fade" id="modalEditJadwal <?php echo $jadwal['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">Edit</span>
                    <span class="fw-light">Jadwal</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $jadwal['id'] ?>">
                    <div class="form-group">
                        <label>Matkul</label>
                        <input value="<?php echo $jadwal['matkul'] ?>" type="text" name="matkul" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>Dosen</label>
                        <input value="<?php echo $jadwal['dosen'] ?>" type="text" name="dosen" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>Hari</label>
                        <input value="<?php echo $jadwal['hari'] ?>" type="text" name="hari" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>Waktu Mulai</label>
                        <input value="<?php echo $jadwal['waktu_mulai'] ?>" type="time" name="waktu_mulai" class="form-control" required="">
                    </div>
                    <div class="form-group">
                    <label>Waktu Selesai</label>
                        <input value="<?php echo $jadwal['waktu_selesai'] ?>" type="time" name="waktu_selesai" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>ID Ruangan</label>
                        <input value="<?php echo $jadwal['id_ruangan'] ?>" type="text" name="id_ruangan" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>Semester Mulai</label>
                        <input value="<?php echo $jadwal['semester_mulai'] ?>" type="date" name="semester_mulai" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>Semester Selesai</label>
                        <input value="<?php echo $jadwal['semester_selesai'] ?>" type="date" name="semester_selesai" class="form-control" required="">
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
// Modal Hapus Jadwal
$query = mysqli_query($conn, 'SELECT * FROM jadwal');
while ($jadwal = mysqli_fetch_array($query)) {
?>

<div class="modal fade" id="modalHapusJadwal <?php echo $jadwal['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">Hapus</span>
                    <span class="fw-light">Jadwal</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $jadwal['id'] ?>">
                    <h4>Apakah Anda Ingin Menghapus Data Ini?</h4>
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
// Proses Simpan Data
if (isset($_POST['simpan'])) {
    $matkul = $_POST['matkul'];
    $dosen = $_POST['dosen'];
    $hari = $_POST['hari'];
    $waktu_mulai = $_POST['waktu_mulai'];
    $waktu_selesai = $_POST['waktu_selesai'];
    $id_ruangan = $_POST['id_ruangan'];
    $semester_mulai = $_POST['semester_mulai'];
    $semester_selesai = $_POST['semester_selesai'];

    mysqli_query($conn, "INSERT INTO jadwal (matkul, dosen, hari, waktu_mulai, waktu_selesai, id_ruangan, semester_mulai, semester_selesai) VALUES ('$matkul', '$dosen', '$hari', '$waktu_mulai', '$waktu_selesai', '$id_ruangan', '$semester_mulai', '$semester_selesai')");
    echo "<script>alert('Data Berhasil Disimpan');</script>";
    echo "<meta http-equiv='refresh' content='0; URL=?view=kelolajadwal'>";
}

// Proses Ubah Data
elseif (isset($_POST['ubah'])) {
    $id = $_POST['id'];
    $matkul = $_POST['matkul'];
    $dosen = $_POST['dosen'];
    $hari = $_POST['hari'];
    $waktu_mulai = $_POST['waktu_mulai'];
    $waktu_selesai = $_POST['waktu_selesai'];
    $id_ruangan = $_POST['id_ruangan'];
    $semester_mulai = $_POST['semester_mulai'];
    $semester_selesai = $_POST['semester_selesai'];

    mysqli_query($conn, "UPDATE jadwal SET matkul='$matkul', dosen='$dosen', hari='$hari', waktu_mulai='$waktu_mulai', waktu_selesai='$waktu_selesai', id_ruangan='$id_ruangan', semester_mulai='$semester_mulai', semester_selesai='$semester_selesai' WHERE id='$id'");
    echo "<script>alert('Data Berhasil Diubah');</script>";
    echo "<meta http-equiv='refresh' content='0; URL=?view=jadwal'>";
}

// Proses Hapus Data
elseif (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    mysqli_query($conn, "DELETE FROM jadwal WHERE id='$id'");
    echo "<script>alert('Data Berhasil Dihapus');</script>";
    echo "<meta http-equiv='refresh' content='0; URL=?view=jawal'>";
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
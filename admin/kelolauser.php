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
                <h4 class="page-title">Data Pengguna</h4>
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
                        <a href="#">Pengguna</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Pengguna</h4>
                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modalAddUser ">
                                    <i class="fa fa-plus"></i>
                                    Tambah Pengguna
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Email</th>
                                            <th>No HP</th>
                                            <th>Username</th>
                                            <th>Level</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $query = mysqli_query($conn, 'SELECT * from user');
                                        while ($user = mysqli_fetch_array($query)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $user['nama_lengkap'] ?></td>
                                                <td><?php echo $user['email'] ?></td>
                                                <td><?php echo $user['nohp'] ?></td>
                                                <td><?php echo $user['username'] ?></td>
                                                <td><?php echo $user['level'] ?></td>
                                                <td>
                                                    <a href="#modalEditUser <?php echo $user['id'] ?>" data-toggle="modal" title="Edit" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                                    <a href="#modalHapusUser <?php echo $user['id'] ?>" data-toggle="modal" title="Hapus" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
    <center><h6><b>&copy; Copyright@2020|UMPKU|</b></h6></center>
</div>

<!-- Modal Tambah Pengguna -->
<div class="modal fade" id="modalAddUser " tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">New</span>
                    <span class="fw-light">Pengguna</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap ..." required="">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email ..." required="">
                    </div>
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="nohp" class="form-control" placeholder="No HP ..." required="">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username ..." required="">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password ..." required="">
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <select name="level" class="form-control" required="">
                            <option value="user">User </option>
                            <option value="admin">Admin</option>
                        </select>
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
$p = mysqli_query($conn, 'SELECT * from user');
while ($d = mysqli_fetch_array($p)) {
?>

<div class="modal fade" id="modalEditUser <?php echo $d['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">Edit</span>
                    <span class="fw-light">Pengguna</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $d['id'] ?>">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input value="<?php echo $d['nama_lengkap'] ?>" type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap ..." required="">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input value="<?php echo $d['email'] ?>" type="email" name="email" class="form-control" placeholder="Email ..." required="">
                    </div>
                    <div class="form-group">
                        <label>No HP</label>
                        <input value="<?php echo $d['nohp'] ?>" type="text" name="nohp" class="form-control" placeholder="No HP ..." required="">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input value="<?php echo $d['username'] ?>" type="text" name="username" class="form-control" placeholder="Username ..." required="">
                    </div>
                    <div class="form-group">
                        <label>Password (Kosongkan jika tidak ingin mengubah)</label>
                        <input type="password" name="password" class="form-control" placeholder="Password ...">
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <select name="level" class="form-control" required="">
                            <option value="user" <?php echo ($d['level'] == 'user') ? 'selected' : ''; ?>>User </option>
                            <option value="admin" <?php echo ($d['level'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                        </select>
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
$c = mysqli_query($conn, 'SELECT * from user');
while ($row = mysqli_fetch_array($c)) {
?>

<div class="modal fade" id="modalHapusUser <?php echo $row['id'] ?>" tabindex="-1" role ="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">Hapus</span>
                    <span class="fw-light">Pengguna</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
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
if (isset($_POST['simpan'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $nohp = $_POST['nohp'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $level = $_POST['level'];

    // Cek apakah email sudah ada
    $checkEmail = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
    if (mysqli_num_rows($checkEmail) > 0) {
        echo "<script>alert('Email sudah terdaftar!');</script>";
    } else {
        mysqli_query($conn, "INSERT INTO user (nama_lengkap, email, nohp, username, password, level) VALUES ('$nama_lengkap', '$email', '$nohp', '$username', '$password', '$level')");
        echo "<script>alert('Data Berhasil Disimpan');</script>";
        echo "<meta http-equiv='refresh' content='0; URL=?view=kelolauser'>";
    }
}

elseif (isset($_POST['ubah'])) {
    $id = $_POST['id'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $nohp = $_POST['nohp'];
    $username = $_POST['username'];
    $level = $_POST['level'];

    // Cek apakah email sudah ada untuk pengguna lain
    $checkEmail = mysqli_query($conn, "SELECT * FROM user WHERE email='$email' AND id != '$id'");
    if (mysqli_num_rows($checkEmail) > 0) {
        echo "<script>alert('Email sudah terdaftar untuk pengguna lain!');</script>";
    } else {
        // Jika password tidak kosong, update password
        if (!empty($_POST['password'])) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            mysqli_query($conn, "UPDATE user SET nama_lengkap='$nama_lengkap', email='$email', nohp='$nohp', username='$username', password='$password', level='$level' WHERE id='$id'");
        } else {
            mysqli_query($conn, "UPDATE user SET nama_lengkap='$nama_lengkap', email='$email', nohp='$nohp', username='$username', level='$level' WHERE id='$id'");
        }
        echo "<script>alert('Data Berhasil Diubah');</script>";
        echo "<meta http-equiv='refresh' content='0; URL=?view=kelolauser'>";
    }
}

elseif (isset($_POST['hapus'])) {
    $id = $_POST['id'];

    // Hapus data terkait di tabel pinjamruangan
    mysqli_query($conn, "DELETE FROM pinjamruangan WHERE id_user='$id'");

    // Hapus pengguna dari tabel user
    mysqli_query($conn, "DELETE FROM user WHERE id='$id'");
    
    echo "<script>alert('Data Berhasil Dihapus');</script>";
    echo "<meta http-equiv='refresh' content='0; URL=?view=kelolauser'>";
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
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
                        <a href="#">Barang</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Create Pinjam Barang</div>
                        </div>
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <select class="form-control" id="id_barang" onchange="changeValue(this.value)" name="id_barang" required="">
                                        <option value="" hidden="">-- Pilih Barang --</option>
                                        <?php
                                        $query = mysqli_query($conn, 'SELECT * from barang');
                                        $stok = "var stok = new Array();\n;";
                                        $deskripsi = "var deskripsi = new Array();\n;";
                                        $nama_barang = "var nama_barang = new Array();\n;";
                                        while ($row = mysqli_fetch_array($query)) {
                                            echo '<option value="' . $row['id'] . '">' . $row['nama_barang'] . '</option>';
                                            $stok .= "stok['" . $row['id'] . "'] = {stok:'" . addslashes($row['stok']) . "'};\n";
                                            $deskripsi .= "deskripsi['" . $row['id'] . "'] = {deskripsi:'" . addslashes($row['deskripsi']) . "'};\n";
                                            $nama_barang .= "nama_barang['" . $row['id'] . "'] = {nama_barang:'" . addslashes($row['nama_barang']) . "'};\n";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <input type="hidden" readonly="" id="nama_barang" value="<?php echo $nama_barang; ?>" name="nama_barang">

                                <div class="form-group">
                                    <label>Stok Barang Tersedia</label>
                                    <input type="text" readonly="" id="stok" class="form-control" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label>Tempat Awal</label>
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
                                    <label>Jumlah Pinjam Barang</label>
                                    <input min="1" step="1" value="1" type="number" name="qty" class="form-control" placeholder="Jumlah Pinjam Barang ..." required>
                                </div>

                                <div class="form-group">
                                    <label>Tgl Mulai Pinjam</label>
                                    <input type="datetime-local" name="tgl_mulai" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Tgl Selesai Pinjam</label>
                                    <input type="datetime-local" name="tgl_selesai" class="form-control" required>
                                </div>
								<div class="form-group">
                                    <label>Tempat Barang Dipinjam?</label>
                                    <input type="text" name="lokasi_barang" class="form-control" placeholder="Lokasi Barang ..." required>
                                </div>
                                <input type="hidden" name="id_user" value="<?php echo $_SESSION['id']; ?>">
                                <input type="hidden" name="email_admin" value="emailpenerima@gmail.com">
                                <input type="hidden" name="status" value="menunggu">

                            </div>
                            <div class="card-action">
                                <button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-save"></i> Save Changes</button>
                                <a href="?view=datapinjambarang" class="btn btn-danger"><i class="fa fa-undo"></i> Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <center>
        <h6><b>&copy; Copyright@2025|UMPKU|</b></h6>
    </center>
</div>

<script type="text/javascript">
    <?php
    echo $stok;
    echo $deskripsi;
    echo $nama_barang;
    ?>

    function changeValue(id) {
        document.getElementById('stok').value = stok[id].stok;
        document.getElementById('deskripsi').value = deskripsi[id].deskripsi;
        document.getElementById('nama_barang').value = nama_barang[id].nama_barang;
    };
</script>
<?php
if (isset($_POST['simpan'])) {
    $id_barang = $_POST['id_barang'];
    $qty = $_POST['qty'];
    $tgl_mulai = $_POST['tgl_mulai'];
    $tgl_selesai = $_POST['tgl_selesai'];
    $lokasi_barang = $_POST['lokasi_barang'];
    $id_user = $_POST['id_user'];
    $status = $_POST['status'];
    $nama_peminjam = $_POST['nama_user']; // Ambil nama peminjam dari form
    $email_peminjam = $_POST['email_user']; // Ambil email peminjam dari form

    // Ambil stok barang
    $selSto = mysqli_query($conn, "SELECT * FROM barang WHERE id='$id_barang'");
    $sto = mysqli_fetch_array($selSto);
    $stok = $sto['stok'];

    // Menghitung sisa stok
    $sisa = $stok - $qty;

    if ($stok < $qty) {
        echo "<script>alert('Stok Kurang Dari Jumlah Pinjam');</script>";
    } else {
        // Insert data peminjaman
        $insertQuery = "INSERT INTO pinjambarang (id_barang, id_user, qty, tgl_mulai, tgl_selesai, lokasi_barang, status, nama_peminjam, email_peminjam) 
                        VALUES ('$id_barang', '$id_user', '$qty', '$tgl_mulai', '$tgl_selesai', '$lokasi_barang', '$status', '$nama_peminjam', '$email_peminjam')";
        
        if (mysqli_query($conn, $insertQuery)) {
            // Update stok barang
            mysqli_query($conn, "UPDATE barang SET stok='$sisa' WHERE id='$id_barang'");
            echo "<script>alert('Peminjaman berhasil!'); window.location.href='?view=datapinjambarang';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data peminjaman.');</script>";
        }
    }
}
?>
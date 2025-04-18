<?php
// koneksi harus dibuat dulu sebelum mysqli_query dipanggil
// echo __DIR__; 
// include "../../../koneksi.php";

// $conn = mysqli_connect('localhost','root','','peminjaman');

// if (!$conn) {
//     die("Koneksi gagal: " . mysqli_connect_error());
// }

// Proses untuk menghapus data tertentu
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    mysqli_query($conn, "DELETE FROM pinjambarang WHERE id='$id'");
    header("Location: datapinjambarang.php");
    exit;
}

// Proses untuk menghapus seluruh data
if (isset($_POST['delete_all'])) {
    mysqli_query($conn, "DELETE FROM pinjambarang");
    header("Location: datapinjambarang.php");
    exit;
}

$query = mysqli_query($conn, 'SELECT pinjambarang.id, pinjambarang.id_barang, pinjambarang.id_user, pinjambarang.tgl_mulai, pinjambarang.tgl_selesai, pinjambarang.qty, pinjambarang.status, barang.nama_barang, pinjambarang.nama_peminjam, pinjambarang.email_peminjam FROM pinjambarang INNER JOIN barang ON barang.id=pinjambarang.id_barang');

if (!$query) {
    die("Query failed: " . mysqli_error($conn)); // Debugging line
}
?>

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Peminjaman Barang</h4>
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
                                <h4 class="card-title">Data Pinjam Barang</h4>
                                <form method="POST" style="margin-left: auto;">
                                    <button type="submit" name="delete_all" class="btn btn-danger">Delete All</button>
                                </form>
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
                                            <th>Jumlah </th>
                                            <th>Nama </th>
                                            <th>Email </th>
                                            <th>Status</th>
                                            <th>control</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            while ($pinjambarang = mysqli_fetch_array($query)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $pinjambarang['nama_barang'] ?></td>
                                            <td><?php echo $pinjambarang['tgl_mulai'] ?></td>
                                            <td><?php echo $pinjambarang['tgl_selesai'] ?></td>
                                            <td><?php echo $pinjambarang['qty'] ?></td>
                                            <td><?php echo $pinjambarang['nama_peminjam'] ?></td>
                                            <td><?php echo $pinjambarang['email_peminjam'] ?></td>
                                            <td><?php echo $pinjambarang['status'] ?></td>
                                            <td>
                                            <?php if ($pinjambarang['status'] == 'menunggu') { ?>
                                                    <a href="?view=detailpinjambarang&id=<?php echo $pinjambarang['id'] ?>" title="Detail" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                                    <a href="#modalApprovePinjamBarang<?php echo $pinjambarang['id'] ?>" data-toggle="modal" title="Approve Pinjam" class="btn btn-xs btn-success"><i class="fa fa-check-circle"></i> Approve</a>
                                                <?php } elseif ($pinjambarang['status'] == 'menunggu_konfirmasi_kembali') { ?>
                                                    <a href="#modalApproveKembaliBarang<?php echo $pinjambarang['id'] ?>" data-toggle="modal" title="Konfirmasi Pengembalian" class="btn btn-xs btn-warning"><i class="fa fa-undo"></i> Konfirmasi Kembali</a>
                                                <?php } ?>
                                                <form method="POST" style="display:inline;">
                                                    <input type="hidden" name="id" value="<?php echo $pinjambarang['id']; ?>">
                                                    <button type="submit" name="delete" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <script>
                                    $(document).ready(function() {
                                        $('#add-row').DataTable(); // Inisialisasi DataTables
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <center>
        <h6><b>&copy; Copyright@2025|UMPKU|</b></h6>
    </center>
</div>
<!-- Modal untuk Approve Pinjam Barang -->
<?php
$c = mysqli_query($conn, 'SELECT pinjambarang.id, pinjambarang.id_barang, pinjambarang.id_user, pinjambarang.tgl_mulai, pinjambarang.tgl_selesai, pinjambarang.qty, pinjambarang.status, barang.nama_barang, user.email FROM pinjambarang INNER JOIN barang ON barang.id=pinjambarang.id_barang INNER JOIN user ON user.id=pinjambarang.id_user');
while ($row = mysqli_fetch_array($c)) {
    if ($row['status'] == 'menunggu') {
?>
        <div class="modal fade" id="modalApprovePinjamBarang<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header no-bd">
                        <h5 class="modal-title">
                            <span class="fw-mediumbold">Approve Pinjaman</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                            <input type="hidden" name="status" value="approve">
                            <p>Apakah Anda yakin ingin menyetujui pinjaman barang <b><?php echo $row['nama_barang'] ?></b> sebanyak <b><?php echo $row['qty'] ?></b>?</p>
                        </div>
                        <div class="modal-footer no-bd">
                            <button type="submit" name="approve_pinjam" class="btn btn-success"><i class="fa fa-check-circle"></i> Approve</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php }} ?>

<!-- Modal untuk Konfirmasi Pengembalian Barang -->
<?php
$c = mysqli_query($conn, 'SELECT pinjambarang.id, pinjambarang.id_barang, pinjambarang.id_user, pinjambarang.tgl_mulai, pinjambarang.tgl_selesai, pinjambarang.qty, pinjambarang.status, barang.nama_barang, user.email FROM pinjambarang INNER JOIN barang ON barang.id=pinjambarang.id_barang INNER JOIN user ON user.id=pinjambarang.id_user');
while ($row = mysqli_fetch_array($c)) {
    if ($row['status'] == 'menunggu_konfirmasi_kembali') {
?>
        <div class="modal fade" id="modalApproveKembaliBarang<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header no-bd">
                        <h5 class="modal-title">
                            <span class="fw-mediumbold">Konfirmasi Pengembalian</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                            <input type="hidden" name="id_barang" value="<?php echo $row['id_barang'] ?>">
                            <input type="hidden" name="qty" value="<?php echo $row['qty'] ?>">
                            <input type="hidden" name="status" value="selesai">
                            <p>Apakah Anda yakin ingin mengonfirmasi pengembalian barang <b><?php echo $row['nama_barang'] ?></b> sebanyak <b><?php echo $row['qty'] ?></b>?</p>
                        </div>
                        <div class="modal-footer no-bd">
                            <button type="submit" name="approve_kembali" class="btn btn-success"><i class="fa fa-check-circle"></i> Konfirmasi</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                        </div>
                        </form>
                </div>
            </div>
        </div>
<?php }} ?>

<?php
// Cek koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'peminjaman');
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST['approve_pinjam'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    mysqli_query($conn, "UPDATE pinjambarang SET status='$status' WHERE id='$id'");
    
    // Update stok barang
    $qty = $_POST['qty']; // Ambil qty dari form
    $id_barang = $_POST['id_barang']; // Ambil id_barang dari form
    mysqli_query($conn, "UPDATE barang SET stok=stok-'$qty' WHERE id='$id_barang'"); // Kurangi stok
    
    echo "<meta http-equiv='refresh' content='0; URL=?view=datapinjambarang'>";
}

// Proses untuk approve kembali
if (isset($_POST['approve_kembali'])) {
    $id = $_POST['id'];
    $id_barang = $_POST['id_barang'];
    $qty = $_POST['qty'];
    $status = $_POST['status'];
    
    // Update status pinjam barang
    mysqli_query($conn, "UPDATE pinjambarang SET status='$status' WHERE id='$id'");

    // Update stok barang
    mysqli_query($conn, "UPDATE barang SET stok=stok+'$qty' WHERE id='$id_barang'");
    
    echo "<meta http-equiv='refresh' content='0; URL=?view=datapinjambarang'>";
}

// Proses untuk menghapus data tertentu
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    mysqli_query($conn, "DELETE FROM pinjambarang WHERE id='$id'");
    echo "<meta http-equiv='refresh' content='0; URL=?view=datapinjambarang'>";
}

// Proses untuk menghapus seluruh data
if (isset($_POST['delete_all'])) {
    mysqli_query($conn, "DELETE FROM pinjambarang");
    echo "<meta http-equiv='refresh' content='0; URL=?view=datapinjambarang'>";
}
?>
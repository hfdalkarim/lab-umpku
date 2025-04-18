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
                <h4 class="page-title">Jadwal Kuliah</h4>
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
                                <h4 class="card-title">Data Jadwal Kuliah</h4>
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

<!-- Tambahkan script untuk DataTables jika diperlukan -->



<?php 
// Menghitung jumlah barang
$query = mysqli_query($conn, 'SELECT count(*) as barang from barang');
$row = mysqli_fetch_array($query);

// Menghitung jumlah ruangan
$p = mysqli_query($conn, 'SELECT count(*) as ruangan from ruangan');
$q = mysqli_fetch_array($p);

// Menghitung jumlah pinjaman barang berdasarkan id_user yang sedang login
$id_user = $_SESSION['id'];
$r = mysqli_query($conn, "SELECT count(*) as pinjambarang from pinjambarang WHERE id_user = '$id_user'");
$d = mysqli_fetch_array($r);

// Menghitung jumlah pinjaman ruangan berdasarkan id_user yang sedang login
$t = mysqli_query($conn, "SELECT count(*) as pinjamruangan from pinjamruangan WHERE id_user = '$id_user'");
$z = mysqli_fetch_array($t);
?>

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-box"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Data Barang</p>
                                        <h4 class="card-title"><?php echo $row['barang'] ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-door-open"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Data Ruangan</p>
                                        <h4 class="card-title"><?php echo $q['ruangan'] ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-newspaper"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">History Barang</p>
                                        <h4 class="card-title"><?php echo $d['pinjambarang'] ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-newspaper"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">History Ruangan</p>
                                        <h4 class="card-title"><?php echo $z['pinjamruangan'] ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <center><h6><b>&copy; Copyright@2025|UMPKU|</b></h6></center>
</div>
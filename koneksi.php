<?php
$conn = mysqli_connect('localhost','root','','peminjaman');

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
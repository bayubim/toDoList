<?php 
// koneksi database
include 'koneksi.php';
$db = new Database();
$connect = $db->connect;
// menangkap data id yang di kirim dari url
$id = $_GET['id_kegiatan'];
 
 
// menghapus data dari database
mysqli_query($connect,"delete from kegiatan where id_kegiatan='$id'");
 
// mengalihkan halaman kembali ke index.php
header("location:listAktivitas.php");
 
?>
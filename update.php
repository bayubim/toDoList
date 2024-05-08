<?php
//Include file koneksi ke database
include "koneksi.php";
$db = new Database();
$connect = $db->connect;
//menerima nilai dari kiriman form update-barang 
$id_kegiatan=$_POST["id_kegiatan"];
$aktivitas=$_POST["aktivitas"];
$start=$_POST["start"];
$end=$_POST["end"];
$status=$_POST["status"];

	//perintah sql untuk update data barang berdasarkan id_barang yang akan di update
	$sql="update kegiatan set
		aktivitas='$aktivitas',
		start='$start',
		end='$end',
		status='$status'
		where id_kegiatan=$id_kegiatan";
		
	//Eksekusi query sql diatas
	$hasil=mysqli_query($connect,$sql);

		//kondisi apabila gagal maka akan tampil pemberitahuan gagal
		if (!$hasil) {
			echo "Gagal Update data";
			exit;
		}
	//apabila berhasil maka halaman akan di redirect ke tampil-barang.php	
	header("Location:listAktivitas.php");
?>
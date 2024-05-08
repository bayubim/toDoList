<?php
session_start();

// Cek apakah ada sesi login
if (!isset($_SESSION['login']) || empty($_SESSION['login'])) {
    header("location: formLogin.php");
    exit; // Menghentikan eksekusi skrip jika tidak ada sesi login
}

// Memastikan ada input yang dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data aktivitas dari form
    $aktivitas = $_POST['aktivitas'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $status = $_POST['status'];

    // Validasi data agar tidak kosong
    if (!empty($aktivitas) && !empty($start) && !empty($end) && !empty($status)) {
        // Menghubungkan ke database
        include "koneksi.php"; // Pastikan file koneksi.php sesuai dengan konfigurasi database Anda
        $db = new Database();
        $connect = $db->connect;
        // Mendapatkan user_id dari sesi
        if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id']; // Pastikan sesuai dengan nama sesi yang digunakan saat login

            // Menyiapkan query untuk menyimpan aktivitas
            $sql = "INSERT INTO kegiatan (aktivitas, start, end, status, user_id) 
                    VALUES ('$aktivitas', '$start', '$end', '$status', '$user_id')";

            // Eksekusi query
            if (mysqli_query($connect, $sql)) {
                header('Location: listAktivitas.php');
                exit; // Menghentikan eksekusi skrip setelah melakukan redirect
            } else {
                echo "Gagal Menyimpan Data!!";
            }
        } else {
            echo "ID Pengguna Tidak Valid!";
        }
    } else {
        echo "Data tidak boleh kosong!";
    }
} else {
    echo "Metode pengiriman data tidak valid!";
}
?>
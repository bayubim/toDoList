<?php
include 'koneksi.php'; // Sesuaikan dengan file koneksi Anda
// Buat objek Database
$db = new Database();
$connect = $db->connect;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);

    // Periksa apakah password dan konfirmasi password cocok
    if ($password != $confirm_password) {
        echo "<script>alert('Konfirmasi Password tidak sesuai')</script>";
        echo "<meta http-equiv='refresh' content='1;url=daftar.php'>";
        exit(); // Menghentikan eksekusi skrip jika konfirmasi password tidak sesuai
    }

    // Cek apakah username atau email sudah ada di database
    $checkQuery = "SELECT * FROM user WHERE username='$username' OR email='$email'";
    $checkResult = mysqli_query($connect, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "<script>alert('Username atau Email sudah digunakan')</script>";
        echo "<meta http-equiv='refresh' content='1;url=daftar.php'>";
        exit(); // Menghentikan eksekusi skrip jika username atau email sudah digunakan
    }

    // Enkripsi password sebelum disimpan ke database
    $hashed_password = md5($password);

    // Simpan data ke database
    $insertQuery = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
    $insertResult = mysqli_query($connect, $insertQuery);

    if ($insertResult) {
        echo "<script>alert('Pendaftaran berhasil')</script>";
        echo "<meta http-equiv='refresh' content='1;url=formLogin.php'>";
        exit(); // Menghentikan eksekusi skrip setelah pendaftaran berhasil
    } else {
        echo "<script>alert('Gagal melakukan pendaftaran')</script>";
        echo "<meta http-equiv='refresh' content='1;url=daftar.php'>";
        exit(); // Menghentikan eksekusi skrip jika gagal melakukan pendaftaran
    }
} else {
    echo "Akses tidak diizinkan";
}
?>
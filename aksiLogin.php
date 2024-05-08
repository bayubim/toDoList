<?php
session_start();

// Import kelas Database
include 'koneksi.php';

// Buat objek Database
$db = new Database();
$connect = $db->connect;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, md5($_POST['password']));

    $query = "SELECT * FROM user WHERE username= '$username' AND password = '$password'";
    $queryDB = mysqli_query($connect, $query);
    $check = mysqli_num_rows($queryDB);

    if ($check > 0) {
        $dataUser = mysqli_fetch_array($queryDB);
        $_SESSION['user_id'] = $dataUser['user_id']; // Ambil user_id dari hasil query
        $_SESSION['login'] = true;
        $_SESSION['role'] = $dataUser['role']; // Misalnya ada kolom 'role' untuk menentukan superuser atau bukan

        if ($_SESSION['role'] == 'superuser') {
            header("location: dashboard.php"); // Arahkan ke dashboard superuser
            exit();
        } else {
            header("location: listAktivitas.php"); // Arahkan ke dashboard user biasa
            exit();
        }
    } else {
        echo "<script>alert('Username atau Password salah')</script>";
        echo "<meta http-equiv='refresh' content='1 url=formLogin.php'>";
    }
}
?>
<?php
session_start();
// Cek apakah user sudah login dan memiliki hak akses superuser
if (!$_SESSION['login'] || $_SESSION['role'] !== 'superuser') {
    header("location: formLogin.php");
    exit;
}

// Include file koneksi ke database
include "koneksi.php";

// Buat objek Database
$db = new Database();
$connect = $db->connect;

$user_id_to_edit = '';
$username_to_edit = '';
$email_to_edit = '';


// Proses tambah pengguna
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah_user'])) {
    // Ambil data dari form
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Hash password sebelum disimpan
    $email = $_POST['email'];

    // Lakukan validasi data

    // Simpan data pengguna ke database
    $query_tambah_user = "INSERT INTO user (username, password, email) VALUES ('$username', '$password', '$email')";
    mysqli_query($connect, $query_tambah_user);
}

// Proses hapus pengguna
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hapus_user'])) {
    $user_id = $_POST['user_id'];

    // Hapus pengguna dari database
    $query_hapus_user = "DELETE FROM user WHERE user_id=$user_id";
    mysqli_query($connect, $query_hapus_user);
}

$query_get_user = "SELECT * FROM user WHERE role='user'";
$result_user = mysqli_query($connect, $query_get_user);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Superuser</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h1 class="mb-4">Data User</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_user)) { ?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                            <button type="submit" name="hapus_user" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Form untuk tambah pengguna -->
        <h2 class="mt-5">Tambah Pengguna Baru</h2>
        <form method="POST" action="" class="mb-5">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" class="form-control" required>
            </div>
            <button type="submit" name="tambah_user" class="btn btn-success">Tambah Pengguna</button>
        </form>

    </div>

    <!-- Bootstrap JS dan Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
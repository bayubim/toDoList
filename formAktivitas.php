<?php
session_start();
if (!$_SESSION['login']) {
    header("location: formLogin.php");
    exit; // tambahkan ini untuk menghentikan eksekusi skrip jika tidak ada sesi login
}
?>
<html>

<head>
    <title>Form Aktivitas</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/formAktivitas.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <?php
    require_once 'vendor/autoload.php';
    require_once 'MyApp/Navigasi.php';

    use MyApp\Navigasi;

    // Call the render method to display the sidebar
    Navigasi::render();
    ?>

    <main>
        <div class="container">
            <form action="simpanAktivitas.php" method="post">
                <!-- Ubah method menjadi POST -->
                <div class="vh-100 d-flex justify-content-center align-items-center">
                    <div class="card-barang col-md-4 p-5 mt-5 shadow-sm border rounded-5">
                        <h1 class="text-center mb-4 pb-1">Tambah Aktivitas</h1>
                        <form>
                            <div>
                                <label class="form-label" for="">Nama Aktivitas</label><br />
                                <input type="text" class="form-control border border-primary" name="aktivitas" />
                                <br /><br />
                            </div>
                            <div>
                                <label class="form-label" for="">Mulai</label></br>
                                <input type="date" class="form-control border border-primary" name="start">
                                <br /><br />
                            </div>
                            <div>
                                <label class="form-label" for="">Selesai</label><br />
                                <input type="date" class="form-control border border-primary" name="end">
                                <br /><br />
                            </div>
                            <div>
                                <label class="form-label" for="">Status</label><br />
                                <select class="form-select border border-primary" name="status">
                                    <option value="belum">Belum</option>
                                    <option value="progress">Progress</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                                <br /><br />
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="alert.js"></script>
</body>

</html>
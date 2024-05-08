<?php
session_start();
if (!$_SESSION['login']) {
    header("location: formLogin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Form</title>
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
            <?php
            include 'koneksi.php';
            // Buat objek Database
            $db = new Database();
            $connect = $db->connect;

            $id_kegiatan = $_GET['id_kegiatan'];
            $data = mysqli_query($connect, "select * from kegiatan where id_kegiatan='$id_kegiatan'");
            while ($kegiatan = mysqli_fetch_array($data)) {
                ?>
                <form action="update.php" method="post">
                    <div class="vh-100 d-flex justify-content-center align-items-center">
                        <div class="card-barang col-md-4 p-5 mt-5 shadow-sm border rounded-5">
                            <h1 class="text-center mb-2 pb-1">Update Kegiatan</h1>
                            <form>
                                <div>
                                    <label class="form-label" for="">Nama Kegiatan</label><br />
                                    <input type="hidden" name="id" value="<?php echo $kegiatan['id_kegiatan']; ?>">
                                    <input type="text" class="form-control border border-primary" name="aktivitas"
                                        value="<?php echo $kegiatan['aktivitas']; ?>" />
                                    <br /><br />
                                </div>
                                <div>
                                    <label class="form-label" for="">Mulai</label></br>
                                    <input type="date" class="form-control border border-primary" name="start"
                                        value="<?php echo $kegiatan['start']; ?>">
                                    <br /><br />
                                </div>
                                <div>
                                    <label class="form-label" for="">Selesai</label><br />
                                    <input type="date" class="form-control border border-primary" name="end"
                                        value="<?php echo $kegiatan['end']; ?>">
                                    <br /><br />
                                </div>
                                <div>
                                    <label class="form-label" for="">Status</label><br />
                                    <input type="teks" class="form-control border border-primary" name="status"
                                        value="<?php echo $kegiatan['status']; ?>">
                                    <br /><br />
                                </div>
                                <div class="d-grid">
                                    <input type="hidden" name="id_kegiatan" value="<?php echo $id_kegiatan; ?>" />
                                    <button class="btn btn-primary" type="submit" value="simpan">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </form>
                <?php
            }
            ?>
        </div>
    </main>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</body>

</html>
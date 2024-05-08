<?php
session_start();
if (!$_SESSION['login'] || $_SESSION['role'] !== 'user') {
  session_destroy();
  header("location: formLogin.php");
  exit;

}
if (!$_SESSION['login']) {
  header("location: formLogin.php");
}
include "koneksi.php";
require_once 'vendor/autoload.php'; // Include autoload file for DOMPDF

// Buat objek Database
$db = new Database();
$connect = $db->connect;

// Buat objek Database
$db = new Database();
$connect = $db->connect;

// Jika tombol Download PDF diklik
if (isset($_POST['download_pdf'])) {
  // Panggil fungsi untuk menghasilkan PDF
  generatePDF();
}

function generatePDF()
{
  global $connect;
  // Buat objek DOMPDF
  $dompdf = new Dompdf\Dompdf();

  // HTML konten yang akan dikonversi menjadi PDF
  ob_start(); // Mulai output buffering

  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar List Aktivitas</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/listAktivitas.css">

    <style>
      /* Define styles for the PDF content */
      body {
        font-family: Arial, sans-serif;
      }

      table {
        width: 100%;
        border-collapse: collapse;
      }

      th,
      td {
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: center;
      }

      th {
        background-color: #f2f2f2;
      }

      .text-center {
        text-align: center;
      }
    </style>
  </head>

  <body>
    <main>

      <?php
      if (isset($_GET['cari'])) {
        $cari = $_GET['cari'];
        echo "<b>Hasil pencarian : " . $cari . "</b>";
      }
      ?>
      <div class="container">
        <h1 class="text-center py-1">LIST AKTIVITAS</h1>


        <table class="table table-bordered">
          <thead class="text-center">
            <tr>
              <th>No</th>
              <th>Aktivitas</th>
              <th>Mulai</th>
              <th>Selesai</th>
              <th>Status</th>
            </tr>
          </thead>
          <?php
          // Ambil id pengguna dari sesi
          $user_id = $_SESSION['user_id'];

          // Query untuk menampilkan aktivitas sesuai dengan id pengguna yang login
          $query_aktivitas = mysqli_query($connect, "SELECT * FROM kegiatan WHERE user_id = $user_id");

          echo '<tbody class="text-center">';
          //menampilkan data dengan dibatasi
          $batasData = 10;
          $halaman = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;
          $halaman_awal = ($halaman > 1) ? ($halaman * $batasData) - $batasData : 0;

          $previous = $halaman - 1;
          $next = $halaman + 1;

          $jumlah_data = mysqli_num_rows($query_aktivitas);
          $total_halaman = ceil($jumlah_data / $batasData);

          //pencarian barang tabel
          if (isset($_GET['cari'])) {
            $cari = $_GET['cari'];
            $data_kegiatan = mysqli_query($connect, "SELECT * FROM kegiatan WHERE aktivitas LIKE '%" . $cari . "%' AND user_id = $user_id");
          } else {
            $data_kegiatan = mysqli_query($connect, "SELECT * FROM kegiatan WHERE user_id = $user_id LIMIT $halaman_awal, $batasData");
          }
          $nomor = $halaman_awal + 1;
          while ($row = mysqli_fetch_array($data_kegiatan)) {

            echo '<tr>
                  <td>' . $nomor++ . '</td>
                  <td>' . $row['aktivitas'] . '</td>
                  <td>' . $row['start'] . '</td>
                  <td>' . $row['end'] . '</td>
                  <td>' . $row['status'] . '</td>
                </tr>';
          }
          echo '</tbody>';
          ?>
        </table>

        </ul>
      </div>
      </div>
    </main>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="alert.js"></script>
  </body>

  </html>
  <?php
  $html_content = ob_get_clean(); // Ambil konten HTML dari output buffer

  // Load konten HTML ke DOMPDF
  $dompdf->loadHtml($html_content);

  // Atur ukuran dan orientasi halaman PDF
  $dompdf->setPaper('A4', 'portrait');

  // Render PDF (konversi HTML ke PDF)
  $dompdf->render();

  // Simpan atau tampilkan PDF
  $dompdf->stream("listAktivitas.pdf", array("Attachment" => false));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar List Aktivitas</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/listAktivitas.css">
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
    <form action="listAktivitas.php" method="get">
      <div class="search">
        <input class="searchForm" type="text" placeholder="Search" name="cari">
        <button class="buttonSearch" type="submit"><i class="fas fa-search"></i></button>
      </div>
    </form>

    <?php
    if (isset($_GET['cari'])) {
      $cari = $_GET['cari'];
      echo "<b>Hasil pencarian : " . $cari . "</b>";
    }
    ?>
    <div class="container">
      <h1 class="text-center py-1">LIST AKTIVITAS</h1>

      <hr />
      <table class="table table-bordered">
        <thead class="text-center">
          <tr>
            <th>No</th>
            <th>Aktivitas</th>
            <th>Mulai</th>
            <th>Selesai</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <?php
        // Ambil id pengguna dari sesi
        $user_id = $_SESSION['user_id'];

        // Query untuk menampilkan aktivitas sesuai dengan id pengguna yang login
        $query_aktivitas = mysqli_query($connect, "SELECT * FROM kegiatan WHERE user_id = $user_id");

        echo '<tbody class="text-center">';
        //menampilkan data dengan dibatasi
        $batasData = 10;
        $halaman = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;
        $halaman_awal = ($halaman > 1) ? ($halaman * $batasData) - $batasData : 0;

        $previous = $halaman - 1;
        $next = $halaman + 1;

        $jumlah_data = mysqli_num_rows($query_aktivitas);
        $total_halaman = ceil($jumlah_data / $batasData);

        //pencarian barang tabel
        if (isset($_GET['cari'])) {
          $cari = $_GET['cari'];
          $data_kegiatan = mysqli_query($connect, "SELECT * FROM kegiatan WHERE aktivitas LIKE '%" . $cari . "%' AND user_id = $user_id");
        } else {
          $data_kegiatan = mysqli_query($connect, "SELECT * FROM kegiatan WHERE user_id = $user_id LIMIT $halaman_awal, $batasData");
        }
        $nomor = $halaman_awal + 1;
        while ($row = mysqli_fetch_array($data_kegiatan)) {

          echo '<tr>
        <td>' . $nomor++ . '</td>
        <td>' . $row['aktivitas'] . '</td>
        <td>' . $row['start'] . '</td>
        <td>' . $row['end'] . '</td>
        <td>' . $row['status'] . '</td>
        <td>
            <a href="formUpdate.php?id_kegiatan=' . $row['id_kegiatan'] . '"><button class="btn w-25 px-0 py-0 bg-warning"><i class="fas fa-edit"></i></button></a>
            <a onClick="return confirmDelete(' . $row['id_kegiatan'] . ')"><button class="btn w-25 px-0 py-0 bg-danger"><i class="fas fa-trash-alt"></i></button></a>
        </td>
    </tr>';
        }
        echo '</tbody>';
        ?>
      </table>

      <!-- button untuk melihat data lainnya -->
      <div>
        <ul class="pagination justify-content-center">
          <li class="page-item">
            <a class="page-link" <?php if ($halaman > 1) {
              echo "href='?halaman=$previous'";
            } ?>>Previous</a>
          </li>
          <?php
          for ($x = 1; $x <= $total_halaman; $x++) {
            ?>
            <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a>
            </li>
            <?php
          }
          ?>
          <li class="page-item">
            <a class="page-link" <?php if ($halaman < $total_halaman) {
              echo "href='?halaman=$next'";
            } ?>>Next</a>
          </li>
        </ul>
      </div>
      <!-- Tombol Download PDF -->
      <form method="post">
        <button type="submit" name="download_pdf" class="btn mb-3 btn-primary">Download PDF</button>
      </form>
    </div>
  </main>
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="alert.js"></script>
  <!-- Font Awesome JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

</body>

</html>
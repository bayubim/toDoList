function confirmDelete(oke) {
  if (confirm("Anda yakin ingin menghapus?")) {
    window.location.href = "hapus.php?id_kegiatan=" + oke + "";
    return true;
  }
}

function confirmLogout() {
  if (confirm("Anda yakin ingin log out?")) {
    window.location.href = "logout.php";
    return true;
  }
}

<?php
// Cek apakah ada parameter id yang dikirim
if (isset($_GET['nis'])) {
    $nis = $_GET['nis'];

    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "database_ukk");

    // Query untuk menghapus data berdasarkan id
    $sql = "DELETE FROM siswa WHERE nis = '$nis'";

    if (mysqli_query($conn, $sql)) {
        echo "Data berhasil dihapus!";
        header("Location: dashboard-siswa.php"); // Redirect kembali ke halaman utama setelah hapus
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
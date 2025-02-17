<?php
// Cek apakah ada parameter id yang dikirim
if (isset($_GET['idproduk'])) {
    $idproduk = $_GET['idproduk'];

    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "database_ukk");

    // Query untuk menghapus data berdasarkan id
    $sql = "DELETE FROM produk WHERE idproduk = '$idproduk'";

    if (mysqli_query($conn, $sql)) {
        echo "Data berhasil dihapus!";
        header("Location: dashboard-produk.php"); // Redirect kembali ke halaman utama setelah hapus
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
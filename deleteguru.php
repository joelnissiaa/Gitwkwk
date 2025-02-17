<?php
// Cek apakah ada parameter id yang dikirim
if (isset($_GET['nip'])) {
    $nip = $_GET['nip'];

    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "database_ukk");

    // Query untuk menghapus data berdasarkan id
    $sql = "DELETE FROM guru WHERE nip = '$nip'";

    if (mysqli_query($conn, $sql)) {
        echo "Data berhasil dihapus!";
        header("Location: dashboard-guru.php"); // Redirect kembali ke halaman utama setelah hapus
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
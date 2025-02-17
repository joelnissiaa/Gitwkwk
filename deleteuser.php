<?php
// Cek apakah ada parameter id yang dikirim
if (isset($_GET['iduser'])) {
    $iduser = $_GET['iduser'];

    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "database_ukk");

    // Query untuk menghapus data berdasarkan id
    $sql = "DELETE FROM user WHERE iduser = '$iduser'";

    if (mysqli_query($conn, $sql)) {
        echo "Data berhasil dihapus!";
        header("Location: dashboard-user.php"); // Redirect kembali ke halaman utama setelah hapus
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
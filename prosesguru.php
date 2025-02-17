<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database_ukk";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Proses update jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data yang dikirim dari form
    $nip = $_POST['nip'];
    $namaguru = $_POST['namaguru'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $kontak = $_POST['kontak'];
    $foto  = $_POST['foto'];
    // Query untuk update data produk
    $sql = "UPDATE guru SET 
                namaguru = '$namaguru', 
                jeniskelamin = '$jeniskelamin', 
                kontak = '$kontak', 
                foto = '$foto'
            WHERE nip = '$nip'";

    if (mysqli_query($conn, $sql)) {
        // Jika update berhasil, redirect ke halaman utama atau halaman lain
        header("Location: dashboard-guru.php"); // Ganti dengan halaman yang diinginkan
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
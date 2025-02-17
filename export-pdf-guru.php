<?php
// Masukkan library FPDF
require('fpdf.php');

// Inisialisasi objek FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Set font
$pdf->SetFont('Arial', 'B', 16);

// Judul Laporan
$pdf->Cell(200, 10, 'Laporan Data Siswa', 0, 1, 'C');

// Spasi
$pdf->Ln(10);

// Menghubungkan ke database dan mengambil data untuk laporan (Contoh)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database_ukk";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Query untuk mengambil data guru
$sql = "SELECT * FROM guru";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Membuat header tabel di PDF
    $pdf->Cell(19, 10, 'NIP', 1);
    $pdf->Cell(36, 10, 'Nama Guru', 1);
    $pdf->Cell(40, 10, 'Jenis Kelamin', 1);
    $pdf->Cell(39, 10, 'Kontak', 1);
    $pdf->Cell(30, 10, 'Foto', 1);  // Kolom untuk Foto
    $pdf->Ln();

// Output data baris per baris
while($row = $result->fetch_assoc()) {
    // Menampilkan data pada tabel (kolom lainnya)
    $pdf->Cell(19, 36.5, $row['nip'], 1);
    $pdf->Cell(36, 36.5, $row['namaguru'], 1);
    $pdf->Cell(40, 36.5, $row['jeniskelamin'], 1);
    $pdf->Cell(39, 36.5, $row['kontak'], 1);
    
    // Kolom Foto - Menampilkan gambar
    $fotoPath = 'assets/img/' . $row['foto'];  // Path foto sesuai dengan lokasi penyimpanan

    // Menentukan lebar dan tinggi kolom foto
    $fotoWidth = 30;  // Tentukan lebar kolom foto (misalnya 20mm)
    $fotoHeight = 36.5; // Menyesuaikan tinggi kolom foto agar rata dengan kolom lainnya

    // Mengecek apakah file gambar ada
    if (file_exists($fotoPath)) {
        // Menyisipkan gambar dengan ukuran yang disesuaikan
        // Menyisipkan gambar pada posisi yang tepat, dengan lebar dan tinggi yang sudah ditentukan
        $pdf->Image($fotoPath, $pdf->GetX(), $pdf->GetY(), $fotoWidth, $fotoHeight);
        
        // Menambahkan garis pembatas di sekitar foto (untuk gambar)
        $pdf->Rect($pdf->GetX() - 0.2, $pdf->GetY() - 0.2, $fotoWidth + 0.4, $fotoHeight + 0.4);
    } else {
        // Jika foto tidak ditemukan, tampilkan teks "Tidak Ada Foto" dengan garis pembatas di sekitar
        $pdf->Cell($fotoWidth, $fotoHeight, 'Tidak Ada Foto', 1, 0, 'C');
    }

    // Pindah ke baris berikutnya setelah gambar atau teks ditampilkan
    $pdf->Ln();
}

    
} else {
    $pdf->Cell(200, 10, 'Tidak ada data ditemukan', 1, 1, 'C');
}

// Tutup koneksi database
$conn->close();

// Output PDF ke browser
$pdf->Output();
?>
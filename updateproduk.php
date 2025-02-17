<style>
    .update-form {
    width: 300px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.update-form label {
    display: block;
    margin-bottom: 5px;
}

.update-form input[type="text"],
.update-form input[type="date"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.update-form input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}
</style>
<?php
// Ambil id produk yang diteruskan lewat URL
if (isset($_GET['idproduk'])) {
    $idproduk = $_GET['idproduk'];

    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "database_ukk");

    // Siapkan query dengan parameter untuk mencegah injection
    $stmt = $conn->prepare("SELECT * FROM produk WHERE idproduk = ?");
    $stmt->bind_param("i", $idproduk);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Tampilkan form untuk mengupdate data dengan styling CSS
        echo '<form method="post" action="prosesproduk.php" class="update-form">
            <label for="idproduk">ID Produk:</label>
            <input type="text" id="idproduk" name="idproduk" value="' . $row['idproduk'] . '"><br>
            <label for="namasiswa">Nama Produk:</label>
            <input type="text" id="namaproduk" name="namaproduk" value="' . $row['namaproduk'] . '"><br>
            <label for="jumlah">Jumlah:</label>
            <input type="number" id="jumlah" name="jumlah" value="' . $row['jumlah'] . '"><br>
            <label for="harga">Harga:</label>
            <input type="text" id="harga" name="harga" value="' . $row['harga'] . '"><br>
            <label for="kelas">Deskripsi:</label>
            <input type="text" id="deskripsi" name="deskripsi" value="' . $row['deskripsi'] . '"><br>
            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" value="' . $row['tanggal'] . '"><br>
            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto" value="' . $row['foto'] . '"><br>
            
            <input type="submit" value="Update">
        </form>';
    } else {
        echo "Data tidak ditemukan!";
    }

    $stmt->close();
    $conn->close();
}
?>
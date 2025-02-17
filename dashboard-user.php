<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PPLG</title>
    <link href="assets/img/rpl.png" rel="icon">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Style untuk Dashboard */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        
        header {
            background-color:rgb(32, 168, 206);
            color: white;
            padding: 10px 20px;
        }

        header h1 {
            display: inline-block;
            margin: 0;
        }

        nav {
            float: right;
            margin-top: 10px;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px;
            margin-left: 20px;
        }

        nav a:hover {
            background-color: #f76d12;
        }

        .container {
            padding: 20px;
        }

        .stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .stats div {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            width: 22%;
            text-align: center;
        }

        .stats div h2 {
            margin: 0;
            font-size: 24px;
        }

        .stats div p {
            font-size: 16px;
            margin-top: 10px;
        }

        .btn-add-siswa {
        display: inline-block;
        padding: 10px 20px;
        background-color:rgb(49, 189, 14); /* Green background */
        color: white;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-add-siswa:hover {
        background-color: #1a1f24; /* Slightly darker green */
        transform: translateY(-2px); /* Lift the button on hover */
    }

    .btn-add-siswa:active {
        background-color: #1a1f24; /* Darker green when clicked */
        transform: translateY(2px); /* Push button down on click */
    }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #333;
            color: white;
        }

            /* Style for the Update button */
    .btn-update {
        padding: 8px 15px;
        background-color: #4CAF50; /* Green background */
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-update:hover {
        background-color: #45a049; /* Darker green on hover */
        transform: translateY(-2px); /* Lift effect on hover */
    }

    .btn-update:active {
        background-color: #3e8e41; /* Even darker green when clicked */
        transform: translateY(2px); /* Pressed effect */
    }

    /* Style for the Delete button */
    .btn-delete {
        padding: 8px 15px;
        background-color: #f44336; /* Red background */
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-delete:hover {
        background-color: #e53935; /* Darker red on hover */
        transform: translateY(-2px); /* Lift effect on hover */
    }

    .btn-delete:active {
        background-color: #c62828; /* Even darker red when clicked */
        transform: translateY(2px); /* Pressed effect */
    }

        .actions button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

     
        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: white;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>

<header>
    <h1><img src="assets/img/logo-new.png" style="width: 25px; height: 25px ;" alt="">Dashboard PPLG</h1>
    <nav>
        <a href="dashboard-produk.php">Data Produk</a>
        <a href="dashboard-siswa.php">Data Siswa</a>
        <a href="dashboard-guru.php">Data Guru</a>
        <a href="dashboard-user.php">Data User</a>
        <a href="regis.php">Registrasi</a>
        <a href="index-2.php">Kembali</a>
        <a href="index.php">LogOut</a>
    </nav>
</header>

<div class="container mt-4">
    <h3 style='text-align: center;'>DATA USER SMK NEGERI 10 SEMARANG</h3>
    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database_ukk";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Tentukan jumlah data per halaman
$limit = 5;

// Ambil halaman saat ini dari parameter URL (default: 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Query untuk mendapatkan data user dengan pagination
$sql = "SELECT * FROM user LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);

// Tombol untuk Create
echo '<a href="createuser.php" class="btn-add-siswa">Tambah User</a><br><br>';

// Tampilkan data dalam tabel
if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID User</th><th>Username</th><th>Password</th><th>Nama User</th><th>Email User</th><th>Level</th><th>Action</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['iduser'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['password'] . "</td>";
        echo "<td>" . $row['namauser'] . "</td>";
        echo "<td>" . $row['emailuser'] . "</td>";
        echo "<td>" . $row['level'] . "</td>";

        // Tombol Action
        echo "<td>
            <form action='detailuser.php' method='get' style='display:inline;'>
                <input type='hidden' name='iduser' value='" . $row['iduser'] . "'>
                <button type='submit' class='btn-update'>Detail</button>
            </form> |
            <form action='updateuser.php' method='get' style='display:inline;'>
                <input type='hidden' name='iduser' value='" . $row['iduser'] . "'>
                <button type='submit' class='btn-update'>Update</button>
            </form> | 
            <form action='deleteuser.php' method='get' style='display:inline;' onsubmit='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>
                <input type='hidden' name='iduser' value='" . $row['iduser'] . "'>
                <button type='submit' class='btn-delete'>Delete</button>
            </form>
          </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
}

// Query untuk menghitung jumlah total data
$total_sql = "SELECT COUNT(*) AS total FROM user";
$total_result = mysqli_query($conn, $total_sql);
$total_row = mysqli_fetch_assoc($total_result);
$total_data = $total_row['total'];
$total_pages = ceil($total_data / $limit);

// Navigasi pagination
echo "<br><div style='text-align:center;'>";
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='?page=$i' style='margin:5px; padding:5px 10px; border:1px solid #000; text-decoration:none;'>" . $i . "</a> ";
}
echo "</div>";

// Tutup koneksi
mysqli_close($conn);
?>

</div>



</body>
</html>
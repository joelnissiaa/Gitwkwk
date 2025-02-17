<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database_ukk";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

$sql = "SELECT * FROM siswa LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);

$total_sql = "SELECT COUNT(*) FROM siswa";
$total_result = mysqli_query($conn, $total_sql);
$total_rows = mysqli_fetch_array($total_result)[0];
$total_pages = ceil($total_rows / $limit);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PPLG</title>
    <link href="assets/img/rpl.png" rel="icon">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: rgb(32, 168, 206);
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .container {
            padding: 20px;
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
        .pagination {
            text-align: center;
            margin-top: 20px;
        }
        .pagination a {
            padding: 8px 12px;
            margin: 5px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .pagination a.active {
            background: rgb(32, 168, 206);
        }
        .back-button {
            background-color: white;
            color: rgb(32, 168, 206);
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            border: 2px solid rgb(32, 168, 206);
            font-weight: bold;
        }
        .back-button:hover {
            background-color: rgb(206, 104, 32);
            color: white;
        }
    </style>
</head>
<body>

<header>
    <h1><img src="assets/img/logo-new.png" style="width: 25px; height: 25px;" alt=""> Dashboard PPLG</h1>
    <nav>
        <a href="index.php" class="back-button">Kembali</a>
    </nav>
</header>

<div class="container mt-4">
    <h3 style='text-align: center;'>DATA SISWA SMK NEGERI 10 SEMARANG</h3>
    <table border="1">
        <tr><th>NIS</th><th>Nama Siswa</th><th>Alamat</th><th>Jenis Kelamin</th>Kelas<th></th><th>Tempat Tanggal Lahir</th><th>Foto</th></tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['nis'] ?></td>
                <td><?= $row['namasiswa'] ?></td>
                <td><?= $row['alamat'] ?></td>
                <td><?= $row['jeniskelamin'] ?></td>
                <td><?= $row['kelas'] ?></td>
                <td><?= $row['ttl'] ?></td>
                <td>
                    <?php if (!empty($row['foto'])) { ?>
                        <img src='assets/img/team/<?= $row['foto'] ?>' width='100'>
                    <?php } else { echo "No photo"; } ?>
                </td>
            </tr>
        <?php } ?>
    </table>

    <div class="pagination">
        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
            <a href="?page=<?= $i ?>" class="<?= ($page == $i) ? 'active' : '' ?>"> <?= $i ?> </a>
        <?php } ?>
    </div>
</div>

</body>
</html>

<?php mysqli_close($conn); ?>

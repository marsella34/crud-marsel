<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Siswa - SMK Kekinian</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #fcb045, #fd1d1d, #833ab4);
            color: #333;
            padding: 30px;
        }

        .container {
            background-color: white;
            max-width: 1000px;
            margin: auto;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            color: #222;
        }

        p {
            text-align: center;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .buttons {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            margin: 5px;
            padding: 10px 20px;
            background: #ff6b6b;
            color: white;
            text-decoration: none;
            border-radius: 30px;
            transition: 0.3s;
        }

        .btn:hover {
            background: #ff4757;
        }

        .btn-logout {
            background-color: #57606f;
        }

        .btn-logout:hover {
            background-color: #2f3542;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
        }

        th {
            background: #ff6b6b;
            color: white;
        }

        tr {
            background-color: #fdfdfd;
            transition: background 0.3s ease;
        }

        tr:nth-child(even) {
            background-color: #f0f0f0;
        }

        tr:hover {
            background-color: #ffeaa7;
        }

        .action-btn {
            display: inline-block;
            padding: 6px 12px;
            margin: 2px;
            font-size: 14px;
            color: white;
            border-radius: 20px;
            text-decoration: none;
            transition: 0.3s;
        }

        .edit {
            background-color: #00b894;
        }

        .edit:hover {
            background-color: #019875;
        }

        .delete {
            background-color: #d63031;
        }

        .delete:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Data Siswa SMK N 1 Wonosobo</h2>
        <p>Halo, <strong><?= $_SESSION['username']; ?></strong>! 👋</p>

        <div class="buttons">
            <a href="form_tambah.php" class="btn">+ Tambah Siswa</a>
            <a href="logout.php" class="btn btn-logout" onclick="return confirm('Yakin ingin logout?')">Logout</a>
        </div>

        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIS</th>
                <th>Alamat</th>
                <th>Opsi</th>
            </tr>
            <?php
            include 'koneksi.php';
            $no = 1;
            $data = mysqli_query($koneksi, "SELECT * FROM tb_siswa");
            while ($d = mysqli_fetch_array($data)) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $d['nama']; ?></td>
                <td><?= $d['nis']; ?></td>
                <td><?= $d['alamat']; ?></td>
                <td>
                    <a href="form_edit.php?id=<?= $d['id']; ?>" class="action-btn edit">Edit</a>
                    <a href="hapus.php?id=<?= $d['id']; ?>" class="action-btn delete" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>

<?php
session_start();
include 'koneksi.php';

// Periksa apakah pengguna sudah login sebagai user
if ($_SESSION['arole'] !== 'user') {
    header("Location: home.php");
    exit();
}

function showNavbarBasedOnRole()
{
    if (isset ($_SESSION['arole'])) {
        $role = $_SESSION['arole'];
        if ($role == 'admin') {
            // Tampilkan navbar untuk admin
            include 'Nav/NavAdmin.php';
        } elseif ($role == 'user') {
            include 'Nav/NavUser.php';
        } else {

            include 'Nav/NavUser.php';
        }
    } else {

        include 'Nav/NavUser.php';
    }
}

$user_id = $_SESSION['ulogin'];


$sql = "SELECT tanggal_transfer, jumlah_transfer, kategori_simpanan, status
        FROM pembayaran
        WHERE ID_User = '$user_id' 
        ORDER BY tanggal_transfer DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Pembayaran</title>
    <link rel="stylesheet" href="css/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css"
        rel="stylesheet">
</head>
<style>
    :root {
        --1: #1B2E3C;
        --2: #0C0C1E;
        --3: #4B0000;
        --4: #F3E3E2;

    }
</style>

<body style="background-color: var(--1); ">

    <!-- Navbar -->
    <?php showNavbarBasedOnRole(); ?>
    <!-- End Navbar -->

    <div class="container mt-5">
        <h2 class="mb-4 " style="margin-top: 80px; color: var(--4); ">History Pembayaran</h2>
        <table class="table table-success " style="border-2">
            <thead>
                <tr>
                    <th>Tanggal Transfer</th>
                    <th>Jumlah Transfer</th>
                    <th>Kategori Simpanan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["tanggal_transfer"] . "</td>";
                        echo "<td>" . $row["jumlah_transfer"] . "</td>";
                        echo "<td>" . $row["kategori_simpanan"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada histori pembayaran.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script src="js/script.js"></script>

</html>

<?php
mysqli_close($conn);
?>
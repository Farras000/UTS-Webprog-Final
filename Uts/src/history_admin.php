<?php
session_start();
include 'koneksi.php';

if ($_SESSION['arole'] !== 'admin') {
    header("Location: home.php");
    exit();
}


function showNavbarBasedOnRole()
{
    if (isset ($_SESSION['arole'])) {
        $role = $_SESSION['arole'];
        if ($role == 'admin') {
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
$sql = "SELECT users.ID_User, users.FullName, pembayaran.tanggal_transfer, pembayaran.jumlah_transfer, pembayaran.kategori_simpanan, pembayaran.status
        FROM users
        INNER JOIN pembayaran ON users.ID_User = pembayaran.ID_User
        ORDER BY pembayaran.tanggal_transfer DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin History</title>
    <link rel="stylesheet" href="css/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css"
        rel="stylesheet">
</head>

<body style=" background-color: var(--1); color:var(--4) ; ">
    <?php showNavbarBasedOnRole(); ?>
    <div class="container " style="margin-top: 85px; ">
        <h2 class="mb-4">Admin History</h2>
        <table class="table table-success ">
            <thead>
                <tr>
                    <th>ID User</th>
                    <th>Nama</th>
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
                        echo "<td>" . $row["ID_User"] . "</td>";
                        echo "<td>" . $row["FullName"] . "</td>";
                        echo "<td>" . $row["tanggal_transfer"] . "</td>";
                        echo "<td>" . $row["jumlah_transfer"] . "</td>";
                        echo "<td>" . $row["kategori_simpanan"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada histori pembayaran.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>

<?php
mysqli_close($conn);
?>
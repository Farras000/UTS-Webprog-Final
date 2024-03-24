<?php
session_start();
include 'koneksi.php';

if ($_SESSION['arole'] !== 'admin') {
    header("Location: home.php");
    exit();
}

if (isset ($_POST['accept']) || isset ($_POST['reject'])) {
    $ID_Pembayaran = $_POST['ID_Pembayaran'];
    $status = isset ($_POST['accept']) ? 'verified' : 'rejected';

    $sql = "UPDATE pembayaran SET status='$status' WHERE ID_Pembayaran='$ID_Pembayaran'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Status pembayaran berhasil diperbarui!');</script>";
    } else {
        echo "<script>alert('Gagal memperbarui status pembayaran.');</script>";
    }
}

$sql = "SELECT * FROM pembayaran WHERE status='pending'";
$result = mysqli_query($conn, $sql);
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unverified Payments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="css/home.css">
</head>

<body style="background-color: var(--1 ); color: var(--4); ">

    <?php showNavbarBasedOnRole(); ?>

    <div class="container " style="margin-top: 95px; ">
        <h2 class="text-center mb-4">Unverified Payments</h2>
        <div class="row">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="col-md-4">
                        <div class="card mt-3" style="background-color: var(--2);  color: var(--4);">
                            <div class="card-body">
                                <h5 class="card-title">ID Pembayaran:
                                    <?php echo $row["ID_Pembayaran"]; ?>
                                </h5>
                                <p class="card-text">ID User:
                                    <?php echo $row["ID_User"]; ?>
                                </p>
                                <p class="card-text">Tanggal Transfer:
                                    <?php echo $row["tanggal_transfer"]; ?>
                                </p>
                                <p class="card-text">Jumlah Transfer:
                                    <?php echo $row["jumlah_transfer"]; ?>
                                </p>
                                <p class="card-text">Kategori Simpanan:
                                    <?php echo $row["kategori_simpanan"]; ?>
                                </p>
                                <p class="card-text">Status:
                                    <?php echo $row["status"]; ?>
                                </p>
                                <form action="" method="post" class="d-inline">
                                    <input type="hidden" name="ID_Pembayaran" value="<?php echo $row["ID_Pembayaran"]; ?>">
                                    <button type="submit" name="accept" class="btn btn-success">Accept</button>
                                </form>
                                <form action="" method="post" class="d-inline">
                                    <input type="hidden" name="ID_Pembayaran" value="<?php echo $row["ID_Pembayaran"]; ?>">
                                    <button type="submit" name="reject" class="btn btn-danger ms-2">Reject</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='mt-3'>Tidak ada pembayaran yang belum diverifikasi.</p>";
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
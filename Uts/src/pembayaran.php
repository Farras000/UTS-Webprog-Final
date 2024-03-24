<?php
// Pastikan untuk memulai sesi sebelum menggunakan $_SESSION
session_start();

// Sisipkan file koneksi database Anda di sini
include 'koneksi.php';

// Cek apakah pengguna sudah login atau belum
if (!isset ($_SESSION['ulogin'])) {
    header("Location: loginpage.php");
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

if (isset ($_POST['submit_payment'])) {
    $kategori_simpanan = $_POST['kategori_simpanan'];
    $jumlah_transfer = $_POST['jumlah_transfer'];

    $bukti_transfer = file_get_contents($_FILES['bukti_transfer']['tmp_name']);

    $bukti_transfer_base64 = base64_encode($bukti_transfer);

    $user_id = $_SESSION['ulogin'];
    $status = "pending";

    $kategori_simpanan = mysqli_real_escape_string($conn, $kategori_simpanan);
    $jumlah_transfer = mysqli_real_escape_string($conn, $jumlah_transfer);
    $bukti_transfer_base64 = mysqli_real_escape_string($conn, $bukti_transfer_base64);

    $sql = "INSERT INTO pembayaran (ID_User, jumlah_transfer, kategori_simpanan, bukti_transfer, status) 
            VALUES ('$user_id', '$jumlah_transfer', '$kategori_simpanan', '$bukti_transfer_base64', '$status')";


    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Menunggu Verifikasi Admin');</script>";
    } else {
        echo "<script>alert('Gagal melakukan pembayaran. Silakan coba lagi.');</script>";
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pembayaran</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/home.css">
</head>

<body style="background-color: #1B2E3C; color: #F3E3E2;">

    <!-- Navbar -->
    <?php showNavbarBasedOnRole(); ?>
    <!-- End Navbar -->
    <section style="">
        <div class="card mx-auto" style="width: 400px; margin-top: 110px;background-color: var(--2)  ; color:var(--4) ">
            <div class="card-body">
                <h2 class="card-title text-center mt-3 mb-4">Form Pembayaran</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="kategori_simpanan" class="form-label">Kategori Simpanan:</label>
                        <select name="kategori_simpanan" id="kategori_simpanan" class="form-select" required>
                            <option value="Wajib">Wajib</option>
                            <option value="Sukarela">Sukarela</option>
                            <option value="Pokok">Pokok</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_transfer" class="form-label">Jumlah Transfer:</label>
                        <input type="number" id="jumlah_transfer" name="jumlah_transfer" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="bukti_transfer" class="form-label">Bukti Transfer:</label>
                        <input type="file" id="bukti_transfer" name="bukti_transfer" class="form-control" required>
                    </div>

                    <button type="submit" name="submit_payment" class="btn"
                        style="background-color:var(--4)  ; color: var(--1) ;  ">Bayar</button>
                </form>
            </div>
        </div>

    </section>

    <!-- All Js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
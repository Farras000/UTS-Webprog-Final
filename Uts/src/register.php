<?php
require 'koneksi.php';

// Memastikan sesi dimulai sebelum menggunakan $_SESSION
session_start();

// Memeriksa apakah captcha benar
if ($_POST['captcha'] != $_SESSION['captcha']) {
    die ('CAPTCHA Incorrect! <a href="javascript:history.back()">Back</a>');
}

if (isset ($_POST['submit'])) {
    $fullName = $_POST['fullName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];

    $fileName = $_FILES['fileToUpload']['name'];
    $fileTemp = $_FILES['fileToUpload']['tmp_name'];

    $uploadDir = "uploads/";
    $filePath = $uploadDir . $fileName;
    move_uploaded_file($fileTemp, $filePath);

    $sql = "INSERT INTO users (FullName, Username, Email, Password, Gender, Birthdate, RegistrationDate, BuktiPembayaran) 
            VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "sssssss", $fullName, $username, $email, $password, $gender, $birthdate, $fileName);

    if (mysqli_stmt_execute($stmt)) {
        header("location:index.php");
        echo '<script>alert("Registrasi berhasil!");</script>';
    } else {
        echo '<script>alert("Registrasi gagal!");</script>';
    }

    mysqli_stmt_close($stmt);
}
?>
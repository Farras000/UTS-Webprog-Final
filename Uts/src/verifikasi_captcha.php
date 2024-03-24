<?php
session_start();

if (isset ($_POST['fullName'], $_POST['email'], $_POST['password'], $_POST['confirmPassword'], $_POST['captcha'])) {
    // Verifikasi CAPTCHA
    if ($_POST['captcha'] == $_SESSION['captcha']) {

        echo "CAPTCHA verified. Registration successful!";
    } else {
        // CAPTCHA tidak cocok, tampilkan pesan kesalahan
        echo "Incorrect CAPTCHA. Please try again.";
    }
} else {
    // Data yang diperlukan tidak diberikan, tampilkan pesan kesalahan
    echo "All fields are required!";
}
?>
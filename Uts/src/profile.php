<?php

session_start();
include 'koneksi.php';


if (!isset ($_SESSION['ulogin'])) {
    header("Location: home.php");
    exit();
}

$user_id = $_SESSION['ulogin'];
$sql = "SELECT * FROM users WHERE ID_User = '$user_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


if (isset ($_POST['update_profile'])) {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $update_sql = "UPDATE users SET FullName='$fullName', Email='$email' WHERE ID_User='$user_id'";
    $update_result = mysqli_query($conn, $update_sql);
    if ($update_result) {
        echo "<script>alert('Profile updated successfully!');</script>";
        echo "<script>window.location.href='profile.php';</script>";
    } else {
        echo "<script>alert('Failed to update profile. Please try again.');</script>";
    }
}
if (isset ($_POST['change_password'])) {
    $oldPassword = md5($_POST['oldPassword']);
    $newPassword = md5($_POST['newPassword']);

    if ($oldPassword === $row['Password']) {

        $update_password_sql = "UPDATE users SET Password='$newPassword' WHERE ID_User='$user_id'";
        $update_password_result = mysqli_query($conn, $update_password_sql);
        if ($update_password_result) {
            echo "<script>alert('Password changed successfully!');</script>";
            echo "<script>window.location.href='profile.php';</script>";
        } else {
            echo "<script>alert('Failed to change password. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Old password is incorrect. Please try again.');</script>";
    }
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

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="css/home.css">
</head>

<body style="background-color: var(--1); ">
    <?php showNavbarBasedOnRole(); ?>
    <div class="card container " style="margin-top: 105px; background-color: var(--2) ; color:var(--4) ; ">
        <div class="card-body">
            <h2 class="card-title">Profile</h2>
            <div class="row mt-4">
                <div class="col-md-6">
                    <h4>Update Profile</h4>
                    <hr>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="fullName"
                                value="<?php echo $row['FullName']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?php echo $row['Email']; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary" name="update_profile">Update Profile</button>
                    </form>
                </div>

                <div class="col-md-6">
                    <h4>Change Password</h4>
                    <hr>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="oldPassword" class="form-label">Old Password</label>
                            <input type="password" class="form-control" id="oldPassword" name="oldPassword">
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword">
                        </div>
                        <button type="submit" class="btn btn-primary" name="change_password">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</html>
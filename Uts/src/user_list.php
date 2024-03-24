<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List - Admin</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css"
        rel="stylesheet">
</head>

<body style="background-color: var(--1); color: var(--4); ">
    <?php
    session_start();


    if (!isset ($_SESSION['arole']) || $_SESSION['arole'] !== 'admin') {

        header("Location: home.php");
        exit();
    }

    include 'koneksi.php';


    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

    if ($result === false) {
        echo "Error: " . mysqli_error($conn);
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

    ?>
    <?php showNavbarBasedOnRole(); ?>
    <div class="container " style=" margin-top: 85px;  ">
        <h1 class="mb-4">User List - Admin</h1>
        <table class="table table-success ">
            <thead>
                <tr>
                    <th>ID User</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Birthdate</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["ID_User"] . "</td>";
                        echo "<td>" . $row["FullName"] . "</td>";
                        echo "<td>" . $row["Username"] . "</td>";
                        echo "<td>" . $row["Email"] . "</td>";
                        echo "<td>" . $row["Gender"] . "</td>";
                        echo "<td>" . $row["Birthdate"] . "</td>";
                        echo "<td>
                                <form method='POST'>
                                    <input type='hidden' name='userID' value='" . $row["ID_User"] . "'>
                                    <button type='submit' name='delete' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</button>
                                </form>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
    if (isset ($_POST['delete'])) {
        $userID = $_POST['userID'];
        $deleteQuery = "DELETE FROM users WHERE ID_User = '$userID'";
        if (mysqli_query($conn, $deleteQuery)) {
            echo '<script>alert("User deleted successfully!");</script>';
            echo '<meta http-equiv="refresh" content="0">';
        } else {
            echo '<script>alert("Failed to delete user!");</script>';
        }
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
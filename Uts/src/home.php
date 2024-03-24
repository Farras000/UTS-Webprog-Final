<?php include 'login.php' ?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <!-- All CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="css/home.css">
</head>

<style>
    :root {
        --1: #1B2E3C;
        --2: #0C0C1E;
        --3: #4B0000;
        --4: #F3E3E2;

    }
</style>

<body style="background-color : var(--1); color: var(--4);">

    <?php

    include 'koneksi.php';



    function getTotalSimpanan($conn, $idUser, $jenisSimpanan)
    {
        $sql = "SELECT total_$jenisSimpanan FROM total_tabungan WHERE ID_User = '$idUser'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row["total_$jenisSimpanan"];
        } else {
            return 0.00;
        }
    }

    // Periksa role pengguna dan arahkan sesuai ke halaman yang sesuai
    if (!isset ($_SESSION['arole']) || ($_SESSION['arole'] !== 'user' && $_SESSION['arole'] !== 'admin')) {
        header("Location: home.php");
        exit();
    }

    if ($_SESSION['arole'] === 'admin' && isset ($_SESSION['alogin'])) {
        $userID = $_SESSION['alogin'];
    } else {
        $userID = $_SESSION['ulogin'];
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



    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>

        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/pexels-andrea-piacquadio-840996.jpg " class="d-block w-100 object-fit-cover " alt="...">
                <div class="carousel-caption  ">
                    <h5 style=" color: var(--4); ">APAKAH KAMU <br> INGIN MENABUNG</h5>
                    <p class>Koperasi kami menawarkan beragam produk dan layanan tabungan</p>
                    <p><a href="pembayaran.php" class="btn   mt-3"
                            style=" border: 1px solid var(--3); color: var(--3); background-color: var(--4) ;">Learn
                            More</a>
                    </p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/pexels-cowomen-2041627.jpg" class="d-block w-100 object-fit-cover " alt="...">
                <div class="carousel-caption">
                    <h5>INGIN TRANSFER <br> TANPA BIAYA ADMIN</h5>
                    <p>Nikmati kemudahan transfer tanpa biaya admin di koperasi kami</p>
                    <p><a href="pembayaran.php" class="btn   mt-3"
                            style=" border: 1px solid var(--3); color: var(--3); background-color: var(--4) ;">Learn
                            More</a>
                    </p>
                </div>
            </div>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>



    <section class="services section-padding" id="services">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-5">
                        <h2 class="text-start mb-5">Informasi Simpanan</h2>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-center pb-2" style="background-color:var(--2) ; color:var(--4) ; ">
                        <div class="card-body">
                            <i class="bi bi-wallet2"></i>
                            <h3 class="card-title">Wajib</h3>
                            <hr>
                            <p class="lead">Rp
                                <?php echo number_format(getTotalSimpanan($conn, $userID, 'wajib'), 2); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-center pb-2" style="background-color:var(--2) ; color:var(--4) ; ">
                        <div class="card-body">
                            <i class="bi bi-cash-coin"></i>
                            <h3 class="card-title">Pokok</h3>
                            <hr>
                            <p class="lead">Rp
                                <?php echo number_format(getTotalSimpanan($conn, $userID, 'pokok'), 2); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-center pb-2" style="background-color:var(--2) ; color:var(--4) ;  ">
                        <div class="card-body">
                            <i class="bi bi-wallet"></i>
                            <h3 class="card-title">Sukarela</h3>
                            <hr>
                            <p class="lead">Rp
                                <?php echo number_format(getTotalSimpanan($conn, $userID, 'sukarela'), 2); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <footer class="text-center text-lg-start " style="background-color: #1c2331">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-between p-4" style="background-color: #6351ce">

        </section>

        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold">PT Damen Sejahtera</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>
                            Koperasi kami berkomitmen memberikan kualitas terbaik.
                        </p>
                    </div>

                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4 ">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Contact</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px" />

                        <p><i class="fas fa-envelope mr-3"></i> ase@gmail.com</p>
                        <p><i class="fas fa-phone mr-3"></i> +62 812-2166-6690</p>

                    </div>
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4 ">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Alamat</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p><i class="fas fa-home mr-3"></i> Jalan Scientia Boulevard Gading, Curug Sangereng, Serpong,
                            Kabupaten Tangerang, Banten 15810</p>


                    </div>

                </div>

            </div>
        </section>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2020 Copyright:
            <a class="" style="">Damen.com</a>
        </div>

    </footer>
    <script>
        function openInstagram(url) {
            window.location.href = url;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>




<!--for getting the form download the code from download button-->
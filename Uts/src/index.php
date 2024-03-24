<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webleb</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="css/index.css">
</head>

<body style="display:flex; align-items:center; justify-content:center;">


    <div class="login-page">

        <div class="form" style="background-color: var(--2);">

            <form class="register" action="register.php" method="POST" enctype="multipart/form-data">
                <h2 style="color: var(--4);"><i class=""></i> Register</h2>
                <div class="pt-4">
                    <input id="input" type="text" name="fullName" placeholder="Full Name *" required />
                    <input id="input" type="text" name="username" placeholder="Username *" required />
                    <input id="input" type="email" name="email" placeholder="Email *" required />
                    <input id="input" type="password" name="password" placeholder="Password *" required />
                    <input id="input" type="password" name="confirmPassword" placeholder="Confirm Password *"
                        required />
                    <select id="input" name="gender" class="form-select" aria-label="Default select example">
                        <option selected>Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Emaile">Emaile</option>
                        <option value="Mechanic">Mechanic</option>
                        <option value="Croissant">Croissant</option>
                    </select>
                    <input id="input" type="date" name="birthdate" required />
                    <p style="color: var(--4) ">Bukti Pembayaran</p>
                    <input id="input" type="file" name="fileToUpload" id="fileToUpload" placeholder="Bukti Pembayaran"
                        required />
                    <p style="color: var(--4) ">CAPTCHA</p>
                    <img src="captcha.php" alt="CAPTCHA"><br><br>
                    <input id="input" type="text" name="captcha" placeholder="Enter CAPTCHA" required />

                    <button type="submit" name="submit">Register</button>
                    <p class="message">Already registered? <a href="loginpage.php">Sign In</a></p>
                </div>
            </form>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="main.js"></script>
</body>

</html>
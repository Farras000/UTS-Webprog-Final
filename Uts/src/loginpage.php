<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>

<body style="display:flex; align-items:center; justify-content:center;">
    <div class="login-page">
        <div class="form" style="background-color: var(--2);">
            <form class="login-form" action="login.php" method="POST">
                <h2 style="color: var(--4);"><i class=""></i> Login</h2>
                <div class="pt-4">
                    <input id="input" type="email" name="email" placeholder="Email" required />
                    <input id="input" type="password" name="password" placeholder="Password" required />
                    <button type="submit" name="signin" class="btn btn-primary">Login</button>
                    <p class="message">Not registered? <a href="index.php">Create an account</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="main.js"></script>
</body>

</html>
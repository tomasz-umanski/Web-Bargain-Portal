<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="/public/styles/style.css">
    <link rel="stylesheet" type="text/css" href="/public/styles/authentication.css">
    <title>Sign in</title>
</head>
<body>
    <div class="container"> 
        <div class="form-box">
            <header>Sign in</header>
            <div class="links">
                <div>If you don’t have an account</div>
                <div>You can <a href="signUp">Register here!</a></div>
            </div>
            <form action="signIn" method="Post">
                <div class="form-inputs">
                    <input class="form-input" type="username" name="email" id="email" placeholder="Enter e-mail or username">
                    <div class="form-password-input">
                        <input class="form-input" type="password" name="password" id="password" placeholder="Password">
                        <span class="password-toggle"><i name="password_toggle" class="bi bi-eye-slash-fill"></i></span>
                    </div>
                    <?php require('partials/validations.php') ?>
                    <input class="form-input button" type="submit" name="submit" value="Sign in">
                </div>
            </form>
        </div>
    </div>
</body>
    <script type="text/javascript" src="/public/scripts/authentication.js" defer></script>
</html>
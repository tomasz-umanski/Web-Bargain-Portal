<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="/public/styles/style.css">
    <link rel="stylesheet" type="text/css" href="/public/styles/auth.css">
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
            <form action="login" method="Post">
                <div class="form-inputs">
                    <div>
                        <div class="error"><?=$validations['username']?></div>
                        <input class="form-input" type="username" name="username" id="username" placeholder="Enter e-mail or username"
                            value = "<?=old('username')?>"
                        >
                    </div>
                    <div>
                        <div class="error"><?=$validations['password']?></div>
                        <div class="form-password-input">
                            <input class="form-input" type="password" name="password" id="password" placeholder="Password"
                            value = "<?=old('password')?>"
                            >
                            <span class="password-toggle"><i name="password_toggle" class="bi bi-eye-slash-fill"></i></span>
                        </div>
                    </div>
                    <?php require('partials/validations.php') ?>
                    <input class="form-input button" type="submit" class="" name="submit_button" value="Login">
                </div>
            </form>
        </div>
    </div>
    <?php require('partials/loader.php') ?>
</body>
    <script type="text/javascript" src="/public/scripts/auth.js" defer></script>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="/public/styles/style.css">
    <link rel="stylesheet" type="text/css" href="/public/styles/auth.css">
    <title>Sign up</title>
</head>
<body>
    <div class="container"> 
        <div class="box form-box">
            <header>Sign up</header>
            <div class="links">
                <div>If you already have an account</div>
                <div>You can <a href="signIn">Login here!</a></div>
            </div>
            <form action="register" method="post">
                <div class="form-inputs">
                    <div>
                        <div class="error"><?=$validations['email']?></div>
                        <input class="form-input" type="username" name="email" id="email" placeholder="Enter e-mail"
                        value = "<?=old('email')?>"
                        >
                    </div>
                    <div>
                        <div class="error"><?=$validations['username']?></div>
                        <input class="form-input" type="username" name="username" id="username" placeholder="Enter username"
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
                    <div>
                        <div class="error"><?=$validations['confirmPassword']?></div>
                        <div class="form-password-input">
                            <input class="form-input" type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password"
                            value = "<?=old('confirmPassword')?>"
                            >
                            <span class="password-toggle"><i name="confirm_password_toggle" class="bi bi-eye-slash-fill"></i></span>
                        </div>
                    </div>
                    <?php require('partials/validations.php') ?>
                    <input class="form-input button" type="submit" class="" name="submit_button" value="Register">
                </div>
            </form>
        </div>
    </div>
    <?php require('partials/loader.php') ?>
</body>
    <script type="text/javascript" src="/public/scripts/auth.js" defer></script>
</html>
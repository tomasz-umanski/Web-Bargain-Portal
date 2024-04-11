<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="/public/styles/style.css">
    <link rel="stylesheet" type="text/css" href="/public/styles/favourites.css">
    <title><?= $categoryDetails['title'] ?></title>
</head>
<body>
    <div class="container">
        <?php require('partials/navbar.php') ?>
        <div class="favourites-header">
            <span class="favourites-label">
                <?= $categoryDetails['title'] ?>
            </span>
        </div>
        <div class="content">
            <?php require('partials/content-items.php') ?>
        </div>
        <?php require('partials/footer.php') ?>
    </div>
    <script type="text/javascript" src="/public/scripts/main.js" defer></script>
</body>
</html>
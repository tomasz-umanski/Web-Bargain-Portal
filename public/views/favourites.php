<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="/public/styles/style.css">
    <link rel="stylesheet" type="text/css" href="/public/styles/favourites.css">
    <title>Favourites</title>
</head>
<body>
    <div class="container">
        <?php require('partials/navbar.php') ?>
        <div class="favourites-header">
            <span class="favourites-label">
                Favourites
            </span>
        </div>
        <div class="content">
            <?php require('partials/content-items.php') ?>
        </div>
        <footer>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus autem reiciendis repellat error, illum recusandae? Molestias, dicta debitis minus eum, veritatis iste suscipit cumque esse corporis omnis tenetur delectus praesentium.
        </footer>
    </div>
    <script type="text/javascript" src="/public/scripts/main.js" defer></script>
</body>
</html>
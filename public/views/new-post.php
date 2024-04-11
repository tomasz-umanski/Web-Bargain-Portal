<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="/public/styles/style.css">
    <link rel="stylesheet" type="text/css" href="/public/styles/new-post.css">
    <title>New post</title>
</head>
<body>
    <div class="container">
        <?php require('partials/navbar.php') ?>
        <div class="content">
            <div class="form-box">
                <form action="" method="post">
                    <div class="form-input">
                        <label for="url">
                            <span class="label-name">URL</span>
                            <span class="label-tag">(mandatory)</span>
                        </label>
                        <input type="url" id="url" name="url" required>
                    </div>
                    <div class="form-input">
                        <label for="title">
                            <span class="label-name">Title</span>
                            <span class="label-tag">(mandatory)</span>
                        </label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    <div class="horizontal">
                        <div class="form-input">
                            <label for="price">
                                <span class="label-name">Price</span>
                                <span class="label-tag">(mandatory)</span>
                            </label>
                            <input type="number" id="price" name="price" required>
                        </div>
                        <div class="form-input">
                            <label for="old_price">
                                <span class="label-name">Old price</span>
                                <span class="label-tag">(mandatory)</span>
                            </label>
                            <input type="number" id="old-price" name="old-price" required>
                        </div>
                    </div>
                    <div class="horizontal">
                        <div class="form-input">
                            <label for="delivery-price">
                                <span class="label-name">Delivery price</span>
                                <span class="label-tag">(mandatory)</span>
                            </label>
                            <input type="number" id="delivery-price" name="delivery-price" required>
                        </div>
                        <div class="form-input">
                            <label for="end-date">
                                <span class="label-name">End date</span>
                                <span class="label-tag">(mandatory)</span>
                            </label>
                            <input type="date" id="end-date" name="end-date" required>
                        </div>
                    </div>
                    <div class="form-input">
                        <label for="description">
                            <span class="label-name">Description</span>
                            <span class="label-tag">(mandatory)</span>
                        </label>
                        <textarea type="text" id="description" name="description" required></textarea>
                    </div>
                    <div class="form-photo-input">
                        <label for="photo"><i class="bi bi-upload"></i> Upload Photo</label>
                        <input type="file" id="photo" name="photo" accept="image/*,.jpg">
                    </div>
                
                    <input type="submit" class="button" value="Post offer">
                </form>
            </div>
        </div>
        <footer>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus autem reiciendis repellat error, illum recusandae? Molestias, dicta debitis minus eum, veritatis iste suscipit cumque esse corporis omnis tenetur delectus praesentium.
        </footer>
    </div>
</body>
<script type="text/javascript" src="/public/scripts/main.js" defer></script>
</html>
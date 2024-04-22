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
                <form action="createPost" method="post" ENCTYPE="multipart/form-data">
                    <div class="form-input">
                        <label for="url">
                            <span class="label-name">URL</span>
                            <span class="label-tag">(mandatory)</span>
                        </label>
                        <input type="input" id="url" name="url"
                        value = "<?=old('url')?>"
                        >
                        <div class="error"><?=$validations['url']?></div>
                    </div>
                    <div class="horizontal">
                        <div class="form-input">
                            <label for="title">
                                <span class="label-name">Title</span>
                                <span class="label-tag">(mandatory)</span>
                            </label>
                            <input type="text" id="title" name="title"
                            value = "<?=old('title')?>"
                            >
                            <div class="error"><?=$validations['title']?></div>
                        </div>
                        <div class="form-input">
                            <label for="category">
                                <span class="label-name">Category</span>
                                <span class="label-tag">(mandatory)</span>
                            </label>
                            <input type="text" id="category" name="category"
                            value = "<?=old('category')?>"
                            >
                            <div class="error"><?=$validations['category']?></div>
                        </div>
                    </div>

                    <div class="horizontal">
                        <div class="form-input">
                            <label for="price">
                                <span class="label-name">Price</span>
                                <span class="label-tag">(mandatory)</span>
                            </label>
                            <input type="text" id="price" name="price" placeholder='0.00'
                            value = "<?=old('price')?>"
                            >
                            <div class="error"><?=$validations['price']?></div>
                        </div>
                        <div class="form-input">
                            <label for="old_price">
                                <span class="label-name">Old price</span>
                                <span class="label-tag">(mandatory)</span>
                            </label>
                            <input type="text" id="old-price" name="old-price" placeholder='0.00'
                            value = "<?=old('oldPrice')?>"
                            >
                            <div class="error"><?=$validations['oldPrice']?></div>
                        </div>
                    </div>
                    <div class="horizontal">
                        <div class="form-input">
                            <label for="delivery-price">
                                <span class="label-name">Delivery price</span>
                                <span class="label-tag">(mandatory)</span>
                            </label>
                            <input type="text" id="delivery-price" name="delivery-price" placeholder='0.00'
                            value = "<?=old('deliveryPrice')?>"
                            >
                            <div class="error"><?=$validations['deliveryPrice']?></div>
                        </div>
                        <div class="form-input">
                            <label for="end-date">
                                <span class="label-name">End date</span>
                                <span class="label-tag">(mandatory)</span>
                            </label>
                            <input type="datetime-local" id="end-date" name="end-date"
                            value = "<?=old('endDate')?>"
                            >
                            <div class="error"><?=$validations['endDate']?></div>
                        </div>
                    </div>
                    <div class="form-input">
                        <label for="description">
                            <span class="label-name">Description</span>
                            <span class="label-tag">(mandatory)</span>
                        </label>
                        <textarea type="text" id="description" name="description"><?=old('description')?></textarea>
                        <div class="error"><?=$validations['description']?></div>
                    </div>
                    <div class="form-photo-input">
                        <label for="photo"><i class="bi bi-upload"></i> <span>Upload Photo</span> </label>
                        <input type="file" id="photo" name="file" accept="image/*">
                    </div>
                    <div class="error"><?=$validations['file']?></div>
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
<script type="text/javascript" src="/public/scripts/fileUpload.js" defer></script>
</html>
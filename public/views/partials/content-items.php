<div class="content-items">
    <?php foreach ($posts as $post) : ?>
        <div class="content-item">
            <div class="content-item-grid">
                <div class="content-image">
                    <img src="/public/assets/images/<?= $post->getImageUrl(); ?>" alt="item image">
                </div>
                <div class="content-user-data">
                    <span><i class="bi bi-person-circle"></i></span>
                    <p class="content-user-data-username"><?= $post->getCreatedBy();?></p>
                    <p class="content-spacer"> - </p>
                    <?php
                    $creationDateString = $post->getCreationDate();

                    $creationDate = new DateTime($creationDateString);

                    $currentDate = new DateTime();

                    $interval = $creationDate->diff($currentDate);

                    $totalHours = $interval->days * 24 + $interval->h;

                    if ($interval->days > 0) {
                        echo "<p class='content-user-data-upload-date'>$interval->days d $interval->h h</p>";
                    } else {
                        echo "<p class='content-user-data-upload-date'>$totalHours h</p>";
                    }
                    ?>
                    <?php
                    $endDateString = $post->getEndDate();

                    $endDate = new DateTime($endDateString);

                    $currentDate = new DateTime();

                    $interval = $currentDate->diff($endDate);

                    $totalHours = $interval->days * 24 + $interval->h;

                    if ($interval->days > 0) {
                        echo "<p class='content-user-data-end-date'>$interval->days d $interval->h h</p>";
                    } else {
                        echo "<p class='content-user-data-end-date'>$totalHours h</p>";
                    }
                    ?>
                </div>
                <div class="content-item-data">
                    <div class="content-item-title">
                        <?= $post->getTitle(); ?>
                    </div>
                    <div class="content-item-price">
                        <span class="content-current-price"><?= $post->getNewPrice(); ?>zł</span>
                        <span class="content-old-price"><?= $post->getOldPrice(); ?>zł</span>
                        <div class="content-item-delivery-price">
                            <span><i class="bi bi-truck"></i></span>
                            <span>
                                <?php 
                                    if ($post->getDeliveryPrice() == 0) {
                                        echo "Free delivery";
                                    } else {
                                        echo $post->getDeliveryPrice() . " zł";
                                    }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="content-item-description">
                    <?= $post->getDescription(); ?>
                </div>
                <div class="content-item-actions">
                    <button class="content-button content-like">
                        <span><i class="bi bi-heart"></i></span>
                        <p> <?= $post->getLikesCount(); ?> </p>
                    </button>
                    <button class="content-button content-favourites">
                        <span><i class="bi bi-star"></i></span>
                    </button>
                    <a class="content-button content-catchdeal" href="<?= $post->getOfferUrl(); ?>">
                        Catch the deal
                        <span><i class="bi bi-link"></i></span>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<template id='post_template'>
    <div class="content-item">
        <div class="content-item-grid">
            <div class="content-image">
                <img src="/public/assets/images/url" alt="item image">
            </div>
            <div class="content-user-data">
                <span><i class="bi bi-person-circle"></i></span>
                <p class="content-user-data-username">UserName</p>
                <p class="content-spacer"> - </p>
            </div>
            <div class="content-item-data">
                <div class="content-item-title">
                    Title
                </div>
                <div class="content-item-price">
                    <span class="content-current-price">123zł</span>
                    <span class="content-old-price">321zł</span>
                    <div class="content-item-delivery-price">
                        <span><i class="bi bi-truck"></i></span>
                        <span>
                            10zł
                        </span>
                    </div>
                </div>
            </div>
            <div class="content-item-description">
                Description
            </div>
            <div class="content-item-actions">
                <button class="content-button content-like">
                    <span><i class="bi bi-heart"></i></span>
                    <p> 125 </p>
                </button>
                <button class="content-button content-favourites">
                    <span><i class="bi bi-star"></i></span>
                </button>
                <a class="content-button content-catchdeal" href="#">
                    Catch the deal
                    <span><i class="bi bi-link"></i></span>
                </a>
            </div>
        </div>
    </div>                          
</template>
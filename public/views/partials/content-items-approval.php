<?php if (empty($posts)) : ?>
        <div class="content not-found">
            <span>No posts for approval...</span>
        </div>
<?php else : ?>
    <div class="content-items">
        <?php foreach ($posts as $post) : ?>
            <div class="content-item" id="<?= $post->getId(); ?>" data-last-updated="<?= $post->getLastUpdated() ?>">
                <div class="content-item-grid">
                    <div class="content-image">
                        <div class="crop">
                            <img src="/public/uploads/<?= $post->getImageUrl(); ?>" alt="item image">
                        </div>
                    </div>
                    <div class="content-item-wrapper">
                        <div class="content-user-data">
                            <span><i class="bi bi-person-circle"></i></span>
                            <p class="content-user-data-username"><?= $post->getUserName();?></p>
                            <p class="content-spacer"> - </p>
                            <p class="content-user-data-upload-date"> <?= $post->getCreationDateDiff() ?> </p>
                            <div class="content-time-left">
                                <span><i class="bi bi-hourglass-split"></i></span>
                                <p class="content-user-data-end-date"> <?= $post->getEndDateDiff() ?> </p>
                            </div>
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
                                        <?= $post->getDeliveryPrice() ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-item-description">
                        <?= $post->getDescription(); ?>
                    </div>
                    <div class="content-item-actions">
                        <a class="content-button content-catchdeal" target="_blank" href="<?= $post->getOfferUrl(); ?>">
                            Catch the deal
                            <span><i class="bi bi-link"></i></span>
                        </a>
                    </div>
                </div>
                <div class="content-item-buttons">
                    <button class="content-button approve-post">
                        Approve
                    </button>
                    <button class="content-button reject-post">
                        Reject
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

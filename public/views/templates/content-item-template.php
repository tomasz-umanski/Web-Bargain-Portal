<template id='post_template'>
    <div class="content-item" id="">
        <div class="content-item-grid">
            <div class="content-image">
                <div class="crop">
                    <img src="/public/uploads/" alt="item image">
                </div>
            </div>
            <div class="content-item-wrapper">
                <div class="content-user-data">
                    <span><i class="bi bi-person-circle"></i></span>
                    <p class="content-user-data-username">Username</p>
                    <p class="content-spacer"> - </p>
                    <p class="content-user-data-upload-date"> UploadDateDiff </p>
                    <div class="content-time-left">
                        <span><i class="bi bi-hourglass-split"></i></span>
                        <p class="content-user-data-end-date"> EndDateDiff </p>
                    </div>
                </div>
                <div class="content-item-data">
                    <div class="content-item-title">
                        Title
                    </div>
                    <div class="content-item-price">
                        <span class="content-current-price">100zł</span>
                        <span class="content-old-price">200zł</span>
                        <div class="content-item-delivery-price">
                            <span><i class="bi bi-truck"></i></span>
                            <span>
                                10
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-item-description">
                Description
            </div>
            <div class="content-item-actions">
                <button class="content-button content-like">
                    <span><i class="bi bi-heart"></i></span>
                    <p> 20 </p>
                </button>
                <button class="content-button content-favourite">
                    <span><i class="bi bi-star"></i></span>
                </button>
                <a class="content-button content-catchdeal" target="_blank" href="">
                    Catch the deal
                    <span><i class="bi bi-link"></i></span>
                </a>
            </div>
        </div>
    </div>
</template>
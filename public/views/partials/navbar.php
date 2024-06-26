<nav id="navbar" class="navbar">
    <div class="navbar-container">
        <div class="navbar-section section-left">
            <a class="navbar-button" href="/" name="home">
                <span class="navbar-icon"><i class="bi bi-house"></i></span>
                <span class="navbar-label">Home</span>
            </a>
            <div class="dropdown">
                <a class="navbar-button" name="categories" onclick="toggleDropdown('categories')">
                    <span class="navbar-icon"><i class="bi bi-columns-gap"></i></span>
                    <span class="navbar-label">Categories</span>
                </a>
                <div id="categories_dropdown" class="dropdown-content">
                    <?php foreach ($categories as $category) : ?>
                        <a href="/category/<?= $category->getUrl() ?>" class="dropdown-link"> 
                            <span class="dropdown-icon"><i class="<?= $category->getIcon() ?>"></i></span>
                            <span><?= $category->getName() ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <a id="search_button" class="search-button" name="search" onclick="toggleSearchBar()">
                <input id="search_input" type="text" class="search-input" placeholder="Search">
                <span class="navbar-icon"><i class="bi bi-search"></i></span>
                <span class="search-clear-icon"><i class="bi bi-x-lg" onclick="clearSearchBarInput()"></i></span>
            </a>
        </div>
        <div class="navbar-section section-rigth">
            <a class="navbar-button" href=/favourites name="favourites">
                <span class="navbar-icon"><i class="bi bi-star"></i></span>
                <span class="navbar-label">Favourites</span>
            </a>
            <a class="navbar-button" href="/newPost" name="new-post">
                <span class="navbar-icon"><i class="bi bi-plus-circle"></i></span>
                <span class="navbar-label">New post</span>
            </a>
            <?php
                $userLoggedIn = userSessionExists();
                if ($userLoggedIn) {
                    $accountLabel = "Account"; 
                } else {
                    $accountLabel = "Sign In"; 
                }
            ?>
            <div class="dropdown">
                <a class="navbar-button" <?= (!$userLoggedIn) ? 'href="/signIn"' : '' ?> name="account" <?= $userLoggedIn ? 'onclick="toggleDropdown(\'account\')"': '' ?>>
                    <span class="navbar-icon"><i class="bi bi-person"></i></span>
                    <span class="navbar-label"><?= $accountLabel ?></span>
                </a>
                <?php if ($userLoggedIn) : ?>
                    <div id="account_dropdown" class="dropdown-content account-dropdown">
                        <span class="user-account-details"><?= getFromSession('user')['username'] ?></span>
                        <?php if (getFromSession('user')['role'] == 'admin') : ?>
                            <a href="/adminApproval" class="dropdown-link"> 
                                <span>Admin approval</span>
                            </a>
                        <?php endif; ?>
                        <form action="/logout" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="dropdown-link">Log out</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<script type="text/javascript" src="/public/scripts/search.js" defer></script>
<script type="text/javascript" src="/public/scripts/statistics.js" defer></script>

<?php require('public/views/templates/content-item-template.php') ?>
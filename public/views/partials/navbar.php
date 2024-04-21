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
            ?>
            <div class="dropdown">
                <a class="navbar-button" <?php if (!$userLoggedIn) : ?> href="<?= '/signIn' ?>" <?php endif; ?> name="account" <?= $userLoggedIn ? 'onclick="toggleDropdown(\'account\')"': '' ?>>
                    <span class="navbar-icon"><i class="bi bi-person"></i></span>
                    <span class="navbar-label">Account</span>
                </a>
                <?php if ($userLoggedIn) : ?>
                    <div id="account_dropdown" class="dropdown-content account-dropdown">
                        <form action="/logout" method="POST">
                            <input type="hidden" name = "_method" value = "DELETE">
                            <button class="dropdown-link"> Log out </button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<script type="text/javascript" src="/public/scripts/search.js" defer></script>
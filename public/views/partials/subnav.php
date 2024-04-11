<div class="subnav">
    <div class="subnav-container">
        <div class="dropdown">
            <button class="subnav-button" name="subnavDropdown" onclick="toggleDropdown('subnav')">
                <span class="subnav-label"><?= $subnavContent['selectedOptionName']?></span>
                <span class="subnav-icon"><i class="bi bi-caret-down-fill"></i></span>
            </button>
            <div id="subnav_dropdown" class="dropdown-content">
                <?php foreach ($subnavContent['options'] as $sub) : ?>
                    <a href="<?= $sub['url']?>" class="dropdown-link"> 
                        <span><?= $sub['name']?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
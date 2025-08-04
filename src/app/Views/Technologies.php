<div class="technologies-block">
    <div class="image-container wave curve">
        <h1>Technologies</h1>
    </div>
    <div class="technologies-container">
        <?php foreach($arrayTech as $key => $value):?>
        <div class="technologies-card">
            <div class="technology-category">
                <h2><?= htmlspecialchars($key) ?></h2>
            </div>
            <div class="technology-types">
                <?php foreach($value as $tech): ?>
                    <div class="technology-item">
                        <i class="<?= htmlspecialchars($tech['boxicon']) ?>"></i>
                        <span><?= htmlspecialchars($tech['technology_name']) ?></span>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
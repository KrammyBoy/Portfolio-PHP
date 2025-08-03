<?php 
declare(strict_types= 1);

?>
<div class="experience-page">
    <h1>Experience</h1>
    <div class="experience-block">
        <div class="timeline-line"></div>
        <?php foreach($experiences as $experience): ?>
        <div class="timeline-item-block">
            <div class="timeline-dot"></div>
            <div class="timeline-content-block">
                <h3 class="degree-block"><?= htmlspecialchars($experience['experience_degree'])?></h3>
                <div class="school-block"><?= htmlspecialchars($experience['school'])?></div>
                <?php 
                    $start_date = new DateTime($experience['start_date']);
                    $end_date = new DateTime($experience['end_date']);
                ?>
                <span class="duration-block"><?= htmlspecialchars($start_date->format('M Y'))?> - <?= htmlspecialchars($end_date->format('M Y'))?></span>
                <p class="description-block">
                    <?= htmlspecialchars($experience['experience_description'])?>
                </p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
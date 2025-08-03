<?php 
declare(strict_types= 1);

use App\Models\ProjectTechnologies;
use App\Enums\StatusName;

?>
    <div class="home">
        <div class="image-container wave curve">
            <img src="image.jpg" alt="Profile Picture" class="profile-image"/>
        </div>
        <div class="project">
            <h1>Projects</h1>
            <div class="projects-container">
                <!-- Project 1 -->
                <?php foreach($projects as $project):?>
                <div class="projectEach">
                    <div class="project-image">
                        <?php if (!empty($project['image'])): ?>
                            <img src="<?= htmlspecialchars($project['image']) ?>" alt="<?= htmlspecialchars($project['image']) ?>"/>
                        <?php endif; ?>
                    </div>
                    <div class="project-content">
                        <h3><?= htmlspecialchars($project['title'])?></h3>
                        <p><?= htmlspecialchars($project['description']) ?></p>
                        <div class="action-buttons">
                            <?php if(!empty($project['live_url'])): ?>
                                <a href="<?= htmlspecialchars($project['live_url'])?>" target="_blank"><i class='bx bx-send' data-tooltip="Link"></i></a>
                            <?php endif; ?>
                            <?php if(!empty($project['repo_url'])): ?>
                                <a href="<?= htmlspecialchars($project['repo_url'])?>" target="_blank"><i class='bxl bx-github' data-tooltip="Github"></i></a>
                            <?php endif; ?>                              
                        </div>                        
                        <div class="moreInfo">
                            <div class="technologies">
                                <?php 
                                    $projectTechnologies = (new ProjectTechnologies())->getById($project['id']);

                                    foreach ($projectTechnologies as $tech): 
                                ?>

                                    <i class='<?= htmlspecialchars($tech['boxicon'])?>'><span><?= htmlspecialchars($tech['technology_name'])?></span></i>
                                <?php endforeach; ?>
                            </div>
                            <div class="status">
                                <div class="status-circle <?= StatusName::getStatusName($project['status_id'])->value?>"></div>
                                <span>
                                    <?= ucfirst( StatusName::getStatusName($project['status_id'])->value) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="experience">
            <h1>Experience</h1>
            <div class="experience-container">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3 class="degree"><?= htmlspecialchars($experience['experience_degree'])?></h3>
                        <div class="school"><?= htmlspecialchars($experience['school'])?></div>
                        <?php 
                            $start_date = new DateTime($experience['start_date']);
                            $end_date = new DateTime($experience['end_date']);
                        ?>
                        <span class="duration"><?= htmlspecialchars($start_date->format('M Y'))?> - <?= htmlspecialchars($end_date->format('M Y'))?></span>
                        <p class="description">
                            <?= htmlspecialchars($experience['experience_description'])?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
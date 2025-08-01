<?php 
declare(strict_types= 1);

use App\Models\Projects;
use App\Models\ProjectTechnologies;

$projects = (new Projects())->getProjects();
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
                                <div class="status-circle"></div>
                                <span>
                                    <?= match($project['status_id']) {
                                        1 => 'Completed',
                                        2 => 'In Progress',
                                        3 => 'Abandoned',
                                        default => 'Unknown'
                                    } ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

                <!-- Project 2 -->
                <div class="projectEach">
                    <div class="project-image"></div>
                    <div class="project-content">
                        <h3>Task Management App</h3>
                        <p>A collaborative task management application with real-time updates, drag-and-drop functionality, and team collaboration features. Built with modern web technologies for enhanced productivity.</p>
                        <div class="moreInfo">
                            <div class="action-buttons">
                                <i class='bx bx-send'></i>
                                <i class='bxl bx-github'></i>
                            </div>
                            <div class="technologies">
                                <i class='bxl bx-javascript'></i>
                                <i class='bxl bx-html5'></i>
                                <i class='bxl bx-css3'></i>
                            </div>
                            <div class="status">
                                <div class="status-circle"></div>
                                <span>Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="experience">
            <h1>Experience</h1>
            <div class="experience-container">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3 class="degree">Bachelor of Science in Computer Science</h3>
                        <div class="school">University of Cebu - Main</div>
                        <span class="duration">2021 - 2025</span>
                        <p class="description">
                            Completed a comprehensive computer science program with focus on software development, algorithms, and data structures. Gained hands-on experience in multiple programming languages including Java, Python, and JavaScript. Participated in various coding competitions and collaborative projects that enhanced problem-solving and teamwork skills.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
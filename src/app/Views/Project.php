<?php 

declare(strict_types= 1);

use App\Models\Projects;
use App\Models\ProjectTechnologies;
use App\Enums\StatusName;

$projectInformation = (new Projects())->getGroupedStatusCount(); 

?>
<div class="projects">
  <div class="image-container wave curve">
    <h1>Projects</h1>
  </div>
  <div class="project-overview">
    <div class="project-status">PROJECT STATUS | FILTER</div>
    <div class="stats-row">
      <div class="stat-item selected" 
      data-status-id="0"
      onclick="filterProjects(0, this)">
        <span class="stat-number"><?= $projectInformation['Total']?></span>
        <span class="stat-label">Total</span>
      </div>
      <div class="stat-item total" 
      data-status-id="1"
      onclick="filterProjects(1, this)">
        <span class="stat-number"><?= $projectInformation['Completed']?></span>
        <span class="stat-label">Completed</span>
      </div>
      <div class="stat-item total" 
      data-status-id="2"
      onclick="filterProjects(2, this)">
        <span class="stat-number"><?= $projectInformation['In Progress']?></span>
        <span class="stat-label">In Progress</span>
      </div>      
      <div class="stat-item total" 
      data-status-id="3"
      onclick="filterProjects(3, this)">
        <span class="stat-number"><?= $projectInformation['Abandoned']?></span>
        <span class="stat-label">Abandoned</span>
      </div> 
    </div>
  </div>

  <div class="project-container-projects">
    <?php foreach($projects as $project): ?>
    <div class="projectEach">
      <div class="project-image">
        <?php if (!empty($project['image'])): ?>
            <img src="<?= htmlspecialchars($project['image']) ?>" alt="<?= htmlspecialchars($project['image']) ?>"/>
        <?php endif; ?>
      </div>
      <div class="project-content">
        <h3><?= htmlspecialchars($project['title'])?></h3>
        <p>
          <?= htmlspecialchars($project['description']) ?>
        </p>
        <br>
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
            <i class="<?= htmlspecialchars($tech['boxicon'])?>"><span><?= htmlspecialchars($tech['technology_name'])?></span></i>
            <?php endforeach; ?>
          </div>
          <div class="status">
            <?php 
              $statusClass = StatusName::getStatusName($project['status_id'])->value;
            ?>
            <div class="status-circle <?= htmlspecialchars($statusClass)?>"></div>
            <span><?= htmlspecialchars(ucfirst($statusClass))?></span>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?> 
  </div>
</div>

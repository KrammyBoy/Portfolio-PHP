<?php 

use App\Enums\StatusName;
?>    
    <div class="projects-admin">
        <div class="projects-admin-header">
            <h1>Experiences</h1>
        </div>
        <div class="projects-admin-table">
            <table>
                <caption>
                    Experience Table Data
                    <button onclick="interfaceModal('experience', 'add')">Add Experience</button>
                </caption>
                <thead>
                    <tr>
                        <th>Experience ID</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>School/Company</th>
                        <th>Degree/Role</th>
                        <th>Deleted At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($projects as $project):
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($project['id'])?></td>
                        <td><?= htmlspecialchars($project['experience_type'])?></td>
                        <td><?= htmlspecialchars($project['experience_description'])?></td>
                        <td><?= htmlspecialchars($project['start_date'])?></td>
                        <td><?= htmlspecialchars($project['end_date']) ?></td>
                        <td><?= htmlspecialchars($project['school'])?></td>
                        <td><?= htmlspecialchars($project['experience_degree'])?></td>
                        <td><?= ($project['deleted_at']===null)? htmlspecialchars('null'):htmlspecialchars(string: $project['deleted_at'])?></td>
                        <td class="actions-cell">
                            <button class="delete-btn" onclick="deleteProject(<?= htmlspecialchars($project['id'])?>)">Delete</button>
                            <button class="update-table-btn" onclick="showProjectModal('update', <?=htmlspecialchars($project['id'])?>)">Update</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    
                </tbody>
            </table>
        </div>
    </div>
    <?php include __DIR__ . '/../Components/ProjectModal.php'?>
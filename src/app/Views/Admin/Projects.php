<?php 

use App\Enums\StatusName;
?>    
    <div class="projects-admin">
        <div class="projects-admin-header">
            <h1>Projects</h1>
        </div>
        <div class="projects-admin-table">
            <table>
                <caption>
                    Project Table Data
                    <button onclick="interfaceModal('project', 'add')">Add Project</button>
                </caption>
                <thead>
                    <tr>
                        <th>Project ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Live URL</th>
                        <th>Repo URL</th>
                        <th>Status</th>
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
                        <td><?php
                        if ($project['image'] === null):
                        ?>
                            <?= htmlspecialchars('null')?>
                        <?php else: ?>
                            <img src="<?= htmlspecialchars('assets/upload/images/'.$project['image'])?>" style="width: 50px; height:50px object-fit:contain">
                        <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($project['title'])?></td>
                        <td><?= htmlspecialchars($project['description'])?></td>
                        <td><?= ($project['live_url']===null)? htmlspecialchars('null'):htmlspecialchars(string: $project['live_url']) ?></td>
                        <td><?= ($project['repo_url']===null)? htmlspecialchars('null'):htmlspecialchars(string: $project['repo_url']) ?></td>
                        <td><?= htmlspecialchars($project['status_id'])?></td>
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
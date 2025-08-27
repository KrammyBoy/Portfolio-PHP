<?php 

use App\Enums\StatusName;


?>    
    <div class="projects-admin">
        <div class="projects-admin-header">
            <h1>Technologies</h1>
        </div>
        <div class="projects-admin-table">
            <table>
                <caption>
                    Technologies Table Data
                    <button onclick="interfaceModal('technologies', 'add')">Add Technologies</button>
                </caption>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Boxicon (CSS)</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($allTechnologies as $projTech):
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($projTech['id'])?></td>
                        <td><?= htmlspecialchars($projTech['technology_name'])?></td>
                        <td><?= htmlspecialchars($projTech['boxicon'])?></td>
                        <td><?= htmlspecialchars($projTech['category']) ?></td>
                        <td class="actions-cell">
                            <button class="delete-btn" onclick="deleteTechnology(<?= htmlspecialchars($projTech['id'])?>)">Delete</button>
                            <button class="update-table-btn" onclick="showTechnologiesModal('update', <?=htmlspecialchars($projTech['id'])?>)">Update</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="projects-admin">
        <div class="projects-admin-header">
            <h1>Project Technology</h1>
        </div>
        <div class="projects-admin-table">
            <table>
                <caption>
                    Association Table For Projects and Technology
                    <button onclick="interfaceModal('projtech', 'add')">Add Association</button>
                </caption>
                <thead>
                    <tr>
                        <th>Project Title</th>
                        <th>Project ID</th>
                        <th>Technology ID</th>
                        <th>ID</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($projectTechnologies as $projTech):
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($projTech['title'])?></td>
                        <td><?= htmlspecialchars($projTech['id'])?></td>
                        <td><?= htmlspecialchars($projTech['technology_id'])?></td>
                        <td><?= htmlspecialchars($projTech['technology_name']) ?></td>
                        <td class="actions-cell">
                            <button class="delete-btn" onclick="deleteProjectTechnology(<?= $projTech['id']?>, <?= $projTech['technology_id']?>)">Delete</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>    
    <?php include __DIR__ . '/../Components/TechnologiesModal.php'?>
    <?php include __DIR__ . '/../Components/ProjTechModal.php'?>
    <script>
        window.addEventListener("load", function () {
           //Add function
           //Store the project and technologies in a session storage
            setItemToSessionStorage('projects',<?= json_encode($projects)?>);
            setItemToSessionStorage('technologies',<?= json_encode($allTechnologies)?>);
            setItemToSessionStorage('projectTechnology', <?= json_encode($projectTechnologies)?>); //We need this to compare projects and technologies

        });
    </script>
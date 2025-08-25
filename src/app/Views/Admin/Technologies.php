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
                    foreach($allTechnologies as $technology):
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($technology['id'])?></td>
                        <td><?= htmlspecialchars($technology['technology_name'])?></td>
                        <td><?= htmlspecialchars($technology['boxicon'])?></td>
                        <td><?= htmlspecialchars($technology['category']) ?></td>
                        <td class="actions-cell">
                            <button class="delete-btn" onclick="deleteExperience(<?= htmlspecialchars($technology['id'])?>)">Delete</button>
                            <button class="update-table-btn" onclick="showCertificatesModal('update', <?=htmlspecialchars($technology['id'])?>)">Update</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include __DIR__ . '/../Components/TechnologiesModal.php'?>
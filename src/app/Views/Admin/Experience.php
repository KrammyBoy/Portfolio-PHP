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
                    foreach($experiences as $experience):
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($experience['id'])?></td>
                        <td><?= htmlspecialchars($experience['experience_type'])?></td>
                        <td><?= htmlspecialchars($experience['experience_description'])?></td>
                        <td><?= htmlspecialchars((new DateTime($experience['start_date']))->format('d, M Y'))?></td>
                        <td><?= htmlspecialchars((new DateTime($experience['end_date']))->format('d, M Y')) ?></td>
                        <td><?= htmlspecialchars($experience['school'])?></td>
                        <td><?= htmlspecialchars($experience['experience_degree'])?></td>
                        <td><?= ($experience['deleted_at']===null)? htmlspecialchars('null'):htmlspecialchars(string: $experience['deleted_at'])?></td>
                        <td class="actions-cell">
                            <button class="delete-btn" onclick="deleteExperience(<?= htmlspecialchars($experience['id'])?>)">Delete</button>
                            <button class="update-table-btn" onclick="showExperienceModal('update', <?=htmlspecialchars($experience['id'])?>)">Update</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include __DIR__ . '/../Components/ExperienceModal.php'?>
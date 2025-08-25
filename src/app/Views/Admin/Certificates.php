<?php 

use App\Enums\StatusName;

?>    
    <div class="projects-admin">
        <div class="projects-admin-header">
            <h1>Certificates</h1>
        </div>
        <div class="projects-admin-table">
            <table>
                <caption>
                    Certification Table Data
                    <button onclick="interfaceModal('certificates', 'add')">Add Certificates</button>
                </caption>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Issuer</th>
                        <th>Date earned</th>
                        <th>Credential Url</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Deleted At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($certificates as $certificate):
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($certificate['id'])?></td>
                        <td><?= htmlspecialchars($certificate['name'])?></td>
                        <td><?= htmlspecialchars($certificate['issuer'])?></td>
                        <td><?= htmlspecialchars((new DateTime($certificate['date_earned']))->format('d, M Y'))?></td>
                        <td><?= htmlspecialchars($certificate['credential_url']) ?></td>
                        <td><?= htmlspecialchars($certificate['type'])?></td>
                        <td><?= htmlspecialchars($certificate['description'])?></td>
                        <td><?= ($certificate['deleted_at']===null)? htmlspecialchars('null'):htmlspecialchars(string: $certificate['deleted_at'])?></td>
                        <td class="actions-cell">
                            <button class="delete-btn" onclick="deleteExperience(<?= htmlspecialchars($certificate['id'])?>)">Delete</button>
                            <button class="update-table-btn" onclick="showCertificatesModal('update', <?=htmlspecialchars($certificate['id'])?>)">Update</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include __DIR__ . '/../Components/CertificateModal.php'?>
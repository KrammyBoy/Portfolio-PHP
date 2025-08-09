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
                    <tr>
                        <td>1</td>
                        <td>None</td>
                        <td>Basic</td>
                        <td>Lero</td>
                        <td>Basic</td>
                        <td>Basic</td>
                        <td>Basic</td>
                        <td>Basic</td>
                        <td class="actions-cell">
                            <button class="delete-btn">Delete</button>
                            <button class="update-table-btn" onclick="interfaceModal('projects', 'update')">Update</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php include __DIR__ . '/../Components/ProjectModal.php'?>
    <div class="admin-modal-overlay proj-tech-modal" id="modalOverlay">
        <div class="admin-modal">
            <button class="close-btn" onclick="closeModal('.proj-tech-modal')">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            
            <div class="admin-modal-header">
                <h2 class="admin-modal-title">Add Certificates</h2>
            </div>
            <form action="/project-technologies/add" method="POST" enctype="multipart/form-data" class="admin-form" id="admin-form">
                <div class="admin-form-group">
                    <label class="form-label" for="projects">Projects</label>
                    <select
                        id="projects"
                        name="projects"
                        class="form-input"
                        onchange="projectTechnologyFilter()"
                    >
                        <option value="" disable selected onchange="">-- Select a project --</option>
                        <?php 
                        foreach($projects as $project):?>
                        <option value="<?= htmlspecialchars($project['id'])?>">
                            <?= htmlspecialchars($project['title'])?>
                        </option>
                        <?php endforeach;?>
                    </select>
                </div>
                
                <div class="admin-form-group">
                    <label class="form-label" for="technologies">Technologies</label>
                    <select
                        id="technologies"
                        name="technologies"
                        class="form-input"
                    >
                        <option value="" disable selected>-- Select a project --</option>
                    </select>
                </div>    
                <div class="modal-actions">
                    <button type="button" class="update-btn" onclick="closeModal('.proj-tech-modal')">
                        Cancel
                    </button>
                    <button type="submit" class="update-btn" id="button-submit">
                        Add Experience
                    </button>
                </div>
            </form>
        </div>
    </div>
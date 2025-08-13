    <div class="admin-modal-overlay project-modal" id="modalOverlay">
        <div class="admin-modal">
            <button class="close-btn" onclick="closeModal('.project-modal')">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            
            <div class="admin-modal-header">
                <h2 class="admin-modal-title">Update Contact Information</h2>
            </div>
            <form action="/updateContactInformation" method="POST" enctype="multipart/form-data" class="admin-form" id="admin-form">
                
                <div class="admin-form-group">
                    <img id="preview" style="display: none;">
                    <label class="form-label" for="image">Project Image</label>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>
                
                <div class="admin-form-group">
                    <label class="form-label" for="title">Project Title</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-input"
                        placeholder="Enter your project title"
                        required
                    >
                </div>
                
                <div class="admin-form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea
                    id="description"
                    name="description"
                    class="form-control"
                    placeholder="Describe your project"
                    required
                    ></textarea>
                </div>
                
                <div class="admin-form-group">
                    <label class="form-label" for="live-url">Live URL</label>
                    <input
                        type="url"
                        id="live-url"
                        name="live_url"
                        class="form-input"
                        placeholder="https://your-project.com"
                        
                    >
                </div>
                
                <div class="admin-form-group">
                    <label class="form-label" for="repo-url">Repository URL</label>
                    <input
                        type="url"
                        id="repo-url"
                        name="repo_url"
                        class="form-input"
                        placeholder="https://github.com/username/repo"
                        
                    >
                </div>
                
                <div class="admin-form-group">
                    <label class="form-label" for="status">Project Status</label>
                    <select class="status" id="status" name="status_id">
                        <option value="2">In Progress</option>
                        <option value="1">Complete</option>
                        <option value="3">Abandoned</option>
                    </select>
                </div>
                
                <div class="modal-actions">
                    <button type="button" class="update-btn" onclick="closeModal('.admin-modal-overlay')">
                        Cancel
                    </button>
                    <button type="submit" class="update-btn">
                        Update Information
                    </button>
                </div>
            </form>
        </div>
    </div>
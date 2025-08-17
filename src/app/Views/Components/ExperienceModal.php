    <div class="admin-modal-overlay experience-modal" id="modalOverlay">
        <div class="admin-modal">
            <button class="close-btn" onclick="closeModal('.experience-modal')">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            
            <div class="admin-modal-header">
                <h2 class="admin-modal-title">Add Experience</h2>
            </div>
            <form action="/experiences/add" method="POST" enctype="multipart/form-data" class="admin-form" id="admin-form">
                
                <div class="admin-form-group">
                    <label class="form-label" for="title">Type</label>
                    <select class="status" id="type" name="type">
                        <option value="Work">Work</option>
                        <option value="Education">Education</option>
                    </select>
                </div>
                
                <div class="admin-form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea
                    id="description"
                    name="description"
                    class="form-control"
                    placeholder="Describe your experience"
                    required
                    ></textarea>
                </div>
                
                <div class="admin-form-group">
                    <label class="form-label" for="start-date">Start Date</label>
                    <input
                        type="date"
                        id="start_date"
                        name="start_date"
                        class="form-input"
                        placeholder="https://your-project.com"
                        
                    >
                </div>
                
                <div class="admin-form-group">
                    <label class="form-label" for="start-date">End Date</label>
                    <input
                        type="date"
                        id="end_date"
                        name="end_date"
                        class="form-input"
                        placeholder="https://github.com/username/repo"
                        
                    >
                </div>
                
                <div class="admin-form-group">
                    <label class="form-label" for="status">School/Company</label>
                    <input
                        type="text"
                        id="school"
                        name="school"
                        class="form-input"
                        placeholder="Harvard University/Google Inc."
                        
                    >
                </div>
                <div class="admin-form-group">
                    <label class="form-label" for="status">Degree/Role</label>
                    <input
                        type="text"
                        id="degree"
                        name="degree"
                        class="form-input"
                        placeholder="Bachelor of Science in Mechatronics/Senior Javascript Engineer"
                        
                    >
                </div>                
                <div class="modal-actions">
                    <button type="button" class="update-btn" onclick="closeModal('.experience-modal')">
                        Cancel
                    </button>
                    <button type="submit" class="update-btn" id="button-submit">
                        Add Experience
                    </button>
                </div>
            </form>
        </div>
    </div>
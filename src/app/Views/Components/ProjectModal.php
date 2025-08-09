    <div class="modal-overlay project-modal">
        <div class="modal">
        
            <button class="close-btn" onclick="closeModal()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>

            <div class="modal-header">
                <h2 class="modal-title">Update Contact Information</h2>
            </div>

            <form action="/updateContactInformation" method="POST">
                <div class="form-group">
                    <input 
                        type="email" 
                        id="email" 
                        name="title" 
                        class="form-input" 
                        placeholder="Project Title"
                        required
                    >
                </div>

                <div class="form-group">
                    <input 
                        type="text" 
                        id="phone" 
                        name="description" 
                        class="form-input" 
                        placeholder="Description"
                        required
                    >
                </div>

                <div class="form-group">
                    <input 
                        type="text" 
                        id="live-url" 
                        name="live-url" 
                        class="form-input" 
                        placeholder="Live URL"
                        required
                    >
                </div>

                <div class="form-group">
                    <input 
                        type="text" 
                        id="repo-url" 
                        name="repo-url" 
                        class="form-input" 
                        placeholder="Repo URL"
                        required
                    >
                </div>

                <select class="status">
                    <option value="2">In Progress</option>
                    <option value="1">Complete</option>
                    <option value="3">Abandoned</option>
                </select>



                <div class="modal-actions">
                    <button type="button" class="update-btn" onclick="closeModal()">
                        Cancel
                    </button>
                    <button type="submit" class="update-btn">
                        Update Information
                    </button>
                </div>
            </form>
        </div>
    </div>
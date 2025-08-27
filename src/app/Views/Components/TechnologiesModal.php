    <div class="admin-modal-overlay technologies-modal" id="modalOverlay">
        <div class="admin-modal">
            <button class="close-btn" onclick="closeModal('.technologies-modal')">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            
            <div class="admin-modal-header">
                <h2 class="admin-modal-title">Add Certificates</h2>
            </div>
            <form action="/technologies/add" method="POST" enctype="multipart/form-data" class="admin-form" id="admin-form">
                

                <div class="admin-form-group">
                    <label class="form-label" for="name">Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-input"
                        placeholder="PHP, Google..."
                        required
                    >
                </div>
                
                <div class="admin-form-group">
                    <label class="form-label" for="boxicon">Boxicon</label>
                    <input
                        type="text"
                        id="boxicon"
                        name="boxicon"
                        class="form-input"
                        placeholder="bxl bx-php"
                        required
                    >
                </div>
                <div class="admin-form-group">
                    <label class="form-label" for="category">Category</label>
                    <input
                        type="text"
                        id="category"
                        name="category"
                        class="form-input"
                        placeholder="PHP"
                        required
                    >
                </div>         
                <div class="modal-actions">
                    <button type="button" class="update-btn" onclick="closeModal('.technologies-modal')">
                        Cancel
                    </button>
                    <button type="submit" class="update-btn" id="button-submit">
                        Add Experience
                    </button>
                </div>
            </form>
        </div>
    </div>
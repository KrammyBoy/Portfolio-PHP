    <div class="admin-modal-overlay certificates-modal" id="modalOverlay">
        <div class="admin-modal">
            <button class="close-btn" onclick="closeModal('.certificates-modal')">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            
            <div class="admin-modal-header">
                <h2 class="admin-modal-title">Add Certificates</h2>
            </div>
            <form action="/certificates/add" method="POST" enctype="multipart/form-data" class="admin-form" id="admin-form">
                

                <div class="admin-form-group">
                    <label class="form-label" for="name">Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-input"
                        placeholder="Sec++"
                        
                    >
                </div>
                
                <div class="admin-form-group">
                    <label class="form-label" for="issuer">Issuer</label>
                    <input
                        type="text"
                        id="issuer"
                        name="issuer"
                        class="form-input"
                        placeholder="Cisco"
                    >
                </div>
                <div class="admin-form-group">
                    <label class="form-label" for="date_earned">Date Earned</label>
                    <input
                        type="date"
                        id="date_earned"
                        name="date_earned"
                        class="form-input"
                    >
                </div>  
                <!-- TODO Should have a file if it is set to file to allow uploads-->    
                <div class="admin-form-group">
                    <label class="form-label" for="title">Type</label>
                    <select class="status" id="type" name="type" onchange="fileUpload()">
                        <option value="Url">Url</option>
                        <option value="File">File</option>
                    </select>
                </div>              
                
                <div id="created-form" class="admin-form-group">
                    <label class="form-label">Credential URL</label>
                    <input id="credential_url" class="form-input" type="text" name="credential_url" placeholder="https://www.credly.com/badges/...">
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
                <div class="modal-actions">
                    <button type="button" class="update-btn" onclick="closeModal('.certificates-modal', 'update-certificate')">
                        Cancel
                    </button>
                    <button type="submit" class="update-btn" id="button-submit">
                        Add Experience
                    </button>
                </div>
            </form>
        </div>
    </div>
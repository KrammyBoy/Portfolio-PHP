    <div class="modal-overlay">
        <div class="modal">
        
            <button class="close-btn" onclick="closeModal()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>

            <div class="modal-header">
                <h2 class="modal-title">Update Contact Information</h2>
                <p class="modal-subtitle">Keep your details current and stay connected</p>
            </div>

            <form action="/updateContactInformation" method="POST">
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input" 
                        placeholder="your.email@example.com"
                        value="<?= htmlspecialchars($contactInformation['email'])?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="phone">Phone Number</label>
                    <input 
                        type="tel" 
                        id="phone" 
                        name="phone" 
                        class="form-input" 
                        placeholder="+1 (555) 123-4567"
                        value="<?= htmlspecialchars($contactInformation['phone'])?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="location">Location</label>
                    <input 
                        type="text" 
                        id="location" 
                        name="location" 
                        class="form-input" 
                        placeholder="Location"
                        value="<?= htmlspecialchars($contactInformation['location'])?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="response">Response Time (hours)</label>
                    <input 
                        type="text" 
                        id="response" 
                        name="response" 
                        class="form-input" 
                        placeholder="Response Time"
                        value="<?= htmlspecialchars($contactInformation['response_time'])?>"
                        required
                    >
                </div>

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
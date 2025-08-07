    <div class="dashboard">
        <!-- Header -->
        <div class="dashboard-card header-card">
            <h1>Portfolio Dashboard</h1>
            <p>Real-time insights and analytics</p>
        </div>

        <!-- Date & Time -->
        <div class="dashboard-card datetime-card">
            <div class="card-title">Current Time</div>
            <div class="time" id="current-time">--:--:--</div>
            <div class="date" id="current-date">Loading...</div>
            <div class="metric-badge pulse">Live</div>
        </div>

        <!-- Page Visits Chart -->
        <div class="dashboard-card visits-card">
            <div class="card-title">Page Visits (Last 7 Days)</div>
            <canvas id="visitsChart"></canvas>
        </div>

        <!-- Stats Grid -->
        <div class="dashboard-card stats-grid">
            <div class="stat-item">
                <div class="stat-number" id="project-count">42</div>
                <div class="stat-label">Projects</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" id="experience-years">5+</div>
                <div class="stat-label">Years Experience</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" id="certificate-count">18</div>
                <div class="stat-label">Certificates</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" id="tech-count">24</div>
                <div class="stat-label">Technologies</div>
            </div>
        </div>

        <!-- Recent Experience -->
        <div class="dashboard-card">
            <div class="card-title">Recent Experience</div>
            <div class="experience-item">
                <div class="exp-company">Tech Solutions Inc.</div>
                <div class="exp-role">Senior Full Stack Developer</div>
                <div class="exp-duration">2023 - Present</div>
                <div class="exp-description">Leading development of web applications using React, Node.js, and cloud services.</div>
            </div>
        </div>
        <!-- Admin Information -->
        <div class="dashboard-card admin-info-card">
            <div class="info-item">
                <div class="info-label">Username</div>
                <div class="info-value">admin@portfolio</div>
            </div>
            <div class="info-item">
                <div class="info-label">Last Login</div>
                <div class="info-value" id="last-login">2 hours ago</div>
            </div>
            <div class="info-item">
                <div class="info-label">Last Updated</div>
                <div class="info-value" id="last-updated">5 minutes ago</div>
            </div>
            <div class="info-item">
                <div class="info-label">Status</div>
                <div class="info-value" style="color: #10b981;">
                    <span class="pulse">●</span> Online
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="dashboard-card contact-card">
            <div class="card-title">Contact Information</div>
            <div class="contact-item">
                <div class="contact-icon">
                    <i class='bx  bx-envelope'  ></i> 
                </div>
                <div>
                    <div style="font-weight: 600;">Email</div>
                    <div style="opacity: 0.7; font-size: 0.9rem;">contact@portfolio.dev</div>
                </div>
            </div>
            <div class="contact-item">
                <div class="contact-icon">
                    <i class='bx  bx-phone'  ></i> 
                </div>
                <div>
                    <div style="font-weight: 600;">Phone</div>
                    <div style="opacity: 0.7; font-size: 0.9rem;">+63 xxx-xxx-xxxx</div>
                </div>
            </div>
            <div class="contact-item">
                <div class="contact-icon">
                    <i class='bx  bx-location'  ></i> 
                </div>
                <div>
                    <div style="font-weight: 600;">Location</div>
                    <div style="opacity: 0.7; font-size: 0.9rem;">Cebu City, PH</div>
                </div>
            </div>
            <div class="contact-item">
                <div class="contact-icon">
                    <i class='bx  bx-thunder'  ></i> 
                </div>
                <div>
                    <div style="font-weight: 600;">Response Time</div>
                    <div style="opacity: 0.7; font-size: 0.9rem;">< 24 hours</div>
                </div>
            </div>
            <button class="update-btn" onclick="setModalType('contact')">Update Contact Info</button>
        </div>
    </div>
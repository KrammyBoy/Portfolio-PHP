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
                <div class="stat-number" id="project-count"><?= htmlspecialchars($dashboard['projectCount'])?></div>
                <div class="stat-label">Projects</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" id="experience-years"><?= ($dashboard['experienceCount'] <= 0) ? htmlspecialchars('No Experience'): htmlspecialchars($dashboard['experienceCount']) ?></div>
                <div class="stat-label">Years Experience</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" id="certificate-count"><?= htmlspecialchars($dashboard['certificateCount'])?></div>
                <div class="stat-label">Certificates</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" id="tech-count"><?= htmlspecialchars($dashboard['technologiesCount'])?></div>
                <div class="stat-label">Technologies</div>
            </div>
        </div>

        <!-- Recent Experience -->
        <div class="dashboard-card">
            <?php 
            $recentExperience = $dashboard['recentExperience'][0];

            unset($start_date, $end_date);
            $start_date = (new DateTime($recentExperience['start_date']))->format('Y');
            $end_date = (new DateTime($recentExperience['end_date']))->format('Y');
            ?>
            <div class="card-title">Recent Experience</div>
            <div class="experience-item">
                <div class="exp-company"><?= htmlspecialchars($recentExperience['school'])?></div>
                <div class="exp-role"><?= htmlspecialchars($recentExperience['experience_degree'])?></div>
                <div class="exp-duration"><?= htmlspecialchars($start_date)?> - <?= htmlspecialchars($end_date)?></div>
                <div class="exp-description"><?= htmlspecialchars($recentExperience['experience_description']) ?></div>
            </div>
        </div>
        <!-- Admin Information -->
        <div class="dashboard-card admin-info-card">
            <?php 
            $adminInfo = $dashboard['getAdminInfo'][0];

            $lastlogin = (new DateTime($adminInfo['last_login_at']));
            $now = new DateTime();

            $diff = $now->diff($lastlogin); 

            $lastUpdate = $adminInfo['updated_at'];
            $lastUpdate = ($lastUpdate !== null) ? (new DateTime($lastUpdate))->format('g') . ' hours ago': 'Did not update';
            ?>
            <div class="info-item">
                <div class="info-label">Username</div>
                <div class="info-value"><?= htmlspecialchars($adminInfo['username']) ?></div>
            </div>
            <div class="info-item">
                <div class="info-label">Last Login</div>
                <div class="info-value" id="last-login"><?= htmlspecialchars($diff->format('%a days %h hours %i minutes'))?> hours ago</div>
            </div>
            <div class="info-item">
                <div class="info-label">Last Updated</div>
                <div class="info-value" id="last-updated"><?= htmlspecialchars($lastUpdate)?></div>
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
            <?php 
            $contactInformation = $dashboard['contactInformation'][0];
            ?>
            <div class="card-title">Contact Information</div>
            <div class="contact-item">
                <div class="contact-icon">
                    <i class='bx  bx-envelope'  ></i> 
                </div>
                <div>
                    <div style="font-weight: 600;">Email</div>
                    <div style="opacity: 0.7; font-size: 0.9rem;"><?= $contactInformation['email']?></div>
                </div>
            </div>
            <div class="contact-item">
                <div class="contact-icon">
                    <i class='bx  bx-phone'  ></i> 
                </div>
                <div>
                    <div style="font-weight: 600;">Phone</div>
                    <div style="opacity: 0.7; font-size: 0.9rem;"><?= $contactInformation['phone']?></div>
                </div>
            </div>
            <div class="contact-item">
                <div class="contact-icon">
                    <i class='bx  bx-location'  ></i> 
                </div>
                <div>
                    <div style="font-weight: 600;">Location</div>
                    <div style="opacity: 0.7; font-size: 0.9rem;"><?= $contactInformation['location']?></div>
                </div>
            </div>
            <div class="contact-item">
                <div class="contact-icon">
                    <i class='bx  bx-thunder'  ></i> 
                </div>
                <div>
                    <div style="font-weight: 600;">Response Time</div>
                    <div style="opacity: 0.7; font-size: 0.9rem;"><?= $contactInformation['response_time']?> hours</div>
                </div>
            </div>
            <button class="update-btn" onclick="interfaceModal('contact')">Update Contact Info</button>
        </div>
    </div>
    <?php include __DIR__ . '/../Components/ContactModal.php'?>
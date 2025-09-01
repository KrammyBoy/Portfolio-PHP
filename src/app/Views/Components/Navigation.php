<?php declare(strict_types=1); ?>

<?php if (!isset($_SESSION['admin_logged_in'])): ?>
    <div class="video-container">
        <div class="video-background">
            <video autoplay muted loop playsinline>
                <source src="/assets/video.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="video-overlay"></div>
        </div>
        <div class="content-overlay">
            <h1>Mark Danielle Salabsab</h1>
            <h2>Programmer</h2>
            <p>An aspiring BS Computer Science graduate of the University of Cebu - Main with a solid foundation in programming, software development and AI integration. 
                Eager to apply my skills in real-world projects and contribute to innovative tech solutions.
            </p>
        </div>
    </div>
<?php endif; ?>

<nav class="navbar">
    <div class="nav-container">
        <button class="download-btn" <?= isset($_SESSION['admin_logged_in']) ? 'disabled' : '' ?>>
            <?php if (isset($_SESSION['admin_logged_in'])): ?>
                <a href="/dashboard">Admin</a>
            <?php else: ?>
                <a href="assets/Salabsab-Resume.pdf" target="_blank" download>Download CV</a>
            <?php endif; ?>
        </button>

        <div class="nav-links">
            <?php include __DIR__ . '/../Components/NavigationComponent.php'; ?>
        </div>

        <button class="mobile-toggle" onclick="toggleMobileMenu()">
            <span></span><span></span><span></span>
        </button>
    </div>

    <div class="mobile-menu">
        <?php include __DIR__ . '/../Components/NavigationComponent.php'; ?>
        <button class="mobile-download-btn" <?= isset($_SESSION['admin_logged_in']) ? 'disabled' : '' ?>>
            <?= isset($_SESSION['admin_logged_in']) ? 'Admin' : 'Download CV' ?>
        </button>
    </div>
</nav>

<?php 

if(!isset($_SESSION['admin_logged_in'])):
?>
    <a href="/" class="nav-link active">Home</a>
    <a href="/projects" class="nav-link">Projects</a>
    <a href="/experiences" class="nav-link">Experiences</a>                    
    <a href="/certifications" class="nav-link">Certificates</a>
    <a href="/technologies" class="nav-link">Technologies</a>                    
    <a href="/contact" class="nav-link">Contact</a>
<?php else: ?>
    <a href="/dashboard" class="nav-link active">Dashboard</a>
    <a href="/projects" class="nav-link">Projects</a>
    <a href="/experiences" class="nav-link">Experiences</a>                    
    <a href="/certifications" class="nav-link">Certificates</a>
    <a href="/technologies" class="nav-link">Technologies</a>                    
    <button class="logout" id="logoutBtn">Logout</button>
<?php endif; ?>
<div class="login-body">    
    <div class="login" id="login-block">
        <h3>Admin Login</h3>
        <?php include __DIR__ . '/../Components/LoginAlert.php';?>
        <form class="login-container" action="/login/checkAuthentication" method="POST">
            <div class="input-group">
                <input type="text" name="username" placeholder="Username" required>
                <label>Username</label>
            </div>
            
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
                <label>Password</label>
            </div>
            
            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>
</div>
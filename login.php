<?php
session_start();
if(isset($_SESSION['user_id'])){
    header("Location: profile.php");
    exit;
}
include ('includes/header.php'); 
?>

<style>
.auth-container {
    max-width: 400px;
    margin: 60px auto;
    padding: 0 20px;
}

.auth-card {
    padding: 40px 30px;
}

.auth-header {
    text-align: center;
    margin-bottom: 30px;
}

.auth-header h2 {
    font-size: 2rem;
    color: var(--text-main);
    margin-bottom: 10px;
}

.auth-header p {
    color: var(--text-muted);
}

.auth-toggle {
    text-align: center;
    margin-top: 20px;
    font-size: 0.9rem;
    color: var(--text-muted);
}

.auth-toggle a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    cursor: pointer;
}

#register-form {
    display: none;
}
</style>

<div class="auth-container">
    <div class="card auth-card">
        
        <!-- Login Form -->
        <div id="login-section">
            <div class="auth-header">
                <h2>Welcome Back</h2>
                <p>Login to continue your assessment</p>
            </div>
            <?php if(isset($_SESSION['auth_error'])): ?>
                <div style="color: #ef4444; background: #fee2e2; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center;">
                    <?php echo $_SESSION['auth_error']; unset($_SESSION['auth_error']); ?>
                </div>
            <?php endif; ?>
            <form id="login-form" action="endpoints/auth.php" method="POST">
                <input type="hidden" name="action" value="login">
                <div class="form-group">
                    <label class="form-label" for="login-email">Email Address</label>
                    <input type="email" id="login-email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="login-password">Password</label>
                    <input type="password" id="login-password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
            </form>
            <div class="auth-toggle">
                Don't have an account? <a id="show-register">Register here</a>
            </div>
        </div>

        <!-- Register Form -->
        <div id="register-section" style="display: none;">
            <div class="auth-header">
                <h2>Create Account</h2>
                <p>Join us to find your path</p>
            </div>
            <form id="register-form" action="endpoints/auth.php" method="POST" style="display: block;">
                <input type="hidden" name="action" value="register">
                <div class="form-group">
                    <label class="form-label" for="reg-name">Full Name</label>
                    <input type="text" id="reg-name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="reg-email">Email Address</label>
                    <input type="email" id="reg-email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="reg-password">Password</label>
                    <input type="password" id="reg-password" name="password" class="form-control" required minlength="6">
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Register</button>
            </form>
            <div class="auth-toggle">
                Already have an account? <a id="show-login">Login here</a>
            </div>
        </div>

    </div>
</div>

<script>
    document.getElementById('show-register').addEventListener('click', function() {
        document.getElementById('login-section').style.display = 'none';
        document.getElementById('register-section').style.display = 'block';
    });

    document.getElementById('show-login').addEventListener('click', function() {
        document.getElementById('register-section').style.display = 'none';
        document.getElementById('login-section').style.display = 'block';
    });
</script>

<?php include 'includes/footer.php'; ?>

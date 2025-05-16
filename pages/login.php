<?php
require_once '../includes/config.php';

// Initialize variables
$error = '';
$success = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'login') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            if (empty($email) || empty($password)) {
                $error = 'Please enter both email and password';
            } else {
                try {
                    // Fetch user by email
                    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
                    $stmt->execute([$email]);
                    $user = $stmt->fetch();

                    if ($user && password_verify($password, $user['password_hash'])) {
                        // Set session variables
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['user_email'] = $user['email'];
                        
                        // Redirect to home page
                        header('Location: ' . SITE_URL . '/index.php');
                        exit;
                    } else {
                        $error = 'Invalid email or password';
                    }
                } catch (PDOException $e) {
                    error_log("Login error: " . $e->getMessage());
                    $error = 'An error occurred during login. Please try again.';
                }
            }
        } elseif ($_POST['action'] === 'register') {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            // Validate input
            if (empty($username) || empty($email) || empty($password)) {
                $error = 'All fields are required';
            } elseif ($password !== $confirm_password) {
                $error = 'Passwords do not match';
            } elseif (strlen($password) < 8) {
                $error = 'Password must be at least 8 characters long';
            } else {
                try {
                    // Check if email or username already exists
                    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ? OR username = ?');
                    $stmt->execute([$email, $username]);
                    if ($stmt->fetch()) {
                        $error = 'Email or username already registered';
                    } else {
                        // Create new user with proper password hashing
                        $password_hash = password_hash($password, PASSWORD_DEFAULT);
                        $stmt = $pdo->prepare('INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)');
                        
                        if ($stmt->execute([$username, $email, $password_hash])) {
                            // Log the user in automatically after registration
                            $_SESSION['user_id'] = $pdo->lastInsertId();
                            $_SESSION['username'] = $username;
                            $_SESSION['user_email'] = $email;
                            
                            // Redirect to home page
                            header('Location: ' . SITE_URL . '/index.php');
                            exit;
                        } else {
                            $error = 'Registration failed. Please try again.';
                        }
                    }
                } catch (PDOException $e) {
                    error_log("Registration error: " . $e->getMessage());
                    $error = 'An error occurred during registration. Please try again.';
                }
            }
        }
    }
}

require_once '../includes/header.php';
?>

<main class="auth-page">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="auth-container">
                    <!-- Login Form -->
                    <div class="auth-form" id="loginForm">
                        <h2 class="text-center mb-4">Welcome Back</h2>
                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <?php if ($success): ?>
                            <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php endif; ?>
                        <form method="POST" action="" class="needs-validation" novalidate>
                            <input type="hidden" name="action" value="login">
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email" required>
                                <div class="invalid-feedback">Please enter a valid email address.</div>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control form-control-lg" id="password" name="password" required>
                                <div class="invalid-feedback">Please enter your password.</div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">Login</button>
                            <p class="text-center mb-0">
                                Don't have an account? 
                                <a href="#" onclick="toggleForms()" class="text-decoration-none">Register here</a>
                            </p>
                        </form>
                    </div>

                    <!-- Register Form -->
                    <div class="auth-form" id="registerForm" style="display: none;">
                        <h2 class="text-center mb-4">Create Account</h2>
                        <form method="POST" action="" class="needs-validation" novalidate>
                            <input type="hidden" name="action" value="register">
                            <div class="mb-4">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control form-control-lg" id="username" name="username" required>
                                <div class="invalid-feedback">Please choose a username.</div>
                            </div>
                            <div class="mb-4">
                                <label for="reg-email" class="form-label">Email</label>
                                <input type="email" class="form-control form-control-lg" id="reg-email" name="email" required>
                                <div class="invalid-feedback">Please enter a valid email address.</div>
                            </div>
                            <div class="mb-4">
                                <label for="reg-password" class="form-label">Password</label>
                                <input type="password" class="form-control form-control-lg" id="reg-password" name="password" required>
                                <div class="invalid-feedback">Password must be at least 8 characters long.</div>
                            </div>
                            <div class="mb-4">
                                <label for="confirm-password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control form-control-lg" id="confirm-password" name="confirm_password" required>
                                <div class="invalid-feedback">Passwords must match.</div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">Register</button>
                            <p class="text-center mb-0">
                                Already have an account? 
                                <a href="#" onclick="toggleForms()" class="text-decoration-none">Login here</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.auth-page {
    min-height: 100vh;
    background: linear-gradient(135deg, var(--rm-navy) 0%, #001f5b 100%);
    padding: 2rem 0;
}

.auth-container {
    background: white;
    padding: 3rem;
    border-radius: 15px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    width: 100%;
}

.auth-form {
    width: 100%;
}

.auth-form h2 {
    color: var(--rm-navy);
    font-weight: 700;
    font-size: 2.25rem;
    margin-bottom: 2rem;
}

.form-label {
    font-weight: 600;
    color: var(--rm-navy);
    margin-bottom: 0.5rem;
}

.form-control {
    border: 2px solid #e9ecef;
    padding: 0.875rem 1rem;
    border-radius: 10px;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: var(--rm-navy);
    box-shadow: 0 0 0 0.25rem rgba(0, 32, 91, 0.15);
}

.btn-primary {
    background-color: var(--rm-navy);
    border-color: var(--rm-navy);
    padding: 0.875rem 1.5rem;
    font-weight: 600;
    font-size: 1.1rem;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #001f5b;
    border-color: #001f5b;
    transform: translateY(-1px);
}

.alert {
    border-radius: 10px;
    margin-bottom: 1.5rem;
    padding: 1rem;
    font-weight: 500;
    font-size: 1.1rem;
}

.auth-form a {
    color: var(--rm-navy);
    font-weight: 600;
    transition: all 0.3s ease;
}

.auth-form a:hover {
    color: #001f5b;
    text-decoration: none;
}

@media (max-width: 768px) {
    .auth-page {
        padding: 1rem;
    }
    
    .auth-container {
        padding: 2rem;
    }
    
    .auth-form h2 {
        font-size: 2rem;
    }
    
    .form-control {
        font-size: 1rem;
    }
    
    .btn-primary {
        font-size: 1rem;
    }
}
</style>

<script>
// Form validation
(function() {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
})();

// Toggle between login and register forms
function toggleForms() {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    
    if (loginForm.style.display === 'none') {
        loginForm.style.display = 'block';
        registerForm.style.display = 'none';
    } else {
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
    }
}
</script>

<?php require_once '../includes/footer.php'; ?> 
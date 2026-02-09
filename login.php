<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Advanced form examples with real-time validation, file uploads, and multi-step wizards">
    <meta name="keywords" content="bootstrap, admin, dashboard, forms, validation">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="./assets/favicon-CvUZKS4z.svg">
    <link rel="icon" type="image/png" href="./assets/favicon-B_cwPWBd.png">
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="./assets/manifest-DTaoG9pG.json">
    
    <!-- Preload critical fonts -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script type="module" crossorigin src="./assets/vendor-bootstrap-C9iorZI5.js"></script>
  <script type="module" crossorigin src="./assets/vendor-charts-DGwYAWel.js"></script>
  <script type="module" crossorigin src="./assets/vendor-ui-CflGdlft.js"></script>
  <script type="module" crossorigin src="./assets/main-DwHigVru.js"></script>
  <script type="module" crossorigin src="./assets/forms-CC-rf4V3.js"></script>
  <link rel="stylesheet" crossorigin href="./assets/main-QD_VOj1Y.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row g-4 w-100">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header border-bottom">
                        <ul class="nav nav-tabs card-header-tabs" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login-content" type="button" role="tab" aria-controls="login-content" aria-selected="true">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register-content" type="button" role="tab" aria-controls="register-content" aria-selected="false">
                                    <i class="bi bi-person-plus me-2"></i>Register
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- Login Tab -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="login-content" role="tabpanel" aria-labelledby="login-tab">
                            <div class="card-body">
                                <form x-data="loginForm()" @submit.prevent="submitLogin()">
                                    <div class="row g-3">
                                        <div class="col-12" x-show="errors.general">
                                            <div class="alert alert-danger" role="alert">
                                                <i class="bi bi-exclamation-circle me-2"></i>
                                                <span x-text="errors.general"></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                <input 
                                                    type="email" 
                                                    class="form-control" 
                                                    x-model="form.email"
                                                    placeholder="Enter your email"
                                                    required
                                                >
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                                <input 
                                                    :type="showLoginPassword ? 'text' : 'password'" 
                                                    class="form-control" 
                                                    x-model="form.password"
                                                    placeholder="Enter your password"
                                                    required
                                                >
                                                <button 
                                                    type="button" 
                                                    class="btn btn-outline-secondary"
                                                    @click="showLoginPassword = !showLoginPassword"
                                                >
                                                    <i :class="showLoginPassword ? 'bi-eye-slash' : 'bi-eye'"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary w-100" :disabled="isSubmitting">
                                                <span x-show="!isSubmitting">
                                                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                                                </span>
                                                <span x-show="isSubmitting">
                                                    <div class="spinner-border spinner-border-sm me-2"></div>
                                                    Logging in...
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Register Tab -->
                        <div class="tab-pane fade" id="register-content" role="tabpanel" aria-labelledby="register-tab">
                            <div class="card-body">
                                <form x-data="registrationForm()" @submit.prevent="submitForm()">
                                    <div class="row g-3">
                                        <div class="col-12" x-show="errors.general">
                                            <div class="alert alert-danger" role="alert">
                                                <i class="bi bi-exclamation-circle me-2"></i>
                                                <span x-text="errors.general"></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                                <label class="form-label">Username</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                    <input 
                                                        type="text" 
                                                        class="form-control" 
                                                        x-model="form.username"
                                                        @input="validateField('username')"
                                                        :class="getFieldClass('username')"
                                                        placeholder="Enter username"
                                                        required
                                                    >
                                                </div>
                                                <div class="invalid-feedback" x-show="errors.username" x-text="errors.username"></div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Email</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                    <input 
                                                        type="email" 
                                                        class="form-control" 
                                                        x-model="form.email"
                                                        @input="validateField('email')"
                                                        :class="getFieldClass('email')"
                                                        placeholder="Enter email"
                                                        required
                                                    >
                                                </div>
                                                <div class="invalid-feedback" x-show="errors.email" x-text="errors.email"></div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Password</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                                    <input 
                                                        :type="showPassword ? 'text' : 'password'" 
                                                        class="form-control" 
                                                        x-model="form.password"
                                                        @input="validatePassword()"
                                                        :class="getFieldClass('password')"
                                                        placeholder="Enter password"
                                                        required
                                                    >
                                                    <button 
                                                        type="button" 
                                                        class="btn btn-outline-secondary"
                                                        @click="showPassword = !showPassword"
                                                    >
                                                        <i :class="showPassword ? 'bi-eye-slash' : 'bi-eye'"></i>
                                                    </button>
                                                </div>
                                                <div class="invalid-feedback" x-show="errors.password" x-text="errors.password"></div>
                                                
                                                <!-- Password Strength Indicator -->
                                                <div class="password-strength mt-2" x-show="form.password">
                                                    <div class="strength-bar">
                                                        <div 
                                                            class="strength-fill"
                                                            :class="passwordStrength.level"
                                                            :style="`width: ${passwordStrength.percentage}%`"
                                                        ></div>
                                                    </div>
                                                    <small :class="`text-${passwordStrength.color}`" x-text="`Password strength: ${passwordStrength.text}`"></small>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Confirm Password</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                                    <input 
                                                        type="password" 
                                                        class="form-control" 
                                                        x-model="form.confirmPassword"
                                                        @input="validateField('confirmPassword')"
                                                        :class="getFieldClass('confirmPassword')"
                                                        placeholder="Confirm password"
                                                        required
                                                    >
                                                </div>
                                                <div class="invalid-feedback" x-show="errors.confirmPassword" x-text="errors.confirmPassword"></div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" x-model="form.agreeTerms" required>
                                                    <label class="form-check-label">
                                                        I agree to the <a href="#" class="text-primary">Terms of Service</a> and <a href="#" class="text-primary">Privacy Policy</a>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-success w-100" :disabled="isSubmitting || !isFormValid">
                                                    <span x-show="!isSubmitting">
                                                        <i class="bi bi-person-plus me-2"></i>Create Account
                                                    </span>
                                                    <span x-show="isSubmitting">
                                                        <div class="spinner-border spinner-border-sm me-2"></div>
                                                        Creating Account...
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script>
    function loginForm() {
        return {
            form: {
                email: '',
                password: ''
            },
            errors: {},
            showLoginPassword: false,
            isSubmitting: false,

            async submitLogin() {
                this.errors.general = '';

                if (!this.form.email || !this.form.password) {
                    this.errors.general = 'Email and password are required';
                    return;
                }

                this.isSubmitting = true;

                try {
                    const response = await fetch('/api/login', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            email: this.form.email,
                            password: this.form.password
                        })
                    });

                    const data = await response.json();

                    if (data.success) {
                        // Attendre un peu avant de rediriger pour laisser la session se mettre à jour
                        setTimeout(() => {
                            window.location.href = data.redirect || '/analytics';
                        }, 300);
                    } else {
                        this.errors.general = data.message || 'Login failed';
                    }
                } catch (error) {
                    this.errors.general = 'An error occurred during login';
                    console.error('Error:', error);
                } finally {
                    this.isSubmitting = false;
                }
            }
        }
    }

    function registrationForm() {
        return {
            form: {
                username: '',
                email: '',
                password: '',
                confirmPassword: '',
                agreeTerms: false
            },
            errors: {},
            showPassword: false,
            isSubmitting: false,
            passwordStrength: {
                percentage: 0,
                level: 'weak',
                text: 'Weak',
                color: 'danger'
            },
            
            get isFormValid() {
                return this.form.username && this.form.email && this.form.password && 
                       this.form.confirmPassword && this.form.agreeTerms && 
                       !Object.values(this.errors).some(err => err);
            },

            validateField(field) {
                this.errors[field] = '';

                switch(field) {
                    case 'username':
                        if (this.form.username.length < 3) {
                            this.errors.username = 'Minimum 3 characters';
                        }
                        break;
                    case 'email':
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(this.form.email)) {
                            this.errors.email = 'Invalid email format';
                        }
                        break;
                    case 'confirmPassword':
                        if (this.form.password && this.form.password !== this.form.confirmPassword) {
                            this.errors.confirmPassword = 'Passwords do not match';
                        }
                        break;
                }
            },

            validatePassword() {
                const password = this.form.password;
                let strength = 0;

                if (password.length >= 8) strength++;
                if (/[A-Z]/.test(password)) strength++;
                if (/[a-z]/.test(password)) strength++;
                if (/[0-9]/.test(password)) strength++;
                if (/[^A-Za-z0-9]/.test(password)) strength++;

                if (strength <= 2) {
                    this.passwordStrength = { percentage: 33, level: 'weak', text: 'Weak', color: 'danger' };
                } else if (strength <= 3) {
                    this.passwordStrength = { percentage: 66, level: 'medium', text: 'Medium', color: 'warning' };
                } else {
                    this.passwordStrength = { percentage: 100, level: 'strong', text: 'Strong', color: 'success' };
                }

                this.validateField('confirmPassword');
            },

            getFieldClass(field) {
                return this.errors[field] ? 'is-invalid' : '';
            },

            async submitForm() {
                // Validate all fields
                this.validateField('username');
                this.validateField('email');
                this.validateField('confirmPassword');

                if (!this.isFormValid) {
                    return;
                }

                this.isSubmitting = true;

                try {
                    const response = await fetch('/api/register', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            username: this.form.username,
                            email: this.form.email,
                            password: this.form.password
                        })
                    });

                    const data = await response.json();

                    if (data.success) {
                        // Redirect to analytics
                        window.location.href = '/analytics';
                    } else {
                        this.errors.general = data.message || 'Registration failed';
                        console.error('Registration error:', data);
                    }
                } catch (error) {
                    this.errors.general = 'An error occurred during registration';
                    console.error('Error:', error);
                } finally {
                    this.isSubmitting = false;
                }
            }
        }
    }
</script>
</html>
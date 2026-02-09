<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <script nonce="<?php echo $nonce ?? ''; ?>">
        (function() {
            const theme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-bs-theme', theme);
        })();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forms - Bootstrap 5 Elements</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Bootstrap 5 form examples - form controls, validation, input groups and layouts">
    <meta name="keywords" content="bootstrap, forms, inputs, validation, controls, checkboxes, radio buttons">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/assets/favicon-CvUZKS4z.svg">
    <link rel="icon" type="image/png" href="/assets/favicon-B_cwPWBd.png">
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="/assets/manifest-DTaoG9pG.json">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Prism.js for syntax highlighting -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet">
    
    <!-- Custom syntax highlighting overrides -->
    <style>
        .element-code-block pre[class*="language-"] {
            background: #1e1e1e !important;
            border: 1px solid #333 !important;
            border-radius: 0.5rem !important;
            margin: 0 !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
        }
        
        .element-code-block code[class*="language-"] {
            background: transparent !important;
            color: #d4d4d4 !important;
            font-family: 'Fira Code', 'Courier New', monospace !important;
            font-size: 0.875rem !important;
            line-height: 1.6 !important;
        }
        
        /* VS Code inspired colors */
        .token.tag { color: #569cd6 !important; }
        .token.attr-name { color: #9cdcfe !important; }
        .token.attr-value { color: #ce9178 !important; }
        .token.string { color: #ce9178 !important; }
        .token.punctuation { color: #808080 !important; }
        .token.comment { color: #6a9955 !important; font-style: italic !important; }
        
        /* Bootstrap classes highlighting */
        .token.attr-value .token.string {
            background: linear-gradient(transparent 0%, transparent 100%);
        }

        /* Fix unreadable active+hover sidebar navigation */
        .nav-submenu .nav-link.active:hover {
            background-color: var(--bs-primary) !important;
            color: white !important;
            transform: translateX(2px) !important;
        }

        .nav-submenu .nav-link.active:hover i {
            opacity: 1 !important;
            color: white !important;
        }

        .sidebar-nav .nav .nav-link.active:hover {
            background-color: var(--bs-primary) !important;
            color: white !important;
            transform: none !important;
        }
    </style>
  <script type="module" crossorigin nonce="<?php echo $nonce ?? ''; ?>" src="/assets/vendor-bootstrap-C9iorZI5.js"></script>
  <script type="module" crossorigin nonce="<?php echo $nonce ?? ''; ?>" src="/assets/vendor-charts-DGwYAWel.js"></script>
  <script type="module" crossorigin nonce="<?php echo $nonce ?? ''; ?>" src="/assets/vendor-ui-CflGdlft.js"></script>
  <script type="module" crossorigin nonce="<?php echo $nonce ?? ''; ?>" src="/assets/main-DwHigVru.js"></script>
  <link rel="stylesheet" crossorigin href="/assets/main-QD_VOj1Y.css">
</head>

<body data-page="forms">


<div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="bi bi-person-plus me-2 text-success"></i>
                                        User Registration with Password Strength
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <form x-data="registrationForm()" @submit.prevent="submitForm()">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Username</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                    <input type="text" class="form-control" x-model="form.username" @input="validateField('username')" :class="getFieldClass('username')" placeholder="Enter username" required="">
                                                </div>
                                                <div class="invalid-feedback" x-show="errors.username" x-text="errors.username" style="display: none;"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Email</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                    <input type="email" class="form-control" x-model="form.email" @input="validateField('email')" :class="getFieldClass('email')" placeholder="Enter email" required="">
                                                </div>
                                                <div class="invalid-feedback" x-show="errors.email" x-text="errors.email" style="display: none;"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Password</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                                    <input :type="showPassword ? 'text' : 'password'" class="form-control" x-model="form.password" @input="validatePassword()" :class="getFieldClass('password')" placeholder="Enter password" required="">
                                                    <button type="button" class="btn btn-outline-secondary" @click="showPassword = !showPassword">
                                                        <i :class="showPassword ? 'bi-eye-slash' : 'bi-eye'" class=""></i>
                                                    </button>
                                                </div>
                                                <div class="invalid-feedback" x-show="errors.password" x-text="errors.password" style="display: none;"></div>
                                                
                                                <!-- Password Strength Indicator -->
                                                <div class="password-strength mt-2" x-show="form.password" style="display: none;">
                                                    <div class="strength-bar">
                                                        <div class="strength-fill" :class="passwordStrength.level" :style="`width: ${passwordStrength.percentage}%`" style=""></div>
                                                    </div>
                                                    <small :class="`text-${passwordStrength.color}`" x-text="`Password strength: ${passwordStrength.text}`" class=""></small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Confirm Password</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                                    <input type="password" class="form-control" x-model="form.confirmPassword" @input="validateField('confirmPassword')" :class="getFieldClass('confirmPassword')" placeholder="Confirm password" required="">
                                                </div>
                                                <div class="invalid-feedback" x-show="errors.confirmPassword" x-text="errors.confirmPassword" style="display: none;"></div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" x-model="form.agreeTerms" required="" value="">
                                                    <label class="form-check-label">
                                                        I agree to the <a href="#" class="text-primary">Terms of Service</a> and <a href="#" class="text-primary">Privacy Policy</a>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-success" :disabled="isSubmitting || !isFormValid">
                                                    <span x-show="!isSubmitting" style="display: none;">
                                                        <i class="bi bi-person-plus me-2"></i>Create Account
                                                    </span>
                                                    <span x-show="isSubmitting" style="display: none;">
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

<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
</style>

</body>


</html> 
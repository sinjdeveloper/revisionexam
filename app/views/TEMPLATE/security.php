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
    <title>Security & Authentication - Modern Bootstrap Admin</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Security settings, authentication, and access control management">
    <meta name="keywords" content="bootstrap, admin, dashboard, security, authentication, 2FA, access control">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/assets/favicon-CvUZKS4z.svg">
    <link rel="icon" type="image/png" href="/assets/favicon-B_cwPWBd.png">
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="/assets/manifest-DTaoG9pG.json">
    
    <!-- Preload critical fonts -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">  <script type="module" crossorigin nonce="<?php echo $nonce ?? ''; ?>" src="/assets/vendor-bootstrap-C9iorZI5.js"></script>
  <script type="module" crossorigin nonce="<?php echo $nonce ?? ''; ?>" src="/assets/vendor-charts-DGwYAWel.js"></script>
  <script type="module" crossorigin nonce="<?php echo $nonce ?? ''; ?>" src="/assets/vendor-ui-CflGdlft.js"></script>
  <script type="module" crossorigin nonce="<?php echo $nonce ?? ''; ?>" src="/assets/main-DwHigVru.js"></script>
  <script type="module" crossorigin nonce="<?php echo $nonce ?? ''; ?>" src="/assets/security-DHdfSIuE.js"></script>
  <link rel="stylesheet" crossorigin href="/assets/main-QD_VOj1Y.css">
</head>

<body data-page="security" class="security-page">
    <!-- Admin App Container -->
    <div class="admin-app">
        <div class="admin-wrapper" id="admin-wrapper">
            
            <?php include_once("inc/header.php") ; ?>
            <!-- Sidebar -->
            <aside class="admin-sidebar" id="admin-sidebar">
                <div class="sidebar-content">
                    <nav class="sidebar-nav">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="/TEMPLATE/dashboard">
                                    <i class="bi bi-speedometer2"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/TEMPLATE/analytics">
                                    <i class="bi bi-graph-up"></i>
                                    <span>Analytics</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/TEMPLATE/users">
                                    <i class="bi bi-people"></i>
                                    <span>Users</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/TEMPLATE/products">
                                    <i class="bi bi-box"></i>
                                    <span>Products</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/TEMPLATE/orders">
                                    <i class="bi bi-bag-check"></i>
                                    <span>Orders</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/TEMPLATE/forms">
                                    <i class="bi bi-ui-checks"></i>
                                    <span>Forms</span>
                                    <span class="badge bg-success rounded-pill ms-auto">New</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#elementsSubmenu" aria-expanded="false">
                                    <i class="bi bi-puzzle"></i>
                                    <span>Elements</span>
                                    <span class="badge bg-primary rounded-pill ms-2 me-2">New</span>
                                    <i class="bi bi-chevron-down ms-auto"></i>
                                </a>
                                <div class="collapse" id="elementsSubmenu">
                                    <ul class="nav nav-submenu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="/TEMPLATE/elements">
                                                <i class="bi bi-grid"></i>
                                                <span>Overview</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/TEMPLATE/elements/buttons">
                                                <i class="bi bi-square"></i>
                                                <span>Buttons</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/TEMPLATE/elements/alerts">
                                                <i class="bi bi-exclamation-triangle"></i>
                                                <span>Alerts</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/TEMPLATE/elements/badges">
                                                <i class="bi bi-award"></i>
                                                <span>Badges</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/TEMPLATE/elements/cards">
                                                <i class="bi bi-card-text"></i>
                                                <span>Cards</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/TEMPLATE/elements/modals">
                                                <i class="bi bi-window"></i>
                                                <span>Modals</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/TEMPLATE/elements/forms">
                                                <i class="bi bi-ui-checks"></i>
                                                <span>Forms</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/TEMPLATE/elements/tables">
                                                <i class="bi bi-table"></i>
                                                <span>Tables</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/TEMPLATE/reports">
                                    <i class="bi bi-file-earmark-text"></i>
                                    <span>Reports</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <?php
                                // index 13 = Security
                                $aside_indice = 13;
                                include_once("inc/aside-TEMPLATE.php");
                                ?>
                                        <div class="security-info">
                                            <h6>SMS Verification</h6>
                                            <small>Receive verification codes via text message</small>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="security-status" :class="securityData.twoFactor.sms ? 'enabled' : 'disabled'" x-text="securityData.twoFactor.sms ? 'Enabled' : 'Disabled'"></span>
                                            <button class="btn btn-outline-primary btn-sm" @click="setupSMSVerification()">
                                                <span x-show="!securityData.twoFactor.sms">Setup</span>
                                                <span x-show="securityData.twoFactor.sms">Manage</span>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="security-item">
                                        <div class="security-info">
                                            <h6>Backup Codes</h6>
                                            <small>Generate backup codes for account recovery</small>
                                        </div>
                                        <button class="btn btn-outline-secondary btn-sm" @click="generateBackupCodes()">
                                            Generate Codes
                                        </button>
                                    </div>
                                </div>

                                <!-- Sessions Management -->
                                <div x-show="activeSection === 'sessions'" class="security-section">
                                    <h5>Active Sessions</h5>
                                    <p>Manage and monitor your active login sessions</p>
                                    
                                    <template x-for="session in activeSessions" :key="session.id">
                                        <div class="session-item">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div class="flex-grow-1">
                                                    <div class="d-flex align-items-center gap-2 mb-2">
                                                        <i :class="session.deviceIcon" class="text-muted"></i>
                                                        <strong x-text="session.device"></strong>
                                                        <span class="badge bg-success ms-auto" x-show="session.current">Current</span>
                                                    </div>
                                                    <div class="small text-muted">
                                                        <div><i class="bi bi-geo-alt me-1"></i><span x-text="session.location"></span></div>
                                                        <div><i class="bi bi-clock me-1"></i>Last active: <span x-text="session.lastActive"></span></div>
                                                        <div><i class="bi bi-wifi me-1"></i>IP: <span x-text="session.ip"></span></div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-outline-danger btn-sm" 
                                                        @click="terminateSession(session.id)" 
                                                        x-show="!session.current">
                                                    Terminate
                                                </button>
                                            </div>
                                        </div>
                                    </template>
                                    
                                    <div class="mt-3">
                                        <button class="btn btn-danger" @click="terminateAllSessions()">
                                            <i class="bi bi-power me-2"></i>Terminate All Other Sessions
                                        </button>
                                    </div>
                                </div>

                                <!-- Privacy Controls -->
                                <div x-show="activeSection === 'privacy'" class="security-section">
                                    <h5>Privacy Controls</h5>
                                    <p>Control your privacy settings and data visibility</p>
                                    
                                    <div class="security-item">
                                        <div class="security-info">
                                            <h6>Profile Visibility</h6>
                                            <small>Control who can view your profile information</small>
                                        </div>
                                        <select class="form-select" style="width: auto;" x-model="securityData.privacy.profileVisibility">
                                            <option value="public">Public</option>
                                            <option value="team">Team Members Only</option>
                                            <option value="private">Private</option>
                                        </select>
                                    </div>
                                    
                                    <div class="security-item">
                                        <div class="security-info">
                                            <h6>Activity Status</h6>
                                            <small>Show when you're online to other users</small>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" x-model="securityData.privacy.showActivity">
                                        </div>
                                    </div>
                                    
                                    <div class="security-item">
                                        <div class="security-info">
                                            <h6>Data Collection</h6>
                                            <small>Allow collection of usage data for analytics</small>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" x-model="securityData.privacy.dataCollection">
                                        </div>
                                    </div>
                                </div>

                                <!-- Security Activity -->
                                <div x-show="activeSection === 'activity'" class="security-section">
                                    <h5>Recent Security Activity</h5>
                                    <p>Monitor recent security events and login attempts</p>
                                    
                                    <template x-for="activity in securityActivity" :key="activity.id">
                                        <div class="activity-item">
                                            <div :class="`activity-icon ${activity.type}`">
                                                <i :class="activity.icon"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1" x-text="activity.title"></h6>
                                                <small class="text-muted" x-text="activity.description"></small>
                                                <div class="small text-muted mt-1">
                                                    <i class="bi bi-clock me-1"></i><span x-text="activity.timestamp"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    
                                    <div class="text-center mt-3">
                                        <button class="btn btn-outline-secondary" @click="loadMoreActivity()">
                                            Load More Activity
                                        </button>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </main>

            <!-- Footer -->            <?php include_once("inc/header.php") ; ?>

        </div> <!-- /.admin-wrapper -->
    </div>

    <!-- Page-specific Component -->

    <!-- Main App Script -->

    <script nonce="<?php echo $nonce ?? ''; ?>">
      document.addEventListener('DOMContentLoaded', () => {
        const toggleButton = document.querySelector('[data-sidebar-toggle]');
        const wrapper = document.getElementById('admin-wrapper');

        if (toggleButton && wrapper) {
          const isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';
          if (isCollapsed) {
            wrapper.classList.add('sidebar-collapsed');
            toggleButton.classList.add('is-active');
          }

          toggleButton.addEventListener('click', () => {
            const isCurrentlyCollapsed = wrapper.classList.contains('sidebar-collapsed');
            
            if (isCurrentlyCollapsed) {
              wrapper.classList.remove('sidebar-collapsed');
              toggleButton.classList.remove('is-active');
              localStorage.setItem('sidebar-collapsed', 'false');
            } else {
              wrapper.classList.add('sidebar-collapsed');
              toggleButton.classList.add('is-active');
              localStorage.setItem('sidebar-collapsed', 'true');
            }
          });
        }
      });
    </script>
</body>
</html>
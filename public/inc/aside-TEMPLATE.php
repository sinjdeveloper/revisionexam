<!-- Sidebar -->
        <?php
        // Structure des entrées pour TEMPLATE
        $aside_items = [
            ['href' => '/TEMPLATE/dashboard', 'icon' => 'bi bi-speedometer2', 'title' => 'Dashboard', 'badge' => null],
            ['href' => '/TEMPLATE/analytics', 'icon' => 'bi bi-graph-up', 'title' => 'Analytics', 'badge' => null],
            ['href' => '/TEMPLATE/users', 'icon' => 'bi bi-people', 'title' => 'Users', 'badge' => null],
            ['href' => '/TEMPLATE/products', 'icon' => 'bi bi-box', 'title' => 'Products', 'badge' => null],
            ['href' => '/TEMPLATE/orders', 'icon' => 'bi bi-bag-check', 'title' => 'Orders', 'badge' => null],
            ['href' => '/TEMPLATE/forms', 'icon' => 'bi bi-ui-checks', 'title' => 'Forms', 'badge' => 'New', 'badge_class' => 'bg-success'],
            ['href' => '#', 'icon' => 'bi bi-puzzle', 'title' => 'Elements', 'badge' => 'New', 'badge_class' => 'bg-primary', 'collapse_id' => 'elementsSubmenu', 'children' => [
                ['href' => '/TEMPLATE/elements', 'icon' => 'bi bi-grid', 'title' => 'Overview'],
                ['href' => '/TEMPLATE/elements/buttons', 'icon' => 'bi bi-square', 'title' => 'Buttons'],
                ['href' => '/TEMPLATE/elements/alerts', 'icon' => 'bi bi-exclamation-triangle', 'title' => 'Alerts'],
                ['href' => '/TEMPLATE/elements/badges', 'icon' => 'bi bi-award', 'title' => 'Badges'],
                ['href' => '/TEMPLATE/elements/cards', 'icon' => 'bi bi-card-text', 'title' => 'Cards'],
                ['href' => '/TEMPLATE/elements/modals', 'icon' => 'bi bi-window', 'title' => 'Modals'],
                ['href' => '/TEMPLATE/elements/forms', 'icon' => 'bi bi-ui-checks', 'title' => 'Forms'],
                ['href' => '/TEMPLATE/elements/tables', 'icon' => 'bi bi-table', 'title' => 'Tables'],
            ]],
            ['href' => '/TEMPLATE/reports', 'icon' => 'bi bi-file-earmark-text', 'title' => 'Reports', 'badge' => null],
            ['href' => '/TEMPLATE/messages', 'icon' => 'bi bi-chat-dots', 'title' => 'Messages', 'badge' => '3', 'badge_class' => 'bg-danger'],
            ['href' => '/TEMPLATE/calendar', 'icon' => 'bi bi-calendar-event', 'title' => 'Calendar', 'badge' => null],
            ['href' => '/TEMPLATE/files', 'icon' => 'bi bi-folder2-open', 'title' => 'Files', 'badge' => null],
            // Admin section header will be rendered separately
            ['href' => '/TEMPLATE/settings', 'icon' => 'bi bi-gear', 'title' => 'Settings', 'badge' => null],
            ['href' => '/TEMPLATE/security', 'icon' => 'bi bi-shield-check', 'title' => 'Security', 'badge' => null],
            ['href' => '/TEMPLATE/help', 'icon' => 'bi bi-question-circle', 'title' => 'Help & Support', 'badge' => null],
        ];

        // Couleur de surbrillance par défaut
        $aside_highlight = $aside_highlight ?? '#6366f1';
        $aside_debug = isset($aside_debug) ? (bool)$aside_debug : false;
        $aside_indice = isset($aside_indice) ? (int)$aside_indice : null;
        $show_aside_numbers = !empty($show_aside_numbers) || $aside_debug;
        $missing_index_warning = ($aside_indice === null);
            // Current request path for automatic active detection
            $current_path = '/';
            if (!empty($_SERVER['REQUEST_URI'])) {
                $current_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: $_SERVER['REQUEST_URI'];
            }
        ?>

        <aside class="admin-sidebar" id="admin-sidebar">
            <div class="sidebar-content">
                <nav class="sidebar-nav">
                    <ul class="nav flex-column">
                        <?php foreach ($aside_items as $idx => $item):
                            // Render admin header before settings (detect by title)
                            if ($item['title'] === 'Settings'):
                        ?>
                        <li class="nav-item mt-3">
                            <small class="text-muted px-3 text-uppercase fw-bold">Admin</small>
                        </li>
                        <?php endif; ?>

                        <?php
                            $i = $idx + 1;
                            $is_highlight = ($aside_indice !== null && $aside_indice === $i);
                            $link_classes = 'nav-link' . ($is_highlight ? ' active' : '');
                            $link_style = $is_highlight ? "background-color: {$aside_highlight}; color: #ffffff;" : '';
                            $warning_dot = ($i === 1 && $missing_index_warning);
                        ?>

                        <li class="nav-item">
                            <?php if (!empty($item['children'])): ?>
                                <a class="<?php echo $link_classes; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#<?php echo $item['collapse_id']; ?>" aria-expanded="false" style="<?php echo $link_style; ?>">
                                    <i class="<?php echo $item['icon']; ?>"></i>
                                    <span><?php echo $item['title']; ?></span>
                                    <?php if (!empty($item['badge'])): ?>
                                        <span class="badge <?php echo $item['badge_class'] ?? 'bg-primary'; ?> rounded-pill ms-2 me-2"><?php echo $item['badge']; ?></span>
                                    <?php endif; ?>
                                    <i class="bi bi-chevron-down ms-auto"></i>
                                </a>
                                <div class="collapse" id="<?php echo $item['collapse_id']; ?>">
                                    <ul class="nav nav-submenu">
                                        <?php foreach ($item['children'] as $child): ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo $child['href']; ?>">
                                                    <i class="<?php echo $child['icon']; ?>"></i>
                                                    <span><?php echo $child['title']; ?></span>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php else: ?>
                                <a class="<?php echo $link_classes; ?>" href="<?php echo $item['href']; ?>" style="<?php echo $link_style; ?>">
                                    <!-- aside-index: <?php echo $idx + 1; ?> -->
                                    <i class="<?php echo $item['icon']; ?> me-2"></i>
                                    <span><?php echo $item['title']; ?></span>
                                    <?php if (!empty($item['badge'])): ?>
                                        <span class="badge <?php echo $item['badge_class'] ?? 'bg-primary'; ?> rounded-pill ms-auto"><?php echo $item['badge']; ?></span>
                                    <?php endif; ?>
                                    <?php if ($idx + 1 === 1 && $missing_index_warning): ?>
                                        <span title="aside index not set" style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#ff4d4f;margin-left:8px;"></span>
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>
                        </li>

                        <?php endforeach; ?>
                    </ul>
                </nav>
            </div>
        </aside>

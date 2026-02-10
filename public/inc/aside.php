            <!-- Sidebar -->
            <?php
            // Liste des entrées de l'aside — numérotation commençant à 1
            $aside_items = [
                ['href' => '/dashboard', 'icon' => 'bi bi-speedometer2', 'title' => 'Dashboard', 'badge' => null],
                ['href' => '/analytics', 'icon' => 'bi bi-graph-up', 'title' => 'Analytics', 'badge' => null],
                ['href' => '/users', 'icon' => 'bi bi-people', 'title' => 'Users', 'badge' => 'Active'],
                ['href' => '/products', 'icon' => 'bi bi-box', 'title' => 'Products', 'badge' => null],
                ['href' => '/orders', 'icon' => 'bi bi-bag-check', 'title' => 'Orders', 'badge' => null],
            ];

            // Couleur de surbrillance (hex / rgb / hsl équivalentes : #6366f1)
            $aside_highlight = $aside_highlight ?? '#6366f1';

            // Mode debug : définir $aside_debug = true avant l'include pour activer les aides de debug
            // Si non défini, par défaut false. On autorise aussi de le définir directement ici.
            $aside_debug = isset($aside_debug) ? (bool)$aside_debug : false;

            // L'utilisateur peut définir $aside_indice (int) avant l'include pour activer la surbrillance
            $aside_indice = isset($aside_indice) ? (int)$aside_indice : null;
            // Pour debug : afficher la numérotation visible (false par défaut)
            // Le mode debug force l'affichage des numéros si activé.
            $show_aside_numbers = !empty($show_aside_numbers) || $aside_debug;

            // Si aucun $aside_indice défini par le fichier qui inclut, afficher un indicateur
            // visuel (point rouge) sur la première entrée pour signaler le manque d'indexation.
            $missing_index_warning = ($aside_indice === null);
            ?>

            <aside class="admin-sidebar" id="admin-sidebar">
                <div class="sidebar-content">
                    <nav class="sidebar-nav">
                        <ul class="nav flex-column">
                            <?php foreach ($aside_items as $idx => $item):
                                $i = $idx + 1;
                                $is_highlight = ($aside_indice !== null && $aside_indice === $i);
                                $link_classes = 'nav-link' . ($is_highlight ? ' active' : '');
                                $link_style = $is_highlight ? "background-color: {$aside_highlight}; color: #ffffff;" : '';
                                $warning_dot = ($i === 1 && $missing_index_warning);
                            ?>
                            <li class="nav-item">
                                <a class="<?php echo $link_classes; ?>" href="<?php echo $item['href']; ?>" data-aside-index="<?php echo $i; ?>" style="<?php echo $link_style; ?>" <?php if ($is_highlight) echo 'aria-current="page"'; ?>>
                                    <?php if ($show_aside_numbers): ?>
                                        <span class="aside-index me-2" style="font-weight:600; opacity:.9"><?php echo $i; ?>.</span>
                                    <?php else: ?>
                                        <!-- aside-index: <?php echo $i; ?> -->
                                    <?php endif; ?>
                                    <i class="<?php echo $item['icon']; ?> me-2"></i>
                                    <span><?php echo $item['title']; ?></span>
                                    <?php if (!empty($item['badge'])): ?>
                                        <span class="badge bg-primary rounded-pill ms-auto"><?php echo $item['badge']; ?></span>
                                    <?php endif; ?>
                                    <?php if (!empty($warning_dot)): ?>
                                        <span title="aside index not set" style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#ff4d4f;margin-left:8px;"></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                </div>
            </aside>
            <!-- End Sidebar -->


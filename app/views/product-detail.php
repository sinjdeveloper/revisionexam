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
    <title>Fiche produit - <?php echo htmlspecialchars($product['nom'] ?? 'Produit'); ?></title>
    <link rel="manifest" href="/assets/manifest-DTaoG9pG.json">
    <script type="module" crossorigin nonce="<?php echo $nonce ?? ''; ?>" src="/assets/vendor-bootstrap-C9iorZI5.js"></script>
    <script type="module" crossorigin nonce="<?php echo $nonce ?? ''; ?>" src="/assets/main-DwHigVru.js"></script>
    <link rel="stylesheet" crossorigin href="/assets/main-QD_VOj1Y.css">
</head>

<body data-page="product-detail" class="product-detail-page">
    <div class="admin-app">
        <div class="admin-wrapper" id="admin-wrapper">
            <?php include_once("inc/header.php"); ?>
            <?php
            // highlight Products in the aside
            $aside_indice = 1; // Products = index 1 in inc/aside.php
            include_once("inc/aside.php");
            ?>

            <!-- Main Content -->
            <main class="admin-main">
                <div class="container-fluid p-4 p-lg-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h1 class="h3 mb-0"><?php echo htmlspecialchars($product['nom'] ?? 'Produit'); ?></h1>
                            <p class="text-muted mb-0"><?php echo htmlspecialchars($product['id_categorie_nom'] ?? ''); ?> — Propriétaire: <?php echo htmlspecialchars($product['proprietaire_nom'] ?? ''); ?></p>
                        </div>
                        <div class="d-flex gap-2">
                            <a class="btn btn-outline-secondary" href="/products">
                                <i class="bi bi-arrow-left"></i> Retour
                            </a>
                            <a class="btn btn-primary" href="#">
                                <i class="bi bi-phone me-1"></i> Contacter
                            </a>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-lg-5">
                            <div class="card">
                                <div class="card-body text-center">
                                    <img src="<?php echo htmlspecialchars($product['image'] ?? '/assets/product-placeholder.svg'); ?>" alt="<?php echo htmlspecialchars($product['nom'] ?? ''); ?>" class="img-fluid mb-3" style="max-height:360px;">
                                    <h4 class="fw-medium"><?php echo htmlspecialchars($product['nom'] ?? ''); ?></h4>
                                    <p class="text-muted mb-0">Réf: <?php echo htmlspecialchars($product['id'] ?? ''); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Description</h5>
                                    <p><?php echo nl2br(htmlspecialchars($product['description'] ?? '')); ?></p>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="mb-2 text-muted">Prix</div>
                                            <div class="fw-medium fs-5"><?php echo isset($product['prix']) ? number_format($product['prix'], 2, ',', ' ') . ' €' : '-'; ?></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2 text-muted">Disponibilité</div>
                                            <div class="fw-medium"><?php echo !empty($product['disponible']) ? 'Disponible' : 'Indisponible'; ?></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2 text-muted">Catégorie</div>
                                            <div class="fw-medium"><?php echo htmlspecialchars($product['id_categorie_nom'] ?? '-'); ?></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2 text-muted">Propriétaire</div>
                                            <div class="fw-medium"><?php echo htmlspecialchars($product['proprietaire_nom'] ?? '-'); ?></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2 text-muted">Statut</div>
                                            <div class="fw-medium"><?php echo htmlspecialchars($product['status_nom'] ?? '-'); ?></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2 text-muted">Créé le</div>
                                            <div class="fw-medium"><?php echo htmlspecialchars($product['created_at'] ?? '-'); ?></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <?php include_once("inc/footer.php"); ?>

        </div>
    </div>

    <script nonce="<?php echo $nonce ?? ''; ?>">
      // small interactive enhancements if needed
    </script>
</body>
</html>

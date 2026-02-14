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
    <title>Product Management - Modern Bootstrap Admin</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Comprehensive product management with inventory tracking, categories, and analytics">
    <meta name="keywords" content="bootstrap, admin, dashboard, products, inventory, e-commerce">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/assets/favicon-CvUZKS4z.svg">
    <link rel="icon" type="image/png" href="/assets/favicon-B_cwPWBd.png">
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="/assets/manifest-DTaoG9pG.json">
    
    <!-- Preload critical fonts -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- ApexCharts CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>  <script type="module" crossorigin nonce="<?php echo $nonce ?? ''; ?>" src="/assets/vendor-bootstrap-C9iorZI5.js"></script>
  <script type="module" crossorigin nonce="<?php echo $nonce ?? ''; ?>" src="/assets/vendor-charts-DGwYAWel.js"></script>
  <script type="module" crossorigin nonce="<?php echo $nonce ?? ''; ?>" src="/assets/vendor-ui-CflGdlft.js"></script>
  <script type="module" crossorigin nonce="<?php echo $nonce ?? ''; ?>" src="/assets/main-DwHigVru.js"></script>
  <script type="module" crossorigin nonce="<?php echo $nonce ?? ''; ?>" src="/assets/products-WhFVlziX.js"></script>
  <link rel="stylesheet" crossorigin href="/assets/main-QD_VOj1Y.css">
</head>

<body data-page="products" class="product-management">
    <!-- Admin App Container -->
    <div class="admin-app">
        <div class="admin-wrapper" id="admin-wrapper">
            
            <?php include_once("inc/header.php") ; ?>

            <?php include_once("inc/aside.php") ; ?>

            <!-- Floating Hamburger Menu -->
            <button class="hamburger-menu" 
                    type="button" 
                    data-sidebar-toggle
                    aria-label="Toggle sidebar">
                <i class="bi bi-list"></i>
            </button>

            <!-- Main Content -->
            <main class="admin-main">
                <div class="container-fluid p-4 p-lg-5">
                    
                    <!-- Page Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4 mb-lg-5">
                        <div>
                            <h1 class="h3 mb-0">Product Management</h1>
                            <p class="text-muted mb-0">Manage your product catalog and inventory</p>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary" @click="exportProducts()">
                                <i class="bi bi-download me-2"></i>Export
                            </button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#importModal">
                                <i class="bi bi-upload me-2"></i>Import
                            </button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal">
                                <i class="bi bi-plus-lg me-2"></i>Add Product
                            </button>
                        </div>
                    </div>

                    <!-- Product Management Container -->
                    <div x-data="productTable" x-init="init()">
                        
                        <!-- Product Stats Widgets -->
                        <div class="row g-4 g-lg-5 mb-5">



                        <!-- Products Table -->
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="card-title mb-0">Product Catalog</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="d-flex gap-2">
                                            <!-- Search -->
                                            <div class="position-relative">
                                                <input type="search" 
                                                       class="form-control form-control-sm" 
                                                       placeholder="Search products..."
                                                       x-model="searchQuery"
                                                       @input="filterProducts()"
                                                       style="width: 200px;">
                                                <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-2 text-muted"></i>
                                            </div>
                                            
                                            <!-- Category Filter -->
                                            <select class="form-select form-select-sm" 
                                                    x-model="categoryFilter" 
                                                    @change="filterProducts()"
                                                    style="width: 150px;">
                                                <option value="">All Categories</option>
                                                <option value="electronics">Electronics</option>
                                                <option value="clothing">Clothing</option>
                                                <option value="books">Books</option>
                                                <option value="home">Home & Garden</option>
                                            </select>
                                            
                                            <!-- Stock Filter -->
                                            <select class="form-select form-select-sm" 
                                                    x-model="stockFilter" 
                                                    @change="filterProducts()"
                                                    style="width: 150px;">
                                                <option value="">All Stock</option>
                                                <option value="in-stock">In Stock</option>
                                                <option value="low-stock">Low Stock</option>
                                                <option value="out-of-stock">Out of Stock</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <!-- Bulk Actions Bar -->
                                <div class="bulk-actions-bar p-3 bg-light border-bottom" x-show="selectedProducts.length > 0" x-transition>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">
                                            <span x-text="selectedProducts.length"></span> product(s) selected
                                        </span>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-sm btn-outline-secondary" @click="bulkAction('publish')">
                                                <i class="bi bi-eye me-1"></i>Publish
                                            </button>
                                            <button class="btn btn-sm btn-outline-secondary" @click="bulkAction('unpublish')">
                                                <i class="bi bi-eye-slash me-1"></i>Unpublish
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" @click="bulkAction('delete')">
                                                <i class="bi bi-trash me-1"></i>Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 40px;">
                                                    <input type="checkbox" 
                                                           class="form-check-input" 
                                                           @change="toggleAll($event.target.checked)"
                                                           :checked="selectedProducts.length === filteredProducts.length && filteredProducts.length > 0">
                                                </th>
                                                <th>Product</th>
                                                <th @click="sortBy('category')" class="sortable">Category</th>
                                                <!-- Price, Stock and Status columns removed -->
                                                <th @click="sortBy('created')" class="sortable">Échangé</th>
                                                <th style="width: 120px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-for="product in paginatedProducts" :key="product.id">
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" 
                                                               class="form-check-input" 
                                                               :value="product.id"
                                                               x-model="selectedProducts">
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img :src="product.image" 
                                                                 class="product-image me-3" 
                                                                 :alt="product.name">
                                                            <div>
                                                                <div class="fw-medium" x-text="product.name"></div>
                                                                <small class="text-muted" x-text="'SKU: ' + product.sku"></small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-light text-dark" x-text="product.category"></span>
                                                    </td>
                                                    <!-- price, stock and status cells removed -->
                                                    <td x-text="product.created"></td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                                                    type="button" 
                                                                    data-bs-toggle="dropdown">
                                                                <i class="bi bi-three-dots"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="#" @click="editProduct(product)">
                                                                    <i class="bi bi-pencil me-2"></i>Edit
                                                                </a></li>
                                                                <li><a class="dropdown-item" href="#" @click="viewProduct(product)">
                                                                    <i class="bi bi-eye me-2"></i>View Details
                                                                </a></li>
                                                                <li><a class="dropdown-item" href="#" @click="echangerProduct(product)">
                                                                    <i class="bi bi-copy me-2"></i>Duplicate
                                                                </a></li>
                                                                <li><hr class="dropdown-divider"></li>
                                                                <li><a class="dropdown-item text-danger" href="#" @click="deleteProduct(product)">
                                                                    <i class="bi bi-trash me-2"></i>Delete
                                                                </a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-between align-items-center p-3">
                                    <div class="text-muted">
                                        Showing <span x-text="(currentPage - 1) * itemsPerPage + 1"></span> to 
                                        <span x-text="Math.min(currentPage * itemsPerPage, filteredProducts.length)"></span> of 
                                        <span x-text="filteredProducts.length"></span> results
                                    </div>
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">
                                            <li class="page-item" :class="{ 'disabled': currentPage === 1 }">
                                                <a class="page-link" href="#" @click.prevent="goToPage(currentPage - 1)">Previous</a>
                                            </li>
                                            <template x-for="(page, index) in visiblePages" :key="`page-${index}`">
                                                <li class="page-item" :class="{ 'active': page === currentPage }">
                                                    <a class="page-link" href="#" @click.prevent="page !== '...' && goToPage(page)" x-text="page"></a>
                                                </li>
                                            </template>
                                            <li class="page-item" :class="{ 'disabled': currentPage === totalPages }">
                                                <a class="page-link" href="#" @click.prevent="goToPage(currentPage + 1)">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        
                    </div> <!-- End Product Management Container -->

                </div>
            </main>

            <!-- Footer -->            
            <?php include_once("inc/header.php") ; ?>

        </div> <!-- /.admin-wrapper -->
    </div>

    <!-- Product Modal (Add/Edit) -->
    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form x-data="productForm">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" x-model="form.name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">SKU</label>
                                <input type="text" class="form-control" x-model="form.sku" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Category</label>
                                <select class="form-select" x-model="form.category" required>
                                    <option value="">Select Category</option>
                                    <option value="electronics">Electronics</option>
                                    <option value="clothing">Clothing</option>
                                    <option value="books">Books</option>
                                    <option value="home">Home & Garden</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control" x-model="form.price" step="0.01" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Stock Quantity</label>
                                <input type="number" class="form-control" x-model="form.stock" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" x-model="form.description" rows="3"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select class="form-select" x-model="form.status" required>
                                    <option value="">Select Status</option>
                                    <option value="published">Published</option>
                                    <option value="draft">Draft</option>
                                    <option value="pending">Pending Review</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Product Image</label>
                                <input type="file" class="form-control" accept="image/*">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" @click="saveProduct()">Save Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Import Modal -->
    <div class="modal fade" id="importModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Products</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Upload JSON File</label>
                        <input type="file" class="form-control" accept=".json,application/json" id="importProductsFile">
                        <div class="form-text">Upload a JSON file (array of objects) with keys: name, sku, category, price, status</div>
                    </div>
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>JSON Format:</strong> [{ "name": "iPhone 14", "sku": "IPHONE14-128", "category": "electronics", "price": 799.99, "status": "published" }]<br>
                        <small>Example: an array of product objects as shown above.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="importProductsBtn">Import Products</button>
                </div>
            </div>
        </div>
    </div>

    <script nonce="<?php echo $nonce ?? ''; ?>">
    (function(){
        const modal = document.getElementById('importModal');
        if(!modal) return;
        const fileInput = document.getElementById('importProductsFile');
        const importBtn = document.getElementById('importProductsBtn');
        importBtn?.addEventListener('click', () => {
            const file = fileInput.files[0];
            if(!file){ alert('Please select a JSON file to import.'); return; }
            const reader = new FileReader();
            reader.onload = async (e) => {
                try {
                    const data = JSON.parse(e.target.result);
                    const res = await fetch('/api/import/products', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(data)
                    });
                    if(res.ok){
                        alert('Import successful');
                        // close modal
                        const bsClose = modal.querySelector('[data-bs-dismiss]');
                        bsClose && bsClose.click();
                    } else {
                        const txt = await res.text();
                        alert('Import failed: ' + txt);
                    }
                } catch(err){
                    alert('Invalid JSON file: ' + err.message);
                }
            };
            reader.readAsText(file);
        });
    })();
    </script>

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
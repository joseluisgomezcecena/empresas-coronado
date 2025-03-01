<div class="container mt-4">
    <h1 class="mb-4">Catálogo de Productos</h1>
    
    <!-- Search Form -->
    <div class="card mb-4">
        <div class="card-body">
            <form class="row g-3" method="get" action="<?php echo base_url('pages/search'); ?>">
                <div class="col-md-2">
                    <select class="form-select" id="brand-select" name="brand">
                        <option value="">Marca</option>
                        <?php foreach($brands as $brand): ?>
                            <option value="<?php echo $brand['id']; ?>" 
                                <?php echo ($selected_brand == $brand['id']) ? 'selected' : ''; ?>>
                                <?php echo $brand['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select" id="model-select" name="model" <?php echo empty($models) ? 'disabled' : ''; ?>>
                        <option value="">Modelo</option>
                        <?php foreach($models as $model): ?>
                            <option value="<?php echo $model['id']; ?>"
                                <?php echo ($selected_model == $model['id']) ? 'selected' : ''; ?>>
                                <?php echo $model['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="year">
                        <option value="">Año</option>
                        <?php 
                        $current_year = date('Y');
                        for($i = $current_year; $i >= 1990; $i--): 
                        ?>
                            <option value="<?php echo $i; ?>" 
                                <?php echo ($selected_year == $i) ? 'selected' : ''; ?>>
                                <?php echo $i; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-4 position-relative">
                    <input type="text" class="form-control" id="search-input" name="search" 
                        value="<?php echo $search_term; ?>" placeholder="Buscar Parte">
                    <div id="search-results" class="position-absolute w-100 bg-white shadow-sm" 
                        style="display:none; z-index: 1000; max-height: 300px; overflow-y: auto;"></div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark w-100">Buscar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
    <div class="col-md-3">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Categorías</h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <a href="<?php echo current_url(); ?>" class="list-group-item list-group-item-action <?php echo empty($selected_category) ? 'active' : ''; ?>">
                        Todas las categorías
                    </a>
                    <?php foreach($categories as $category): ?>
                        <a href="<?php echo add_query_param(current_url(), 'category', $category['category_id']); ?>" 
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?php echo ($selected_category == $category['category_id']) ? 'active' : ''; ?>">
                            <?php echo $category['category_name']; ?>
                            <span class="badge bg-secondary rounded-pill"><?php echo $category['product_count']; ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Section -->
    <div class="col-md-9">

        <div class="">
            <?php if(empty($products)): ?>
                <div class="col-12 text-center py-5">
                    <h3>No se encontraron productos</h3>
                    <p>No hay productos disponibles en este momento</p>
                </div>
            <?php else: ?>
                <?php foreach($products as $product): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <?php if(!empty($product['product_image'])): ?>
                                <img src="<?php echo base_url('uploads/products/' . $product['product_image']); ?>" 
                                    class="card-img-top" alt="<?php echo $product['product_name']; ?>"
                                    style="height: 200px; object-fit: cover;">
                            <?php else: ?>
                                <img src="<?php echo base_url('assets/images/no-image.png'); ?>" 
                                    class="card-img-top" alt="No Image"
                                    style="height: 200px; object-fit: cover;">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product['product_name']; ?></h5>
                                <p class="card-text">
                                    <small class="text-muted">Número de Parte: <?php echo $product['part_number']; ?></small><br>
                                    <small class="text-muted">Marca: <?php echo $product['brand_name']; ?></small><br>
                                    <small class="text-muted">Modelo: <?php echo $product['car_model']; ?></small>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="h5 mb-0">$<?php echo number_format($product['sale_price'], 2); ?></span>
                                    <span class="badge bg-success">En Stock</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="<?php echo base_url('producto/' . $product['id']); ?>" 
                                class="btn btn-dark btn-sm w-100">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                
                <!-- Pagination -->
                <div class="col-12 mt-4">
                    <div class="pagination-container">
                        <?php echo $pagination; ?>
                    </div>
                    <div class="text-center text-muted mt-2">
                        Mostrando <?php echo count($products); ?> de <?php echo $total_results; ?> productos
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const brandSelect = document.getElementById('brand-select');
    const modelSelect = document.getElementById('model-select');

    brandSelect.addEventListener('change', async function() {
        const brandId = this.value;
        modelSelect.disabled = true;
        modelSelect.innerHTML = '<option value="">Modelo</option>';

        if(brandId) {
            try {
                const response = await fetch('<?php echo base_url("pages/get_models"); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `brand_id=${brandId}`
                });
                
                if (!response.ok) throw new Error('Network response was not ok');
                
                const models = await response.json();
                
                models.forEach(model => {
                    const option = document.createElement('option');
                    option.value = model.id;
                    option.textContent = model.name;
                    modelSelect.appendChild(option);
                });
                
                modelSelect.disabled = false;
            } catch (error) {
                console.error('Error:', error);
            }
        }
    });
});
</script>


<script>
// Predictive search functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const searchResults = document.getElementById('search-results');
    let searchTimeout;

    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const term = this.value;
        
        if(term.length >= 3) {
            searchTimeout = setTimeout(async function() {
                try {
                    const response = await fetch('<?php echo base_url("pages/search_products"); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `term=${encodeURIComponent(term)}`
                    });
                    
                    if (!response.ok) throw new Error('Network response was not ok');
                    
                    const products = await response.json();
                    
                    if(products.length > 0) {
                        searchResults.innerHTML = products.map(product => `
                            <div class="p-2 search-item border-bottom" role="button" 
                                 onclick="selectProduct('${product.product_name.replace(/'/g, "\\'")}')">
                                ${product.product_name} - ${product.part_number}
                            </div>
                        `).join('');
                        searchResults.style.display = 'block';
                    } else {
                        searchResults.innerHTML = '<div class="p-2">No se encontraron resultados</div>';
                        searchResults.style.display = 'block';
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            }, 300);
        } else {
            searchResults.style.display = 'none';
        }
    });

    // Hide search results when clicking outside
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.style.display = 'none';
        }
    });

    // Function to select a product from search results
    window.selectProduct = function(productName) {
        searchInput.value = productName;
        searchResults.style.display = 'none';
    };
});
</script>

<style>
.search-item:hover {
    background-color: #f8f9fa;
    cursor: pointer;
}
</style>
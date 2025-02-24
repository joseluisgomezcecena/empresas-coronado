<div class="container mt-4">
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
                <div class="col-md-4">
                    <input type="text" class="form-control" name="search" 
                           value="<?php echo $search_term; ?>" placeholder="Buscar Parte">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark w-100">Buscar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Results Section -->
    <div class="row">
        <?php if(empty($products)): ?>
            <div class="col-12 text-center py-5">
                <h3>No se encontraron resultados</h3>
                <p>Intenta con otros términos de búsqueda</p>
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
                            <a href="<?php echo base_url('productos/detalle/' . $product['id']); ?>" 
                               class="btn btn-dark btn-sm w-100">Ver Detalles</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
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
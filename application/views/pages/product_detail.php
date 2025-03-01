<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('pages/search'); ?>">Catálogo</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $product['product_name']; ?></li>
        </ol>
    </nav>

    <div class="row">
        <!-- Product Image -->
        <div class="col-md-5 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <?php if(!empty($product['product_image'])): ?>
                        <img src="<?php echo base_url('uploads/products/' . $product['product_image']); ?>" 
                            class="img-fluid" alt="<?php echo $product['product_name']; ?>" 
                            style="max-height: 400px;">
                    <?php else: ?>
                        <img src="<?php echo base_url('assets/images/no-image.png'); ?>" 
                            class="img-fluid" alt="No Image" style="max-height: 400px;">
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Product Details -->
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h2 class="mb-0"><?php echo $product['product_name']; ?></h2>
                        
                        <!-- Social Share Buttons -->
                        <div class="share-buttons">
                            <div class="btn-group" role="group">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(current_url()); ?>" 
                                   class="btn btn-outline-primary" target="_blank" rel="noopener">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(current_url()); ?>&text=<?php echo urlencode('Mira este producto: ' . $product['product_name']); ?>" 
                                   class="btn btn-outline-info" target="_blank" rel="noopener">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://api.whatsapp.com/send?text=<?php echo urlencode('Mira este producto: ' . $product['product_name'] . ' ' . current_url()); ?>" 
                                   class="btn btn-outline-success" target="_blank" rel="noopener">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <p class="mb-1"><strong>Número de Parte:</strong> <?php echo $product['part_number']; ?></p>
                        <p class="mb-1"><strong>Marca:</strong> <?php echo $product['brand_name']; ?></p>
                        <p class="mb-1"><strong>Modelo:</strong> <?php echo $product['car_model']; ?></p>
                        
                        <?php if(!empty($product_years)): ?>
                            <p class="mb-1">
                                <strong>Años Compatibles:</strong> 
                                <?php 
                                sort($product_years);
                                
                                // Group consecutive years
                                $ranges = [];
                                $start = $product_years[0];
                                $prev = $start;
                                
                                for ($i = 1; $i <= count($product_years); $i++) {
                                    if ($i == count($product_years) || $product_years[$i] != $prev + 1) {
                                        if ($start == $prev) {
                                            $ranges[] = $start;
                                        } else {
                                            $ranges[] = $start . ' - ' . $prev;
                                        }
                                        if ($i < count($product_years)) {
                                            $start = $product_years[$i];
                                            $prev = $start;
                                        }
                                    } else {
                                        $prev = $product_years[$i];
                                    }
                                }
                                
                                echo implode(', ', $ranges);
                                ?>
                            </p>
                        <?php endif; ?>
                        
                        <p class="mb-1"><strong>Ubicación:</strong> <?php echo $product['location']; ?></p>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-6">
                            <h3 class="text-primary mb-0">$<?php echo number_format($product['sale_price'], 2); ?></h3>
                            <small class="text-muted">Precio sugerido: $<?php echo number_format($product['suggested_price'], 2); ?></small>
                        </div>
                        <div class="col-6 text-right">
                            <?php if($product['current_stock'] > 0): ?>
                                <span class="badge bg-success p-2">En Stock (<?php echo $product['current_stock']; ?>)</span>
                            <?php else: ?>
                                <span class="badge bg-danger p-2">Agotado</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="https://wa.me/+52123456789?text=Hola, estoy interesado en el producto: <?php echo urlencode($product['product_name'] . ' (' . $product['part_number'] . ')'); ?>" 
                           class="btn btn-success btn-lg" target="_blank">
                            <i class="fa fa-whatsapp me-2"></i> Contactar por WhatsApp
                        </a>
                        <a href="tel:+52123456789" class="btn btn-outline-dark btn-lg">
                            <i class="fa fa-phone me-2"></i> Llamar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Similar Products -->
    <?php if(!empty($similar_products)): ?>
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="mb-4">Productos Similares</h3>
        </div>
        
        <?php foreach($similar_products as $similar): ?>
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <?php if(!empty($similar['product_image'])): ?>
                    <img src="<?php echo base_url('uploads/products/' . $similar['product_image']); ?>" 
                         class="card-img-top" alt="<?php echo $similar['product_name']; ?>"
                         style="height: 150px; object-fit: cover;">
                <?php else: ?>
                    <img src="<?php echo base_url('assets/images/no-image.png'); ?>" 
                         class="card-img-top" alt="No Image"
                         style="height: 150px; object-fit: cover;">
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $similar['product_name']; ?></h5>
                    <p class="card-text">
                        <small class="text-muted">Número de Parte: <?php echo $similar['part_number']; ?></small>
                    </p>
                    <p class="h5 text-primary mb-2">$<?php echo number_format($similar['sale_price'], 2); ?></p>
                </div>
                <div class="card-footer">
                    <a href="<?php echo base_url('producto/' . $similar['id']); ?>" 
                       class="btn btn-dark btn-sm w-100">Ver Detalles</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
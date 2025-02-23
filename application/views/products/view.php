<div class="page-header">
    <h2 class="header-title">Detalles del Producto</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>admin" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="<?php echo base_url("products") ?>">Productos</a>
            <span class="breadcrumb-item active">Detalles del Producto</span>
        </nav>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <h4><?php echo $product['product_name']; ?></h4>
            </div>
            <div class="col-md-6 text-right">
                <a href="<?php echo base_url("products/update/".$product['id']) ?>" class="btn btn-primary">
                    <i class="anticon anticon-edit"></i> Editar
                </a>
                <a href="<?php echo base_url("products/delete/".$product['id']) ?>" class="btn btn-danger">
                    <i class="anticon anticon-delete"></i> Eliminar
                </a>
                <a href="<?php echo base_url("products") ?>" class="btn btn-default">
                    <i class="anticon anticon-rollback"></i> Volver
                </a>
            </div>
        </div>

        <!-- echo flash messages -->
        <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Operación exitosa!</strong> <?php echo $this->session->flashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>

        <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error</strong> <?php echo $this->session->flashdata('error'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>

        <div class="row">
    <!-- Left column with image -->
    <div class="col-md-4 text-center mb-4">
        <?php if (!empty($product['product_image'])) : ?>
            <img src="<?php echo base_url('uploads/products/' . $product['product_image']); ?>" alt="<?php echo $product['product_name']; ?>" class="img-fluid" style="max-height: 250px;">
        <?php else : ?>
            <img src="<?php echo base_url('assets/images/no-image.png'); ?>" alt="No Image" class="img-fluid" style="max-height: 250px;">
        <?php endif; ?>
    </div>
    <!-- Right column with details -->
    <div class="col-md-8">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="width: 30%;">Número de Parte</th>
                        <td><?php echo $product['part_number']; ?></td>
                    </tr>
                    <tr>
                        <th>Nombre del Producto</th>
                        <td><?php echo $product['product_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Marca de Auto</th>
                        <td><?php echo $product['car_brand']; ?></td>
                    </tr>
                    <tr>
                        <th>Modelo de Auto</th>
                        <td><?php echo $product['car_model']; ?></td>
                    </tr>
                    <tr>
                        <th>Ubicación</th>
                        <td><?php echo $product['location']; ?></td>
                    </tr>
                    <tr>
                        <th>Inventario Actual</th>
                        <td>
                            <strong><?php echo $product['current_stock']; ?></strong>
                            <a href="<?php echo base_url("inventory/movements/".$product['id']) ?>" class="btn btn-sm btn-info ml-2">
                                Ver Movimientos
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Precio de Compra</th>
                        <td>$<?php echo number_format($product['purchase_price'], 2); ?></td>
                    </tr>
                    <tr>
                        <th>Precio de Venta</th>
                        <td>$<?php echo number_format($product['sale_price'], 2); ?></td>
                    </tr>
                    <tr>
                        <th>Precio Sugerido</th>
                        <td>$<?php echo number_format($product['suggested_price'], 2); ?></td>
                    </tr>
                    <tr>
                        <th>Margen de Ganancia</th>
                        <td>
                            <?php 
                            $margin = $product['sale_price'] - $product['purchase_price'];
                            $margin_percentage = ($margin / $product['purchase_price']) * 100;
                            echo '$' . number_format($margin, 2) . ' (' . number_format($margin_percentage, 2) . '%)';
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Años Compatibles</th>
                        <td>
                            <?php 
                            if (!empty($product_years)) {
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
                            } else {
                                echo 'Sin años especificados';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Categorías</th>
                        <td>
                            <?php 
                            $category_names = array();
                            foreach ($product_categories as $cat_id) {
                                foreach ($this->Categories_model->get_categories() as $category) {
                                    if ($category['category_id'] == $cat_id) {
                                        $category_names[] = $category['category_name'];
                                        break;
                                    }
                                }
                            }
                            echo !empty($category_names) ? implode(', ', $category_names) : 'Sin categorías';
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Fecha de Creación</th>
                        <td><?php echo date('d/m/Y H:i', strtotime($product['created_at'])); ?></td>
                    </tr>
                    <tr>
                        <th>Última Actualización</th>
                        <td><?php echo date('d/m/Y H:i', strtotime($product['updated_at'])); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div
    </div>
</div>
<div class="page-header">
    <h2 class="header-title">Productos</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>admin" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <span class="breadcrumb-item active">Productos</span>
        </nav>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <h4>Lista de Productos</h4>
            </div>
            <div class="col-md-6 text-right">
                <a href="<?php echo base_url("products/create") ?>" class="btn btn-primary">
                    <i class="anticon anticon-plus"></i> Nuevo Producto
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

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Número de Parte</th>
                        <th>Producto</th>
                        <th>Marca / Modelo</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                        <th>Precio Sugerido</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products)) : ?>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td>
                                    <?php if (!empty($product['product_image'])) : ?>
                                        <img src="<?php echo base_url('assets/uploads/products/' . $product['product_image']); ?>" alt="<?php echo $product['product_name']; ?>" width="50">
                                    <?php else : ?>
                                        <img src="<?php echo base_url('assets/images/no-image.png'); ?>" alt="No Image" width="50">
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $product['part_number']; ?></td>
                                <td><?php echo $product['product_name']; ?></td>
                                <td><?php echo $product['car_brand'] . ' / ' . $product['car_model']; ?></td>
                                <td>$<?php echo number_format($product['purchase_price'], 2); ?></td>
                                <td>$<?php echo number_format($product['sale_price'], 2); ?></td>
                                <td>$<?php echo number_format($product['suggested_price'], 2); ?></td>
                                <td>
                                    <a href="<?php echo base_url('products/view/' . $product['id']); ?>" class="btn btn-sm btn-info" title="Ver">
                                        <i class="anticon anticon-eye"></i>
                                    </a>
                                    <a href="<?php echo base_url('products/update/' . $product['id']); ?>" class="btn btn-sm btn-primary" title="Editar">
                                        <i class="anticon anticon-edit"></i>
                                    </a>
                                    <a href="<?php echo base_url('products/delete/' . $product['id']); ?>" class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="anticon anticon-delete"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="8" class="text-center">No hay productos registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
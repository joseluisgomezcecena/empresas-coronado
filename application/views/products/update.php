<div class="page-header">
    <h2 class="header-title">Actualizar Producto</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>admin" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="<?php echo base_url("products") ?>">Productos</a>
            <span class="breadcrumb-item active">Actualizar Producto</span>
        </nav>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h4>Información del Producto</h4>
        <div class="m-t-25">

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

            <form action="<?php echo base_url("products/update/".$product['id']) ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="part_number">Número de Parte</label>
                        <input type="text" class="form-control" id="part_number" name="part_number" placeholder="Número de Parte" value="<?php echo set_value('part_number', $product['part_number']); ?>">
                        <?php echo form_error('part_number', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="car_brand">Marca de Auto</label>
                        <input type="text" class="form-control" id="car_brand" name="car_brand" placeholder="Marca de Auto" value="<?php echo set_value('car_brand', $product['car_brand']); ?>">
                        <?php echo form_error('car_brand', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="car_model">Modelo de Auto</label>
                        <input type="text" class="form-control" id="car_model" name="car_model" placeholder="Modelo de Auto" value="<?php echo set_value('car_model', $product['car_model']); ?>">
                        <?php echo form_error('car_model', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="product_name">Nombre del Producto</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Nombre del Producto" value="<?php echo set_value('product_name', $product['product_name']); ?>">
                        <?php echo form_error('product_name', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="purchase_price">Precio de Compra</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" step="0.01" class="form-control" id="purchase_price" name="purchase_price" placeholder="0.00" value="<?php echo set_value('purchase_price', $product['purchase_price']); ?>">
                        </div>
                        <?php echo form_error('purchase_price', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="sale_price">Precio de Venta</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" step="0.01" class="form-control" id="sale_price" name="sale_price" placeholder="0.00" value="<?php echo set_value('sale_price', $product['sale_price']); ?>">
                        </div>
                        <?php echo form_error('sale_price', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="suggested_price">Precio Sugerido</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" step="0.01" class="form-control" id="suggested_price" name="suggested_price" placeholder="0.00" value="<?php echo set_value('suggested_price', $product['suggested_price']); ?>">
                        </div>
                        <?php echo form_error('suggested_price', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="category_id">Categorías</label>
                        <select class="form-control select2" id="category_id" name="category_id[]" multiple>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?php echo $category['category_id']; ?>" 
                                    <?php echo (in_array($category['category_id'], $product_categories)) ? 'selected' : ''; ?>>
                                    <?php echo $category['category_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php echo form_error('category_id[]', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="product_image">Imagen del Producto</label>
                        <?php if (!empty($product['product_image'])) : ?>
                            <div class="mb-2">
                                <img src="<?php echo base_url('assets/uploads/products/' . $product['product_image']); ?>" alt="<?php echo $product['product_name']; ?>" width="100">
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control-file" id="product_image" name="product_image">
                        <small class="form-text text-muted">Formatos permitidos: jpg, jpeg, png, gif. Tamaño máximo: 2MB</small>
                        <small class="form-text text-muted">Deje en blanco para mantener la imagen actual</small>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                        <a href="<?php echo base_url("products") ?>" class="btn btn-default">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2({
        placeholder: "Seleccione las categorías"
    });
});
</script>
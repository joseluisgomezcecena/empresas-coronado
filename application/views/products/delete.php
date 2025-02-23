<div class="page-header">
    <h2 class="header-title">Eliminar Producto</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>admin" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="<?php echo base_url("products") ?>">Productos</a>
            <span class="breadcrumb-item active">Eliminar Producto</span>
        </nav>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h4>¿Está seguro que desea eliminar este producto?</h4>
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

            <div class="alert alert-warning">
                <p>Esta acción no se puede deshacer. Se eliminará permanentemente el producto: <strong><?php echo $product['product_name']; ?></strong> (Número de Parte: <?php echo $product['part_number']; ?>)</p>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <?php if (!empty($product['product_image'])) : ?>
                                <img src="<?php echo base_url('uploads/products/' . $product['product_image']); ?>" alt="<?php echo $product['product_name']; ?>" class="img-fluid">
                            <?php else : ?>
                                <img src="<?php echo base_url('assets/images/no-image.png'); ?>" alt="No Image" class="img-fluid">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-10">
                            <h5><?php echo $product['product_name']; ?></h5>
                            <p><strong>Marca / Modelo:</strong> <?php echo $product['car_brand'] . ' / ' . $product['car_model']; ?></p>
                            <p><strong>Número de Parte:</strong> <?php echo $product['part_number']; ?></p>
                            <p><strong>Precio de Venta:</strong> $<?php echo number_format($product['sale_price'], 2); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <form action="<?php echo base_url("products/delete/".$product['id']) ?>" method="post">
                <div class="row">
                    <div class="form-group col-lg-12">
                        <input type="hidden" name="confirm_delete" value="1">
                        <button type="submit" class="btn btn-danger">Eliminar Permanentemente</button>
                        <a href="<?php echo base_url("products") ?>" class="btn btn-default">Cancelar</a>
                    </div>
                </div>    
            </form>
        </div>
    </div>
</div>
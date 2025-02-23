<div class="page-header">
    <h2 class="header-title">Movimientos de Inventario</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>admin" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="<?php echo base_url("products") ?>">Productos</a>
            <span class="breadcrumb-item active">Movimientos de Inventario</span>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-4">
            <div class="col">
                <h4><?php echo $product['product_name']; ?> (<?php echo $product['part_number']; ?>)</h4>
                <p class="mb-0">
                    Ubicación: <?php echo $product['location']; ?><br>
                    Stock Actual: <strong><?php echo $inventory['total_entradas'] - $inventory['total_salidas']; ?></strong>
                </p>
            </div>
            <div class="col text-right">
                <a href="<?php echo base_url("inventory/add_movement/".$product['id']) ?>" class="btn btn-primary">
                    <i class="anticon anticon-plus"></i> Nuevo Movimiento
                </a>
                <a href="<?php echo base_url("products/view/".$product['id']) ?>" class="btn btn-default">
                    <i class="anticon anticon-rollback"></i> Volver al Producto
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
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Cantidad</th>
                        <th>Motivo</th>
                        <th>Descripción</th>
                        <th>Registrado por</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($movements)) : ?>
                        <?php foreach ($movements as $movement) : ?>
                            <tr>
                                <td><?php echo date('d/m/Y H:i', strtotime($movement['created_at'])); ?></td>
                                <td>
                                    <?php if ($movement['movement_type'] === 'entrada') : ?>
                                        <span class="badge badge-success">Entrada</span>
                                    <?php else : ?>
                                        <span class="badge badge-danger">Salida</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $movement['quantity']; ?></td>
                                <td><?php echo ucfirst(str_replace('_', ' ', $movement['reason'])); ?></td>
                                <td><?php echo $movement['description']; ?></td>
                                <td><?php echo $movement['created_by_user']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center">No hay movimientos registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="page-header">
    <h2 class="header-title">Agregar Movimiento de Inventario</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>admin" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="<?php echo base_url("products") ?>">Productos</a>
            <a class="breadcrumb-item" href="<?php echo base_url("inventory/movements/".$product['id']) ?>">Movimientos de Inventario</a>
            <span class="breadcrumb-item active">Agregar Movimiento</span>
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
                    Stock Actual: <strong><?php 
                        $current_stock = $this->Inventory_model->get_current_stock($product['id']);
                        echo $current_stock; 
                    ?></strong>
                </p>
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

        <form action="<?php echo base_url("inventory/add_movement/".$product['id']) ?>" method="post">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="movement_type">Tipo de Movimiento</label>
                    <select class="form-control" id="movement_type" name="movement_type" required>
                        <option value="">Seleccione el tipo de movimiento</option>
                        <option value="entrada" <?php echo set_select('movement_type', 'entrada'); ?>>Entrada</option>
                        <option value="salida" <?php echo set_select('movement_type', 'salida'); ?>>Salida</option>
                    </select>
                    <?php echo form_error('movement_type', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="form-group col-md-4">
                    <label for="quantity">Cantidad</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" min="1" required 
                           value="<?php echo set_value('quantity'); ?>" placeholder="Cantidad">
                    <?php echo form_error('quantity', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="form-group col-md-4">
                    <label for="reason">Motivo</label>
                    <select class="form-control" id="reason" name="reason" required>
                        <option value="">Seleccione el motivo</option>
                        <!-- Los motivos se cargarán dinámicamente con JavaScript -->
                    </select>
                    <?php echo form_error('reason', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="form-group col-md-12">
                    <label for="description">Descripción (Opcional)</label>
                    <textarea class="form-control" id="description" name="description" rows="3" 
                              placeholder="Agregue una descripción opcional"><?php echo set_value('description'); ?></textarea>
                    <?php echo form_error('description', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary">Guardar Movimiento</button>
                    <a href="<?php echo base_url("inventory/movements/".$product['id']) ?>" class="btn btn-default">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the select elements
    const movementTypeSelect = document.getElementById('movement_type');
    const reasonSelect = document.getElementById('reason');
    
    // Define the reasons
    const reasons = {
        entrada: <?php echo json_encode($entrada_reasons); ?>,
        salida: <?php echo json_encode($salida_reasons); ?>
    };
    
    // Function to update reasons based on movement type
    function updateReasons() {
        const selectedType = movementTypeSelect.value;
        reasonSelect.innerHTML = '<option value="">Seleccione el motivo</option>';
        
        if (selectedType && reasons[selectedType]) {
            reasons[selectedType].forEach(function(reason) {
                const option = document.createElement('option');
                option.value = reason.reason;
                option.textContent = reason.reason.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                reasonSelect.appendChild(option);
            });
        }
    }
    
    // Add event listener for movement type change
    movementTypeSelect.addEventListener('change', updateReasons);
    
    // Initialize reasons on page load
    updateReasons();
    
    // Handle form submission
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const quantity = parseInt(document.getElementById('quantity').value);
        const type = document.getElementById('movement_type').value;
        const currentStock = <?php echo $current_stock; ?>;
        
        if (type === 'salida' && quantity > currentStock) {
            e.preventDefault();
            alert('No hay suficiente stock disponible. Stock actual: ' + currentStock);
        }
    });
});
</script>
<script type="text/javascript">
    console.log('View file loaded');
</script>
<div class="page-header">
    <h2 class="header-title">Nuevo Producto</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>admin" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="<?php echo base_url("products") ?>">Productos</a>
            <span class="breadcrumb-item active">Nuevo Producto</span>
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

            <form action="<?php echo base_url("products/create") ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="part_number">Número de Parte</label>
                        <input type="text" class="form-control" id="part_number" name="part_number" placeholder="Número de Parte" value="<?php echo set_value('part_number'); ?>">
                        <?php echo form_error('part_number', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    
                    <!--
                    <div class="form-group col-md-4">
                        <label for="car_brand">Marca de Auto</label>
                        <input type="text" class="form-control" id="car_brand" name="car_brand" placeholder="Marca de Auto" value="<?php echo set_value('car_brand'); ?>">
                        <?php echo form_error('car_brand', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="car_model">Modelo de Auto</label>
                        <input type="text" class="form-control" id="car_model" name="car_model" placeholder="Modelo de Auto" value="<?php echo set_value('car_model'); ?>">
                        <?php echo form_error('car_model', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    -->
                    <div class="form-group col-md-4">
    <label for="car_brand">Marca de Auto</label>
    <select class="form-control" id="car_brand" name="car_brand" required>
        <option value="">Seleccione una marca</option>
        <?php foreach ($brands as $brand): ?>
            <option value="<?php echo $brand['id']; ?>" <?php echo set_select('car_brand', $brand['id']); ?>>
                <?php echo $brand['name']; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <?php echo form_error('car_brand', '<div class="text-danger">', '</div>'); ?>
</div>

<div class="form-group col-md-4">
    <label for="car_model">Modelo de Auto</label>
    <select class="form-control" id="car_model" name="car_model" required disabled>
        <option value="">Seleccione un modelo</option>
    </select>
    <?php echo form_error('car_model', '<div class="text-danger">', '</div>'); ?>
</div>
                    
                    <div class="form-group col-md-12">
                        <label for="product_name">Nombre del Producto</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Nombre del Producto" value="<?php echo set_value('product_name'); ?>">
                        <?php echo form_error('product_name', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    
 

                    
                    <div class="form-group col-md-4">
                        <label for="purchase_price">Precio de Compra</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" step="0.01" class="form-control" id="purchase_price" name="purchase_price" placeholder="0.00" value="<?php echo set_value('purchase_price'); ?>">
                        </div>
                        <?php echo form_error('purchase_price', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="sale_price">Precio de Venta</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" step="0.01" class="form-control" id="sale_price" name="sale_price" placeholder="0.00" value="<?php echo set_value('sale_price'); ?>">
                        </div>
                        <?php echo form_error('sale_price', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="suggested_price">Precio Sugerido</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" step="0.01" class="form-control" id="suggested_price" name="suggested_price" placeholder="0.00" value="<?php echo set_value('suggested_price'); ?>">
                        </div>
                        <?php echo form_error('suggested_price', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="category_id">Categorías</label>
                        <select class="form-control select2" id="category_id" name="category_id[]" multiple>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?php echo $category['category_id']; ?>" <?php echo set_select('category_id[]', $category['category_id']); ?>><?php echo $category['category_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php echo form_error('category_id[]', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="product_image">Imagen del Producto</label>
                        <input type="file" class="form-control-file" id="product_image" name="product_image">
                        <small class="form-text text-muted">Formatos permitidos: jpg, jpeg, png, gif. Tamaño máximo: 2MB</small>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="years">Años Compatibles</label>
                        <div class="years-container">
                            <div class="year-row">
                                <div class="input-group">
                                    <input type="number" class="form-control" name="years[]" placeholder="Año" min="1900" max="<?php echo date('Y') + 1; ?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-danger remove-year-btn" type="button">
                                            <i class="anticon anticon-close"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-secondary add-year-btn mt-2">
                            <i class="anticon anticon-plus"></i> Agregar otro año
                        </button>
                        <small class="form-text text-muted">Agregue los años para los que este producto es compatible.</small>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="years">Cantidad Inicial</label>
                        <input type="number" class="form-control" id="qty" name="qty" placeholder="Cantidad Inicial" value="<?php echo set_value('qty'); ?>">
                        <?php echo form_error('initial_quantity', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="location">Ubicación</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Ubicación" value="<?php echo set_value('location'); ?>">
                        <?php echo form_error('location', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary">Guardar Producto</button>
                        <a href="<?php echo base_url("products") ?>" class="btn btn-default">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
// Wait for document to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Select2 if it exists
    if ($.fn.select2) {
        $('.select2').select2({
            placeholder: "Seleccione las categorías"
        });
    }
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the containers and buttons
    const yearsContainer = document.querySelector('.years-container');
    const addYearBtn = document.querySelector('.add-year-btn');

    // Function to create a new year input row
    function createYearRow() {
        const yearRow = document.createElement('div');
        yearRow.className = 'year-row';
        yearRow.innerHTML = `
            <div class="input-group mt-2">
                <input type="number" class="form-control" name="years[]" placeholder="Año" 
                       min="1900" max="${new Date().getFullYear() + 1}">
                <div class="input-group-append">
                    <button class="btn btn-danger remove-year-btn" type="button">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
            </div>
        `;
        return yearRow;
    }

    // Add new year field
    addYearBtn.addEventListener('click', function() {
        const newRow = createYearRow();
        yearsContainer.appendChild(newRow);
    });

    // Remove year field using event delegation
    yearsContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-year-btn') || 
            e.target.closest('.remove-year-btn')) {
            const yearRow = e.target.closest('.year-row');
            const totalYears = yearsContainer.querySelectorAll('.year-row').length;
            
            if (totalYears > 1) {
                yearRow.remove();
            } else {
                // If it's the last field, just clear the value
                yearRow.querySelector('input').value = '';
            }
        }
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const brandSelect = document.getElementById('car_brand');
    const modelSelect = document.getElementById('car_model');
    
    // Function to load models for a brand
    async function loadModels(brandId, selectedModel = null) {
        if (!brandId) {
            modelSelect.innerHTML = '<option value="">Seleccione un modelo</option>';
            modelSelect.disabled = true;
            return;
        }

        try {
            const response = await fetch(`<?php echo base_url('products/get_models_by_brand/'); ?>${brandId}`);
            if (!response.ok) throw new Error('Network response was not ok');
            
            const models = await response.json();
            
            let options = '<option value="">Seleccione un modelo</option>';
            models.forEach(model => {
                const selected = selectedModel && selectedModel == model.name ? 'selected' : '';
                options += `<option value="${model.name}" ${selected}>${model.name}</option>`;
            });
            
            modelSelect.innerHTML = options;
            modelSelect.disabled = false;
        } catch (error) {
            console.error('Error loading models:', error);
            modelSelect.innerHTML = '<option value="">Error cargando modelos</option>';
            modelSelect.disabled = true;
        }
    }

    // Handle brand selection change
    brandSelect.addEventListener('change', function() {
        loadModels(this.value);
    });

    // Initial load if brand is selected (for edit form)
    <?php if(isset($product) && $product['car_brand']): ?>
    // Find the brand ID for the current product's brand
    const brandOptions = Array.from(brandSelect.options);
    const currentBrand = brandOptions.find(option => option.textContent.trim() === '<?php echo $product['car_brand']; ?>');
    if (currentBrand) {
        currentBrand.selected = true;
        loadModels(currentBrand.value, '<?php echo $product['car_model']; ?>');
    }
    <?php endif; ?>
});
</script>
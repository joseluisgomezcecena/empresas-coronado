<div class="page-header">
    <h2 class="header-title">Propiedades</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>admin" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="#">Propiedades</a>
            <span class="breadcrumb-item active">Eliminar</span>
        </nav>
    </div>
    <!--button that floats to the right-->
    
</div>
<form action="<?php echo base_url("properties/delete/" . $property['property_id']) ?>" method="post" id="myForm">

<div class="row">
    <div class="col-lg-12">
    <div class="card mt-5">
        <div class="card-body">

            <!-- echo flash messages -->
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Operación exitosa!</strong> <?php echo $this->session->flashdata('success'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>

            <?php 
            
        
            echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            ?>

                <div class="container">
                    <h2 class="mb-5">Eliminar <?php echo $property['title']; ?></h2>
                   
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="title">Titulo de la publicación</label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Titulo"
                                    value="<?php echo $property['title']; ?>" 
                                    disabled>
                                    <?php echo form_error('title', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>


                          

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="category">Tipo de Propiedad</label>
                                    <select class="form-control" name="category" id="category" disabled>
                                        <option value="">Seleccione una categoria</option>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?php echo $category['category_id']; ?>"  <?php echo ($category['category_id'] == $property['category']) ? 'selected' : ''; ?>>
                                                <?php echo $category['category_name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php echo form_error('category', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>

                            
                        </div>
                        
                        <button type="submit" class="btn btn-danger mt-5">Eliminar</button>
                   
                </div>
        
        </div>
    </div>
    </div>
    

    

</div>
</form>


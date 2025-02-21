<style>
    iframe {
        width: 100%;
        height: 250px;
    }
</style>

<div class="page-header">
    <h2 class="header-title">Propiedades</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>admin" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="#">Propiedades</a>
            <span class="breadcrumb-item active">Actualizar</span>
        </nav>
    </div>
    <!--button that floats to the right-->
    
</div>
<form action="<?php echo base_url("properties/update/" . $property['property_id']) ?>" method="post" id="myForm">

<div class="row">
    <div class="col-lg-9">
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
                    <h2 class="mb-5">Actualizar <?php echo $property['title']; ?></h2>
                   
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <label for="title">Titulo de la publicación</label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Titulo"
                                    value="<?php echo $property['title']; ?>"
                                    >
                                    <?php echo form_error('title', '<div class="text-danger">', '</div>'); ?>
                                    <small>Trata de que sea un titulo llamativo.</small>
                                </div>
                            </div>


                          

                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="category">Tipo de Propiedad</label>
                                    <select class="form-control" name="category" id="category">
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

                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="purpose">Tipo de Transacción</label>
                                    <select class="form-control" name="purpose" id="purpose">
                                        <option value="">Seleccione un tipo de transacción</option>
                                        <option value="v" <?php echo ($property['purpose'] == 'v') ? 'selected' : ''; ?> >Venta</option>
                                        <option value="r" <?php echo ($property['purpose'] == 'r') ? 'selected' : ''; ?>>Renta</option>
                                        <option value="t" <?php echo ($property['purpose'] == 't') ? 'selected' : ''; ?>>Traspaso</option>
                                    </select>
                                    <?php echo form_error('purpose', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="price">Precio</label>
                                    <input type="text" class="form-control" name="price" id="price" placeholder="Precio" value="<?php echo $property['price'] ?>">
                                    <?php echo form_error('price', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="currency">Moneda</label>
                                    <select class="form-control" name="currency" id="currency">
                                        <option value="">Seleccione una moneda</option>
                                        <option <?php echo ($property['currency'] == 'mxn') ? 'selected' : ''; ?> value="mxn">MXN</option>
                                        <option <?php echo ($property['currency'] == 'usd') ? 'selected' : ''; ?> value="usd">USD</option>
                                    </select>
                                    <?php echo form_error('currency', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="surface">Superficie</label>
                                    <input type="text" class="form-control" name="surface" id="surface" placeholder="Superficie" value="<?php echo $property['surface'] ?>">
                                    <?php echo form_error('surface', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="build_surface">Superficie Construida</label>
                                    <input type="text" class="form-control" name="build_surface" id="build_surface" placeholder="Superficie Construida" value="<?php echo $property['build_surface'] ?>">
                                    <?php echo form_error('build_surface', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="um">Unidad de Medida</label>
                                    <select class="form-control" name="um" id="um">
                                        <option value="">Seleccione una unidad de medida</option>
                                        <option <?php echo ($property['um'] == 'm2') ? 'selected' : ''; ?> value="m2">m2</option>
                                        <option <?php echo ($property['um'] == 'ft2') ? 'selected' : ''; ?> value="ft2">ft2</option>
                                    </select>
                                    <?php echo form_error('um', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="bedrooms">Recamaras</label>
                                    <input type="text" class="form-control" name="bedrooms" id="bedrooms" placeholder="Recamaras" value="<?php echo $property['bedrooms'] ?>">
                                    <?php echo form_error('bedrooms', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="bathrooms">Baños</label>
                                    <input type="text" class="form-control" name="bathrooms" id="bathrooms" placeholder="Baños" value="<?php echo $property['bathrooms'] ?>">
                                    <?php echo form_error('bathrooms', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="garage">Cochera</label>
                                    <input type="text" class="form-control" name="garage" id="garage" placeholder="Cochera" value="<?php echo $property['garage'] ?>">
                                    <?php echo form_error('garage', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="street">Calle</label>
                                    <input type="text" class="form-control" name="street" id="street" placeholder="Calle" value="<?php echo $property['street'] ?>">
                                    <?php echo form_error('street', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="number">Número</label>
                                    <input type="text" class="form-control" name="number" id="number" placeholder="Número" value="<?php echo $property['number'] ?>">
                                    <?php echo form_error('number', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="nhood">Colonia</label>
                                    <input type="text" class="form-control" name="nhood" id="nhood" placeholder="Colonia" value="<?php echo $property['nhood'] ?>">
                                    <?php echo form_error('nhood', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="state">Estado</label>
                                <select class="form-control" id="state" name="state">
                                        <option value="">Seleccione un estado</option>
                                        <?php foreach ($states as $state): ?>
                                            <option <?php if ($property['state']==$state['id']){echo"selected";}else{echo "";} ?> value="<?php echo $state['id']; ?>"><?php echo $state['nombre']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php echo form_error('state', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="city">Ciudad</label> 
                                    <select class="form-control" name="city" id="city">
                                        <option value="">Seleccionar ciudad</option>
                                        <option value="<?php echo $property['city'] ?>" selected><?php echo $property['ciudad'] ?></option>
                                    </select>
                                    <?php echo form_error('city', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="city">Agente Inmobiliario</label> 
                                    <select class="form-control" name="user_id" id="user_id">
                                        <option value="">Seleccionar</option>
                                        <?php foreach ($users as $user): ?>
                                            <option <?php if($property['user_id'] == $user['user_id']){echo "selected";}else{echo "";} ?>  value="<?php echo $user['user_id']; ?>"><?php echo $user['username']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php echo form_error('user_id', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>




                        </div>

                        <div class="row">

                            <div class="col-md-12 mb-5">
                                <div id="editor">
                                    <?php echo $property['description']; ?>
                                </div>
                            </div>
                            <input type="hidden" name="description" id="editorContent">
                                            


                            <div class="col-md-6 mt-5">
                                <div class="form-group mb-4">
                                    <div style="width:100%; height:250px; ">
                                    <iframe src="https://www.youtube.com/embed/<?php echo $property['youtube_id']; ?>"></iframe>
                                    </div>
                                    <label for="video">Video de Youtube</label> 
                                    <input type="text" class="form-control" name="video" id="video" value="<?php echo $property['youtube_id'] ?>" placeholder="Video de youtube solo ingresa el id del video. Ejemplo: 1a2b3c4d5e6f">
                                    <?php echo form_error('video', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="col-md-6 mt-5">
                                <div class="form-group mb-4">
                                    <div style="width:100%; height:250px; ">
                                        <?php echo $property['google_map']; ?>
                                    </div>
                                    <label for="map">Google Map</label> 
                                    <input type="text" class="form-control" name="map" id="map"  placeholder="Google Map solo ingresa el id del mapa. Ejemplo: 1a2b3c4d5e6f">
                                    <?php echo form_error('map', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>

                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-5">Guardar y Continuar</button>
                   
                </div>
        
        </div>
    </div>
    </div>
    

    <div class="col-lg-3">
        <div class="card mt-5 sticky-top" style="position: sticky; top: 0;">
            <div class="card-body">
                <div class="container">
                    <h2 class="mb-5">Amenidades</h2>
                    <?php foreach ($custom_fields as $custom_field): ?>
                        <!--checkboxes-->
                        <?php $checked = (in_array($custom_field['custom_id'], $property_custom_field_ids)) ? 'checked' : ''; ?>


                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="<?php echo $custom_field['custom_id']; ?>"   id="custom_field_<?php echo $custom_field['custom_id']; ?>" name="custom_fields[]" <?php echo $checked ?>>
                            <label class="form-check label" for="custom_field_<?php echo $custom_field['custom_id']; ?>">
                                <?php echo $custom_field['custom_name']; ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
                                                
       

</div>
</form>


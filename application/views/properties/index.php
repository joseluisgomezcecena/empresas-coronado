<div class="page-header">
    <h2 class="header-title">Propiedades</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>admin" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="#">Propiedades</a>
            <span class="breadcrumb-item active">Indexar</span>
        </nav>
    </div>
    <!--button that floats to the right-->
    <div class="float-right">
        <a href="<?php echo base_url('properties/create') ?>" class="btn btn-primary">Nueva Propiedad</a>
    </div>
</div>
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

        <table style="font-size:12px;" id="data-property" class="table">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Categoria</th>
                    <th>Transacción</th>
                    <th>Precio</th>
                    <th>Dirección</th>
                    <th>Amenidades</th>
                    <th>Portada</th>
                    <th>Vendida</th>
                    <th>Creado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
               <?php foreach ($properties as $property): ?>
                    <tr>
                        <td><?php echo $property['title']; ?></td>
                        <td>
                            <img src="<?php echo base_url() ?>uploads/properties/<?php echo  $controller->main_image($property['property_id']) ?>" alt="" class="img-a img-fluid" width="150">
                            <a class="text-center" href="<?php echo base_url("properties/images/" . $property['property_id']) ?>">Actualizar Galeria</a>
                        </td>
                        <td><?php echo $property['category_name'] ?></td>
                        <td><?php if($property['purpose'] == 'v'){echo "Venta";}elseif($property['purpose']=='r'){echo "Renta";}else{echo"Traspaso";} ?></td>
                        <td><?php echo number_format($property['price']); ?></td>

                        <td><?php echo $property['street'] . ' ' . $property['number'] . ', ' . $property['nhood'] . ', ' . $property['ciudad'] . ', ' . $property['estado']; ?></td>

                        <td>
                            <?php
                            $custom_fields = $controller->get_custom_fields($property['property_id']);
                            foreach ($custom_fields as $custom_field) {
                                echo '*' . $custom_field['custom_name'] . '<br>';
                            }
                            ?>
                        </td>
                        <td>
                            <?php if($property['portada']== 0){echo "No";}else{echo "Si";} ?>
                            <a href="<?php echo base_url("properties/cover/") ?><?php echo $property['property_id'] ?>">Cambiar</a>
                        </td>
                        <td>
                            <?php if($property['status']== 1){echo "No";}else{echo "Si";} ?>
                            <a href="<?php echo base_url("properties/sold/") ?><?php echo $property['property_id'] ?>">Cambiar</a>
                        </td>
                        <td><?php echo date_format(date_create($property['created_at']), "m/d/Y H:i:s"); ?></td>
                       
                        <td>
                            <a href="<?php echo base_url('properties/update/' . $property['property_id']) ?>" class="btn btn-sm btn-success">Editar</a>
                            <a href="<?php echo base_url('properties/delete/' . $property['property_id']) ?>" class="btn btn-sm btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th><a style="font-weight:lighter;" href="#">Lista imprimible</a></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<div class="row">               
    <div class="col-md-6 col-lg-3">
        <a href="<?php echo base_url() ?>properties">
            <div class="card-hover card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="m-b-0">Propiedades en sistema</p>
                            <h2 class="m-b-0">
                                <span><?php echo $property_count ?></span>
                            </h2>
                        </div>
                        <div class="avatar avatar-icon avatar-lg avatar-blue">
                            <i class="anticon anticon-home"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="m-b-0">Propiedades vendidas</p>
                        <h2 class="m-b-0">
                            <span><?php echo $property_sold; ?></span>
                        </h2>
                    </div>
                    <div class="avatar avatar-icon avatar-lg avatar-cyan">
                        <i class="anticon anticon-arrow-up"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="m-b-0">Efectividad</p>
                        <h2 class="m-b-0">
                            <span><?php echo $property_sold_percent ?></span>
                        </h2>
                    </div>
                    <div class="avatar avatar-icon avatar-lg avatar-red">
                        <i class="anticon anticon-percentage"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <a href="<?php echo base_url() ?>messages">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="m-b-0">Mensajes del mes</p>
                            <h2 class="m-b-0">
                                <span><?php echo $messages_count_month ?></span>
                            </h2>
                        </div>
                        <div class="avatar avatar-icon avatar-lg avatar-gold">
                            <i class="anticon anticon-message"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>


<p class="mt-5">Para administrar propiedades haz click en el boton.</p><a class="btn btn-dark" href="<?php echo base_url() ?>properties">Administrar Propiedades</a>

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

        <table style="font-size:12px;" id="data-property-dash" class="table">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Categoria</th>
                    <th>Transacción</th>
                    <th>Precio</th>
                    <th>Dirección</th>
                    <th>Amenidades</th>
                    
                    <th>Creado</th>
                    
                </tr>
            </thead>
            <tbody>
               <?php foreach ($properties as $property): ?>
                    <tr>
                        <td><?php echo $property['title']; ?></td>
                        <td>
                            <img src="<?php echo base_url() ?>uploads/properties/<?php echo  $controller->main_image($property['property_id']) ?>" alt="" class="custom-avatar avatar-image m-h-10 m-r-15" >
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
                        
                        <td><?php echo date_format(date_create($property['created_at']), "m/d/Y H:i:s"); ?></td>
                       
                        
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
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
            <span class="breadcrumb-item active">Vender propiedad</span>
        </nav>
    </div>
    <!--button that floats to the right-->
    
</div>
<form action="<?php echo base_url("properties/sold/" . $property['property_id']) ?>" method="post" id="myForm">

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
                    <h2 class="mb-5">Vender <?php echo $property['title']; ?></h2>
                   
                        <div class="row">

                           
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="city">Vendido por:</label> 
                                    <select class="form-control" name="seller" id="seller">
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
                                <label for="description">Notas de la venta</label>
                                <div id="editor">
                                    
                                </div>
                            </div>
                            <input type="hidden" name="description" id="editorContent">
                                            


                            

                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-5">Guardar </button>
                   
                </div>
        
        </div>
    </div>
    </div>
    


</div>
</form>


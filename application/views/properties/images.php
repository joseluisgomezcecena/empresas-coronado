<style>
    .list-group-item {
    width: 100%;
}
</style>
<div class="page-header">
    <h2 class="header-title">Propiedades</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>admin" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="<?php echo base_url() ?>properties/<?php echo $property['property_id']; ?>">Propiedades</a>
            <span class="breadcrumb-item active">Galeria De Imagenes</span>
        </nav>
    </div>
    <!--button that floats to the right-->
    <div class="float-right">
        <a href="<?php echo base_url('properties') ?>" class="btn btn-primary">Terminar y volver</a>
    </div>
</div>



<?php echo validation_errors(); ?>

<div class="row">

        <div class="col-lg-12">
                <!-- echo flash messages -->
                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Operación exitosa!</strong> <?php echo $this->session->flashdata('success'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } ?>

                    <!-- echo flash messages -->
                    <?php if ($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error</strong> <?php echo $this->session->flashdata('error'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } ?>
        </div>
    
        <div class="col-lg-6">
            <div class="card mt-3">
                <div class="card-body">

                   

                    <h5 style="font-weight:900" class="mb-5">Subir imagen</h5>

                    <form action="<?php echo base_url("properties/images/" . $property['property_id']) ?>" method="post" enctype="multipart/form-data">
    
                    <div class="form-group mb-5">
                        <div class="custom-file mb-5">
                            <input type="file" class="custom-file-input" id="customFile" name="userfile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                            <button type="submit" name="submit" class="btn btn-success mt-5 mb-5 float-right">Guardar</button>
                            <p id="file-chosen" class="alert alert-info" style="display: none;"></p>

                        </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    



    <div class="col-lg-6">
        <div class="card mt-3">
            <div class="card-body">
            <div id="gallery-container mt-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 style="font-weight:900" class="mb-5">Orden de las imagenes</h5>
                            <p>La primera imagen es la imagen principal, <strong>y sera la portada de la publicación</strong>.</p>
                        </div>
                                        
                            <div class="m-t-25 col-lg-12">
                                
                                
                                <ul style="cursor: move;" class="list-group list-group-flush">
                                    <?php foreach ($images as $image): ?>
                                        
                                        <li class="list-group-item" id="<?php echo $image['image_id']; ?>">
                                            <form action="<?php echo base_url("properties/delete_image/" . $image['image_id'] . "/" . $property['property_id']) ?>" method="post">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <div style="background: url('<?php echo base_url("uploads/properties/") . $image['url'] ?>') no-repeat center center; background-size: cover; height: 150px; width: 100%;"></div>
                                                    </div>
                                                    <div class="col-6 d-flex align-items-center justify-content-end">
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="anticon anticon-delete"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </li>

                                    <?php endforeach; ?>
                                </ul>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>

    </div>

<script>
document.getElementById('customFile').addEventListener('change', function() {
    var fileName = this.files[0].name;
    var fileChosen = document.getElementById('file-chosen');
    fileChosen.textContent = 'File chosen: ' + fileName;
    fileChosen.style.display = 'block';
});
</script>
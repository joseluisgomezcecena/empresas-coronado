<div class="page-header">
    <h2 class="header-title">Mensajes</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>admin" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="<?php echo base_url(); ?>messages">Mensajes</a>
            <span class="breadcrumb-item active">Detalles</span>
        </nav>
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

        
        <div class="row">

            <div class="col-md-12">
                <div class="form-group">
                    <label>Propiedad</label>
                    <input type="text" class="form-control" value="<?php echo $message['title']; ?>" readonly>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" id="name" value="<?php echo $message['name']; ?>" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" value="<?php echo $message['email']; ?>" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="message">Mensaje</label>
                    <textarea class="form-control" id="message" rows="5" readonly><?php echo $message['message']; ?></textarea>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="created_at">Fecha</label>
                    <input type="text" class="form-control" id="created_at" value="<?php echo date_format(date_create($message['created_at']), "m/d/Y H:i:s"); ?>" readonly>
                </div>
            </div>    

            <form action="<?php echo base_url(); ?>" method="post">
                <div class="col-md-12">
                    <input type="hidden" name="message_id" value="<?php echo $message['message_id']; ?>">
                    <div class="form-group">
                        <a href="<?php echo base_url('messages'); ?>" class="btn btn-dark">Regresar</a>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="page-header">
    <h2 class="header-title">Eliminar Categoria</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>admin" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="<?php echo base_url("categories") ?>">Categorias</a>
            <span class="breadcrumb-item active">Eliminar Categoria</span>
        </nav>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h4>¿Está seguro que desea eliminar esta categoria?</h4>
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

            <div class="alert alert-warning">
                <p>Esta acción no se puede deshacer. Se eliminará permanentemente la categoría: <strong><?php echo $category['category_name']; ?></strong></p>
            </div>

            <form action="<?php echo base_url("categories/delete/".$category['category_id']) ?>" method="post">
                <div class="row">
                    <div class="form-group col-lg-12">
                        <input type="hidden" name="confirm_delete" value="1">
                        <button type="submit" class="btn btn-danger">Eliminar Permanentemente</button>
                        <a href="<?php echo base_url("categories") ?>" class="btn btn-default">Cancelar</a>
                    </div>
                </div>    
            </form>
        </div>
    </div>
</div>
<div class="page-header">
    <h2 class="header-title">Actualizar Categoria</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>admin" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="<?php echo base_url("categories") ?>">Categorias</a>
            <span class="breadcrumb-item active">Actualizar Categoria</span>
        </nav>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h4>Categoria</h4>
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

            <form action="<?php echo base_url("categories/update/".$category['category_id']) ?>" method="post">
                <div class="row">
                    
                    <div class="form-group col-lg-4">
                        <label for="category_name">Nombre de la categoria</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Categoria" value="<?php echo set_value('category_name', $category['category_name']); ?>">
                        <?php echo form_error('category_name', '<div class="text-danger">', '</div>'); ?>
                    </div>

                    <div class="form-group col-lg-12" >
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="<?php echo base_url("categories") ?>" class="btn btn-default">Cancelar</a>
                    </div>
                </div>    
            </form>
        </div>
    </div>
</div>
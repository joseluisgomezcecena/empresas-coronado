<!-- Side Nav START -->
<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            <li class="nav-item dropdown" <?php echo ($active == 'home') ? "style='background-color: rgba(55, 222, 119, .15); border-right: 2px solid; border-color: #29b35e;'" : "" ?> >
                <a class="dropdown-toggle" href="<?php echo base_url(); ?>admin">
                    <span class="icon-holder">
                        <i class="anticon anticon-dashboard"></i>
                    </span>
                    <span class="title">Inicio</span>
                </a>
            </li>
            
            <li <?php echo ($active == 'products') ? "style='background-color: rgba(7, 139, 255, 0.33); border-right: 2px solid; border-color:rgb(84, 61, 255);'" : "" ?> class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-car"></i>
                    </span>
                    <span class="title">Productos</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url() ?>products/create">Agregar Producto</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>products/">Lista</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>inventory/">Inventario</a>
                    </li>
                </ul>
            </li>
            <li <?php echo ($active == 'clients') ? "style='background-color: rgba(55, 222, 119, .15); border-right: 2px solid; border-color: #29b35e;'" : "" ?> class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-solution"></i>
                    </span>
                    <span class="title">Clientes y Mensajes</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <!--
                    <li>
                        <a href="<?php echo base_url() ?>clients/create">Registrar Cliente</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>clients/">Ver Lista</a>
                    </li>
                    -->
                    <li>
                        <a href="<?php echo base_url() ?>messages">Ver Mensajes</a>
                    </li>
                </ul>
            </li>
            <li <?php echo ($active == 'categories' || $active == 'customfields') ? "style='background-color: rgba(55, 222, 119, .15); border-right: 2px solid; border-color: #29b35e;'" : "" ?> class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-setting"></i>
                    </span>
                    <span class="title">Configuración</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url() ?>categories/index">Categorias</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>customs/index">Campos Personalizados</a>
                    </li>
                </ul>
            </li>
            <li <?php echo ($active == 'users') ? "style='background-color: rgba(55, 222, 119, .15); border-right: 2px solid; border-color: #29b35e;'" : "" ?> class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-user-add"></i>
                    </span>
                    <span class="title">Usuarios y Agentes</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url() ?>users/create">Registrar Usuario</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>users/">Ver Lista</a>
                    </li>
                </ul>
            </li>
            <!--
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-form"></i>
                    </span>
                    <span class="title">Forms</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="form-elements.html">Form Elements</a>
                    </li>
                    <li>
                        <a href="form-layouts.html">Form Layouts</a>
                    </li>
                    <li>
                        <a href="form-validation.html">Form Validation</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown open">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-table"></i>
                    </span>
                    <span class="title">Tables</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="basic-table.html">Basic Table</a>
                    </li>
                    <li class="active">
                        <a href="data-table.html">Data Table</a>
                    </li>
                </ul>
            </li>
-->
            <!--
            <li <?php echo ($active == 'reports') ? "style='background-color: rgba(55, 222, 119, .15); border-right: 2px solid; border-color: #29b35e;'" : "" ?> class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-pie-chart"></i>
                    </span>
                    <span class="title">Reportes</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url() ?>reports">Generador De Reportes</a>
                    </li>
                </ul>
            </li>
            -->
        </ul>
    </div>
</div>
<!-- Side Nav END -->
    <!-- Page Container START -->
    <div class="page-container">
            <!-- Content Wrapper START -->
            <div class="main-content">
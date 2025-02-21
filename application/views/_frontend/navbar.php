<!-- ======= 
<nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand" href="<?php echo base_url(); ?>">Bienes<span class="color-b">Raices
        <sup><span class="bi bi-house-fill"></sup>
      </span></a>

      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">

          <li class="nav-item">
            <a class="nav-link active" href="<?php echo base_url(); ?>">Inicio</a>
          </li>

          <li class="nav-item">
            <a class="nav-link " href="<?php echo base_url("nosotros") ?>">Nosotros</a>
          </li>

          <li class="nav-item">
            <a class="nav-link " href="<?php echo base_url("property_list") ?>">Todas Las Propiedades</a>
          </li>


          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categorias</a>
            <div class="dropdown-menu">
             
              <?php foreach ($categories as $category) : ?>
                <a class="dropdown-item" href="<?php echo base_url("property_list/" . $category['category_slug']) ?>"><?php echo $category['category_name'] ?></a>
              <?php endforeach; ?>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="<?php echo base_url("contact") ?>">Contacto</a>
          </li>
        </ul>
      </div>

      <button type="button" class="btn btn-b-n navbar-toggle-box navbar-toggle-box-collapse" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01">
        <i class="bi bi-search"></i>
      </button>

    </div>
  </nav>End Header/Navbar -->

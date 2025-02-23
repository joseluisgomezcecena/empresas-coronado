<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">


  <title><?= $title; ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  
  <!-- Favicon -->
  <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/favicon.ico">

<!--icons for apple devices and android devices-->
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url() ?>assets/images/apple-touch-icon.png">

<!-- android-chrome icons -->
<link rel="icon" type="image/png" sizes="512x512"  href="<?php echo base_url() ?>assets/images/android-chrome-512x512.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url() ?>assets/images/android-chrome-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url() ?>assets/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/images/favicon-16x16.png">


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url(); ?>assets/frontend/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/frontend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/frontend/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/frontend/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url(); ?>assets/frontend/css/style.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery UI CSS -->
    <link href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" rel="stylesheet">
    <style>
        .field-item { cursor: move; }
  
    /* Custom CSS */
    @media (max-width: 768px) {
      .title-a {
        font-size: 36px;
      }
    }
  </style>


  <!-- =======================================================
  Jose Luis Gomez Ceceña.
  ======================================================== -->
</head>

<body>

  <!-- ======= Property Search Section ======= -->
  <div class="click-closed"></div>
 
  <div class="box-collapse">
    <div class="title-box-d">
      <h3 class="title-d">Busca Propiedades</h3>
    </div>
    <span class="close-box-collapse right-boxed bi bi-x"></span>
    <div class="box-collapse-wrap form">
      <form class="form-a" action="<?php echo base_url("pages/search") ?>" method="post">
        <div class="row">
          <div class="col-md-12 mb-2">
            <div class="form-group">
              <label class="pb-2" for="Type">Palabra clave</label>
              <input type="text" name="keyword" class="form-control form-control-lg form-control-a" placeholder="Palabra clave">
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2" for="Type">Transacción</label>
              <select class="form-control form-select form-control-a" name="purpose" id="Type">
                <option value="">Todas</option>
                
                <option value="r">Renta</option>
                <option value="v">Venta</option>
                <option value="t">Traspaso</option>
              
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2" for="city">Ciudad</label>
              <input list="cities" class="form-control form-select form-control-a" name="city" id="city">
              <datalist id="cities">
                <?php foreach ($cities as $city) : ?>
                  <option value="<?php echo $city['nombre']; ?>">
                <?php endforeach; ?>
                <!-- Add more cities here -->
              </datalist>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2" for="bedrooms">Recamaras</label>
              <select class="form-control form-select form-control-a" name="bedrooms" id="bedrooms">
                <option value="">Todas</option>
                <?php for ($i = 1; $i <= 10; $i++) : ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2" for="garages">Garages</label>
              <select class="form-control form-select form-control-a" id="garages" name="garages">
                <option value="">Todas</option>
                <?php for ($i = 1; $i <= 10; $i++) : ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2" for="bathrooms">Baños</label>
              <select class="form-control form-select form-control-a" name="bathrooms" id="bathrooms">
                <option value="">Todas</option>
                <?php for ($i = 1; $i <= 10; $i++) : ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2" for="price">Precio</label>
              <select class="form-control form-select form-control-a" id="price" name="max_price">
                <option value="">Sin limites</option>
                <option value="50000">$50,000</option>
                <option value="100000">$100,000</option>
                <option value="150000">$150,000</option>
                <option value="200000">$200,000</option>
                <option value="500000">$500,000</option>
                <option value="1000000">1,000,000</option>
                <option value="2000000">2,000,000</option>
                <option value="5000000">5,000,000</option>
                <option value="10000000">10,000,000</option>
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <button type="submit" name="search" class="btn btn-b">Buscar Propiedad</button>
          </div>
        </div>
      </form>
    </div>
  </div><!-- End Property Search Section -->>

<style>
  .amenities-list .list-a {
    display: flex;
    flex-wrap: wrap;
    gap: 10px; /* Adjust the gap as needed */
  }

  .amenities-list .list-a li {
    flex: 1 1 auto;
    white-space: nowrap;
    margin: 5px; /* Adjust the margin as needed */
  }

  iframe {
    width: 100%;
  }

</style>
 <!-- ======= Intro Single ======= -->
 <section class="intro-single">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-8">
            <div class="title-single-box">
              <h1 class="title-single"><?php echo $property['street'] ?> <?php echo $property['number'] ?> <?php echo $property['nhood'] ?></h1>
              <span class="color-text-a"><?php echo $property['estado'] ?>, <?php echo $property['ciudad'] ?></span>
            </div>
          </div>
          <div class="col-md-12 col-lg-4">
            <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="<?php echo base_url(); ?>">Inicio</a>
                </li>
                <li class="breadcrumb-item">
                  <a href="<?php echo base_url("property_list"); ?>">Propiedades</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                <?php echo $property['street'] ?> <?php echo $property['number'] ?> <?php echo $property['nhood'] ?>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section><!-- End Intro Single-->

    <!-- ======= Property Single ======= -->
    <section class="property-single nav-arrow-b">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div id="property-single-carousel" class="swiper">
              <div class="swiper-wrapper">
                
              <?php foreach ($images as $image) : ?>
                <div class="carousel-item-b swiper-slide">
                  <div style="background-image: url('<?php echo base_url("uploads/properties/" . $image['url']); ?>'); background-size: cover; background-position: center; height: 550px;"></div>
                <!--  
                  <img src="<?php echo base_url("uploads/properties/" . $image['url']) ?>" alt="">
                -->
                </div>
              <?php endforeach; ?>
                <!--
                <div class="carousel-item-b swiper-slide">
                  <img src="assets/img/slide-2.jpg" alt="">
                </div>
                -->
              </div>
            </div>
            <div class="property-single-carousel-pagination carousel-pagination"></div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">

            <div class="row justify-content-between">
              <div class="col-md-5 col-lg-4">
                <div class="property-price d-flex justify-content-center foo">
                  <div class="card-header-c d-flex">
                    <div class="card-box-ico">
                      <span class="bi bi-cash">$</span>
                    </div>
                    <div class="card-title-c align-self-center">
                      <h5 class="title-c"><?php echo number_format($property['price']) ?></h5>
                    </div>
                  </div>
                </div>
                <div class="property-summary">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="title-box-d section-t4">
                        <h3 class="title-d">Detalles</h3>
                      </div>
                    </div>
                  </div>
                  <div class="summary-list">
                    <ul class="list">
                      <li class="d-flex justify-content-between">
                        <strong>ID de la propiedad:</strong>
                        <span><?php echo $property['property_id'] ?></span>
                      </li>
                      <li class="d-flex justify-content-between">
                        <strong>Ubicación:</strong>
                        <span><?php echo $property['ciudad'] ?>; <?php echo $property['estado'] ?></span>
                      </li>
                      <li class="d-flex justify-content-between">
                        <strong>Tipo de propiedad:</strong>
                        <span><?php echo $property['category_name'] ?></span>
                      </li>
                      <li class="d-flex justify-content-between">
                        <strong>Transacción:</strong>
                        <span><?php if($property['purpose'] == 'v'){echo "Venta";}elseif($property['purpose']=="r"){echo "Renta";}else{echo 'Traspaso';} ?></span>
                      </li>
                      <li class="d-flex justify-content-between">
                        <strong>Terreno:</strong>
                        <span><?php echo $property['surface'] ?> <?php echo $property['um'] ?></span>
                          <!--
                          <sup>2</sup>
                          -->
                        </span>
                      </li>
                      <li class="d-flex justify-content-between">
                        <strong>Recamaras:</strong>
                        <span><?php echo $property['bedrooms']; ?></span>
                      </li>
                      <li class="d-flex justify-content-between">
                        <strong>Baños:</strong>
                        <span><?php echo $property['bathrooms']; ?></span>
                      </li>
                      <li class="d-flex justify-content-between">
                        <strong>Garage:</strong>
                        <span><?php echo $property['garage']; ?></span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-7 col-lg-7 section-md-t3">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="title-box-d">
                      <h3 class="title-d">Descripción</h3>
                    </div>
                  </div>
                </div>
                <div class="property-description">
                  <p class="description color-text-a">
                    <?php echo $property['description'] ?>
                  </p>
                  
                </div>
                <div class="row section-t3">
                  <div class="col-sm-12">
                    <div class="title-box-d">
                      <h3 class="title-d">Amenidades</h3>
                    </div>
                  </div>
                </div>
                <div class="amenities-list color-text-a">
                  <ul class="list-a no-margin">
                    <?php foreach ($custom_fields as $custom_field) : ?>
                      <li><?php echo $custom_field['custom_name'] ?></li>
                    <?php endforeach; ?>
                    
                    
                  </ul>
                </div>
              </div>
            </div>
          </div>
         
          <div class="col-md-10 offset-md-1">
            <ul class="nav nav-pills-a nav-pills mb-3 section-t3" id="pills-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="pills-video-tab" data-bs-toggle="pill" href="#pills-video" role="tab" aria-controls="pills-video" aria-selected="true">Video</a>
              </li>
             
              <li class="nav-item">
                <a class="nav-link" id="pills-map-tab" data-bs-toggle="pill" href="#pills-map" role="tab" aria-controls="pills-map" aria-selected="false">Mapa</a>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-video" role="tabpanel" aria-labelledby="pills-video-tab">
                <iframe src="https://www.youtube.com/embed/<?php echo $property['youtube_id'] ?>" width="100%" height="460" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
              </div>
              
              <div class="tab-pane fade" id="pills-map" role="tabpanel" aria-labelledby="pills-map-tab">
              <!--  
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.1422937950147!2d-73.98731968482413!3d40.75889497932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes+Square!5e0!3m2!1ses-419!2sve!4v1510329142834" width="100%" height="460" frameborder="0" style="border:0" allowfullscreen></iframe>
              
              <iframe src="https://www.google.com/maps/embed?pb=" width="100%" height="460" frameborder="0" style="border:0" allowfullscreen></iframe>
              -->
                
              <?php echo $property['google_map'] ?>  
              
            </div>
            </div>
          </div>
           
          <div class="col-md-12">
            <div class="row section-t3">
              <div class="col-sm-12">
                <div class="title-box-d">
                  <h3 class="title-d">Contactanos</h3>
                </div>
              </div>
            </div>
            <div class="row">
              <!--
              <div class="col-md-6 col-lg-4">
                <img src="<?php echo base_url(); ?>assets/img/agent-4.jpg" alt="" class="img-fluid">
              </div>
              -->
              <div class="col-md-6 col-lg-6">
                <div class="property-agent">
                  <h4 class="title-agent"><?php echo strtoupper($user['username']); ?></h4>
                  <!--
                  <p class="color-text-a">
                    Nulla porttitor accumsan tincidunt. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet
                    dui. Quisque velit nisi,
                    pretium ut lacinia in, elementum id enim.
                  </p>
                  justify-content-between
                -->
                  <ul class="list-unstyled">
                    <li class="d-flex ">
                      <strong>Telefono: </strong>
                      <span class="color-text-a"><?php echo $user['user_phone'] ?></span>
                    </li>
                    
                    <li class="d-flex ">
                      <strong>Email: </strong>
                      <span class="color-text-a">
                        <?php echo $user['email'] ?>
                      </span>
                    </li>
                    <!--
                    <li class="d-flex justify-content-between">
                      <strong>Skype:</strong>
                      <span class="color-text-a">Annabela.ge</span>
                    </li>
                  -->
                  </ul>
                  <!--
                  <div class="socials-a">
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <a href="#">
                          <i class="bi bi-facebook" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#">
                          <i class="bi bi-twitter" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#">
                          <i class="bi bi-instagram" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#">
                          <i class="bi bi-linkedin" aria-hidden="true"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                -->
                </div>
              </div>
              <div class="col-md-12 col-lg-6">
                <div class="property-contact">
                  <form class="form-a" id="contact" action="<?php echo base_url(); ?>pages/send" method="post">
                    <input type="hidden" name="property_id" id="property_id" value="<?php echo $property['property_id'] ?>">
                    <div class="row">
                      <div class="col-md-12 mb-1">
                        <div class="form-group">
                          <input type="text" class="form-control form-control-lg form-control-a" id="inputName" placeholder="Nombre *" required>
                        </div>
                      </div>
                      <div class="col-md-12 mb-1">
                        <div class="form-group">
                          <input type="email" class="form-control form-control-lg form-control-a" id="inputEmail1" placeholder="Email *" required>
                        </div>
                      </div>
                      <div class="col-md-12 mb-1">
                        <div class="form-group">
                          <textarea id="textMessage" class="form-control" placeholder="Mensaje *" name="message" cols="45" rows="8" required></textarea>
                        </div>
                      </div>
                      <div class="col-md-12 mt-3 mb-5">
                        <button type="submit" class="btn btn-a">Enviar Mensaje</button>
                      </div>
                      <div class="col-lg-12 mb-5">
                      <button type="button" class="btn btn-primary" id="shareBtn"> <i class="bi bi-facebook"></i> Compartir en Facebook</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Property Single-->
<script>
document.getElementById('shareBtn').addEventListener('click', function() {
    var propertyUrl = '<?php echo site_url("properties/details/" . $property['property_id']); ?>';
    console.log(propertyUrl); // Debugging: Print the URL to the console
    var facebookShareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(propertyUrl);
    window.open(facebookShareUrl, 'facebook-share-dialog', 'width=800,height=600');
    return false;
});
</script>
<!--
139/84 82
129/75 71
129/78 72
124/74 70
120/71 70
116/75 69
117/71 68
113/71 70
121/75 71
137/77 72
129/80 68
119/75 70
119/76 69
116/74 67
115/67 65
111/73 67
115/73 66
116/70 64

130/78 65

-->


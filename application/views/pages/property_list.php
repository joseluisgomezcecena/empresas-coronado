



   <!-- ======= Latest Properties Section ======= -->
   <section class="section-property section-t8">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box">
                <h2 class="title-a">Nuestras propiedades</h2>
              </div>
              
            </div>
          </div>
        </div>

        <div class="row">

        <?php 
          //if there are no properties, show a message
          if (empty($properties)):?>

            <div style="height: 95vh;" class="col-lg-12 text-center mt-5 mb-5">
              <h3>No hay resultados con estos parametros de busqueda.</h3>
            </div>

        <?php endif; ?>  
        
          
        <?php foreach ($properties as $property): ?>  

         

          <div class="col-lg-4 mb-5">
            <div class="">
           
            <div style="background-image: url('<?php echo base_url("uploads/properties/" . $controller->main_image($property['property_id'])); ?>'); background-size: cover; background-position: center; height: 450px;" class="card-box-a card-shadow">
                <!--
                <div class="img-box-a">
                  <img src="<?php echo base_url() ?>uploads/properties/<?php echo  $controller->main_image($property['property_id']) ?>" alt="" class="img-a img-fluid">
                </div>
                -->
                <div class="card-overlay">
                  <div class="card-overlay-a-content">
                    <div class="card-header-a">
                      <h2 class="card-title-a">
                        <a href="property-single.html"><?php echo $property['title'] ?></a>
                          <br /> <?php echo $property['street'] ?> <?php echo $property['number'] ?> <?php $property['nhood'] ?></a>
                      </h2>
                    </div>
                    <div class="card-body-a">
                      <div class="price-box d-flex">
                        <span class="price-a"><?php if( $property['purpose'] == 'v'){echo "Venta";}elseif ($property['purpose']=='r'){echo "Renta";}else{echo "Traspaso";} ?> | $ <?php echo number_format($property['price']) ?></span>
                      </div>
                      <a href="<?php echo base_url("property/" . $property['slug']) ?>" class="link-a">Ver mas!
                        <span class="bi bi-chevron-right"></span>
                      </a>
                    </div>
                    <div class="card-footer-a">
                      <ul class="card-info d-flex justify-content-around">
                        <li>
                          <h4 class="card-info-title">Terreno</h4>
                          <span><?php echo $property['surface'] ?> <?php echo $property['um'] ?>
                            <!--<sup>2</sup>-->
                          </span>
                        </li>
                        <li>
                          <h4 class="card-info-title">Recamaras</h4>
                          <span><?php echo $property['bedrooms'] ?></span>
                        </li>
                        <li>
                          <h4 class="card-info-title">Baños</h4>
                          <span><?php echo $property['bathrooms'] ?></span>
                        </li>
                        <li>
                          <h4 class="card-info-title">Garages</h4>
                          <span><?php echo $property['garage'] ?></span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End  item -->
           
          </div>
        <?php endforeach; ?>
          

        </div>
        <div class="propery-carousel-pagination carousel-pagination"></div>

      </div>
    </section><!-- End Latest Properties Section -->

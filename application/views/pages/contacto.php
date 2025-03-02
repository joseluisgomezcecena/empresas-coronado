<style>
  .map-container {
    position: relative;
    width: 100%;
    height: 50vh; /* This makes it 50% of the viewport height */
    overflow: hidden;
    margin-bottom: 2rem;
  }
  
  .map {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
  }
</style>

<main id="main">
    <!-- ======= Contact Single ======= -->
    <div class="map-container">
        <iframe class="map" 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4752.194151541582!2d-115.41437367223789!3d32.62460148889958!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80d7713cebc5ff25%3A0x7742f0a673d08e0!2sEMPRESAS%20CORONADO!5e0!3m2!1sen!2smx!4v1740432401048!5m2!1sen!2smx"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>

    <!-- ======= Intro Single ======= -->
    <section class="intro-single mt-5">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-6">
            <div class="title-single-box">
              <h1 class="title-single">Contactanos</h1>
              
              <span>
                En Empresas Coronado estamos para servirte. Si tienes alguna duda o comentario, no dudes en contactarnos. Puedes hacerlo a través de nuestro formulario de contacto
                o bien, visitarnos en nuestras instalaciones.
              </span>
                <br><br/>
                <strong>Horario de atención:</strong> Lunes a Viernes de 8:00 a 18:00 hrs.
                <br><br/>
                <strong>Teléfono:</strong> +52 686 123 4567
                <br><br/>
                <strong>Dirección:</strong> Lazaro Cardenas Km 2.5 No. S/N, Mexicali, Mexico. 
      
              </span>



            </div>

            <div class="row mt-5">
              <!--two cols with cards-->
              <div class="col-md-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Julian Moreno Perez</h5>
                    <p class="card-text">CEO</p>
                    <a href="<?php echo base_url() ?>julian-moreno" target="_blank" class="btn btn-dark">Conocer mas</a>    
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Gustavo Coronado</h5>
                    <p class="card-text">Director General</p>
                    <a href="<?php echo base_url() ?>gustavo-coronado" target="_blank" class="btn btn-dark">Conocer mas</a>    
                  </div>
                </div>
              </div>

            </div>


          </div>

          <div class="col-md-12 col-lg-6">
            <div class="title-single-box">
              <h1 class="title-single">Formulario de contacto</h1>
              <form id="contactForm" class="form-a">
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="form-group mb-2">
                <label for="name">Nombre</label>

                <input type="text" class="form-control form-control-lg form-control-a" id="name" name="name" placeholder="" required>
                <div class="invalid-feedback">Por favor, ingresa tu nombre.</div>
                <div class="valid-feedback">¡Bien!</div>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group mb-2">
                <label for="email">Email</label>

                <input type="email" class="form-control form-control-lg form-control-a" id="email" name="email" placeholder="" required>
                <div class="invalid-feedback">Por favor, ingresa tu correo electrónico.</div>
                <div class="valid-feedback">¡Bien!</div>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group mb-2"> 
                <label for="phone">Teléfono</label>

                <input type="text" class="form-control form-control-lg form-control-a" id="phone" name="phone" placeholder="" required>
                <div class="invalid-feedback">Por favor, ingresa tu número de teléfono.</div>
                <div class="valid-feedback">¡Bien!</div>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group mb-2">
                <label for="subject">Asunto</label>

                <input type="text" class="form-control form-control-lg form-control-a" id="subject" name="subject" placeholder="" required>
                <div class="invalid-feedback">Por favor, ingresa el asunto de tu mensaje.</div>
                <div class="valid-feedback">¡Bien!</div>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group mb-2">
                <label for="message">Mensaje</label>

                <textarea class="form-control" id="message" name="message" placeholder="Mensaje" rows="5" required></textarea>
                <div class="invalid-feedback">Por favor, ingresa tu mensaje.</div>
                <div class="valid-feedback">¡Bien!</div>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group ">
                <button type="submit" class="btn btn-primary">Enviar mensaje</button>
            </div>
            
            <div id="form-response" class="mt-3" style="display: none;"></div>
        </div>
    </div>
</form>




        </div>
      </div>
    </section><!-- End Intro Single-->
</main><!-- End #main -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    const formResponse = document.getElementById('form-response');
    
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate form
        if (!contactForm.checkValidity()) {
            contactForm.classList.add('was-validated');
            return;
        }
        
        // Get form data
        const formData = new FormData(contactForm);
        
        // Convert to object for fetch API
        const data = {};
        formData.forEach((value, key) => {
            data[key] = value;
        });
        
        // Send AJAX request
        fetch('<?php echo base_url("Ajaxmessages/submit"); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                // Show success message
                formResponse.innerHTML = '<div class="alert alert-success">' + result.message + '</div>';
                formResponse.style.display = 'block';
                
                // Reset form
                contactForm.reset();
                contactForm.classList.remove('was-validated');
            } else {
                // Show error message
                formResponse.innerHTML = '<div class="alert alert-danger">' + result.message + '</div>';
                formResponse.style.display = 'block';
            }
        })
        .catch(error => {
            // Show error message
            formResponse.innerHTML = '<div class="alert alert-danger">Ha ocurrido un error al enviar el mensaje. Por favor, intenta nuevamente.</div>';
            formResponse.style.display = 'block';
            console.error('Error:', error);
        });
    });
});
</script>



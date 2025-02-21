<footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <!--
          <nav class="nav-footer">
            <ul class="list-inline">
              <li class="list-inline-item">
                <a href="#">Home</a>
              </li>
              <li class="list-inline-item">
                <a href="#">About</a>
              </li>
              <li class="list-inline-item">
                <a href="#">Property</a>
              </li>
              <li class="list-inline-item">
                <a href="#">Blog</a>
              </li>
              <li class="list-inline-item">
                <a href="#">Contact</a>
              </li>
            </ul>
          </nav>
          -->
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
          <div class="copyright-footer">
            <p class="copyright color-text-a">
              &copy; Copyright
              <span class="color-a">Realestate</span> All Rights Reserved.
            </p>
          </div>
          <div class="credits">
            <!--
            App by <a href="https://github.com/joseluisgomezcecena/">adminsystems</a>
            -->
            App by <a href="http://www.adminsystems.mx/">adminsystems</a>
          </div>
        </div>
      </div>
    </div>
  </footer><!-- End  Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!--
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
-->

  <!-- Vendor JS Files -->
  <script src="<?php echo base_url(); ?>assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/frontend/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/frontend/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url(); ?>assets/frontend/js/main.js"></script>


  <script>
  $(document).ready(function() {
      $('#contact').on('submit', function(e) {
          e.preventDefault();

          var name = $('#inputName').val();
          var email = $('#inputEmail1').val();
          var message = $('#textMessage').val();
          var property_id = $('#property_id').val();

          $.ajax({
              url: '<?php echo base_url(); ?>pages/send',
              type: 'POST',
              data: {
                  name: name,
                  email: email,
                  message: message,
                  property_id: property_id
              },
              success: function(response) {
                  alert('Tu mensaje ha sido enviado con exito.');
                  // Optionally, clear the form fields
                  $('#inputName').val('');
                  $('#inputEmail1').val('');
                  $('#textMessage').val('');
                  $('#property_id').val('');
              },
              error: function() {
                  alert('Ocurrio un error. Por favor intenta de nuevo.');
              }
          });
      });
  });
  </script>


</body>

</html>
</div>
                <!-- Content Wrapper END -->

                <!-- Footer START -->
                <footer class="footer">
                    <div class="footer-content justify-content-between">
                        <p class="m-b-0">Copyright © <?php echo date("Y") ?> Nexus Software Solutions.</p>
                        <span>
                            <a href="" class="text-gray m-r-15">Term &amp; Conditions</a>
                            <a href="" class="text-gray">Privacy &amp; Policy</a>
                        </span>
                    </div>
                </footer>
                <!-- Footer END -->

            </div>
            <!-- Page Container END -->

        
     

    
    <!-- Core Vendors JS -->
    <script src="<?php echo base_url(); ?>assets/js/vendors.min.js"></script>

    <!-- page js -->
    <script src="<?php echo base_url(); ?>assets/vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/datatables.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>


    <!-- Core JS -->
    <script src="<?php echo base_url(); ?>assets/js/app.min.js"></script>


    <!-- chart js -->
    <script src="<?php echo base_url(); ?>assets/vendors/chartjs/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/chartjs.js"></script>


    <!-- Datatables Buttons -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <!-- Select 2 -->
    <script src="<?php echo base_url(); ?>assets/vendors/select2/select2.min.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.js"></script>

    <!-- quill js -->
    <script src="<?php echo base_url(); ?>assets/vendors/quill/quill.min.js"></script>

    <!--
    https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js
https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js
https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js
https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js
https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js
https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js
-->

<script>
    new Quill('#editor', {
    theme: 'snow'
});
</script>


<script>
    var quill = new Quill('#editor', {
        // your options here
    });

    document.querySelector('#myForm').onsubmit = function() {
        // Get the editor's content and put it into the hidden input
        document.querySelector('#editorContent').value = quill.root.innerHTML;
    };
</script>


<script>
    //make the datatable scrollable
    $(document).ready(function() {
        $('#data-tables').DataTable({
            scrollX: true,
            scrollCollapse: true,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print', 'copy', 'csv'
            ]
        });
    });


    $(document).ready(function() {
        $('#data-property').DataTable({
            scrollX: true,
            scrollCollapse: true,
            bSort: false,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print', 'copy'
            ],
            columnDefs: [
                { width: '100px', targets: [0,4,6,7] },
                { width: '150px', targets: [1,2,3,5,8,9] },
               
                { width: '200px', targets: [10] }
            ]
        });
    });


    $(document).ready(function() {
        $('#data-property-dash').DataTable({
            scrollX: true,
            scrollCollapse: true,
            bSort: false,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print', 'copy'
            ],
            columnDefs: [
                { width: '130px', targets: [0,4,6,7] },
                { width: '150px', targets: [1,2,3,5] }
            ]
        });
    });


    $(document).ready(function() {
        $('#data-users').DataTable({
            scrollX: true,
            scrollCollapse: true,
            bSort: false,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print', 'copy'
            ],
            columnDefs: [
                { width: '100px', targets: [0,1,2,3,4] },
                { width: '250px', targets: [5,6,7,8] }
               
            ]
        });
    });


    $(document).ready(function() {
        $('#data-clients').DataTable({
            scrollX: true,
            scrollCollapse: true,
            bSort: false,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print', 'copy', 'csv'
            ],
            columnDefs: [
                { width: '100px', targets: [0] },
                { width: '130px', targets: [1, 2, 3, 4, 5] },
                { width: '200px', targets: [6] }
            ]
        });
    });


    $(document).ready(function() {
        $('#data-projects-client').DataTable({
            scrollX: true,
            scrollCollapse: true,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print', 'copy', 'csv'
            ],
            columnDefs: [
                { width: '15px', targets: [0] },
                { width: '150px', targets: [1, 2,  5, 6, 7,8,9,10] },
                { width: '100px', targets: [3] },
                { width: '75px', targets: [4] }
                
            ]
        });
    });




</script>

<script>
    $(document).ready(function() {
        $('#warningModal').modal('show');
    });
</script>

<script>
    $('.select2').select2();
    
</script>

<script>

    function applyTheme() {
        if (localStorage.getItem('is-side-nav-dark')) {
            $('.app .layout').addClass("is-side-nav-dark");
            $('#side-nav-theme-toogle').prop('checked', true);
        } else {
            $('.app .layout').removeClass("is-side-nav-dark");
            $('#side-nav-theme-toogle').prop('checked', false);
        }

        if (localStorage.getItem('is-folded')) {
            $('.app .layout').addClass("is-folded");
            $('#side-nav-fold-toogle').prop('checked', true);
        } else {
            $('.app .layout').removeClass("is-folded");
            $('#side-nav-fold-toogle').prop('checked', false);
        }
    }

    // Apply theme on page load
    applyTheme();

    $(document).on('change', 'input[name="header-theme"]', ()=> {
        const context = $('input[name="header"]:checked').val();
        console.log(context)
        $(".app").removeClass (function (index, className) {
            return (className.match (/(^|\s)is-\S+/g) || []).join(' ');
        }).addClass( 'is-'+ context );
    });

    $('#side-nav-theme-toogle').on('change', (e)=> {
        e.preventDefault();

        if ($('#side-nav-theme-toogle').is(':checked')) {
            $('.app .layout').addClass("is-side-nav-dark");
            localStorage.setItem('is-side-nav-dark', 'true');
        } else {
            $('.app .layout').removeClass("is-side-nav-dark");
            localStorage.removeItem('is-side-nav-dark');
        }
    });

    $('#side-nav-fold-toogle').on('change', (e)=> {
        e.preventDefault();

        if ($('#side-nav-fold-toogle').is(':checked')) {
            $('.app .layout').addClass("is-folded");
            localStorage.setItem('is-folded', 'true');
        } else {
            $('.app .layout').removeClass("is-folded");
            localStorage.removeItem('is-folded');
        }
    });

    // Add click event to the apply button
    $('.btnapply').on('click', function(e) {
        e.preventDefault();
        location.reload();
    });

</script>

<script>

    $(function() {
        $( ".list-group" ).sortable({

            // Change cursor when dragging
            cursor: "move",

            // add active class to the list item being dragged
            start: function(event, ui) {
                ui.item.addClass('active');
            },

            // Remove active class when dragging stops
            stop: function(event, ui) {
                ui.item.removeClass('active');
            },

            update: function(event, ui) {
                var order = $(this).sortable('toArray');
                // Make ajax call to save the new order
                $.post('<?php echo base_url(); ?>properties/update_order', {order: order});
            }
        });
    });

</script>


<script>
    $('.datepicker-input').datepicker();
</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>


<script>

$('.timepicker').timepicker({
    timeFormat: 'm:mm p',
    interval: 60,
    minTime: '10',
    maxTime: '6:00pm',
    defaultTime: '11',
    startTime: '10:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});
    

</script>



<script>
    //dependent dropdown for estados and municipios
    $(document).ready(function() {
        $('#state').on('change', function() {
            var estado_id = $(this).val();
            if (estado_id) {
                $.ajax({
                    url: '<?php echo base_url(); ?>properties/get_municipios/' + estado_id,
                    type: "POST",
                    dataType: "json",
                    success: function(data) {
                        $('#city').empty();
                        $.each(data, function(key, value) {
                            $('#city').append('<option value="' + value.id + '">' + value.nombre + '</option>');
                        });
                    }
                });
            } else {
                $('#city').empty();
            }
        });
    });
</script>


</body>

</html>
<div class="container-fluid mt-4">
        <div class="row">
            <!-- Field Types Sidebar -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Add Fields</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <?php foreach ($field_types as $value => $label): ?>
                            <button class="list-group-item list-group-item-action add-field" data-type="<?php echo $value; ?>">
                                <?php echo $label; ?>
                            </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Preview -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Form Editor - <?php echo htmlspecialchars($form->title); ?></h5>
                        <div>
                            <a href="<?php echo site_url('form_builder/preview/'.$form->id); ?>" class="btn btn-secondary">Preview</a>
                            <button class="btn btn-primary save-form">Save Changes</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="form-fields" class="sortable">
                            <?php foreach ($fields as $field): ?>
                            <div class="field-item card mb-3" data-id="<?php echo $field->id; ?>">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="card-title"><?php echo htmlspecialchars($field->label); ?></h6>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-primary edit-field">Edit</button>
                                            <button class="btn btn-sm btn-danger delete-field">Delete</button>
                                        </div>
                                    </div>
                                    <div class="field-preview">
                                        <?php $this->load->view('forms/field_previews/'.$field->field_type, ['field' => $field]); ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Field Edit Modal -->
    <div class="modal fade" id="fieldModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Field</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="fieldForm">
                        <input type="hidden" name="id">
                        <input type="hidden" name="form_id" value="<?php echo $form->id; ?>">
                        <input type="hidden" name="field_type">
                        
                        <div class="mb-3">
                            <label class="form-label">Label</label>
                            <input type="text" class="form-control" name="label" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Placeholder</label>
                            <input type="text" class="form-control" name="placeholder">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Help Text</label>
                            <input type="text" class="form-control" name="help_text">
                        </div>
                        
                        <div class="mb-3 options-group" style="display: none;">
                            <label class="form-label">Options (one per line)</label>
                            <textarea class="form-control" name="options" rows="4"></textarea>
                        </div>
                        
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" name="required" value="1">
                            <label class="form-check-label">Required</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-field">Save Field</button>
                </div>
            </div>
        </div>
    </div>
    ...
<script 
    src="https://code.jquery.com/jquery-3.6.0.min.js" 
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
    crossorigin="anonymous"></script>

<!-- jQuery UI -->
<script 
    src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" 
    integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" 
    crossorigin="anonymous"></script>

<!-- Bootstrap -->
<script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" 
    crossorigin="anonymous"></script>

<script>
$(document).ready(function() {
    // Check if jQuery and jQuery UI are loaded
    console.log('jQuery version:', $.fn.jquery);
    console.log('jQuery UI version:', $.ui ? $.ui.version : 'not loaded');
    
    if (typeof $.ui === 'undefined') {
        console.error('jQuery UI is not loaded!');
        return;
    }

    // Initialize sortable
    $("#form-fields").sortable({
        handle: '.card-title',
        update: function(event, ui) {
            updateFieldOrder();
        }
    });
    
    const fieldModal = new bootstrap.Modal(document.getElementById('fieldModal'));
    
    // Add new field
    $('.add-field').click(function() {
        const fieldType = $(this).data('type');
        $('input[name="id"]').val('');
        $('input[name="field_type"]').val(fieldType);
        $('.options-group').toggle(['select', 'radio', 'checkbox'].includes(fieldType));
        fieldModal.show();
    });
    
    // Save field
    $('.save-field').click(function() {
        const formData = $('#fieldForm').serialize();
        $.post('<?php echo site_url('form_builder/add_field/'.$form->id); ?>', formData, function(response) {
            location.reload();
        });
    });
    
    // Edit field
    $(document).on('click', '.edit-field', function() {
        const fieldItem = $(this).closest('.field-item');
        const fieldId = fieldItem.data('id');
        
        $.get('<?php echo site_url('form_builder/get_field/'); ?>/' + fieldId, function(data) {
            const field = typeof data === 'string' ? JSON.parse(data) : data;
            
            $('input[name="id"]').val(field.id);
            $('input[name="field_type"]').val(field.field_type);
            $('input[name="label"]').val(field.label);
            $('input[name="placeholder"]').val(field.placeholder);
            $('input[name="help_text"]').val(field.help_text);
            $('textarea[name="options"]').val(field.options);
            $('input[name="required"]').prop('checked', field.required == 1);
            $('.options-group').toggle(['select', 'radio', 'checkbox'].includes(field.field_type));
            
            fieldModal.show();
        });
    });
    
    // Delete field
    $('.delete-field').click(function() {
        if (confirm('Are you sure you want to delete this field?')) {
            const fieldItem = $(this).closest('.field-item');
            const fieldId = fieldItem.data('id');
            $.post('<?php echo site_url('form_builder/delete_field/'); ?>' + fieldId, function() {
                fieldItem.remove();
            });
        }
    });
    
    function updateFieldOrder() {
        const fields = [];
        $('.field-item').each(function(index) {
            fields.push({
                id: $(this).data('id'),
                field_order: index + 1
            });
        });
        
        $.post('<?php echo site_url('form_builder/update_field_order'); ?>', {fields: fields});
    }
});
</script>
...
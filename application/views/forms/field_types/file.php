<input type="file" 
    class="form-control" 
    name="field_<?php echo $field->id; ?>" 
    <?php echo $field->required ? 'required' : ''; ?>
    accept="<?php echo htmlspecialchars($field->validation_rules ?? ''); ?>">
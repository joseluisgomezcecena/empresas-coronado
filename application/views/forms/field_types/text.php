<input type="text" 
    class="form-control" 
    name="field_<?php echo $field->id; ?>" 
    placeholder="<?php echo htmlspecialchars($field->placeholder); ?>"
    <?php echo $field->required ? 'required' : ''; ?>>
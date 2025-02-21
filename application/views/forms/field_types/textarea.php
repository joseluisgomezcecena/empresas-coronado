<textarea 
    class="form-control" 
    name="field_<?php echo $field->id; ?>" 
    placeholder="<?php echo htmlspecialchars($field->placeholder); ?>"
    rows="3"
    <?php echo $field->required ? 'required' : ''; ?>></textarea>
<select 
    class="form-control" 
    name="field_<?php echo $field->id; ?>"
    <?php echo $field->required ? 'required' : ''; ?>>
    <option value="">Select an option</option>
    <?php 
    $options = json_decode($field->options, true);
    if ($options): 
        foreach ($options as $option): 
    ?>
    <option value="<?php echo htmlspecialchars($option); ?>"><?php echo htmlspecialchars($option); ?></option>
    <?php 
        endforeach;
    endif; 
    ?>
</select>
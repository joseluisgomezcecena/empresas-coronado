<select class="form-control" disabled>
    <option value="">Select an option</option>
    <?php 
    $options = json_decode($field->options, true);
    if ($options): 
        foreach ($options as $option): 
    ?>
    <option><?php echo htmlspecialchars($option); ?></option>
    <?php 
        endforeach;
    endif; 
    ?>
</select>
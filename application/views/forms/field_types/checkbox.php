<?php 
$options = json_decode($field->options, true);
if ($options): 
    foreach ($options as $option): 
?>
<div class="form-check">
    <input type="checkbox" 
        class="form-check-input" 
        name="field_<?php echo $field->id; ?>[]" 
        value="<?php echo htmlspecialchars($option); ?>"
        id="field_<?php echo $field->id; ?>_<?php echo md5($option); ?>">
    <label class="form-check-label" for="field_<?php echo $field->id; ?>_<?php echo md5($option); ?>">
        <?php echo htmlspecialchars($option); ?>
    </label>
</div>
<?php 
    endforeach;
endif; 
?>
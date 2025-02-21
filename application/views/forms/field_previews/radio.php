<?php 
$options = json_decode($field->options, true);
if ($options): 
    foreach ($options as $option): 
?>
<div class="form-check">
    <input type="radio" class="form-check-input" disabled>
    <label class="form-check-label"><?php echo htmlspecialchars($option); ?></label>
</div>
<?php 
    endforeach;
endif; 
?>
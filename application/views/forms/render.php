<div class="container mt-4">
    <form method="post" action="<?php echo site_url('form_builder/submit/'.$form->id); ?>" enctype="multipart/form-data">
        <?php foreach ($fields as $field): ?>
        <div class="mb-3">
            <label class="form-label">
                <?php echo htmlspecialchars($field->label); ?>
                <?php if ($field->required): ?>
                <span class="text-danger">*</span>
                <?php endif; ?>
            </label>
            
            <?php $this->load->view('forms/field_types/'.$field->field_type, ['field' => $field]); ?>
            
            <?php if ($field->help_text): ?>
            <div class="form-text"><?php echo htmlspecialchars($field->help_text); ?></div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
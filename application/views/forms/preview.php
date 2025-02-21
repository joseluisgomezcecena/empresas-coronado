<div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2><?php echo htmlspecialchars($form->title); ?></h2>
                <?php if ($form->description): ?>
                <p class="mb-0"><?php echo htmlspecialchars($form->description); ?></p>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <?php if (isset($errors)): ?>
                <div class="alert alert-danger">
                    <?php echo $errors; ?>
                </div>
                <?php endif; ?>

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
        </div>
    </div>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>My Forms</h1>
            <a href="<?php echo site_url('form_builder/create'); ?>" class="btn btn-primary">Create New Form</a>
        </div>

        <div class="row">
            <?php foreach ($forms as $form): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($form->title); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($form->description); ?></p>
                        <div class="btn-group">
                            <a href="<?php echo site_url('form_builder/edit/'.$form->id); ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="<?php echo site_url('form_builder/preview/'.$form->id); ?>" class="btn btn-sm btn-secondary">Preview</a>
                            <button class="btn btn-sm btn-danger delete-form" data-id="<?php echo $form->id; ?>">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
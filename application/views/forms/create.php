<div class="container mt-4">
        <h1>Create New Form</h1>
        <form method="post" action="<?php echo base_url('form_builder/create'); ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Form Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Form</button>
            <a href="<?php echo site_url('form_builder'); ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
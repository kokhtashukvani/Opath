<?php require_once APP_ROOT . '/views/partials/header.php'; ?>

<!-- Page header -->
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                Form Builder: <?php echo htmlspecialchars($data['form']->name); ?>
            </h2>
            <p class="text-muted"><?php echo htmlspecialchars($data['form']->description); ?></p>
        </div>
    </div>
</div>

<div class="row row-cards">
    <!-- List of Existing Fields -->
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Existing Fields</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>Label</th>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Required</th>
                            <th>Order</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data['fields'])): ?>
                            <tr>
                                <td colspan="5" class="text-center">This form has no fields yet.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($data['fields'] as $field): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($field->label); ?></td>
                                    <td><?php echo htmlspecialchars($field->field_type); ?></td>
                                    <td><code><?php echo htmlspecialchars($field->field_name); ?></code></td>
                                    <td><?php echo $field->is_required ? 'Yes' : 'No'; ?></td>
                                    <td><?php echo htmlspecialchars($field->sort_order); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add New Field Form -->
    <div class="col-12">
        <form class="card" action="index.php?action=form_field_store" method="post">
            <input type="hidden" name="form_id" value="<?php echo $data['form']->id; ?>">
            <div class="card-header">
                <h3 class="card-title">Add New Field</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Field Label</label>
                            <input type="text" class="form-control" name="label" placeholder="e.g., Your Full Name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Field Type</label>
                            <select name="field_type" class="form-select" required>
                                <option value="text">Single Line Text</option>
                                <option value="textarea">Paragraph Text</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Field Name (Machine-readable)</label>
                            <input type="text" class="form-control" name="field_name" placeholder="e.g., full_name (no spaces)" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Sort Order</label>
                            <input type="number" class="form-control" name="sort_order" value="0" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                             <label class="form-check">
                                <input type="checkbox" class="form-check-input" name="is_required" value="1">
                                <span class="form-check-label">Is this field required?</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Add Field to Form</button>
            </div>
        </form>
    </div>
</div>

<?php require_once APP_ROOT . '/views/partials/footer.php'; ?>

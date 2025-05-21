<?php
// Department Form - For adding or editing departments
$action = $data['action'] ?? 'add';
$department = $data['department'] ?? null;

$formAction = 'index.php?page=departments&action=' . $action;
if ($action === 'edit' && isset($department['id'])) {
    $formAction .= '&id=' . $department['id'];
}
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-building me-2"></i>
                <?php echo ($action === 'add') ? 'Add New Department' : 'Edit Department'; ?>
            </h5>
        </div>
        <div class="card-body">
            <form action="<?php echo $formAction; ?>" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Department Name</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="<?php echo isset($department['name']) ? htmlspecialchars($department['name']) : ''; ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location" 
                           value="<?php echo isset($department['location']) ? htmlspecialchars($department['location']) : ''; ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4"><?php echo isset($department['description']) ? htmlspecialchars($department['description']) : ''; ?></textarea>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="index.php?page=departments" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> <?php echo ($action === 'add') ? 'Add Department' : 'Update Department'; ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
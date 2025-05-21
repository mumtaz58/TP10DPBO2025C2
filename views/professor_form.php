<?php
// Get data from viewmodel (professor and departments are passed from the controller)
$professor = $data['professor'] ?? null;
$departments = $data['departments'] ?? [];
$action = $data['action'] ?? 'add';
$pageTitle = ($action === 'edit') ? 'Edit Professor' : 'Add Professor';
?>

<div class="row mb-4">
    <div class="col">
        <h2><?php echo $pageTitle; ?></h2>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="index.php?page=professors&action=<?php echo $action; ?><?php echo ($action === 'edit') ? '&id=' . $professor['id'] : ''; ?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($professor['name'] ?? ''); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($professor['email'] ?? ''); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="specialty" class="form-label">Specialty</label>
                <input type="text" class="form-control" id="specialty" name="specialty" value="<?php echo htmlspecialchars($professor['specialty'] ?? ''); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="department_id" class="form-label">Department</label>
                <select class="form-select" id="department_id" name="department_id" required>
                    <option value="">Select Department</option>
                    <?php foreach ($departments as $department): ?>
                    <option value="<?php echo $department->getDepartmentId(); ?>" <?php echo (isset($professor['department_id']) && $professor['department_id'] == $department->getDepartmentId()) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($department->getName()); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="index.php?page=professors" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
<?php
// Get data from viewmodel (departments are passed from the controller)
$departments = $data;
?>

<div class="row mb-4">
    <div class="col">
        <h2>Departments</h2>
    </div>
    <div class="col-auto">
        <a href="index.php?page=departments&action=add" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Department
        </a>
    </div>
</div>

<?php if (empty($departments)): ?>
<div class="alert alert-info">
    No departments found. Please add a new department.
</div>
<?php else: ?>
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($departments as $department): ?>
            <tr>
                <td><?php echo $department['id']; ?></td>
                <td><?php echo htmlspecialchars($department['name']); ?></td>
                <td><?php echo htmlspecialchars($department['location']); ?></td>
                <td><?php echo htmlspecialchars($department['description']); ?></td>
                <td>
                    <a href="index.php?page=departments&action=edit&id=<?php echo $department['id']; ?>" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button onclick="confirmDelete('department', <?php echo $department['id']; ?>)" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>
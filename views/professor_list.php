<?php
// Get data from viewmodel (professors are passed from the controller)
$professors = $data;
?>

<div class="row mb-4">
    <div class="col">
        <h2>Professors</h2>
    </div>
    <div class="col-auto">
        <a href="index.php?page=professors&action=add" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Professor
        </a>
    </div>
</div>

<?php if (empty($professors)): ?>
<div class="alert alert-info">
    No professors found. Please add a new professor.
</div>
<?php else: ?>
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Specialty</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($professors as $professor): ?>
            <tr>
                <td><?php echo $professor['id']; ?></td>
                <td><?php echo htmlspecialchars($professor['name']); ?></td>
                <td><?php echo htmlspecialchars($professor['email']); ?></td>
                <td><?php echo htmlspecialchars($professor['specialty']); ?></td>
                <td><?php echo htmlspecialchars($professor['department_name']); ?></td>
                <td>
                    <a href="index.php?page=professors&action=edit&id=<?php echo $professor['id']; ?>" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button onclick="confirmDelete('professor', <?php echo $professor['id']; ?>)" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>
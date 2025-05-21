<?php
// Get data from viewmodel (courses are passed from the controller)
$courses = $data;
?>

<div class="row mb-4">
    <div class="col">
        <h2>Courses</h2>
    </div>
    <div class="col-auto">
        <a href="index.php?page=courses&action=add" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Course
        </a>
    </div>
</div>

<?php if (empty($courses)): ?>
<div class="alert alert-info">
    No courses found. Please add a new course.
</div>
<?php else: ?>
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Code</th>
                <th>Title</th>
                <th>Credits</th>
                <th>Department</th>
                <th>Professor</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($courses as $course): ?>
            <tr>
                <td><?php echo htmlspecialchars($course['code']); ?></td>
                <td><?php echo htmlspecialchars($course['title']); ?></td>
                <td><?php echo $course['credits']; ?></td>
                <td><?php echo htmlspecialchars($course['department_name']); ?></td>
                <td><?php echo htmlspecialchars($course['professor_name']); ?></td>
                <td>
                    <a href="index.php?page=courses&action=edit&id=<?php echo $course['id']; ?>" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button onclick="confirmDelete('course', <?php echo $course['id']; ?>)" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>
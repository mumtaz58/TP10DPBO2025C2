<?php
// Get data from viewmodel (course, departments and professors are passed from the controller)
$course = $data['course'] ?? null;
$departments = $data['departments'] ?? [];
$professors = $data['professors'] ?? [];
$action = $data['action'] ?? 'add';
$pageTitle = ($action === 'edit') ? 'Edit Course' : 'Add Course';
?>

<div class="row mb-4">
    <div class="col">
        <h2><?php echo $pageTitle; ?></h2>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="index.php?page=courses&action=<?php echo $action; ?><?php echo ($action === 'edit') ? '&id=' . $course['id'] : ''; ?>" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Course Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($course['title'] ?? ''); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="code" class="form-label">Course Code</label>
                <input type="text" class="form-control" id="code" name="code" value="<?php echo htmlspecialchars($course['code'] ?? ''); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="credits" class="form-label">Credits</label>
                <input type="number" class="form-control" id="credits" name="credits" value="<?php echo $course['credits'] ?? 3; ?>" min="1" max="6" required>
            </div>
            
            <div class="mb-3">
                <label for="department_id" class="form-label">Department</label>
                <select class="form-select" id="department_id" name="department_id" required>
                    <option value="">Select Department</option>
                    <?php foreach ($departments as $department): ?>
                    <option value="<?php echo $department->getDepartmentId(); ?>" <?php echo (isset($course['department_id']) && $course['department_id'] == $department->getDepartmentId()) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($department->getName()); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="professor_id" class="form-label">Professor</label>
                <select class="form-select" id="professor_id" name="professor_id" required>
                    <option value="">Select Professor</option>
                    <?php foreach ($professors as $professor): ?>
                    <option value="<?php echo $professor->getProfessorId(); ?>" <?php echo (isset($course['professor_id']) && $course['professor_id'] == $professor->getProfessorId()) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($professor->getName()); ?> (<?php echo htmlspecialchars($professor->getDepartmentName()); ?>)
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($course['description'] ?? ''); ?></textarea>
            </div>
            
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="index.php?page=courses" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
<?php
// Include necessary files
require_once('config/Database.php');
require_once('model/Department.php');
require_once('model/Professor.php');
require_once('model/Course.php');
require_once('viewmodel/DepartmentViewModel.php');
require_once('viewmodel/ProfessorViewModel.php');
require_once('viewmodel/CourseViewModel.php');

// Basic routing
$page = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;

// Handle department actions
if ($page === 'departments') {
    $viewModel = new DepartmentViewModel();
    
    // Handle CRUD operations
    if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $location = $_POST['location'] ?? '';
        $description = $_POST['description'] ?? '';
        
        $viewModel->addDepartment($name, $location, $description);
        header('Location: index.php?page=departments');
        exit;
    } 
    else if ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $location = $_POST['location'] ?? '';
        $description = $_POST['description'] ?? '';
        
        $viewModel->updateDepartment($id, $name, $location, $description);
        header('Location: index.php?page=departments');
        exit;
    } 
    else if ($action === 'delete') {
        $viewModel->deleteDepartment($id);
        header('Location: index.php?page=departments');
        exit;
    }
    
    // Show appropriate view
    include_once('views/template/header.php');
    
    if ($action === 'add') {
        $data = ['action' => 'add'];
        include_once('views/department_form.php');
    } 
    else if ($action === 'edit') {
        $department = $viewModel->getDepartmentById($id);
        $data = [
            'action' => 'edit',
            'department' => [
                'id' => $department->getDepartmentId(),
                'name' => $department->getName(),
                'location' => $department->getLocation(),
                'description' => $department->getDescription()
            ]
        ];
        include_once('views/department_form.php');
    } 
    else {
        // List view
        $departments = $viewModel->getDepartments();
        $data = $viewModel->bindDepartmentData($departments);
        include_once('views/department_list.php');
    }
}
// Handle professor actions
else if ($page === 'professors') {
    $viewModel = new ProfessorViewModel();
    
    // Handle CRUD operations
    if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $department_id = $_POST['department_id'] ?? '';
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $specialty = $_POST['specialty'] ?? '';
        
        $viewModel->addProfessor($department_id, $name, $email, $specialty);
        header('Location: index.php?page=professors');
        exit;
    } 
    else if ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $department_id = $_POST['department_id'] ?? '';
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $specialty = $_POST['specialty'] ?? '';
        
        $viewModel->updateProfessor($id, $department_id, $name, $email, $specialty);
        header('Location: index.php?page=professors');
        exit;
    } 
    else if ($action === 'delete') {
        $viewModel->deleteProfessor($id);
        header('Location: index.php?page=professors');
        exit;
    }
    
    // Show appropriate view
    include_once('views/template/header.php');
    
    if ($action === 'add' || $action === 'edit') {
        $departments = $viewModel->getDepartments();
        
        if ($action === 'edit') {
            $professor = $viewModel->getProfessorById($id);
            $data = [
                'action' => 'edit',
                'professor' => [
                    'id' => $professor->getProfessorId(),
                    'department_id' => $professor->getDepartmentId(),
                    'name' => $professor->getName(),
                    'email' => $professor->getEmail(),
                    'specialty' => $professor->getSpecialty()
                ],
                'departments' => $departments
            ];
        } else {
            $data = [
                'action' => 'add',
                'departments' => $departments
            ];
        }
        
        include_once('views/professor_form.php');
    } 
    else {
        // List view
        $professors = $viewModel->getProfessors();
        $data = $viewModel->bindProfessorData($professors);
        include_once('views/professor_list.php');
    }
}
// Handle course actions
else if ($page === 'courses') {
    $viewModel = new CourseViewModel();
    
    // Handle CRUD operations
    if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $department_id = $_POST['department_id'] ?? '';
        $professor_id = $_POST['professor_id'] ?? '';
        $title = $_POST['title'] ?? '';
        $code = $_POST['code'] ?? '';
        $credits = $_POST['credits'] ?? 3;
        $description = $_POST['description'] ?? '';
        
        $viewModel->addCourse($department_id, $professor_id, $title, $code, $credits, $description);
        header('Location: index.php?page=courses');
        exit;
    } 
    else if ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $department_id = $_POST['department_id'] ?? '';
        $professor_id = $_POST['professor_id'] ?? '';
        $title = $_POST['title'] ?? '';
        $code = $_POST['code'] ?? '';
        $credits = $_POST['credits'] ?? 3;
        $description = $_POST['description'] ?? '';
        
        $viewModel->updateCourse($id, $department_id, $professor_id, $title, $code, $credits, $description);
        header('Location: index.php?page=courses');
        exit;
    } 
    else if ($action === 'delete') {
        $viewModel->deleteCourse($id);
        header('Location: index.php?page=courses');
        exit;
    }
    
    // Show appropriate view
    include_once('views/template/header.php');
    
    if ($action === 'add' || $action === 'edit') {
        $departments = $viewModel->getDepartments();
        $professors = $viewModel->getProfessors();
        
        // Apply department filter if specified
        $department_id = $_GET['department_id'] ?? null;
        if ($department_id) {
            $professors = $viewModel->getProfessorsByDepartment($department_id);
        }
        
        if ($action === 'edit') {
            $course = $viewModel->getCourseById($id);
            $data = [
                'action' => 'edit',
                'course' => [
                    'id' => $course->getCourseId(),
                    'department_id' => $course->getDepartmentId(),
                    'professor_id' => $course->getProfessorId(),
                    'title' => $course->getTitle(),
                    'code' => $course->getCode(),
                    'credits' => $course->getCredits(),
                    'description' => $course->getDescription()
                ],
                'departments' => $departments,
                'professors' => $professors
            ];
        } else {
            $data = [
                'action' => 'add',
                'departments' => $departments,
                'professors' => $professors
            ];
        }
        
        include_once('views/course_form.php');
    } 
    else {
        // List view
        $courses = $viewModel->getCourses();
        $data = $viewModel->bindCourseData($courses);
        include_once('views/course_list.php');
    }
}
// Default home page
else {
    include_once('views/template/header.php');
    
    // Show welcome page with system overview
    ?>
    <div class="jumbotron bg-light p-5 rounded">
        <h1 class="display-4">College Course Management System</h1>
        <p class="lead">A comprehensive system for managing college departments, professors, and courses.</p>
        <hr class="my-4">
        <p>Use the navigation bar above to access different modules of the system.</p>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-building me-2"></i>Departments</h5>
                    <p class="card-text">Manage academic departments, including names, locations, and descriptions.</p>
                    <a href="index.php?page=departments" class="btn btn-primary">Manage Departments</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-user-tie me-2"></i>Professors</h5>
                    <p class="card-text">Manage faculty members, their departments, specialties, and contact information.</p>
                    <a href="index.php?page=professors" class="btn btn-primary">Manage Professors</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-book me-2"></i>Courses</h5>
                    <p class="card-text">Manage course offerings, including details, department associations, and instructors.</p>
                    <a href="index.php?page=courses" class="btn btn-primary">Manage Courses</a>
                </div>
            </div>
        </div>
    </div>
    <?php
}

// Include footer
include_once('views/template/footer.php');
?>
<?php
require_once('config/Database.php');
require_once('model/Course.php');
require_once('viewmodel/DepartmentViewModel.php');
require_once('viewmodel/ProfessorViewModel.php');

class CourseViewModel
{
    private $db;
    private $courses = [];
    private $departmentViewModel;
    private $professorViewModel;

    public function __construct()
    {
        $this->db = new Database();
        $this->departmentViewModel = new DepartmentViewModel();
        $this->professorViewModel = new ProfessorViewModel();
        $this->loadCourses();
    }

    // Load all courses from database with department and professor names
    private function loadCourses()
    {
        $this->courses = [];
        $query = "SELECT c.*, d.name as department_name, p.name as professor_name
                 FROM courses c
                 JOIN departments d ON c.department_id = d.department_id
                 JOIN professors p ON c.professor_id = p.professor_id
                 ORDER BY c.title";
        $result = $this->db->fetchAll($query);

        foreach ($result as $row) {
            $course = new Course(
                $row['course_id'],
                $row['department_id'],
                $row['professor_id'],
                $row['title'],
                $row['code'],
                $row['credits'],
                $row['description'],
                $row['department_name'],
                $row['professor_name']
            );
            $this->courses[] = $course;
        }
    }

    // Get all courses
    public function getCourses()
    {
        return $this->courses;
    }

    // Get course by ID
    public function getCourseById($id)
    {
        $query = "SELECT c.*, d.name as department_name, p.name as professor_name
                 FROM courses c
                 JOIN departments d ON c.department_id = d.department_id
                 JOIN professors p ON c.professor_id = p.professor_id
                 WHERE c.course_id = :id";
        $params = [':id' => $id];
        $result = $this->db->fetch($query, $params);

        if ($result) {
            return new Course(
                $result['course_id'],
                $result['department_id'],
                $result['professor_id'],
                $result['title'],
                $result['code'],
                $result['credits'],
                $result['description'],
                $result['department_name'],
                $result['professor_name']
            );
        }
        return null;
    }

    // Add a new course
    public function addCourse($department_id, $professor_id, $title, $code, $credits, $description)
    {
        $query = "INSERT INTO courses (department_id, professor_id, title, code, credits, description) 
                 VALUES (:department_id, :professor_id, :title, :code, :credits, :description)";
        $params = [
            ':department_id' => $department_id,
            ':professor_id' => $professor_id,
            ':title' => $title,
            ':code' => $code,
            ':credits' => $credits,
            ':description' => $description
        ];
        $this->db->executeQuery($query, $params);
        $this->loadCourses(); // Refresh data
        return true;
    }

    // Update an existing course
    public function updateCourse($id, $department_id, $professor_id, $title, $code, $credits, $description)
    {
        $query = "UPDATE courses 
                 SET department_id = :department_id, professor_id = :professor_id, 
                     title = :title, code = :code, credits = :credits, description = :description 
                 WHERE course_id = :id";
        $params = [
            ':id' => $id,
            ':department_id' => $department_id,
            ':professor_id' => $professor_id,
            ':title' => $title,
            ':code' => $code,
            ':credits' => $credits,
            ':description' => $description
        ];
        $this->db->executeQuery($query, $params);
        $this->loadCourses(); // Refresh data
        return true;
    }

    // Delete a course
    public function deleteCourse($id)
    {
        $query = "DELETE FROM courses WHERE course_id = :id";
        $params = [':id' => $id];
        $this->db->executeQuery($query, $params);
        $this->loadCourses(); // Refresh data
        return true;
    }

    // Get courses by department ID
    public function getCoursesByDepartment($department_id)
    {
        $filtered = [];
        foreach ($this->courses as $course) {
            if ($course->getDepartmentId() == $department_id) {
                $filtered[] = $course;
            }
        }
        return $filtered;
    }

    // Get courses by professor ID
    public function getCoursesByProfessor($professor_id)
    {
        $filtered = [];
        foreach ($this->courses as $course) {
            if ($course->getProfessorId() == $professor_id) {
                $filtered[] = $course;
            }
        }
        return $filtered;
    }

    // Get departments for dropdown
    public function getDepartments()
    {
        return $this->departmentViewModel->getDepartments();
    }

    // Get professors for dropdown
    public function getProfessors()
    {
        return $this->professorViewModel->getProfessors();
    }

    // Get professors by department for filtered dropdown
    public function getProfessorsByDepartment($department_id)
    {
        return $this->professorViewModel->getProfessorsByDepartment($department_id);
    }

    // Data binding method - prepare data for view
    public function bindCourseData($courses = null)
    {
        if ($courses === null) {
            $courses = $this->courses;
        }
        
        $data = [];
        foreach ($courses as $course) {
            $data[] = [
                'id' => $course->getCourseId(),
                'department_id' => $course->getDepartmentId(),
                'professor_id' => $course->getProfessorId(),
                'title' => $course->getTitle(),
                'code' => $course->getCode(),
                'credits' => $course->getCredits(),
                'description' => $course->getDescription(),
                'department_name' => $course->getDepartmentName(),
                'professor_name' => $course->getProfessorName()
            ];
        }
        return $data;
    }
}
<?php
require_once('config/Database.php');
require_once('model/Professor.php');
require_once('viewmodel/DepartmentViewModel.php');

class ProfessorViewModel
{
    private $db;
    private $professors = [];
    private $departmentViewModel;

    public function __construct()
    {
        $this->db = new Database();
        $this->departmentViewModel = new DepartmentViewModel();
        $this->loadProfessors();
    }

    // Load all professors from database with department names
    private function loadProfessors()
    {
        $this->professors = [];
        $query = "SELECT p.*, d.name as department_name 
                  FROM professors p
                  JOIN departments d ON p.department_id = d.department_id
                  ORDER BY p.professor_id ASC"; // ✅ Diperbaiki: urut berdasarkan ID
                  
        $result = $this->db->fetchAll($query);

        foreach ($result as $row) {
            $professor = new Professor(
                $row['professor_id'],
                $row['department_id'],
                $row['name'],
                $row['email'],
                $row['specialty'],
                $row['department_name']
            );
            $this->professors[] = $professor;
        }
    }

    // Get all professors
    public function getProfessors()
    {
        return $this->professors;
    }

    // Get professor by ID
    public function getProfessorById($id)
    {
        $query = "SELECT p.*, d.name as department_name 
                  FROM professors p
                  JOIN departments d ON p.department_id = d.department_id
                  WHERE p.professor_id = :id";
        $params = [':id' => $id];
        $result = $this->db->fetch($query, $params);

        if ($result) {
            return new Professor(
                $result['professor_id'],
                $result['department_id'],
                $result['name'],
                $result['email'],
                $result['specialty'],
                $result['department_name']
            );
        }
        return null;
    }

    // Add a new professor
    public function addProfessor($department_id, $name, $email, $specialty)
    {
        $query = "INSERT INTO professors (department_id, name, email, specialty) 
                  VALUES (:department_id, :name, :email, :specialty)";
        $params = [
            ':department_id' => $department_id,
            ':name' => $name,
            ':email' => $email,
            ':specialty' => $specialty
        ];
        $this->db->executeQuery($query, $params);
        $this->loadProfessors(); // Refresh data
        return true;
    }

    // Update an existing professor
    public function updateProfessor($id, $department_id, $name, $email, $specialty)
    {
        $query = "UPDATE professors 
                  SET department_id = :department_id, name = :name, 
                      email = :email, specialty = :specialty 
                  WHERE professor_id = :id";
        $params = [
            ':id' => $id,
            ':department_id' => $department_id,
            ':name' => $name,
            ':email' => $email,
            ':specialty' => $specialty
        ];
        $this->db->executeQuery($query, $params);
        $this->loadProfessors(); // Refresh data
        return true;
    }

    // Delete a professor
    public function deleteProfessor($id)
    {
        $query = "DELETE FROM professors WHERE professor_id = :id";
        $params = [':id' => $id];
        $this->db->executeQuery($query, $params);
        $this->loadProfessors(); // Refresh data
        return true;
    }

    // Get professors by department ID
    public function getProfessorsByDepartment($department_id)
    {
        $filtered = [];
        foreach ($this->professors as $professor) {
            if ($professor->getDepartmentId() == $department_id) {
                $filtered[] = $professor;
            }
        }
        return $filtered;
    }

    // Get departments for dropdown
    public function getDepartments()
    {
        return $this->departmentViewModel->getDepartments();
    }

    // Data binding method - prepare data for view
    public function bindProfessorData($professors = null)
    {
        if ($professors === null) {
            $professors = $this->professors;
        }
        
        $data = [];
        foreach ($professors as $professor) {
            $data[] = [
                'id' => $professor->getProfessorId(),
                'department_id' => $professor->getDepartmentId(),
                'name' => $professor->getName(),
                'email' => $professor->getEmail(),
                'specialty' => $professor->getSpecialty(),
                'department_name' => $professor->getDepartmentName()
            ];
        }
        return $data;
    }
}

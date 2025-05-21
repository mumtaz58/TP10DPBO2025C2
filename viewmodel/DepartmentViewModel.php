<?php
require_once('config/Database.php');
require_once('model/Department.php');

class DepartmentViewModel
{
    private $db;
    private $departments = [];

    public function __construct()
    {
        $this->db = new Database();
        $this->loadDepartments();
    }

    // Load all departments from database
    private function loadDepartments()
    {
        $this->departments = [];
        $query = "SELECT * FROM departments ORDER BY name";
        $result = $this->db->fetchAll($query);

        foreach ($result as $row) {
            $department = new Department(
                $row['department_id'],
                $row['name'],
                $row['location'],
                $row['description']
            );
            $this->departments[] = $department;
        }
    }

    // Get all departments
    public function getDepartments()
    {
        return $this->departments;
    }

    // Get department by ID
    public function getDepartmentById($id)
    {
        $query = "SELECT * FROM departments WHERE department_id = :id";
        $params = [':id' => $id];
        $result = $this->db->fetch($query, $params);

        if ($result) {
            return new Department(
                $result['department_id'],
                $result['name'],
                $result['location'],
                $result['description']
            );
        }
        return null;
    }

    // Add a new department
    public function addDepartment($name, $location, $description)
    {
        $query = "INSERT INTO departments (name, location, description) 
                 VALUES (:name, :location, :description)";
        $params = [
            ':name' => $name,
            ':location' => $location,
            ':description' => $description
        ];
        $this->db->executeQuery($query, $params);
        $this->loadDepartments(); // Refresh data
        return true;
    }

    // Update an existing department
    public function updateDepartment($id, $name, $location, $description)
    {
        $query = "UPDATE departments 
                 SET name = :name, location = :location, description = :description 
                 WHERE department_id = :id";
        $params = [
            ':id' => $id,
            ':name' => $name,
            ':location' => $location,
            ':description' => $description
        ];
        $this->db->executeQuery($query, $params);
        $this->loadDepartments(); // Refresh data
        return true;
    }

    // Delete a department
    public function deleteDepartment($id)
    {
        // Note: Foreign key constraints will handle cascading deletes
        $query = "DELETE FROM departments WHERE department_id = :id";
        $params = [':id' => $id];
        $this->db->executeQuery($query, $params);
        $this->loadDepartments(); // Refresh data
        return true;
    }

    // Data binding method - prepare data for view
    public function bindDepartmentData($departments = null)
    {
        if ($departments === null) {
            $departments = $this->departments;
        }
        
        $data = [];
        foreach ($departments as $department) {
            $data[] = [
                'id' => $department->getDepartmentId(),
                'name' => $department->getName(),
                'location' => $department->getLocation(),
                'description' => $department->getDescription()
            ];
        }
        return $data;
    }
}
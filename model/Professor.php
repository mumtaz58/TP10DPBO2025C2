<?php

class Professor
{
    private $professor_id;
    private $department_id;
    private $name;
    private $email;
    private $specialty;
    private $department_name; // For displaying department name

    public function __construct($professor_id = "", $department_id = "", $name = "", $email = "", $specialty = "", $department_name = "")
    {
        $this->professor_id = $professor_id;
        $this->department_id = $department_id;
        $this->name = $name;
        $this->email = $email;
        $this->specialty = $specialty;
        $this->department_name = $department_name;
    }

    // Getters
    public function getProfessorId()
    {
        return $this->professor_id;
    }

    public function getDepartmentId()
    {
        return $this->department_id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSpecialty()
    {
        return $this->specialty;
    }
    
    public function getDepartmentName()
    {
        return $this->department_name;
    }

    // Setters
    public function setProfessorId($professor_id)
    {
        $this->professor_id = $professor_id;
    }

    public function setDepartmentId($department_id)
    {
        $this->department_id = $department_id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setSpecialty($specialty)
    {
        $this->specialty = $specialty;
    }
    
    public function setDepartmentName($department_name)
    {
        $this->department_name = $department_name;
    }
}
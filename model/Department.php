<?php

class Department
{
    private $department_id;
    private $name;
    private $location;
    private $description;

    public function __construct($department_id = "", $name = "", $location = "", $description = "")
    {
        $this->department_id = $department_id;
        $this->name = $name;
        $this->location = $location;
        $this->description = $description;
    }

    // Getters
    public function getDepartmentId()
    {
        return $this->department_id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getDescription()
    {
        return $this->description;
    }

    // Setters
    public function setDepartmentId($department_id)
    {
        $this->department_id = $department_id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
}
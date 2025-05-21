<?php

class Course
{
    private $course_id;
    private $department_id;
    private $professor_id;
    private $title;
    private $code;
    private $credits;
    private $description;
    private $department_name; // For displaying department name
    private $professor_name; // For displaying professor name

    public function __construct($course_id = "", $department_id = "", $professor_id = "", $title = "", $code = "", $credits = "", $description = "", $department_name = "", $professor_name = "")
    {
        $this->course_id = $course_id;
        $this->department_id = $department_id;
        $this->professor_id = $professor_id;
        $this->title = $title;
        $this->code = $code;
        $this->credits = $credits;
        $this->description = $description;
        $this->department_name = $department_name;
        $this->professor_name = $professor_name;
    }

    // Getters
    public function getCourseId()
    {
        return $this->course_id;
    }

    public function getDepartmentId()
    {
        return $this->department_id;
    }

    public function getProfessorId()
    {
        return $this->professor_id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getCredits()
    {
        return $this->credits;
    }

    public function getDescription()
    {
        return $this->description;
    }
    
    public function getDepartmentName()
    {
        return $this->department_name;
    }
    
    public function getProfessorName()
    {
        return $this->professor_name;
    }

    // Setters
    public function setCourseId($course_id)
    {
        $this->course_id = $course_id;
    }

    public function setDepartmentId($department_id)
    {
        $this->department_id = $department_id;
    }

    public function setProfessorId($professor_id)
    {
        $this->professor_id = $professor_id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function setCredits($credits)
    {
        $this->credits = $credits;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    public function setDepartmentName($department_name)
    {
        $this->department_name = $department_name;
    }
    
    public function setProfessorName($professor_name)
    {
        $this->professor_name = $professor_name;
    }
}
<?php

namespace app\models;

use Flight;


Class Categorie
{
    private $id;
    private $name;

    public function __construct($name = null, $id = null)
    {
        $this->name = $name;
        $this->id = $id;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}
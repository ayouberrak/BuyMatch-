<?php



require_once __DIR__ . '/../../config/database.php';

 class User
{

    private $id;
    private $name;
    private $email;
    private $password;
    private $photo;
    private $role;
    private $status;

    public function __construct($id = null, $name = null, $email = null, $password = null, $photo = null, $role = null, $status = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->photo = $photo;
        $this->role = $role;
        $this->status = $status;
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getPhoto()
    {
        return $this->photo;
    }
    public function getRole()
    {
        return $this->role;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }


}
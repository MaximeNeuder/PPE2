<?php

namespace RallyeLecture\Model;

class Enseignant implements IModele {
    
   private $id;
    private $nom;
    private  $prenom;
    private $login;
    private  $password;
    
    function __construct(array $properties) {
        if (!empty($properties)) {
            $this->Map($properties);
        }
    }
    
    public function GetId() {
        return $this->id;
    }
    
    public function GetNom() {
        return $this->nom;
    }
    
     public function GetPrenom() {
        return $this->prenom;
    }
    
     public function GetLogin() {
        return $this->login;
    }
    
     public function GetPassword() {
        return $this->password;
    }

    public function GetParams() {
        $params = array(
            ':id' => array($this->id, \PDO::PARAM_INT),
            ':nom' => array($this->nom, \PDO::PARAM_STR),
            ':prenom' => array($this->prenom, \PDO::PARAM_STR),
            ':login' => array($this->login, \PDO::PARAM_STR),
            ':password' => array($this->password, \PDO::PARAM_STR)
        );
        return $params;
    }

    public function Map(array $properties) {
        foreach ($properties as $key => $value) {
            if (property_exists('\RallyeLecture\Model\Enseignant', $key)) {
                $this->$key = $value;
            }
        }
    }

    public function SetId($id) {
        $this->id = $id;
    }

    public function Validate() {
        
    }

//put your code here
}

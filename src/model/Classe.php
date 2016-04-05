<?php

namespace RallyeLecture\Model;

class Classe implements IModele{
    
    private $id;
    private $anneeScolaire;
    private $idEnseignant;
    private $idNiveau;
    
    function __construct(array $properties) {
        if (!empty($properties)) {
            $this->Map($properties);
        }
    }
    
    public function GetId() {
        return $this->id;
    }
    
    public function GetAnneeScolaire(){
        return $this->anneeScolaire;
    }
    
    public function GetIdEnseignant(){
        return $this->idEnseignant;
    }
    
    public function GetIdNiveau(){
        return $this->idNiveau;
    }

    public function GetParams() {
        $params = array(
            ':id' => array($this->id, \PDO::PARAM_INT),
            ':anneeScolaire' => array($this->anneeScolaire, \PDO::PARAM_STR),
            ':idEnseignant' => array($this->idEnseignant, \PDO::PARAM_INT),
            ':idNiveau' => array($this->idNiveau, \PDO::PARAM_INT)
            );
        return $params;
    }

    public function Map(array $properties) {
        foreach ($properties as $key => $value) {
            if (property_exists('\RallyeLecture\Model\Classe', $key)) {
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

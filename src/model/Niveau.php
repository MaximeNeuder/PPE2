<?php

namespace RallyeLecture\Model;

class Niveau implements IModele {
    /* @var $id int */
    /* @var $niveauScolaire string */

    private $id;
    private $niveauScolaire;

    function __construct(array $properties) {
        if (!empty($properties)) {
            $this->Map($properties);
        }
    }

    public function GetId() {
        return $this->id;
    }

    public function GetNiveauScolaire() {
        return $this->niveauScolaire;
    }

    public function GetParams() {
        $params = array(
            ':id'             => array($this->id, \PDO::PARAM_INT),
            ':niveauScolaire' => array($this->niveauScolaire, \PDO::PARAM_STR)
        );
        return $params;
    }

    public function Map(array $properties) {
        foreach ($properties as $key => $value) {
            if (property_exists('\RallyeLecture\Model\Niveau', $key)) {
                $this->$key = $value;
            }
        }
    }

    public function Validate() {
        
    }

    public function SetId($id) {
        $this->id = $id;
    }

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RallyeLecture\dao;

class SqlBuilder {

    private $select;    /* @var string */

    public function __construct($select) {
        //$selectLower = \strtolower($select);
        if (!(\strpos($select, 'select') === 0)) {
            throw new \Exception("la requête doit commencer par select");
        }
        if (\strpos($select, 'from') === false) {
            throw new \Exception("la clause from doit être présente dans la requête");
        }
        $this->select = $select;
    }

    public function GetSelect() {
        return $this->select;
    }

    public function GetSelectById() {
        return $this->select . " where id=:id";
    }
    
    public function  GetCount() {
        return "select count(*) from " . $this->getTable();
    }

    public function GetInsert() {
        $insert = "insert into " . $this->getTable() . "(";
        $attributs = $this->getAttributes();

        for ($index = 0; $index < count($attributs); $index++) {
            if ($index == (count($attributs) - 1)) {
                $insert = $insert . $attributs[$index] . ")";
            } else {
                $insert = $insert . $attributs[$index] . ",";
            }
        }
        $insert = $insert . " values(";
        for ($index = 0; $index < count($attributs); $index++) {
            if ($index == (count($attributs) - 1)) {
                $insert = $insert . ":" . $attributs[$index] . ")";
            } else {
                $insert = $insert . ":" . $attributs[$index] . ",";
            }
        }
        return $insert;
    }

    public function GetDelete() {
        return "delete from " . $this->getTable() . " where id=:id";
    }

    public function GetUpdate() {
        $update = "update " . $this->getTable() . " set ";
        $attributs = $this->getAttributes();
        for ($index = 0; $index < count($attributs); $index++) {
            if ($index == (count($attributs) - 1)) {
                if ($attributs[$index] != 'id') {
                    $update = $update . $attributs[$index] . "=:" . $attributs[$index];
                }
                $update = $update . " where id=:id";
            } else {
                if ($attributs[$index] != 'id') {
                    $update = $update . $attributs[$index] . "=:" . $attributs[$index] . ",";
                }
            }
        }
        return $update;
    }

    public function GetTable() {
        $array = \explode(" ", $this->select);
        $index = \array_search('from', $array);
        return $array[$index + 1];
    }

    public function GetAttributes() {
        $search = array('select', 'from ' . $this->GetTable());
        $subject = str_replace($search, "", $this->select);
        $attributs = explode(",", trim($subject));
        return $attributs;
    }

    public function GetClass() {
        // pour l'instant. todo: dissocier table/class
        return 'RallyeLecture\\Model\\' . $this->GetTable();
    }

}

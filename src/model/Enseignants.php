<?php

namespace RallyeLecture\Model;

class Enseignants implements \Iterator{
    
    private $enseignants;
    private $index;
    
     public function __construct (array $enseignants) {
        /* @var $value Niveau */
        foreach ($enseignants as $value) {
            $this->enseignants[] = $value;
            $this->index = 0;
        }
    }
    
    public function GetEnseignant($id) {
        /* @var $niveau Niveau */
        foreach ($this->enseignants as $enseignant) {
            if ($enseignant->GetId() === $id) {
                return $enseignant;
            }
        }
    }
    
    public function current() {
        return $this->enseignants[$this->index];
    }

    public function key() {
        return $this->index;
    }

    public function next() {
        $this->index++;
    }

    public function rewind() {
        $this->index = 0;
    }

    public function valid() {
        return isset($this->enseignants[$this->index]);
    }

//put your code here
}

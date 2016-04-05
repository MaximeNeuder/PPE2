<?php

namespace RallyeLecture\Model;

class Classes implements \Iterator{
    
    private $classes;
    private $index;
    
    
    public function __construct (array $classes) {
        /* @var $value Niveau */
        foreach ($classes as $value) {
            $this->classes[] = $value;
            $this->index = 0;
        }
    }
    
    public function GetClasse($id) {
        /* @var $niveau Niveau */
        foreach ($this->classes as $classe) {
            if ($classe->GetId() === $id) {
                return $classe;
            }
        }
    }
    
    public function current() {
        return $this->classes[$this->index];
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
        return isset($this->classes[$this->index]);
    }

//put your code here
}

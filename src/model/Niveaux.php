<?php

namespace RallyeLecture\Model;

class Niveaux implements \Iterator {
    /* @var $niveaux array */
    /* @var $index int */

    private $niveaux;
    private $index;

    public function __construct (array $niveaux) {
        /* @var $value Niveau */
        foreach ($niveaux as $value) {
            $this->niveaux[] = $value;
            $this->index = 0;
        }
    }

    public function GetNiveau($id) {
        /* @var $niveau Niveau */
        foreach ($this->niveaux as $niveau) {
            if ($niveau->GetId() === $id) {
                return $niveau;
            }
        }
    }

    public function current() {
        return $this->niveaux[$this->index];
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
        return isset($this->niveaux[$this->index]);
    }

}

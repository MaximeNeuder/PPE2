<?php
namespace RallyeLecture\Model;

interface IModele {
    public function Map(array $properties);
    public function GetParams();
    public function GetId();
    public function SetId($id);
    public function Validate();
}
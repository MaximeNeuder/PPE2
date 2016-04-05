<?php

namespace RallyeLecture\dao;

use PDO;

class BaseDao {
    /** @var $db \PDO */

    /** @var $sqlBuilder \RallyeLecture\dao\SqlBuilder */
    static private $db = null;
    private $sqlBuilder;

    static protected function GetDb() {
        // la connexion n'existe pas on l'instancie
        if (BaseDao::$db == null) {
            $config = \RallyeLecture\Config\Config::getConfig("db");
            try {
                BaseDao::$db = new PDO($config['server'], $config['username'], $config['password'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            } catch (Exception $ex) {
                throw new Exception('DB erreur de connection : ' . $ex->getMessage());
            }
        }
        return BaseDao::$db;
    }

    protected static function throwDbError(array $errorInfo) {
        throw new Exception('DB erreur [' . $errorInfo[0] . ', ' . $errorInfo[1] . ']: ' . $errorInfo[2]);
    }

    protected static function formatDateTime(DateTime $date) {
        return $date->format(DateTime::ISO8601);
    }

    public function __construct($select) {
        $this->sqlBuilder = new \RallyeLecture\dao\SqlBuilder($select);
    }

    public function GetAll() {
        /* @var $query \PDOStatement */
        $select = $this->sqlBuilder->GetSelect();
        $class = $this->sqlBuilder->GetClass();

        $query = BaseDao::getDb()->prepare($select);
        if (!$query->execute()) {
            self::throwDbError($this->getDb()->errorInfo());
        }
        return $query->FetchAll(PDO::FETCH_CLASS, $class, array(array()));

        // array(0 => false)
    }

    public function GetById($id) {
        /* @var $query \PDOStatement */
        $select = $this->sqlBuilder->GetSelectById();
        $class = $this->sqlBuilder->GetClass();
        $params = array(':id' => $id);

        $query = BaseDao::getDb()->prepare($select, $params);
        if (!$query->execute()) {
            self::throwDbError($this->getDb()->errorInfo());
        }
        return $query->fetchObject($class, array(array()));
    }

    public function Delete($id) {
        /* @var $query \PDOStatement */
        /* @var $db \PDO */
        $delete = $this->sqlBuilder->GetDelete();
        $query = $this->getDb()->prepare($delete);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        try {
            $query->execute();
        } catch (Exception $exc) {
            self::throwDbError($this->getDb()->errorInfo());
            // $table = $this->sqlBuilder->GetTable();
            // throw new NotFoundException("l'occurence id : {$id} de la table {$table} n''a pas pu être supprimée");
        }
        // retourne le nombre d'occurences supprimées
        return $query->rowCount();
    }

    public function Insert(\RallyeLecture\Model\IModele $iModele) {
        /* @var $query \PDOStatement */
        $insert = $this->sqlBuilder->Getinsert();

        $params = $iModele->GetParams();
        $query = self::GetDb()->prepare($insert);
        $query = $this->bindParams($query, $params);
        try {
            $query->execute();
        } catch (Exception $exc) {
            self::throwDbError($this->getDb()->errorInfo());
            //    $id = $iModele->GetId();
            //    $table = $this->sqlBuilder->GetTable();
            //    throw new NotFoundException("impossible mettre à jour id : {$id} dans la table {$table}");
        }
        if ($iModele->getId() === null) {
            $lastId = self::GetDb()->LastInsertID();
            $iModele->SetId($lastId);
        }
        return $iModele;
    }

    public function Update(\RallyeLecture\Model\IModele $iModele) {
        /* @var $query \PDOStatement */
        $update = $this->sqlBuilder->GetUpdate();
        $params = $iModele->GetParams();
        $query = self::GetDb()->prepare($update);
        $query = $this->bindParams($query, $params);
        try {
            $query->execute();
        } catch (Exception $exc) {
            self::throwDbError($this->getDb()->errorInfo());
            //    $id = $iModele->GetId();
            //    $table = $this->sqlBuilder->GetTable();
            //    throw new NotFoundException("impossible mettre à jour id : {$id} dans la table {$table}");
        }
        return $iModele;
    }

    private function bindParams(\PDOStatement $query, $params) {
        foreach ($params as $key => $param) {
            $query->bindParam($key, $param[0], $param[1]);
        }
        return $query;
    }

}

<?php

namespace RallyeLecture\Config;

final class Config {
    private static $data = null;  /** @var array */

    public static function GetConfig($section) {
        if ($section === null) {
            return self::getData();
        }
        $data = self::getData();
        if (!array_key_exists($section, $data)) {
            throw new Exception('section de configuration inconnue : ' . $section);
        }
        return $data[$section];
    }

    private static function getData() {
        if (self::$data !== null) {
            return self::$data;
        }
        self::$data = \parse_ini_file('..\src\config\config.ini',true);
        return self::$data;
    }
}

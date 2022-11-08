<?php
class Config {
    public static $url            = "";
    public static $rootDir        = "";
    public static $sqlHost        = "";
    public static $sqlUser        = "";
    public static $sqlPass        = "";
    public static $sqlScrema      = "";
}
Config::$sqlHost           = $_SERVER['sqlHost'];
Config::$sqlUser           = $_SERVER['sqlUser'];
Config::$sqlPass           = $_SERVER['sqlPass'];
Config::$sqlScrema         = $_SERVER['sqlScrema'];
Config::$rootDir           = $_SERVER['rootDir'];
Config::$url               = $_SERVER['url'];
?>

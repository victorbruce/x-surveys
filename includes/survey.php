<?php
include_once('database.php');

class Survey {


    public static function find_all() {
        global $database;

        $result_set = $database->query("SELECT * FROM surveys");
        return $result_set;
    } 

    public static function find_by_id($id="") {
        global $database;

        $result = $database->query("SELECT * FROM surveys WHERE id={$id}");
        $found = $database->fetch_array($result);
        return $found;
    }
}
?>
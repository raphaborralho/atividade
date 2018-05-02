<?php
error_reporting(E_ERROR);
class MyDB extends SQLite3 {
    function __construct() {
       $this->open('test.sqlite');
    }
 }
 
 $db = new MyDB();
 if(!$db) {
     header("Location: db.php");
    //echo $db->lastErrorMsg();
 }